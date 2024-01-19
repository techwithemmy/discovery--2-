@include('header')

<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">All Users</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">All</li>
                                <li class="breadcrumb-item active"><a href="#">Users</a></li>
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
                    <div class="col-12 col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                 <form style="padding:3px; float:right;" role="form" method="post" action="{{action('Controller@search')}}">
				            <a class="btn btn-default" href="{{ url('dashboard/manageusers') }}">Show all</a>
					   		<input style="padding:5px; margin-top:15px;" placeholder="Search user" type="text" name="searchItem" required>
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<input type="hidden" name="type" value="user">
					   		<input type="submit" style="margin-top:-5px;" class="btn btn-default" value="Go">
					  </form>
					  
				<a href="#" data-toggle="modal" data-target="#sendmailModal" class="btn btn-default btn-lg" style="margin:10px;">Message all</a>
				
				
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                             <tr> 
								<th>ID</th> 
								<th>BALANCE</th> 
								<th>PROFIT</th>
								<th>SIGNAL FEE</th> 
								<th>NAME</th> 
								<th>EMAIL</th> 
								<th>PHONE</th>
								<th>PLAN</th>
								<th>STATUS</th>
								<th>REG DATE</th> 
								<th>ACTION</th> 
							</tr> 
                                        </thead>
                                        <tbody>
                                   @foreach($users as $list)
							<tr> 
								<th scope="row">{{$list->id}}</th>
								 <td>${{$list->account_bal}}</td> 
								  <td>${{$list->roi}}</td>
								 <td>${{$list->sig}}</td> 
								 <td>{{$list->name}}</td> 
								 <td>{{$list->email}}</td> 
								 <td>{{$list->phone_number}}</td>
								 
								 <td>
								      @if($list->acct_form=='forex')
								     {{$list->user_plan}}
								      @else
								      {{$list->plan}}
								      @endif
								     </td>
								 
								 <td>{{$list->status}}</td> 
								 <td>{{$list->created_at}}</td> 
								 <td> <a href="#"  data-toggle="modal" data-target="#topupModal{{$list->id}}" class="btn btn-default btn-block">Top Balance</a>  
								 <a href="#"  data-toggle="modal" data-target="#toppupModal{{$list->id}}" class="btn btn-default btn-block">Top Profit</a> 
								 
								  @if($list->stat=='1')
								 <a class="btn btn-default btn-block" href="{{ url('dashboard/popup') }}/{{$list->id}}/0">Turn off popup</a> 
								 @else
								 <a class="btn btn-default btn-block" href="{{ url('dashboard/popup') }}/{{$list->id}}/1">Turn on popup</a>
								 @endif
								  
								 <a href="#"  data-toggle="modal" data-target="#popupModal{{$list->id}}" class="btn btn-default btn-block">Update Popup Message</a>
								 
								     <a href="#" data-toggle="modal" data-target="#edituser{{$list->id}}" class="btn btn-default btn-block">Edit User</a> 
								     <a href="#" data-toggle="modal" data-target="#topuppModal{{$list->id}}" class="btn btn-default btn-block">Signal Fee</a> 
								     <a href="{{ url('dashboard/deluser') }}/{{$list->id}}" class="btn btn-default btn-block">Delete</a>  
								     <a href="#"  data-toggle="modal" data-target="#topupoModal{{$list->id}}" class="btn btn-default btn-block">Upgrade Plan</a>  
								 @if($list->status==NULL || $list->status=='blocked')
								  <a class="btn btn-default btn-block" href="{{ url('dashboard/unblock') }}/{{$list->id}}">Unblock</a> 
								 @else
								 <a class="btn btn-default btn-block" href="{{ url('dashboard/ublock') }}/{{$list->id}}">Block</a>
								 @endif  
								 <a href="#" data-toggle="modal" data-target="#resetpswdModal{{$list->id}}"  class="btn btn-default btn-block">Password</a> 
								 @if($list->trade_mode=='on')
								 <a class="btn btn-default btn-block" href="{{ url('dashboard/usertrademode') }}/{{$list->id}}/off">Turn off trade</a> 
								 @else
								 <a class="btn btn-default btn-block" href="{{ url('dashboard/usertrademode') }}/{{$list->id}}/on">Turn on trade</a>
								 @endif 
								 <a href="#" data-toggle="modal" data-target="#TradingModal{{$list->id}}" class="btn btn-default btn-block">Add Trading History</a>  
								 <a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal{{$list->id}}" class="btn btn-primary btn-block">Send Message</a> 
								 
								 
								 <a href="#" data-toggle="modal" data-target="#clearacctModal{{$list->id}}" class="btn btn-default btn-block">Clear Account</a> 
								
								  @if($list->type=='1')
								 <a class="btn btn-default btn-block" href="{{ url('dashboard/makeadmin') }}/{{$list->id}}/off" >Remove admin</a> 
								 @else
								 <a class="btn btn-danger btn-block" href="{{ url('dashboard/makeadmin') }}/{{$list->id}}/on">Make admin</a>
								 @endif  
								 <a href="#" data-toggle="modal" data-target="#switchuserModal{{$list->id}}"  class="btn btn-success btn-block">Get access</a></td>
							</tr>  
							
							
							<!-- Deposit for a plan Modal -->
								<div id="topupModal{{$list->id}}" class="modal fade " role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    <h4 class="modal-title" style="text-align:center;">Top up user account.</strong></h4>
										<form style="padding:3px;" role="form" method="post" action="{{action('SomeController@topup')}}">
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" disabled><br/>
											<input style="padding:5px;" class="form-control" placeholder="Enter amount to top up" type="text" name="amount" required><br/>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{$list->id}}">
											<center><input type="submit" class="btn btn-primary" value="Credit account"></center>
									</form>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /deposit for a plan Modal -->
							
							
								<!-- Deposit for a plan Modal -->
								<div id="toppupModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    <h4 class="modal-title" style="text-align:center;">Top up user Profit.</strong></h4>
										<form style="padding:3px;" role="form" method="post" action="{{action('SomeController@toppup')}}">
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" disabled><br/>
											<input style="padding:5px;" class="form-control" placeholder="Enter amount to top up" type="text" name="amount" required><br/>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{$list->id}}">
											<center><input type="submit" class="btn btn-primary" value="Credit Profit"></center>
									</form>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /deposit for a plan Modal -->
							
								<!-- Deposit for a plan Modal -->
								<div id="popupModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-header">
									
								</div>
								<div class="modal-body">
								    <h4 class="modal-title" style="text-align:center;">Send Popup Message.</strong></h4>
										<form style="padding:3px;" role="form" method="post" action="{{action('SomeController@popup')}}">
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" disabled><br/>
											
											<textarea class="form-control" placeholder="Start Typing..." type="text" name="amount" required> Enter Message here... </textarea><br>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{$list->id}}">
											<center><input type="submit" class="btn btn-primary" value="Send Popup"></center>
									</form>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /deposit for a plan Modal -->
							
							
								<!-- Upgrade a plan Modal -->
								<div id="topupoModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    <h4 class="modal-title" style="text-align:center;">Upgrade User.</strong></h4>
										<form style="padding:3px;" role="form" method="post" action="{{action('SomeController@topupo')}}">
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" disabled><br/>
											<select name="amount" class="form-control">
											   <option value="Bronze Pack">Bronze Pack</option>
											    <option value="Silver Pack">Silver Pack</option>
											     <option value="Crystal Pack">Crystal Pack</option>
											      <option value="Diamond Pack">Diamond Pack</option> 
											      <option value="Premium Pack">Premium Pack</option>
											      
											   
											</select>
											<br/>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{$list->id}}">
											<center><input type="submit" class="btn btn-primary" value="Upgrade"></center>
									</form>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /deposit for a plan Modal -->
							
								<!-- Signal plan Modal -->
								<div id="topuppModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    <h4 class="modal-title" style="text-align:center;">Enter User Signal Fee</strong></h4>
										<form style="padding:3px;" role="form" method="post" action="{{action('SomeController@topupp')}}">
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" disabled><br/>
											<input style="padding:5px;" class="form-control" placeholder="Enter Signal fee" type="text" name="amount" required><br/>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{$list->id}}">
											<center><input type="submit" class="btn btn-primary" value="Credit account"></center>
									</form>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /deposit for a plan Modal -->
							
																<!-- /Trading History Modal -->
									
									<div id="TradingModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
									<div class="modal-dialog modal-dialog-centered">

										<!-- Modal content-->
										<div class="modal-content">
										<div class="modal-body">
										<center><h4>Add Trading History for {{$list->name}} {{$list->l_name}} </h4></center>
										
												<form style="padding:3px;" role="form" method="post" action="{{action('Controller@addHistory')}}">
												<input type="hidden" name="user_id" value="{{$list->id}}">

												<div class="form-group">
													<label>Investment Plans</label>
													<select class="form-control" name="plan">
													<option value="">Select Plan</option>
													 <option value="Bronze Pack">Bronze Pack</option>
											    <option value="Silver Pack">Silver Pack</option>
											     <option value="Crystal Pack">Crystal Pack</option>
											      <option value="Diamond Pack">Diamond Pack</option> 
											      <option value="Premium Pack">Premium Pack</option>
											      
													</select>
												</div>
												<label>Amount</label>
												<input type="number" name="amount" class="form-control">
												<br>
												<div class="form-group">
													<label>Type</label>
													<select class="form-control" name="type">
													<option value="">Select type</option>
													<option value="Bonus">Bonus</option>
													<option value="ROI">ROI</option>
													</select>
												</div>
												
												<div class="form-group">
													<label>Currency Pair</label>
													<select class="form-control" name="pair">
													<option value="">Select type</option>
													<option value="USD/EUR">USD/EUR</option>
													<option value="EUR/USD">EUR/USD</option>
													<option value="BTC/EUR">BTC/EUR</option>
													<option value="EUR/BTC">EUR/BTC</option>
													<option value="USD/BTC">USD/BTC</option>
													<option value="BTC/USD">BTC/USD</option>
													<option value="BTC/LTC">BTC/LTC</option>
													<option value="ETH/USD">ETH/USD</option>
													</select>
												</div>
													
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="submit" class="btn btn-default" value="Add History">
											</form>
										</div>
										<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
										</div>
									</div>
									</div>
									<!-- /send a single user email Modal -->
							
							<!-- send a single user email Modal-->
							<div id="sendmailtooneuserModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
									<div class="modal-dialog modal-dialog-centered">

										<!-- Modal content-->
											<div class="modal-content">
								<div class="modal-body">
											<h4 class="modal-title" style="text-align:center;">This message will be sent to {{$list->name}} {{$list->l_name}} </h4>
										</div>
										
										<div class="modal-body">
												<form style="padding:3px;" role="form" method="post" action="{{action('UsersController@sendmailtooneuser')}}">
													<input type="hidden" name="user_id" value="{{$list->id}}">
													<textarea class="form-control" name="message" row="3" required=""></textarea><br/>
													
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="submit" class="btn btn-default btn-block" value="Send">
											</form>
										</div>
										<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
										</div>
									</div>
									</div>
							
							
							
							
							
							<!-- Reset user password Modal -->
							<div id="resetpswdModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    <h4 class="modal-title" style="text-align:center;">You are reseting password for {{$list->name}}.</strong></h4>
									<p>Default password:</p>
									<h3>#Tr@de#</h3><br>
								<center>	<a class="btn btn-primary" href="{{ url('dashboard/resetpswd') }}/{{$list->id}}">Proceed</a></center>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /Reset user password Modal -->
							
							<!-- Switch useraccount Modal -->
							<div id="switchuserModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    	<h4 class="modal-title" style="text-align:center;">You are about to login as {{$list->name}}.</strong></h4>
								<center>	<a class="btn btn-primary" href="{{ url('dashboard/switchuser') }}/{{$list->id}}">Proceed</a></center>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /Switch user account Modal -->
							
							
								<!-- Edit user Modal -->
								<div id="edituser{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								<h4 class="modal-title" style="text-align:center;">Edit {{$list->name}}'s Details.</strong></h4>
								
										<form style="padding:3px;" role="form" method="post" action="{{action('UsersController@edituser')}}">
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" disabled><br/>
											<label>Full name</label>
											<input style="padding:5px;" class="form-control" value="{{$list->name}}" type="text" name="name" required><br/>
											<label>Email</label>
											<input style="padding:5px;" class="form-control" value="{{$list->email}}" type="text" name="email" required><br/>
											<label>Phone number</label>
											<input style="padding:5px;" class="form-control" value="{{$list->phone_number}}" type="text" name="phone" required><br/>
											<label>Referral link</label>
											<input style="padding:5px;" class="form-control" value="{{$list->ref_link}}" type="text" name="ref_link" required><br/>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="user_id" value="{{$list->id}}">
											<input type="submit" class="btn btn-default" value="Update user">
									</form>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /Edit user Modal -->

							<!-- Clear account Modal -->
							<div id="clearacctModal{{$list->id}}" class="modal fade" role="dialog" data-backdrop="false">
							<div class="modal-dialog modal-dialog-centered">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								    	<h4 class="modal-title" style="text-align:center;">You are clearing account for {{$list->name}} to $0.00</strong></h4>
								<center>	<a class="btn btn-primary" href="{{ url('dashboard/clearacct') }}/{{$list->id}}">Proceed</a></center>
								</div>
								<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
								</div>
							</div>
							</div>
							<!-- /Clear account Modal -->
						
							
							
							
							
							
							
							 @endforeach
                                        </tbody>
                                    </table>
                                    <span style="margin:3px;">
				        {{$users->render()}}
				    </span>
                                </div>
                            </div>                                
                        </div><br><br><br>
                    </div>
		
        @include('modals')
		@include('footer')