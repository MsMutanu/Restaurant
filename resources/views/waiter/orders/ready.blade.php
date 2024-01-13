@extends('layouts.waiter')
@section('title', 'Ready Orders')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($orders as $order)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Table: {{ $order->table_id }}</h5>
                    <p>Customer: {{ $order->firstname }}</p>
                </div>
                <div class="card-body bg-success">
                    <h6>Order Items:</h6>
                    <ul>
                        @foreach ($order->items as $item)
                        <li>{{ $item->item_name }}- Quantity: {{ $item->pivot->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <span class="timer" data-created-time="{{ strtotime($order->created_at) }}"></span>
                    <!-- Button to mark the order as "Completed" -->
                    <form action="{{ route('waiter.orders.markCompleted', $order->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                    </form>


                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
