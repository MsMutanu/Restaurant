@extends('layouts-frontend.app')
@section('title', 'Home, Coffee-Shop || Coffee')
@section('content')

<section class="appointment">
    <div class="container">
        <div class="row justify-content-center align-items-center py-sm-3 py-lg-5">
            <div class="col-md-6 appointment ftco-animate shadow border border-rounded">
                <h3 class="mb-3">Book a Table</h3>
                <form class="appointment-form" method="POST" action="{{ route('sentReservation') }}">
                    @csrf

                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group ml-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <div class="input-wrap">
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input type="date" name="date" placeholder="Date">
                            </div>
                        </div>
                        <div class="form-group ml-md-4">
                            <div class="input-wrap">
                                <div class="icon"><span class="ion-ios-clock"></span></div>
                                <input type="time" name="time" placeholder="Time" max="23:59">
                            </div>
                        </div>
                        <div class="form-group ml-md-4">
                            <input type="text" name="phone" class="form-control" placeholder="Phone">
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <label for="table_id" class="block text-sm font-medium text-gray-700">Choose a Table</label>
                            <select name="table_id" id="table_id" class="form-control" style="background-color: black; ">
								@foreach($tables as $table)
								<option value="{{ $table->id }}">{{ $table->name }}</option>
								@endforeach
							</select>
                        </div>
                        <div class="form-group ml-md-4">
                            <textarea name="description" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="form-group ml-md-4">
                        <input type="submit" value="Appointment" class="btn btn-primary py-3 px-4">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- End Appointment Section -->




	 
    
    <section class="ftco-intro">
    	<div class="container-wrap">
    		<div class="row wrap justify-content-center">
	    		<div class="col-lg-10 info bg-transparent">
	    			<div class="row">
	    				<div class="col-md-4 ftco-animate">
	    					<div class="icon"><span class="icon-phone"></span></div>
	    					<div class="text">
	    						<h3>0796510665</h3>
	    						
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-my_location"></span></div>
	    					<div class="text">
	    						<h3>Nairobi, South B</h3>
	    						
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-clock-o"></span></div>
	    					<div class="text">
	    						<h3>Open Monday-Friday</h3>
	    						<p>8:00am - 9:00pm</p>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		 
    		</div>
    	</div>
    </section>
 


	<section class="ftco-appointment bg-transparent">
	 <div class="container-wrap">
    		<div class="row no-gutters d-md-flex align-items-center">
    			
	    	   			
    		</div>
    	</div>
    </section>

 
   
 

@endsection