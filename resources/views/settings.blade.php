@include('header')
<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Settings</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Site</li>
                                <li class="breadcrumb-item active"><a href="#">Settings</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                           
        @if(Session::has('message'))
                <div class="alert alert-primary" role="alert">
                                    {{ Session::get('message') }}
                                </div>
        @endif
        
        @if(count($errors) > 0)
        <div class="alert alert-primary" role="alert">
             @foreach ($errors->all() as $error)
                                     {{ $error }}
                                </div>
                                 @endforeach
        @endif
         <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
    <!-- Main content -->
   
			
              <!-- form start -->
              <form method="post" action="{{action('SomeController@updatesettings')}}" enctype="multipart/form-data">
                <div class="card-body">
				<div class="form-group">
                        <label>Public Notice</label>
                        <textarea name="update" class="form-control" rows="3">{{$settings->update}}</textarea>
                      </div>
					   <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" class="form-control" name="site_name" value="{{$settings->site_name}}" required>
                      </div>
					  <div class="form-group">
                        <label>Site Description</label>
                        <textarea class="form-control" name="description" class="form-control" rows="3">{{$settings->description}}</textarea>
                      </div>
					  <div class="form-group">
                        <label>Site Chat Widget</label>
                        <textarea class="form-control" name="tawk_to" rows="2">{{$settings->tawk_to}}</textarea>
                      </div>
					  <div class="form-group">
                        <label>Site Title</label>
                        <input type="text" class="form-control" name="site_title" value="{{$settings->site_title}}" required>
                      </div>
                  <div class="form-group">
                        <label>Site Keyword</label>
                        <input type="text" class="form-control" name="keywords" value="{{$settings->keywords}}" required>
                      </div>
				   <div class="form-group">
                        <label>Site URL</label>
                        <input type="text" class="form-control" name="site_address" value="{{$settings->site_address}}" required>
                      </div>
					   
					   <div class="form-group">
                        <label>Contact Mail</label>
                        <input type="text" class="form-control" name="contact_email" value="{{$settings->contact_email}}" required>
                      </div>
					  <div class="form-group">
                        <label>Site Currency</label>
                        <select name="currency" id="select_c" class="form-control" onchange="s_f()">
                          <option value="<?php echo htmlentities($settings->currency); ?>">{{ $settings->currency }}</option>
						  @foreach($currencies as $key=>$currency)
                          <option id="{{$key}}" value="<?php echo htmlentities($currency); ?>">{{$key .' ('.$currency.')'}}</option>
                          @endforeach
                        </select>
                      </div>
					  
					  <script>
						function s_f(){
							var e = document.getElementById("select_c");
							var selected = e.options[e.selectedIndex].id;
							document.getElementById("s_c").value = selected;
						}
					</script>
					
					<div class="form-group">
                    <label for="exampleInputFile">Change Site Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div></div>
					  <div class="form-group">
                        <label>Site Preference</label>
                        <select name="site_preference" class="form-control">
                          <option value="{{$settings->site_preference}}">Currently ({{$settings->site_preference}})</option>
                        </select>
                      </div>
					 
					   <div class="form-group">
                        <label>Referral Commission %</label>
                        <input type="text" class="form-control" name="ref_commission" value="{{$settings->referral_commission}}" required>
                      </div>
					   <div class="form-group">
                        <label>Referral Commission %</label>
                        <input type="text" class="form-control" name="ref_commission1" value="{{$settings->referral_commission1}}" required>
                      </div>
					   <div class="form-group">
                        <label>Referral Commission %</label>
                        <input type="text" class="form-control" name="ref_commission2" value="{{$settings->referral_commission2}}" required>
                      </div>
					   <div class="form-group">
                        <label>Referral Commission %</label>
                        <input type="text" class="form-control" name="ref_commission3" value="{{$settings->referral_commission3}}" required>
                      </div>
					   <div class="form-group">
                        <label>Referral Commission %</label>
                        <input type="text" class="form-control" name="ref_commission4" value="{{$settings->referral_commission4}}" required>
                      </div>
					   <div class="form-group">
                        <label>Referral Commission %</label>
                        <input type="text" class="form-control" name="ref_commission5" value="{{$settings->referral_commission5}}" required>
                      </div>
					  
					  <div class="form-group">
                        <label>Sign up Bonus ({{$settings->currency}})</label>
                        <input type="text" class="form-control" name="signup_bonus" value="{{$settings->signup_bonus}}" required>
                      </div>
					  
					  <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="trade_mode" id="check" value="on">
                          <label for="check" class="custom-control-label">Enable Auto Trade</label>
                        </div>
						 </div>
						 <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="enable_2fa" id="2fa_check" value="yes">
                          <label for="2fa_check" class="custom-control-label">Enable 2FA</label>
                        </div>
						 </div>
					 <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="enable_kyc" id="kyc_check" value="yes">
                          <label for="kyc_check" class="custom-control-label">Enable KYC</label>
                        </div>
						 </div>
						 
						<div class="form-group">
                        <label>Site Preference</label>
                        <select name="withdrawal_option" class="form-control" disabled>
                          <option value="{{$settings->withdrawal_option}}">Currently ({{$settings->withdrawal_option}})</option>
                          <option>auto</option>
						  <option>Manual</option>
                        </select>
                      </div>
						@if($settings->trade_mode=='on')
						<script>document.getElementById("check").checked= true;</script>
					@endif
					
					@if($settings->enable_2fa=='yes')
						<script>document.getElementById("2fa_check").checked= true;</script>
					@endif
					
					@if($settings->enable_kyc=='yes')
						<script>document.getElementById("kyc_check").checked= true;</script>
					@endif
					
				
					<div class="form-group">
                        <label>Site Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" value="{{$settings->bank_name}}" disabled>
                      </div>
					<div class="form-group">
                        <label>Site Account Name</label>
                        <input type="text" class="form-control" name="account_name" value="{{$settings->account_name}}" disabled>
                      </div>
					  <div class="form-group">
                        <label>Site Account Number</label>
                        <input type="text" class="form-control" name="account_number" value="{{$settings->account_number}}" disabled>
                      </div>
					  <div class="form-group">
                        <label>Site Bitcoin Wallet</label>
                        <input type="text" class="form-control" name="btc_address" value="{{$settings->btc_address}}" disabled>
                      </div>
					  <div class="form-group">
                        <label>Site Ethereum Wallet</label>
                        <input type="text" class="form-control" name="eth_address" value="{{$settings->eth_address}}" disabled>
                      </div>
                      
                      <div class="form-group">
                        <label>Site USDT Wallet</label>
                        <input type="text" class="form-control" name="usdt_address" value="{{$settings->usdt_address}}" disabled>
                      </div>
					  
					   <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="check1" value="1" name="payment_mode1">
                          <label for="check1" class="custom-control-label">Bank transfer</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="check3" value="3" name="payment_mode3">
                          <label for="check3" class="custom-control-label">Ethereum</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="check2" value="2" name="payment_mode2">
                          <label for="check2" class="custom-control-label">Bitcoin</label>
                        </div>
						
						<div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="check6" value="6" name="payment_mode6" disabled>
                          <label for="check6" class="custom-control-label">Paypal <font color="red">(message support for integration)</font></label>
                        </div>
						<div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="check5" value="5" name="payment_mode5" disabled>
                          <label for="check5" class="custom-control-label">Credit Card<font color="red"> (message support for integration)</font></label>
                        </div>
                      </div>
                    </div> 
					
					<?php 
						$pmodes = str_split($settings->payment_mode);
						foreach($pmodes as $pmode){
							if($pmode==1){
							echo'
							<script>document.getElementById("check1").checked= true;</script>
							';
							}
							if($pmode==2){
								echo'
								<script>document.getElementById("check2").checked= true;</script>
								';
							}
							if($pmode==3){
								echo'
								<script>document.getElementById("check3").checked= true;</script>
								';
							}
							if($pmode==4){
								echo'
								<script>document.getElementById("check4").checked= true;</script>
								';
							}
							if($pmode==5){
								echo'
								<script>document.getElementById("check5").checked= true;</script>
								';
							}
							if($pmode==6){
								echo'
								<script>document.getElementById("check6").checked= true;</script>
								';
							}
						}
					 ?>

					<!-- end Payment info and methods -->
					<hr>
                  <button type="submit" class="btn btn-info">Update Site Info</button>
				<hr>
				<input type="hidden" name="id" value="1">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					</form>
					 @foreach($wmethods as $method)
					<div class="row">
                    <div class="col-12  mt-3">       
                            <div class="card-body p-0">
                                <ul class="contacts grid">
                                    <li class="contact  py-3 px-2">
                                        <div class="media d-flex w-100">
                                            <a href="#"><img src="dist/images/author1.jpg" alt="" class="img-fluid ml-0 mt-2 ml-md-2 rounded-circle" width="40"></a>
                                            <div class="media-body align-self-center pl-2">
                                                <b class="mb-0">{{$method->name}}</b><br/>
                                                
                                            </div>

                                            <div class="ml-auto mail-tools">
                                                <a href="#"  data-toggle="modal" data-target="#wmethodModal{{$method->id}}" title="Edit Method" data-placement="bottom" class="ml-2"><i class="icon-pencil"></i></a> 
                                                <a href="{{url('dashboard/deletewdmethod')}}/{{$method->id}}" data-toggle="tooltip" title="Delete Method" data-placement="bottom" class="ml-2"><i class="icon-trash"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                       </ul>
                        </div></div></div>

					
            <!-- Edit Withdrawal method Modal -->
			<div id="wmethodModal{{$method->id}}" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
                        <form style="padding:3px;" role="form" method="post" action="{{action('SomeController@updatewdmethod')}}">
                            <label>Enter method name</label>
					   		<input style="padding:5px;" class="form-control" placeholder="Enter method name" type="text" name="name" value="{{$method->name}}" required><br/>
					   		<label>Minimum amount $</label>
					   		<input style="padding:5px;" class="form-control" placeholder="Minimum amount $" type="text" name="minimum" value="{{$method->minimum}}" required><br/>
					   		<label>Maximum amount $</label>
					   		<input style="padding:5px;" class="form-control" placeholder="Maximum amount $" type="text" name="maximum" value="{{$method->maximum}}" required><br/>
					   		<label>Charges (Fixed amount $)</label>
					   		<input style="padding:5px;" class="form-control" placeholder="Charges (Fixed amount $)" type="text" name="charges_fixed" value="{{$method->charges_fixed}}" required><br/>
					   		<label>Charges (Percentage %)</label>
					   		<input style="padding:5px;" class="form-control" placeholder="Charges (Percentage %)" type="text" name="charges_percentage" value="{{$method->charges_percentage}}" required><br/>
					   		<label>Duration</label>
					   		<input style="padding:5px;" class="form-control" placeholder="Payout duration" type="text" name="duration" value="{{$method->duration}}" required><br/>
					   		<label>Method status</label>
					   		<select name="status" class="form-control">
					   		    <option>{{$method->status}}</option> 
					   		    <option value="enabled">Enable</option> 
					   		    <option value="disabled">Disable</option> 
					   		</select><br/>
                             <input type="hidden" name="type" value="withdrawal">
                             <input type="hidden" name="id" value="{{$method->id}}">
					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<input type="submit" class="btn btn-default" value="Continue">
					   </form>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- /edit withdrawal method Modal -->
                    @endforeach
                    
                    <hr>
                    <!-- End withdrawal method -->
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#wmethodModal"><i class="fa fa-plus"></i> Add Withdrawal Method</a>
                    <br><br><br>
                    
                      
		
		@include('modals')
		@include('footer')