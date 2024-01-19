@include('header')
<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Profile </h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Personal</li>
                                <li class="breadcrumb-item active"><a href="#">Profile</a></li>
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
        
 <!-- Main content -->
      <div class="row">
                    <div class="col-12 col-sm-12">
        <div class="row">
          <div class="col-12 col-md-3 mt-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                 <center>   @if(Auth::user()->photo =='')
                    <img class="d-flex img-fluid rounded-circle" src="/profilep.png" width="300" alt="User profile picture" >
                </div>
                @else
                <img class="d-flex img-fluid rounded-circle" src="/profilep.png" width="100" alt="User profile picture">
                </div>
          @endif</center>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">@if($settings->enable_kyc =="yes")@if(Auth::user()->account_verify=='Verified')<img src="/verified.png" width="15" height="15"> Verified</a>
				    @else
				   <a><font color="red">{{Auth::user()->account_verify}}</font></a><br> <a href="#" data-toggle="modal" data-target="#verifyModal"><font color="red">CLICK VERIFY ACCOUNT</font></a>
				    @endif
				    @endif</p>
				    <hr>
				  <center>  <div class="toggle"></div><strong>ACTIVATE DARK MODE</strong></center>
                    <hr>
                <ul class="list-group list-group-unbordered mb-3">
                     <li class="list-group-item">
                    <b>Country</b> <a class="float-right">{{Auth::user()->country}}</a>
                  </li>
                   <li class="list-group-item">
                    <b>Current Plan</b> <a class="float-right">{{Auth::user()->user_plan}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone Number</b> <a class="float-right">{{Auth::user()->phone_number}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Balance</b> <a class="float-right">{{$settings->currency}}{{ number_format(Auth::user()->account_bal, 2, '.', ',')}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right">@if($settings->enable_kyc =="yes")@if(Auth::user()->account_verify=='Verified')<img src="/verified.png" width="15" height="15"> Verified</a>
				    @else
				   <a> <font color="red">{{Auth::user()->account_verify}}</font></a><br> <a href="#" data-toggle="modal" data-target="#verifyModal"><font color="red">CLICK VERIFY ACCOUNT</font></a>
				    @endif
				    @endif
							</a>
                  </li>
                  <li class="list-group-item">
                    <b>Profit</b> <a class="float-right">{{$settings->currency}}{{ number_format(Auth::user()->roi, 2, '.', ',')}}</a>
                  </li>
                </ul>

                <a href="{{ url('dashboard/deposits') }}" class="btn btn-primary btn-block"><b>Deposit</b></a>
              </div>
              <!-- /.card-body -->
            </div></div>
            <!-- /.card -->

           
          <!-- /.col -->
          
          <div class="col-12 col-md-9 mt-3">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Payment Details</a></li>
                  </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   <!-- form start -->
              <form method="post" action=" ">
                <div class="card-body">
                  <div class="form-group">
                    <label for="bn">Bank Name</label>
                    <input class="form-control" type="text" name="bank_name" value="{{Auth::user()->bank_name}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="an">Account Name</label>
                    <input class="form-control" type="text" name="account_name" value="{{Auth::user()->account_name}}" readonly>
                  </div>
                  
                  <div class="form-group">
                    <label for="ann">Account Number</label>
                    <input class="form-control" type="text" name="account_number" value="{{Auth::user()->account_no}}" readonly>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="inputWarning"> Swift Code</label>
                    <input class="form-control" type="text" name="eth_address" value="{{Auth::user()->eth_address}}" readonly>
                  </div>
                   <div class="form-group">
                    <label class="col-form-label" for="inputSuccess"><i class="fab fa-bitcoin"></i> Bitcoin Wallet Address</label>
                    <input class="form-control" type="text" name="btc_address" value="{{Auth::user()->btc_address}}" readonly>
                  </div>
                 
                  <div class="form-group">
                    <label class="col-form-label" for="inputError" hidden><i class="fas fa-lira-sign"></i> Litecoin Address</label>
                    <input class="form-control" type="text" name="ltc_address" value="{{Auth::user()->ltc_address}}" hidden readonly>
                  </div>

                
              </form>
                  <form action="/dashboard/accountdetails" method="get">
                                   <button type="submit" class="btn btn-primary">Update Payment Details</button>
                    </form>
                    
                  </div></div>
                  <!-- /.tab-pane -->
              </div></div></div>
  
   <!-- Main content -->
      <div class="row">
                    <div class="col-12 col-sm-12">
        <div class="row">
          <div class="col-12 col-md-12 mt-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">CHANGE PASSWORD BELOW</a></li>
                  </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   <!-- form start -->
              <!-- form start -->
              <form method="post" action="{{action('UsersController@updatepass')}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="password">Enter Old Password</label>
                    <input type="password" name="old_password" required class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="passwordaa">Password</label>
                    <input type="password" name="password" required class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="passworda">Password</label>
                    <input type="password" name="password_confirmation" required class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">SAVE</button>
               
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="current_password" value="{{Auth::user()->password}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
              </form>
                
                    
                  </div></div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>
            

                    <br><br><br>

        @include('modals')
		@include('footer')