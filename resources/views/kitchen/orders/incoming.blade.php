@extends('layouts.kitchen')
@section('title', 'Incoming Orders')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($incomingOrders as $order)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header ">
                    <h5>Table: {{ $order->table_id }}</h5>
                    <p>Customer: {{ $order->firstname }}</p>
                </div>
                <div class="card-body bg-warning", >
                    <h6>Order Items:</h6>
                    <ul>
                        @foreach ($order->items as $item)
                        <li>{{ $item->item_name }}- Quantity: {{ $item->pivot->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    @php
                    // Calculate time remaining (in seconds)
                    $createdTime = strtotime($order->created_at);
                    $currentTime = time();
                    $timeRemaining = 600 - ($currentTime - $createdTime);

                    // Set the timer color based on remaining time
                    $timerColor = $timeRemaining < 0 ? 'text-danger' : 'text-success';

                    // Format the remaining time
                    $minutes = floor($timeRemaining / 60);
                    $seconds = $timeRemaining % 60;
                    @endphp

                    <span class="{{ $timerColor }}">
                        @if ($timeRemaining > 0)
                        Time Remaining: {{ $minutes }}:{{ str_pad($seconds, 2, '0', STR_PAD_LEFT) }}
                        @else
                        Priority!
                        @endif
                    </span>
                    <form action="{{ route('kitchen.orders.markInProgress', $order->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-info btn-sm">Mark as In Progress</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
