@include('header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page signup-page">
				
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

                @if(count($errors) > 0)
		        <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @foreach ($errors->all() as $error)
                            <i class="fa fa-warning"></i> {{ $error }}
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

				<div class="sign-up-row widget-shadow">
					
					<div class="ghorder">
						<h4>You are confirming that you received the sum of <strong>{{$settings->currency}} {{$dorder->donated_amount}}</strong><br/>
						 from <strong>{{$from->name}}</strong>.
						 <hr style="border:1px solid #999;">
						 Phone: {{$from->phone}}<br>
						</h4>
						
					</div>
					<form method="post" action="{{action('UsersController@confirm')}}" enctype="multipart/form-data">

					<div class="sub_home">
						<input type="submit" class="btn btn-default" value="confirm payment">
						<div class="clearfix"> </div>
					</div>
					<input type="hidden" name="id" value="{{$dorder->id}}">
					<input type="hidden" name="ph_id" value="{{$dorder->ph_id}}">
					<input type="hidden" name="amount" value="{{$dorder->donated_amount}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
				</form>
				
				</div>
			</div>
		</div>
		@include('footer')