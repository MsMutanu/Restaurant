@extends('layouts-frontend.app')
@section('title', 'profile | Cofee')
  
 
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2 pt-lg-5">
          <div class="col-sm-6 pt-lg-5">
            <h3>My Profile</h3>
          </div>
          <div class="col-sm-6 pt-lg-5">
            <ol class="breadcrumb float-sm-right bg-transparent">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-5">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('uploads/profile/avater.png')}}" alt="{{ Auth::user()->name }}">
                </div>

                <h3 class="profile-username text-center text-dark">{{ Auth::user()->name }} </h3>

                <p class="text-muted text-center">Regular User </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{ Auth::user()->phone }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Carts</b> <a class="float-right">{{ $cartcount }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>My Orders</b> <a class="float-right">{{ $ordercount }}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Continue</b></a>
              </div>
              <!-- /.card-body -->
            </div>
         
                  
            
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
 