@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-bag-fill me-2 text-success"></i>Rice Menu</h2>
    <a href="{{ route('rice-items.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>Add Rice Item
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price per kg</th>
                    <th>Stock (kg)</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riceItems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ $item->name }}</td>
                    <td>₱{{ number_format($item->price_per_kg, 2) }}</td>
                    <td>{{ number_format($item->stock_quantity, 2) }} kg</td>
                    <td>{{ $item->description ?? '—' }}</td>
                    <td class="text-center">
                        <a href="{{ route('rice-items.edit', $item) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('rice-items.destroy', $item) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this rice item?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No rice items found. Add one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection