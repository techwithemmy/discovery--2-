@include('header')


<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Select Payment</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Select</li>
                                <li class="breadcrumb-item active"><a href="#">Payment</a></li>
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
         @foreach ($errors->all() as $error)
         <div class="alert alert-primary" role="alert">
                             {{ $error }}
                                </div>
         @endforeach
        @endif
        <br>
        <div class="alert alert-primary" role="alert">
                           <center><p> <i class="fas fa-info"></i> Note: You are to make payment of <strong>{{$settings->currency}}{{$amount}}</strong> using your preferred mode of payment below, And please upload proof after payment below.</p></center>
                                </div>
        
        <!-- START: Card Data-->
                <div class="row">

                    <div class="col-12 col-lg-6  col-xl-4 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header"><center><strong>BITCOIN WALLET (Bitcoin-Network)</strong></center></div>
                            <div class="card-body">
                                 ADDRESS:<span class="float-right badge">{{$settings->btc_address}}</span><hr>
                                <p class="card-text">                          <center class="mb-3">
                            <a href="bitcoin:{{$settings->btc_address}}" class="btn btn-secondary btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Pay Using BTC Wallet App</a>
                          
                            </center>
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6  col-xl-4 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header"><center><strong>ETHERUEM WALLET (ETH-ERC20 Network)</strong></center></div>
                            <div class="card-body">
                                 ADDRESS:<span class="float-right badge">{{$settings->eth_address}}</span><hr>
                                <p class="card-text">
                <center class="mb-3">
                            <a href="etheruem:{{$settings->eth_address}}" class="btn btn-secondary btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Pay Using Eth Wallet App</a>
                          
                            </center>
         
         </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-6  col-xl-4 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header"><center><strong>TETHER (USDT) WALLET (USDT-TRC20 Network)</strong></center></div>
                            <div class="card-body">
                                 ADDRESS:<span class="float-right badge">{{$settings->usdt_address}}</span><hr>
                                <p class="card-text">
                <center class="mb-3">
                            <a href="tether:{{$settings->usdt_address}}" class="btn btn-secondary btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Pay Using Trust Wallet App</a>
                          
                            </center>
         
         </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-6  col-xl-4 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header"><center><strong>BANK DETAILS</strong></center></div>
                            <div class="card-body">
                                <p class="card-text">
                                BANK NAME: <span class="float-right badge">{{$settings->bank_name}}</span><br><hr>
                                ACCOUNT NAME:<span class="float-right badge">{{$settings->account_name}}</span><br><hr>
                                ACCOUNT NUMBER:<span class="float-right badge">{{$settings->account_number}}</span>
                                
                                
                                </p>
                            </div>
                        </div>
                    </div>
                    
                     <!-- START: Card Data-->
                    <div class="col-12 mt-3">
                        <div class="card text-auto bg-default">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">UPLOAD PROOF OF PAYMENT</h4> 
                            </div>
                            <div class="card-body">
                                    <p class="lead"> <form method="post" action="{{action('SomeController@savedeposit')}}" enctype="multipart/form-data" style="padding:20px; margin-top:10px;">
                <div class="form-group">
                  <label>Payment Mode</label>
                  <select name="payment_mode" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select Payment Mode</option>
                    <option>Bitcoin</option>
                    <option>Bank Transfer</option>
                    <option>Ethereum</option>
                    <option>Tether (USDT)</option>
                  </select>
                  
                  <br>
    <div class="form-group">
         <label>Hash Key (Optional, Cryptocurrency payments only)</label>
  <input type="text" class="form-control" name="hashurl" id="usr">
  <font color="red"><i>(all cryptocurrency payment without hashkey submission wont be approved)</i></font>
</div>
                  
                  <label>Proof of Payment</label>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" name="proof" required>
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
                </div>  <!-- /.form-group -->
                	<div class="sub_home">
						<input type="submit" class="btn btn-primary" value="I have Paid">
						<div class="clearfix"> </div>
					</div>
					<input type="hidden" name="amount" value="{{$amount}}">
					<input type="hidden" name="pay_type" value="{{$pay_type}}">
					<input type="hidden" name="plan_id" value="{{$plan_id}}">
					<!--<input type="hidden" name="payment_mode" value="{{$payment_mode}}">-->
					<input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
				</form></p>
                                </div> </div> </div> </div>
                    <br><br><br>

		@include('footer')