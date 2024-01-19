@include('header')


<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Withdrawal</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Make</li>
                                <li class="breadcrumb-item active"><a href="#">Withdrawal</a></li>
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
        
          <div class="alert alert-primary" role="alert" style="text-align:center;">Payment will be sent through your selected method.
                                </div>
                    
                     
                     <div class="row">
@foreach($wmethods as $method)
                    <div class="col-12 col-lg-6  col-xl-4 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header" style="text-transform: uppercase;"><center>{{$method->name}} WITHDRAWAL</center></div>
                            <div class="card-body">
                                 MINIMUM:<span class="float-right">{{$settings->currency}}{{$method->minimum}}</span><hr>
                                 MAXIMUM:<span class="float-right">{{$settings->currency}}{{$method->maximum}}</span><hr>
                                 CHARGES (VAT):<span class="float-right">{{$settings->currency}}{{$method->charges_fixed}}</span><hr>
                                 CHARGES (%):<span class="float-right">{{$method->charges_percentage}}%</span><hr>
                                 DURATION:<span class="float-right">{{$method->duration}}</span><hr>
                                <p class="card-text">                          <center class="mb-3">
                            <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#withdrawalModal{{$method->id}}"><i class="fa fa-plus"></i> Request withdrawal</a>
                          
                            </center>
                            </p>
                            </div>
                        </div>
                    </div>
                    
@endforeach
</div>


                <div class="row">
                    <div class="col-12 col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group mb-2">
                                   <strong> PROCESSED/PENDING WITHDRAWALS</strong>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                           <tr>
                  <th>ID</th>
                  <th>REQUESTED AMOUNT</th>
                  <th>AMOUNT + CHARGES</th>
                  <th>RECIEVING MODE</th>
                  <th>DATE</th>
                  <th>STATUS</th>
                </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($withdrawals as $withdrawal)
                <tr>
                  <td>{{$withdrawal->id}}</td>
                  <td>${{$withdrawal->amount}}</td>
                  <td>${{$withdrawal->to_deduct}}</td>
                  <td> {{$withdrawal->payment_mode}}</td>
                  <td>{{$withdrawal->created_at}}</td>
                  <td>{{$withdrawal->status}}</td>
                </tr>
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