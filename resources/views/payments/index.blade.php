@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-cash-stack me-2 text-success"></i>Payments</h2>
    <a href="{{ route('payments.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>Record Payment
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Rice Item</th>
                    <th>Order Total</th>
                    <th>Amount Paid</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ $payment->order->riceItem->name }}</td>
                    <td>₱{{ number_format($payment->order->total_cost, 2) }}</td>
                    <td>₱{{ number_format($payment->amount_paid, 2) }}</td>
                    <td>
                        @if($payment->status === 'paid')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                    <td>{{ $payment->created_at->format('M d, Y') }}</td>
                    <td class="text-center">
                        {{-- Toggle Status --}}
                        <form action="{{ route('payments.update', $payment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            @if($payment->status === 'unpaid')
                                <input type="hidden" name="status" value="paid">
                                <button type="submit" class="btn btn-sm btn-success me-1" title="Mark as Paid">
                                    <i class="bi bi-check-circle-fill"></i>
                                </button>
                            @else
                                <input type="hidden" name="status" value="unpaid">
                                <button type="submit" class="btn btn-sm btn-warning me-1" title="Mark as Unpaid">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            @endif
                        </form>

                        {{-- Delete --}}
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this payment record?')">
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
                    <td colspan="7" class="text-center text-muted py-4">No payment records yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection