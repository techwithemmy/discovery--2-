@include('header')


<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Active Packages</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Active</li>
                                <li class="breadcrumb-item active"><a href="#">Packages</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
        @if(Session::has('message'))
                <div class="alert alert-primary" style="text-align:center;" role="alert">
                                    {{ Session::get('message') }}
                                </div>
        @endif
        
        @if(count($errors) > 0)
         @foreach ($errors->all() as $error)
         <div class="alert alert-primary" role="alert">
                             {{ $error }}
                                </div>
         @endforeach
        @endif
        
                     
                     <div class="row">

                    <div class="col-12 col-lg-12  col-xl-12 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header" style="text-transform: uppercase;"><center>{{$cplan->dplan->name}} PACKAGE ACTIVE </center></div>
                            <div class="card-body">
                                 STATUS:<span class="float-right">@if($cplan->active=="yes")
                                    <p style="color:green;">ACTIVE <i class="glyphicon glyphicon-ok"></i></p>
                                    @elseif($cplan->active=="expired")
                                    <p style="color:red;">Expired! <i class="fa fa-info-circle"></i></p>
                                    @else
                                    <p style="color:gray;">INACTIVE <i class="fa fa-info-circle"></i></p>
                                    @endif</span><hr>
                                 PACKAGE NAME:<span class="float-right">{{$cplan->dplan->name}} </span><hr>
                                 AMOUNT:<span class="float-right">{{$settings->currency}}{{$cplan->amount}}</span><hr>
                                 DURATION:<span class="float-right">{{$cplan->inv_duration}}</span><hr>
                                 DATE ACTIVATED:<span class="float-right">{{\Carbon\Carbon::parse($cplan->created_at)->toDayDateTimeString()}} </span>
                                
                            </div>
                        </div>
                    </div>
                    

</div>


                <div class="row">
                    <div class="col-12 col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group mb-2">
                                   <strong> CONCURRENT PLANS</strong>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                <tr>
                  <th>PACKAGE NAME</th>
                  <th>AMOUNT</th>
                  <th>DATE</th>
                  <th>STATUS</th>
                </tr>
                                        </thead>
                                        <tbody>
                                      @foreach($plans as $plan)
                @if($cplan->id != $plan->id)
                <tr>
                  <td>{{$plan->dplan->name}}</td>
                  <td>{{$settings->currency}}{{$plan->amount}}</td>
                  <td>{{\Carbon\Carbon::parse($plan->created_at)->toDayDateTimeString()}}</td>
                  <td>@if($cplan->active=="yes")
                                    <p style="color:green;">ACTIVE <i class="glyphicon glyphicon-ok"></i></p>
                                    @elseif($cplan->active=="expired")
                                    <p style="color:red;">Expired! <i class="fa fa-info-circle"></i></p>
                                    @else
                                    <p style="color:gray;">INACTIVE <i class="fa fa-info-circle"></i></p>
                                    @endif</td>
                </tr>
                @endif
				@endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>                                
                        </div>
                    </div>
    
        <br>
        @foreach($wmethods as $method)
        
                    <!-- Withdrawal Modal -->
        			<div id="withdrawalModal{{$method->id}}" class="modal fade" role="dialog">
        			  <div class="modal-dialog modal-dialog-centered">
        
        			    <!-- Modal content-->
        			    <div class="modal-content">
        			      
        			      <div class="modal-body">
        			          <h4 class="modal-title" style="text-align:center;">ENTER AMOUNT BELOW</h4>
                                <form style="padding:3px;" role="form" method="post" action="{{action('SomeController@withdrawal')}}">
        					   		<input style="padding:5px;" class="form-control" placeholder="Enter amount here" type="text" name="amount" required><br/>
        					   		<input style="padding:5px;" class="form-control" value="{{$method->name}}" type="text" disabled><br/>
        					   		<input value="{{$method->name}}" type="hidden" name="payment_mode">
        					   		<input value="{{$method->id}}" type="hidden" name="method_id"><br/>
                                       
        					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        					   		<center><input type="submit" class="btn btn-primary" value="Submit"></center>
        					   </form>
        			      </div>
        			    </div>
        			  </div>
        			</div>
        			<!-- /Withdrawals Modal -->
                    @endforeach
                </div>
                
               
		<br><br><br>

		@include('footer')