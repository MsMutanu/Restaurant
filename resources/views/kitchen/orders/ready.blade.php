@extends('layouts.kitchen')
@section('title', 'Ready Orders')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($readyOrders as $order)
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


                    <script>
                        function updateTimer() {
                            var timerElements = document.querySelectorAll('.timer');

                            timerElements.forEach(function (element) {
                                var createdTime = parseInt(element.getAttribute('data-created-time'));
                                var currentTime = Math.floor(Date.now() / 1000); // Get current time in seconds
                                var timeRemaining = 600 - (currentTime - createdTime);

                                // Calculate minutes and seconds
                                var minutes = Math.floor(timeRemaining / 60);
                                var seconds = timeRemaining % 60;

                                if (timeRemaining <= 0) {
                                    // Time is up, set to red
                                    element.classList.add('text-danger');
                                    element.textContent = 'Priority!';
                                } else {
                                    // Display time remaining
                                    element.textContent = 'Time Remaining: ' + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                                }
                            });
                        }

                        // Initial update
                        updateTimer();

                        // Update the timer every second
                        setInterval(updateTimer, 1000);
                    </script>



                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
