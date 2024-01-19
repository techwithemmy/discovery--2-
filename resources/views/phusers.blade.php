@include('header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page signup-page">
				<h3 class="title1">PH users</h3>
				
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

				<div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
					<table class="table table-hover"> 
						<thead> 
							<tr> 
								<th>ID</th> 
								<th>User</th> 
								<th>Pledged amount</th> 
								<th>Donated amount</th> 
								<th>Confirmed value</th> 
								<th>Date created</th> 
							</tr> 
						</thead> 
						<tbody> 
							@foreach($phusers as $phuser)
							@if($phuser->u->username !='brume')
							<tr> 
								<th scope="row">{{$phuser->id}}</th>
								 <td>{{$phuser->u->name}}</td> 
								 <td>N {{$phuser->donated_amount}}</td> 
								 <td>N {{$phuser->donated_amount - $phuser->new_value}}</td> 
								 <td>N {{$phuser->confirmed_amount}}</td> 
								 <td>N {{$phuser->entered_at}}</td> 
								 
							</tr> 
							@endif
							@endforeach
							
						</tbody> 
					</table>
				</div>
			</div>
		</div>
		@include('footer')