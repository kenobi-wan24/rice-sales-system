@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-bold">
                <i class="bi bi-plus-circle me-2"></i>Create New Order
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Rice Item</label>
                        <select name="rice_item_id" id="riceItemSelect"
                                class="form-select @error('rice_item_id') is-invalid @enderror">
                            <option value="">-- Select a rice item --</option>
                            @foreach($riceItems as $item)
                                <option value="{{ $item->id }}"
                                        data-price="{{ $item->price_per_kg }}"
                                        {{ old('rice_item_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }} — ₱{{ number_format($item->price_per_kg, 2) }}/kg
                                    (Stock: {{ number_format($item->stock_quantity, 2) }} kg)
                                </option>
                            @endforeach
                        </select>
                        @error('rice_item_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Quantity (kg)</label>
                        <input type="number" name="quantity_kg" id="quantityInput" step="0.01" min="0.1"
                               class="form-control @error('quantity_kg') is-invalid @enderror"
                               value="{{ old('quantity_kg') }}" placeholder="0.00">
                        @error('quantity_kg')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Live Total Cost Preview --}}
                    <div class="mb-4 p-3 bg-light rounded border">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-muted">Estimated Total:</span>
                            <span class="fw-bold fs-5 text-success" id="totalCost">₱0.00</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>Place Order
                        </button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const riceSelect  = document.getElementById('riceItemSelect');
    const quantityInput = document.getElementById('quantityInput');
    const totalCost   = document.getElementById('totalCost');

    function computeTotal() {
        const selectedOption = riceSelect.options[riceSelect.selectedIndex];
        const price    = parseFloat(selectedOption.dataset.price) || 0;
        const quantity = parseFloat(quantityInput.value) || 0;
        const total    = price * quantity;
        totalCost.textContent = '₱' + total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    riceSelect.addEventListener('change', computeTotal);
    quantityInput.addEventListener('input', computeTotal);
</script>
@endsection