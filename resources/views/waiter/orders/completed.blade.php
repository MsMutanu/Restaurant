@extends('layouts.waiter')
@section('title', 'Incoming Orders')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($orders as $order)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header ">
                    <h5>Table: {{ $order->table_id }}</h5>
                    <p>Customer: {{ $order->firstname }}</p>
                </div>
                <div class="card-body bg-success", >
                    <h6>Order Items:</h6>
                    <ul>
                        @foreach ($order->items as $item)
                        <li>{{ $item->item_name }}- Quantity: {{ $item->pivot->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                <h5>Payment Status</h5>
            <p>{{$order->order_payment_status}}</p>
            <form action="{{ route('waiter.updatePayment', $order->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-info btn-sm">Confirm Payment</button>
            </form>
            </div>
            </div>


            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
