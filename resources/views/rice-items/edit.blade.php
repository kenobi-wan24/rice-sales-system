@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-warning fw-bold">
                <i class="bi bi-pencil-fill me-2"></i>Edit Rice Item
            </div>
            <div class="card-body">
                <form action="{{ route('rice-items.update', $riceItem) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rice Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $riceItem->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price per kg (₱)</label>
                        <input type="number" name="price_per_kg" step="0.01"
                               class="form-control @error('price_per_kg') is-invalid @enderror"
                               value="{{ old('price_per_kg', $riceItem->price_per_kg) }}">
                        @error('price_per_kg')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stock Quantity (kg)</label>
                        <input type="number" name="stock_quantity" step="0.01"
                               class="form-control @error('stock_quantity') is-invalid @enderror"
                               value="{{ old('stock_quantity', $riceItem->stock_quantity) }}">
                        @error('stock_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description <span class="text-muted">(optional)</span></label>
                        <textarea name="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Brief description of this rice variety">{{ old('description', $riceItem->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-1"></i>Update Item
                        </button>
                        <a href="{{ route('rice-items.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection