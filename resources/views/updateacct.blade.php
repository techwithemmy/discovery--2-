@include('header')
		<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Update Payment Details </h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Update</li>
                                <li class="breadcrumb-item">Payment</li>
                                <li class="breadcrumb-item active"><a href="#">Details</a></li>
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
        
         <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12 mt-3">
                        <div class="card">                      
                            <div class="card-content">
                        <div class="col-12 col-lg-12  col-xl-12 mt-3">
                        <div class="card">
                            
                             <!-- form start -->
              <form method="post" action="{{action('UsersController@updateacct')}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="bn">Bank Name</label>
                    <input class="form-control" type="text" name="bank_name" value="{{Auth::user()->bank_name}}" required>
                  </div>
                  <div class="form-group">
                    <label for="an">Account Name</label>
                    <input class="form-control" type="text" name="account_name" value="{{Auth::user()->account_name}}" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="ann">Account Number</label>
                    <input class="form-control" type="text" name="account_number" value="{{Auth::user()->account_no}}" required>
                  </div>
                 <div class="form-group">
                    <label class="col-form-label" for="inputWarning"> Swift Code</label>
                    <input class="form-control" type="text" name="eth_address" value="{{Auth::user()->eth_address}}">
                  </div>
                   <div class="form-group">
                    <label class="col-form-label" for="inputSuccess"><i class="fab fa-bitcoin"></i> Bitcoin Wallet Address</label>
                    <input class="form-control" type="text" name="btc_address" value="{{Auth::user()->btc_address}}" required>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-form-label" for="inputError" hidden><i class="fas fa-lira-sign"></i> Litecoin Address</label>
                    <input class="form-control" type="text" name="ltc_address" value="{{Auth::user()->ltc_address}}" hidden>
                  </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
              </form>
        
                            </div>
                        </div>
                    </div> </div> </div>
                    
		<br><br><br>
		@include('footer')