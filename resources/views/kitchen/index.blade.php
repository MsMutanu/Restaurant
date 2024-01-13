@extends('layouts.kitchen')
@section('title', 'Kitchen Staff Dashboard')

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
                        <h3>{{ $incomingOrders }}</h3>
                        <p>Incoming Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                    <a href="{{ route('kitchen.orders.incoming') }}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $inProgress }}</h3>
                        <p>In Progress</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                    <a href="{{ route('kitchen.orders.inprogress') }}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $readyOrders }}</h3>
                        <p>Ready to Deliver</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-restaurant"></i>
                    </div>
                    <a href="{{ route('kitchen.orders.ready') }}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
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
    <!-- Low Stock Items Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Low Stock Items</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity In Stock</th>
                                    <th>Availability</th>
                                    <th>Update Availability</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockItems as $item)
                                    <tr>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->in_stock }}</td>
                                        <td>@if($item->availability == 1)
                                            Available
                                        @else
                                            Unavailable
                                        @endif</td>
                                        <td>
                                            <form action="{{ route('kitchen.updateMenuItemAvailability', ['item' => $item->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <!-- Include the 'in_stock' field as a hidden input -->
                                                <input type="hidden" name="in_stock" value="{{ $item->in_stock }}">
                                                <select name="availability" class="form-control">
                                                    <option value="1" {{ $item->availability == 1 ? 'selected' : '' }}>Available</option>
                                                    <option value="0" {{ $item->availability == 0 ? 'selected' : '' }}>Unavailable</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
