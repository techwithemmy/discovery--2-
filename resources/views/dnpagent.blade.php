@include('header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page signup-page">

                <div class="row">
                   <div class="col-md-12 gh">
                        <a href="#" style="color:#fff;">
                        <h3>Agent Earnings <br>
                            <small style="color:#f1f1f1;">Agent earnings record</small> 
                            <span style="float:right;">{{$settings->currency}} {{Auth::user()->dnp_earnings}}.00</span>
                        </h3>
                        </a>
                        <div class="clearfix"> </div>   
                    </div>
                </div>

				@if(Session::has('message'))
		        <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->type !='agent')
                <h3 class="title1">Complete the form below to opt in as an agent.<br>
                    <small style="color:#000;">You earn 2% of your referrals PHs for life</small>
                </h3>
				<div class="sign-up-row widget-shadow">
					
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('dashboard/saveagent') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" >

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Phone Number <small>Format (090xx,080xx,070xx)</small></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">State </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="state" value="{{ old('state') }}" required>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lga') ? ' has-error' : '' }}">
                            <label for="lga" class="col-md-4 control-label">L.G.A.</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lga" value="{{ old('lga') }}" required>

                                @if ($errors->has('lga'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lga') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> OPT IN
                                </button>
                            </div>
                        </div>
                    </form>
                    <h2>How it work</h2>
                    <strong>You opt in as an agent.</strong><br>
                    <strong>You register users through your dashboard or referral link.</strong><br>
                    <strong>The system adds 2% to your earnings anytime your referral makes a donation.</strong><br>
                    <strong>Contact support when you want to withdraw your earnings.</strong><br>
                    <span>support@e.g.com</span><br/>
                    <strong>We will process your withdrawal immediately we receive your request.</strong>
                    <h4><b>Thanks for being part of us.</b></h4>
				</div>
                @endif
			</div>
		</div>
		@include('footer')