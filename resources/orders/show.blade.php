@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white fw-bold">
                <i class="bi bi-clipboard2-fill me-2"></i>Order Details
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="bg-light" width="40%">Rice Item</th>
                        <td>{{ $order->riceItem->name }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Price per kg</th>
                        <td>₱{{ number_format($order->riceItem->price_per_kg, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Quantity</th>
                        <td>{{ number_format($order->quantity_kg, 2) }} kg</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Total Cost</th>
                        <td class="fw-bold text-success fs-5">₱{{ number_format($order->total_cost, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Date Ordered</th>
                        <td>{{ $order->created_at->format('F d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Payment Status</th>
                        <td>
                            @if($order->payment)
                                @if($order->payment->status === 'paid')
                                    <span class="badge bg-success fs-6">Paid</span>
                                @else
                                    <span class="badge bg-danger fs-6">Unpaid</span>
                                @endif
                            @else
                                <span class="badge bg-secondary fs-6">No Payment Recorded</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-3">
                    @if(!$order->payment)
                        <a href="{{ route('payments.create') }}" class="btn btn-success">
                            <i class="bi bi-cash me-1"></i>Process Payment
                        </a>
                    @endif
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection