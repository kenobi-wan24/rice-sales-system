@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-bold">
                <i class="bi bi-cash me-2"></i>Record Payment
            </div>
            <div class="card-body">

                @if($orders->isEmpty())
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        No unpaid orders available. All orders already have payments recorded.
                    </div>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back to Orders
                    </a>
                @else
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Order</label>
                            <select name="order_id" id="orderSelect"
                                    class="form-select @error('order_id') is-invalid @enderror">
                                <option value="">-- Select an order --</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}"
                                            data-total="{{ $order->total_cost }}"
                                            {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                        Order #{{ $order->id }} — {{ $order->riceItem->name }}
                                        ({{ number_format($order->quantity_kg, 2) }} kg)
                                        — ₱{{ number_format($order->total_cost, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('order_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Order Total Preview --}}
                        <div class="mb-3 p-3 bg-light rounded border">
                            <div class="d-flex justify-content-between">
                                <span class="fw-semibold text-muted">Order Total:</span>
                                <span class="fw-bold text-success" id="orderTotal">₱0.00</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Amount Paid (₱)</label>
                            <input type="number" name="amount_paid" step="0.01" min="0"
                                   class="form-control @error('amount_paid') is-invalid @enderror"
                                   value="{{ old('amount_paid') }}" placeholder="0.00">
                            @error('amount_paid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Payment Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="paid"   {{ old('status') === 'paid'   ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ old('status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i>Save Payment
                            </button>
                            <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Cancel
                            </a>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>

<script>
    const orderSelect = document.getElementById('orderSelect');
    const orderTotal  = document.getElementById('orderTotal');

    orderSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const total    = parseFloat(selected.dataset.total) || 0;
        orderTotal.textContent = '₱' + total.toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    });
</script>
@endsection