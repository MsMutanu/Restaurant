@extends('layouts-frontend.app')
@section('title', 'about-us | Cofee')
@section('content')
 

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">About Us</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('fontend.index')}}">Home</a></span> <span>About</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(images/about.jpg);"></div>
    	<div class="one-half ftco-animate">
    		<div class="overlap">
	        <div class="heading-section ftco-animate ">
	        	
	          <h2 class="mb-4">Our Story</h2>
	        </div>
	        <div>
	  				<p>A premier dining destination in the heart of Nairobi. With our passion for culinary excellence and commitment to exceptional service, we aim to create unforgettable dining experiences for our guests.</p>
	  			</div>
  			</div>
    	</div>
    </section>

    

    

    
 
  @endsection
