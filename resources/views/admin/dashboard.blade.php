@extends('layouts.app')
@section('title', 'Admin || Dashboard')

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
         <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
               <div class="inner">
                  <h3>{{ $user }}</h3>
                  <p>Total Users</p>
               </div>
               <div class="icon">
                  <i class="ion ion-person"></i>
               </div>
               <a href="{{route('admin.dashboard')}}" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : '' }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
         </div>

         <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
               <div class="inner">
                  <h3>{{ $item }}</h3>
                  <p>Total Items</p>
               </div>
               <div class="icon">
                  <i class="ion ion-bag"></i>
               </div>
               <a href="{{route('item.index')}}" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : '' }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
         </div>

         <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
               <div class="inner">
                  <h3>{{ $reservation }}</h3>
                  <p>Total Reservations</p>
               </div>
               <div class="icon">
                  <i class="ion ion-clock"></i>
               </div>
               <a href="{{route('reservation.index')}}" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : '' }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
         </div>

         <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
               <div class="inner">
                  <h3>{{ $userOrder }}</h3>
                  <p>Total User Orders</p>
               </div>
               <div class="icon">
                  <i class="ion ion-android-cart"></i>
               </div>
               <a href="{{route('order.index')}}" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : '' }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
         </div>

      </div>

      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reservation Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="reservationChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      // Get the counts of pending and confirmed reservations from PHP variables
      var pendingCount = {{ $reservationpending }};
      var confirmedCount = {{ $reservationconfirmed }};
  
      // Create a pie chart using Chart.js
      var ctx = document.getElementById('reservationChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['Pending Reservations', 'Confirmed Reservations'],
              datasets: [{
                  data: [pendingCount, confirmedCount],
                  backgroundColor: ['#FF5733', '#33FF57'],
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              legend: {
                  position: 'bottom',
              },
          }
      });
  </script>
  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Status</h3>
            </div>
            <div class="card-body">
                <canvas id="orderChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get the counts of pending and confirmed orders from PHP variables
    var pendingCount = {{ $pendingOrderCount }};
    var confirmedCount = {{ $confirmedOrderCount }};

    // Create a pie chart using Chart.js
    var ctx = document.getElementById('orderChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pending Orders', 'Confirmed Orders'],
            datasets: [{
                data: [pendingCount, confirmedCount],
                backgroundColor: ['#FF5733', '#33FF57'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
            },
        }
    });
</script>

    
@endsection
