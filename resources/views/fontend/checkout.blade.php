@extends('layouts-frontend.app')
@section('title', 'checkout ')
@section('content')
 
     
          
     

    <section class="ftco-section">
      <div class="container">
		  <div class="row slider-text justify-content-start align-items-start">
            <div class="col-md-7 col-sm-12 ftco-animate">
            	  <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> / <span>Checout</span></p>
            </div>
          </div>
        <div class="row">

   @if (Route::has('login'))
    @auth
			<div class="col-xl-8 ftco-animate">
			<form action="{{route('order.store')}}" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
				
		  
			 @csrf

                       @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

				<h3 class="mb-4 billing-heading">Billing Details</h3>
		  
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">Firt Name</label>
	                  <input type="text" name="firstname" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Last Name</label>
	                  <input type="text" name="lastname" class="form-control" placeholder="">
	                </div>
                </div>
                <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
		            		<label for="country">State / Country</label>
		            		<input type= "text" name="country" id="" class="form-control">
		                  	
		                </div>
		            	</div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="streetaddress">Street Address</label>
	                  <input type="text" name="line1" class="form-control" placeholder="House number and street name">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                  <input type="text" name="line-2" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">Town / City</label>
	                  <input type="text" name="city" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postcodezip">Postcode / ZIP *</label>
	                  <input type="text" name="postcode" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input type="text" name="phone" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Email Address</label>
	                  <input type="text" name="email" class="form-control" placeholder="">
	                </div>
                </div>
               
	            </div>
	         



	          <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>

	          			<p class="d-flex">
							     <input type="hidden" name="item_id" value="{{$cart->item_id}}">
							     	<span>Quantity</span>
		    						<span>  {{ $quantity = $cart->quantity }}</span>
									<input type="hidden" name="quantity" value="{{$quantity}}">
		    					</p>

	          			<p class="d-flex">
							     <span>Single Price</span>
		    						<span> Ksh {{ $single_price = $cart->item->price}}</span>
									<input type="hidden" name="subtotal" value="{{$single_price}}">
		    					</p>

	          			<p class="d-flex">
							     <input type="hidden" name="item_id" value="{{$cart->item_id}}">
							     	<span>Subtotal</span>
		    						<span> Ksh {{ $price = $quantity * $single_price}}</span>
									<input type="hidden" name="subtotal" value="{{$price}}">
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery Charge</span>
		    						<span>Ksh {{ $delevary =  30}}</span>
									<input type="hidden" name="tax" value="{{$delevary}}">
		    					</p>
 

		    					<p class="d-flex">
		    						<span>Discount</span>
		    						<span>Ksh{{ $discount = $price/100*2  }}</span>
									<input type="hidden" name="discount" value="{{$discount}}">
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
		    						<span>Ksh {{ $total = $price + $delevary - $discount}}</span>
									<input type="hidden" name="total" value="{{$total}}">
								 
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group d-none">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2" value="bank transfer"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div>
 
									<div class="form-group d-none">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2" value="papel"> Paypal</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2" value="cash on delivary"> Cash on delibary</label>
											</div>
										</div>
									</div>									
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="checked" class="mr-2"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									<button type="submit" name="submit" class="btn btn-primary py-3 px-4">Place an order</button>
									 
								</div>
	          	</div>
				   </form><!-- END -->
	          </div>
          
			  @else
 
@section('content')
<div class="row hold-transition login-page justify-content-center bg-white h-100" >
<div class="col-md-4 login-box my-5">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary shadow">
    <div class="card-header text-center">
      <a href=" " class="h1"><b>User</b>Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">please login first</p>
 
      <form action="{{route('userslogin')}}" method="POST">
         @csrf
         

        <div class="input-group mb-3 border">

          <input type="email" id="email" name="email" class="form-control border @error('email') is-invalid @enderror"
          value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-envelope"></span> </div>
          </div>
          
           @error('email')
            <span class="invalid-feedback" role="alert">
                <strong style="color:red">{{ $message }}</strong>
            </span>
            @enderror
                               

        </div>



        <div class="input-group mb-3 border">
          <input type="password" name="password"  id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
              required autocomplete="current-password">


          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-lock"></span> </div>
          </div>
              @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                         </span>
                          @enderror
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary mx-4">
                <input class="form-check-input" type="checkbox" name="remember"
                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>



            </div>
          </div>

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
      <p class="mb-1">
          @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
               {{ __('Forgot Your Password?') }}
            </a>
          @endif
           </p>

          @if (Route::has('register'))
                    
            <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                      
          @endif
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
</div>
@endsection
 
	        @endauth
          @endif
          </div> <!-- .col-md-8 -->
 

			

          
        </div>
      </div>
    </section> <!-- .section -->
 

  @endsection