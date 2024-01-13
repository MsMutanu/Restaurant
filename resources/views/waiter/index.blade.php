@extends('layouts.waiter')
@section('title', 'Waiter Dashboard')

@section('header')
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $orderedOrders }}</h3>
                        <p>Ordered Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                    <a href="{{ route('waiter.ordered') }}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $inProgressOrders }}</h3>
                        <p>In Progress</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                    <a href="{{ route('waiter.inprogress') }}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $readyForDeliveryOrders }}</h3>
                        <p>Ready for Delivery</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                    <a href="{{ route('waiter.ready') }}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $completedOrders }}</h3>
                        <p>Completed</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Order Button -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('waiter.create') }}" class="btn btn-primary">Create New Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Performance Chart -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Waiter Performance Chart</h3>
                    </div>
                    <div class="card-body ">
                        <div class="performance-chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

    const orderCounts = @json($orderCounts);

    // Create the chart
    const ctx = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({ length: orderCounts.length }, (_, i) => (i + 1).toString()),
            datasets: [{
                label: 'Orders Made',
                data: orderCounts,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>



                    </div>
                </div>
            </div>
        </div>

        <!-- Create Order Button -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('waiter.create') }}" class="btn btn-primary">Create New Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
