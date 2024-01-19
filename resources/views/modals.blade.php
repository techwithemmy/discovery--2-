				<!-- send all users email -->
			<div id="sendmailModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			        <h4 class="modal-title" style="text-align:center;">Mail All Users On This Platform</h4>
                        <form style="padding:3px;" role="form" method="post" action="{{action('UsersController@sendmail')}}">
					   		
					   		<textarea class="form-control" name="message" row="3" required=""></textarea><br/>
                               
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<center><input type="submit" class="btn btn-primary" value="Send"></center>
					   </form>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /send all users email Modal -->
			
			
			<!-- Verify Modal -->
			<div id="verifyModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			          <h4 class="modal-title" style="text-align:center;">USER VERIFICATION SYSTEM.</h4>
			          <center><p><font color="red">Upload required documents to get verified.<br>Using the format below:</font>
			          <img src="/verify.png" width="100%">
			          </p></center>
                        <form style="padding:3px;" role="form" method="post" action="{{action('SomeController@savevdocs')}}"  enctype="multipart/form-data"><hr>
                            <label>VALID IDENTITY CARD (FRONT)</label>
                            <input type="file" name="id" required><hr>
                            <label>VALID IDENTITY CARD (BACK)</label>
                            <input type="file" name="ic" required><hr>
					   		<label>USER FACIAL PASSPORT</label>
                            <input type="file" name="passport" required><hr>
                               
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   	<center>	<input type="submit" class="btn btn-primary" value="Submit documents"></center>
					   </form>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /Verify Modal -->
			
			<!-- Deposit Modal -->
			<div id="depositModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			          <h6 class="modal-title"><center><strong>ENTER AMOUNT TO DEPOSIT BELOW</strong></center></h6>
                        <form style="padding:3px;" role="form" method="post" action="{{action('SomeController@deposit')}}">
                            
                            <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Username</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">{{$settings->currency}}</div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter amount here..." name="amount" required>
      </div>
    </div>
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<center><input type="submit" class="btn btn-primary" value="Continue"></center>
					   </form>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /deposit Modal -->
			
			
			<!-- Withdrawal method Modal -->
			<div id="wmethodModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			           <h4 class="modal-title" style="text-align:center;">Add new withdrawal method</h4>
                        <form style="padding:3px;" role="form" method="post" action="{{action('SomeController@addwdmethod')}}">
					   		<input style="padding:5px;" class="form-control" placeholder="Enter method name" type="text" name="name" required><br/>
					   		<input style="padding:5px;" class="form-control" placeholder="Minimum amount $" type="text" name="minimum" required><br/>
					   		<input style="padding:5px;" class="form-control" placeholder="Maximum amount $" type="text" name="maximum" required><br/>
					   		<input style="padding:5px;" class="form-control" placeholder="Charges (Fixed amount $)" type="text" name="charges_fixed" required><br/>
					   		<input style="padding:5px;" class="form-control" placeholder="Charges (Percentage %)" type="text" name="charges_percentage" required><br/>
					   		<input style="padding:5px;" class="form-control" placeholder="Payout duration" type="text" name="duration" required><br/>
					   		<select name="status" class="form-control">
					   		    <option value="">Select action</option> 
					   		    <option value="enabled">Enable</option> 
					   		    <option value="disabled">Disable</option> 
					   		</select><br/>
                             <input type="hidden" name="type" value="withdrawal">
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   	<center>	<input type="submit" class="btn btn-primary" value="Continue"></center>
					   </form>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /withdrawal method Modal -->


            			<!-- Withdrawal Modal -->
			<div id="withdrawalModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			          <h4 class="modal-title" style="text-align:center;">ENTER AMOUNT BELOW</h4>
                        <form style="padding:3px;" role="form" method="post" action="{{action('SomeController@withdrawal')}}">
					   		<input style="padding:5px;" class="form-control" placeholder="Enter amount here" type="text" name="amount" required><br/>
                               
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<center><input type="submit" class="btn btn-primary" value="Submit"></center>
					   </form>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /Withdrawals Modal -->
			
				<!-- Deposit for a plan Modal -->
								<div id="topupModal{{$list->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">

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
							
																<!-- /Trading History Modal -->
									
									<div id="TradingModal{{$list->id}}" class="modal fade" role="dialog">
									<div class="modal-dialog">

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
													@foreach($pl as $plns)
													<option value="{{$plns->name}}">{{$plns->name}}</option>
													@endforeach
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
							<div id="sendmailtooneuserModal{{$list->id}}" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title" style="text-align:center;">This message will be sent to {{$list->name}} {{$list->l_name}} </h4>
										</div>
										
										<div class="modal-body">
												<form style="padding:3px;" role="form" method="post" action="{{action('UsersController@sendmailtooneuser')}}">
													<input type="hidden" name="user_id" value="{{$list->id}}">
													<textarea class="form-control" name="message" row="3" required=""></textarea><br/>
													
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="submit" class="btn btn-default" value="Send">
											</form>
										</div>
										<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
										</div>
									</div>
									</div>
							
							
							
							
							
							<!-- Reset user password Modal -->
							<div id="resetpswdModal{{$list->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">

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
							<div id="switchuserModal{{$list->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">

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
								<div id="edituser{{$list->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">

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
							<div id="clearacctModal{{$list->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">

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

			       			<!-- Plans Modal -->
			<div id="plansModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			          			        <h4 class="modal-title" style="text-align:center;">Add new plan / package</h4>

              <form style="padding:3px;" role="form" method="post" action="{{action('Controller@addplan')}}">
							<label>Plan name</label><br/>	
							<input style="padding:5px;" class="form-control" placeholder="Enter Plan name" type="text" name="name" required><br/>
								 <label>Plan price</label><br/>
								 <input style="padding:5px;" class="form-control" placeholder="Enter Plan price" type="text" name="price" required><br/>
								 <label>Plan MIN. price</label><br/>		 
            					  <input style="padding:5px;" placeholder="Enter Plan minimum price" class="form-control" type="text" name="min_price" required><br/>
            					  <label>Plan MAX. price</label><br/>		 
            					  <input style="padding:5px;" class="form-control" placeholder="Enter Plan maximum price" type="text" name="max_price" required><br/>
								 <label>Plan expected return (ROI)</label><br/>
								 <input style="padding:5px;" class="form-control" placeholder="Enter expected return for this plan" type="text" name="return" required><br/>						 
															 <label>top up interval</label><br/>
                               <select class="form-control" name="t_interval">
																		<option>Monthly</option>
																		<option>Weekly</option>
																		<option>Daily</option>
																		<option>Hourly</option>
															 </select><br>
															 <label>top up type</label><br/>
                               <select class="form-control" name="t_type">
																		<option>Percentage</option>
																		<option>Fixed</option>
															 </select><br>
															 <label>top up amount (in % or $ as specified above)</label><br/>
															 <input style="padding:5px;" class="form-control" placeholder="top up amount" type="text" name="t_amount" required><br/>
															 <label>Investment duration</label><br/>
                               <select class="form-control" name="expiration">
																		<option>One week</option>
																		<option>One month</option>
																	<option>Three months</option>	
																		<option>Six months</option>
																		<option>One year</option>
															 </select><br>
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   	<center>	<input type="submit" class="btn btn-primary" value="Submit"></center>
					   </form>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /plans Modal -->

			<!-- settings update Modal -->
			<div id="s_updModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
			          			   <center>  <p><h4>UPDATE TRACKER</h4></p></center>
                <hr>
                       <p><h5>LAST UPDATED BY: {{$settings->updated_by}}</h5> </p> 
                        <p><h5>TIME UPDATED: {{$settings->updated_at}}</h5> </p> 
                        <hr>
                        <p><font color="red">If Data Was Updated By an impostor or none admin, please change admin login details Immediately.</font></p>
			      </div>
			      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
			    </div>
			  </div>
			</div>
			<!-- /settings update Modal -->
