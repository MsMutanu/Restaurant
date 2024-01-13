@extends('layouts-frontend.app')
@section('title', 'menu ')
@section('content')


    <section class="ftco-section">
    	<div class="container">
			<div class="col-md-12 text-start ftco-animate">
            	<h1 class="m-0 p-0 bread"></h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('fontend.index')}}">Home</a></span><span>/</span> <span>menu</span></p>
            </div>

    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">


            <h2 class="mb-4">Our Menus</h2>

          </div>
        </div>
        <div class="row">


            @foreach($categories as $category)
        	<div class="col-md-6 mb-5 pb-3">
        		<h3 class="mb-5 heading-pricing ftco-animate">{{$category->name}}</h3>

				@php
				$products = DB::table('items')->where('category_id', $category->id)->orderBy('created_at','DESC')->get()->take(10);
				@endphp

                @foreach($products as $item)
				<a href="{{route('fontend.viewproduct',$item->id)}}">
				<div class="pricing-entry d-flex ftco-animate">
        			<div class="img" style="background-image: url('{{asset('uploads/item/'.$item->image)}}');"></div>
        			<div class="desc pl-3">
	        			<div class="d-flex text align-items-center">
	        				<h3><span>{{ $item->item_name}}</span></h3>
	        				<span class="price">Ksh{{ $item->price}}</span>
	        			</div>
	        			<div class="d-block">
	        				<p>{{ $item->description}}</p>
	        			</div>
	        		</div>
        		</div>
               </a>
        	   @endforeach
        	</div>
			 @endforeach


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
                        <div class="col-md-3">
                            @include('fontend.user.cart', ['cartItems' => $cartItems, 'cartTotal' => $cartTotal])
                        </div>
                        <div>
                            <button onclick="window.location='{{ route('fontend.checkout') }}'">Proceed to Checkout</button>
                        </div>

		          <div class="col-md-12 nav-link-wrap mb-5">
					 <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						@foreach($categories as $key=>$category)
						<a class="nav-link {{$key==0 ? 'active' : ''}}" id="v-pills-{{$category->id}}-tab" data-toggle="pill" href="#{{$category->id}}" role="tab" aria-controls="{{$category->id}}" aria-selected="true">{{$category->name}}</a>
						@endforeach
		             </div>
				  </div>

		        <div class="col-md-12 d-flex align-items-center">

				  <div class="tab-content ftco-animate" id="v-pills-tabContent">
					@foreach($categories as $key=>$category)
		              <div class="tab-pane fade show {{$key==0 ? 'active' : ''}}" id="{{$category->id}}" role="tabpanel" aria-labelledby="v-pills-{{$category->id}}-tab">
		              	<div class="row">

						@php
						$products = DB::table('items')->where('category_id', $category->id)->orderBy('created_at','DESC')->get()->take(10);
						@endphp

						@foreach($products as $item)
						<a href="{{route('fontend.viewproduct',$item->id)}}">
		              		<div class="col-md-4 text-center" style="min-width:300px; max-width: 350px;">
		              			<div class="menu-wrap">
		              				<a href="{{route('fontend.viewproduct',$item->id)}}" class="menu-img img mb-4" style="background-image: url('{{asset('uploads/item/'.$item->image)}}');"></a>
		              				<div class="text">
		              					<h3><a href="{{route('fontend.viewproduct',$item->id)}}">{{ $item->item_name}}</a></h3>
		              					<p class="descriptions">{{ $item->description}}</p>
		              					<p class="price"><span>Ksh {{ $item->price}}</span></p>
                                          <form action="{{route('cart.add')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf

                                           <input type="hidden" name="item_id" value="{{$item->id}}" class="form-control">
                                           <input type="hidden" name="total" value="1" class="form-control">
                                           <input type="hidden" name="price" value="{{$item->price}}" class="form-control">
                                           <input type="hidden" name="quantity" value="1">

                                             @if (Route::has('login'))
                                             @auth
                                             <button type="submit" class="btn btn-primary pull-right mt-4">Add to Cart</button>
                                                 @else
                                                 <button class="btn btn-primary pull-right mt-4"><a class="text-dark" href="{{route('user.login')}}">Add to Cart</a></button>

                                             @endauth
                                             @endif
                                              <div class="clearfix"></div>
                                       </form>
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

  @endsection
