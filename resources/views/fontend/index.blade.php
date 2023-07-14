@extends('layouts-frontend.app')
@section('title', 'Home, Restaurant')
@section('content')

<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
	  <div class="container">
		<div class="row slider-text justify-content-center align-items-center">

		  <div class="col-md-7 col-sm-12 text-center ftco-animate">
			  <h1 class="mb-3 mt-5 bread">Welcome To Our Restaurant</h1>
			  
		  </div>

		</div>
	  </div>
	</div>
  </section>
 
    <section class="home-slider owl-carousel">
	 @foreach($sliders as $slider)
      <div class="slider-item" style="background: url('{{asset('uploads/slider/'.$slider->image)}}');background-size: cover; background-repeat :no-repeat">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">{{$slider->title}}</h1>
              <p class="mb-4 mb-md-5">{{$slider->sub_title}}</p>
              <p><a href="{{route('fontend.shop')}}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="{{route('fontend.menu')}}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>

          </div>
        </div>
      </div>
	   @endforeach
  
    </section>

    <section class="ftco-intro">
    	<div class="container-wrap">
	    		<div class="book p-4">
	    			<h3>Book a Table</h3>
	    			<form  class="appointment-form" method="POST" action="{{route('sentReservation')}}">
                                @csrf
                            

					<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" name="name" class="form-control" placeholder="Name">
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<input type="email"  name="email" class="form-control" placeholder="Last Name">
		    				</div>
	    				</div>
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<div class="input-wrap">
		            		<div class="icon"><span class="ion-md-calendar"></span></div>
		            		<input type="date" name="date"  placeholder="Date">
	            		</div>
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<div class="input-wrap">
		            		<div class="icon"><span class="ion-ios-clock"></span></div>
		            		<input type="time" name="time"  placeholder="Time" max="23:59">
	            		</div>
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<input type="text" name="phone" class="form-control" placeholder="Phone">
		    				</div>
	    				</div>
	    				<div class="d-md-flex">
	    					<div class="form-group">
		              <textarea name="description" id="" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
		            </div>
		            <div class="form-group ml-md-4">
		              <input type="submit" value="Appointment" class="btn btn-white py-3 px-4">
		            </div>
	    				</div>
	    			</form>
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
 
 
 
    

	 

    <section class="ftco-menu mb-5 pb-5">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	
            <h2 class="mb-4">Our Products</h2>
            
          </div>
        </div>
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">

		          <div class="col-md-12 nav-link-wrap mb-5">
					 <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						@foreach($categorys as $key=>$category)
						<a class="nav-link {{$key==0 ? 'active' : ''}}" id="v-pills-{{$category->id}}-tab" data-toggle="pill" href="#{{$category->id}}" role="tab" aria-controls="{{$category->id}}" aria-selected="true">{{$category->name}}</a>
						@endforeach
		             </div>
				  </div>

		        <div class="col-md-12 d-flex align-items-center">
		            
				  <div class="tab-content ftco-animate" id="v-pills-tabContent">
					@foreach($categorys as $key=>$category)
		              <div class="tab-pane fade show {{$key==0 ? 'active' : ''}}" id="{{$category->id}}" role="tabpanel" aria-labelledby="v-pills-{{$category->id}}-tab">
		              	<div class="row">

						@php
						$products = DB::table('items')->where('category_id', $category->id)->orderBy('created_at','DESC')->get()->take(10);
						@endphp

						@foreach($products as $item)
						<a href="{{route('fontend.viewproduct',$item->id)}}">
		              		<div class="col-md-4 text-center" style="min-width:300px; max-width: 350px;">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url('{{asset('uploads/item/'.$item->image)}}');"></a>
		              				<div class="text">
		              					<h3><a href="#">{{ $item->item_name}}</a></h3>
		              					<p class="descriptions">{{ $item->description}}</p>
		              					<p class="price"><span>Ksh {{ $item->price}}</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
						</a>
					    @endforeach  


		              	</div>
		              </div>
					  @endforeach
 
                    </div>
					
		          </div>
		        </div>
		      </div>
		    </div>
    	</div>
    </section>
 
   

	 
		
		<section class="ftco-appointment">
			<div class="overlay"></div>
    	<div class="container-wrap">
    		<div class="row no-gutters d-md-flex align-items-center">
    			
	    		<div class="col-md-6 appointment ftco-animate">
	    			<h3 class="mb-3">Book a Table</h3>
	    				    			<form  class="appointment-form" method="POST" action="{{route('sentReservation')}}">
                                @csrf
                            

					<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" name="name" class="form-control" placeholder="Name">
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<input type="email"  name="email" class="form-control" placeholder="Last Name">
		    				</div>
	    				</div>
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<div class="input-wrap">
		            		<div class="icon"><span class="ion-md-calendar"></span></div>
		            		<input type="date" name="date"  placeholder="Date">
	            		</div>
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<div class="input-wrap">
		            		<div class="icon"><span class="ion-ios-clock"></span></div>
		            		<input type="time" name="time"  placeholder="Time" max="23:59">


	            		</div>
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<input type="text" name="phone" class="form-control" placeholder="Phone">
		    				</div>
	    				</div>
	    				<div class="d-md-flex">
	    					<div class="form-group">
		              <textarea name="description" id="" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
		            </div>
                    <div class="form-group ml-md-4">
		              <input type="submit" value="Appointment" class="btn btn-primary py-3 px-4">
		            </div>  
	    				</div>
	    			</form>
	    		</div>    			
    		</div>
    	</div>
    </section>

@endsection