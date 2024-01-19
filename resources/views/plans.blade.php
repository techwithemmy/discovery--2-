@include('header')


 <!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">  <a class="btn btn-default" href="#" data-toggle="modal" data-target="#plansModal"><i class="fa fa-plus"></i> Add A New Package</a>
         </h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Choose</li>
                                <li class="breadcrumb-item active"><a href="#">Plan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->


        @if(Session::has('message'))
                <div class="alert alert-primary" role="alert">
                               <center>    {{ Session::get('message') }}</center> 
                                </div>
        @endif
        
        
         <div class="row">
@foreach($plans as $plan)
                    <div class="col-12 col-lg-6  col-xl-4 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header" style="text-transform: uppercase;"><center>{{$plan->name}} PACKAGE</center><br><center>
                            @if(Auth::user()->type=="1")
								<a href="#" data-toggle="modal" data-target="#editplansModal{{$plan->id}}" class="btn btn-default"><i class="fa fa-pencil"></i><font color="black">Edit Plan</font></a>&nbsp; &nbsp;
								<a href="{{ url('dashboard/trashplan') }}/{{$plan->id}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete Plan</a>
								@endif</center></div>
                            <div class="card-body">
                                 STARTING FROM:<span class="float-right">{{$settings->currency}}{{$plan->price}}</span><hr>
                                 MINIMUM:<span class="float-right">{{$settings->currency}}{{$plan->min_price}}</span><hr>
                                 MAXIMUM:<span class="float-right">{{$settings->currency}}{{$plan->max_price}}</span><hr>
                                INTEREST:<span class="float-right">{{$plan->increment_amount}} {{$plan->increment_interval}}</span><hr>
                                 DURATION:<span class="float-right">{{$plan->expiration}}</span><hr>
                                <p class="card-text">                          <center class="mb-3">
                             <p><strong><a class="float-center">
                                 
                                 <form style="padding:3px;" role="form" method="post" action="{{action('Controller@joinplan')}}">
                                     
                                 <select class="form-control" name="duration">
            									<option>{{$plan->expiration}}</option>
            								
            								</select>
                                 <hr>
                                        <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Username</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">{{$settings->currency}}</div>
        </div>
        
        <input type="number" class="form-control" min="{{$plan->min_price}}" max="{{$plan->max_price}}" name="iamount" placeholder="Type in minimum of {{$plan->price}}" required>
      </div>
    </div>
            							 <center>    <input type="hidden" name="id" value="{{ $plan->id }}">
            					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
            					   		<input type="submit" class="btn btn-primary" value="Join plan"> </center> 
            					   </form>
            					   
            					   </a></strong></p>
                            </center>
                            </p>
                            </div>
                        </div>
                    </div>
                    <!-- edit Plans Modal -->
			<div id="editplansModal{{$plan->id}}" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
              		<form style="padding:3px;" role="form" method="post" action="{{action('Controller@updateplan')}}">
					  <label>Plan name</label><br/>	   
					  <input style="padding:5px;" class="form-control" value="{{$plan->name}}" type="text" name="name" required><br/>
					  <label>Plan price</label><br/>		 
					  <input style="padding:5px;" class="form-control" value="{{$plan->price}}" type="text" name="price" required><br/>
					  <label>Plan MIN. price</label><br/>		 
					  <input style="padding:5px;" class="form-control" value="{{$plan->min_price}}" type="text" name="min_price" required><br/>
					  <label>Plan MAX. price</label><br/>		 
					  <input style="padding:5px;" class="form-control" value="{{$plan->max_price}}" type="text" name="max_price" required><br/>
					  <label>Plan expected return (ROI)</label><br/>
					  <input style="padding:5px;" class="form-control" placeholder="Enter expected return" value="{{$plan->expected_return}}" type="text" name="return" required><br/>
								 <label>top up interval</label><br/>
                               <select class="form-control" name="t_interval">
									<option>{{$plan->increment_interval}}</option>
									<option>Monthly</option>
									<option>Weekly</option>
									<option>Daily</option>
									<option>Hourly</option>
								</select><br>
								<label>top up type</label><br/>
                               <select class="form-control" name="t_type">
									<option>{{$plan->increment_type}}</option>
									<option>Percentage</option>
									<option>Fixed</option>
								</select><br>
								<label>top up amount (in % or $ as specified above)</label><br/>
                               <input style="padding:5px;" class="form-control" value="{{$plan->increment_amount}}" placeholder="top up amount" type="text" name="t_amount" required><br/>
							   <label>Investment duration</label><br/>
                               <select class="form-control" name="expiration">
									<option>{{$plan->expiration}}</option>
									<option>One week</option>
									<option>One month</option>
									<option>Three months</option>
									<option>Six months</option>
									<option>One year</option>
								</select><br>
							   <input type="hidden" name="id" value="{{ $plan->id }}">
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<input type="submit" class="btn btn-default" value="Submit" >
					   </form>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- /edit plans Modal -->
@endforeach
</div>

<br><br><br>
        
        
        
		@include('modals')
		@include('footer')