@include('header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page signup-page">
				<h3 class="title1">Agents</h3>
				
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

				<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
					<table class="table table-hover"> 
						<thead> 
							<tr> 
								<th>Agent name</th>
                                <th>Clients referred</th>
                                <!--<th>Clients activated</th>
								<th>Earnings</th>-->
								<th>Option(s)</th>
							</tr> 
						</thead> 
						<tbody> 
							@foreach($agents as $agent)
							<tr> 
								 <td>{{$agent->duser->name}}</td> 
								 <td>{{$agent->total_refered}}</td> 
                                 <!--<td>{{$agent->total_activated}}</td> 
								 <td>{{$agent->earnings}}</td>-->
								 <td>
								     <a href="{{url('dashboard/viewagent')}}/{{$agent->agent}}" title="View agent clients">
								     <i class="fa fa-eye"></i>
								     </a>
								 </td> 
							</tr> 
							@endforeach
						</tbody> 
					</table>
				</div>
			</div>
		</div>
        @include('modals')
		@include('footer')