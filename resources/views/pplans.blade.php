@include('header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page signup-page">
				<h3 class="title1">Join any of our promo packages for free.</h3>
				
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

						<div class="row">
						@foreach($plans as $plan)
                		<div class="col-lg-4">
							<div class="sign-up-row widget-shadow" style="width:100%; padding:0px;">
								<h3 style="background-color:#e9e9e9; padding:20px;">
								{{$plan->name}}
								</h3>
								<div style="padding:20px; text-align:center;">
									<h4><strong>{{$settings->currency}} {{$plan->price}}</strong></h4>
									<hr>
									<p><i class="fa fa-star"></i>  2:1 matrix</p>
									<hr>
									<p><i class="fa fa-star"></i>  Auto Asign</p>
									<hr>
									<p><i class="fa fa-star"></i>  Auto Payout</p>
									<hr>
									<p><i class="fa fa-star"></i>  100% return on investment</p>
									<hr>
									<a href="{{ url('dashboard/joinplan') }}/{{$plan->id}}" class="btn btn-default">Join plan</a>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
		@include('modals')
		@include('footer')