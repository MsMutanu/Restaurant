@extends('layouts.waiter')

@section('title', 'Create Order')

@section('content')
    <div class="container">
        <h1>Create Order</h1>

        <!-- Menu Items Section -->
        <div class="menu-items">
            <h2>Menu Items</h2>
            <ul>
                @php
						$categories = DB::table('categories')->orderBy('created_at','DESC')->get()->take(10);
						@endphp

            @foreach($categories as $category)
        	<div class="col-md-6 mb-5 pb-3">
        		<h3 class="mb-5 heading-pricing ftco-animate">{{$category->name}}</h3>
                @php
						$categories = DB::table('categories')->orderBy('created_at','DESC')->get()->take(10);
						@endphp

						@php
						$menuItems = DB::table('items')->where('category_id', $category->id)->orderBy('created_at','DESC')->get()->take(10);
						@endphp
                @foreach ($menuItems as $item)
                <div class="col-md-4 text-center" style="min-width:300px; max-width: 450px;">
                    <div class="menu-wrap">

                        <a  class="menu-img-circle menu-img img mb-4" style="background-image: url('{{asset('uploads/item/'.$item->image)}}');"></a>

                        <div class="text">
                            <h3>{{ $item->item_name}}</h3>
                            <form action="{{route('waiter.addToCart')}}" method="POST"  enctype="multipart/form-data">
                                @csrf

                               <input type="hidden" name="item_id" value="{{$item->id}}" class="form-control">
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


                @endforeach
                @endforeach
            </ul>
        </div>
        <div>
            @include('fontend.user.cart', ['cartItems' => $cartItems, 'cartTotal' => $cartTotal])
        </div>

        <!-- Order Details and Submit Button -->
        <div class="order-details">
            <h2>Order Details</h2>

            <form action="{{ route('waiter.createOrder') }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Customer Name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="table_id">Choose a Table</label>
                    <select name="table_id" id="table_id" class="form-control" required>
                        <option value="">Select a Table</option> <!-- Add an empty option to force selection -->
                        @foreach($restauranttables as $table)
                            <option value="{{ $table->id }}">{{ $table->name }}</option>
                        @endforeach
                    </select>
                </div>


                <button type="submit">Submit Order</button>
            </form>
        </div>
    </div>


@endsection
