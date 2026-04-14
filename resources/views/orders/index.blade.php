@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-clipboard2-fill me-2 text-success"></i>Orders</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>New Order
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Rice Item</th>
                    <th>Quantity (kg)</th>
                    <th>Total Cost</th>
                    <th>Date</th>
                    <th>Payment Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ $order->riceItem->name }}</td>
                    <td>{{ number_format($order->quantity_kg, 2) }} kg</td>
                    <td>₱{{ number_format($order->total_cost, 2) }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($order->payment)
                            @if($order->payment->status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-danger">Unpaid</span>
                            @endif
                        @else
                            <span class="badge bg-secondary">No Payment</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this order?')">
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
                    <td colspan="7" class="text-center text-muted py-4">No orders yet. Create one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection