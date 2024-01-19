@include('header')

@if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='forex'))
 <!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                           <center> <div class="w-sm-100 mr-auto"><h4 class="mb-0">Your current Trading Package <font color="Red">"{{Auth::user()->user_plan}}"</font><br>
Upgrade your trading account to a plan that best suit your trading experience and have access to several Trading benefits</h4></div></center>

                        
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
<div class="col-12 col-lg-6  col-xl-4 mt-3">
<div class="card text-auto bg-default">
<div class="card-header" style="text-transform: uppercase;"><center>BRONZE PACK</center></div>
<div class="card-body">
UPGRADE NOW<span class="float-right">TO BRONZE</span><hr>
<center>
<input type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Join plan"> </center>
</a></strong></p>
</center>
</p>
</div>
</div>
</div>
<div class="col-12 col-lg-6  col-xl-4 mt-3">
<div class="card text-auto bg-default">
<div class="card-header" style="text-transform: uppercase;"><center>SILVER PACK</center></div>
<div class="card-body">
UPGRADE NOW<span class="float-right">TO SILVER</span><hr>
<center>
<input type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Join plan"> </center>
</a></strong></p>
</center>
</p>
</div>
</div>
</div>
<div class="col-12 col-lg-6  col-xl-4 mt-3">
<div class="card text-auto bg-default">
<div class="card-header" style="text-transform: uppercase;"><center>CRYSTAL PACK</center></div>
<div class="card-body">
UPGRADE NOW<span class="float-right">TO CRYSTAL</span><hr>
<center>
<input type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Join plan"> </center>
</a></strong></p>
</center>
</p>
</div>
</div>
</div>
<div class="col-12 col-lg-6  col-xl-4 mt-3">
<div class="card text-auto bg-default">
<div class="card-header" style="text-transform: uppercase;"><center>DIAMOND PACK</center></div>
<div class="card-body">
UPGRADE NOW<span class="float-right">TO DIAMOND</span><hr>
<center>
<input type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Join plan"> </center>
</a></strong></p>
</center>
</p>
</div>
</div>
</div>
<div class="col-12 col-lg-6  col-xl-4 mt-3">
<div class="card text-auto bg-default">
<div class="card-header" style="text-transform: uppercase;"><center>PREMIUM PACK</center></div>
<div class="card-body">
UPGRADE NOW<span class="float-right">TO PREMIUM</span><hr>
<center>
<input type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Join plan"> </center>
</a></strong></p>
</center>
 </p>
</div>
</div>
</div>
<div class="col-12 col-lg-6  col-xl-4 mt-3">
<div class="card text-auto bg-default">
<div class="card-header" style="text-transform: uppercase;"><center>ULTIMATE PACK</center></div>
<div class="card-body">
UPGRADE NOW<span class="float-right">TO ULTIMATE</span><hr>
<center>
<input type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary" value="Join plan"> </center>
</a></strong></p>
</center>
</p>
</div>
</div>
</div>
</div>

<br><br><br>
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>To Upgrade your account and get the benefits/bonuses of the plan you currently trade on, please contact our live chat/support team for upgrade requirements and enquires.<br> Alternatetively, you can contact your account manager/trade agent for assistance on your account upgrade process..</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        @endif
        
        @if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='crypto'))
        
        
 <!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Choose a Crypto Plan</h4><br>
                            <p>Your current Trading Package <font color="Red">"{{Auth::user()->plan}}"</font></p>
                            </div>

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
                            <div class="card-header" style="text-transform: uppercase;"><center>{{$plan->name}} PACKAGE</center></div>
                            <div class="card-body">
                                
                                <i class="fa fa-check" aria-hidden="true"></i>  {{$plan->increment_amount}}% {{$plan->increment_interval}} ROI<br><br>
                                
                                <i class="fa fa-check" aria-hidden="true"></i>  Minimum investment: {{$settings->currency}}{{$plan->min_price}}<br><br>
                                
                                <i class="fa fa-check" aria-hidden="true"></i>  30 days investment duration<br><br>
                                
                                <i class="fa fa-check" aria-hidden="true"></i>  Instant daily withdrawal of earnings<br><br>
                                
                                <i class="fa fa-check" aria-hidden="true"></i>  Minimum withdrawal of {{$settings->currency}}5<br>
                                 <form style="padding:3px;" role="form" method="post" action="{{action('Controller@joinplan')}}">
                                     
                                 <select class="form-control" name="duration" hidden>
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
            					   		<input type="submit" class="btn btn-primary" value="Activate Plan"> </center> 
            					   </form>
            					   
            					   </a></strong></p>
                            </center>
                            </p>
                            </div>
                        </div>
                    </div>
                    
@endforeach
</div><br><br><br>
        
        @endif
        
		@include('modals')
		@include('footer')