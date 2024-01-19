@include('header')
<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">All Verifications</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">All</li>
                                <li class="breadcrumb-item active"><a href="#">Verifications</a></li>
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
                                
                                <div class="btn-group mb-2">
                                   Pending and Processed Verifications 
                                </div>
                                 {{$kyc->render()}}
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                       <tr> 
								<th>ID</th> 
								<th>NAME</th> 
								<th>EMAIL</th> 
								<th>STATUS</th>
								<th>ACTION</th> 
							</tr> 
                                        </thead>
                                        <tbody>
                                        @foreach($users as $list)
							<tr> 
								<th scope="row">{{$list->id}}</th>
								 <td>{{$list->name}}</td> 
								 <td>{{$list->email}}</td> 
								 
								 <td>{{$list->account_verify}}</td> 
								 <td>
								<a href="#"  data-toggle="modal" data-target="#viewkycIModal{{$list->id}}" class="btn btn-default btn-block"><i class="fa fa-eye"></i> ID FRONT</a>
								<a href="#"  data-toggle="modal" data-target="#viewkycIIModal{{$list->id}}" class="btn btn-default btn-block"><i class="fa fa-eye"></i> ID BACK</a>
								<a href="#" data-toggle="modal" data-target="#viewkycPModal{{$list->id}}" class="btn btn-default btn-block"><i class="fa fa-eye"></i> Passport</a>
								
								<a href="{{ url('dashboard/acceptkyc') }}/{{$list->id}}" class="btn btn-default btn-block">Accept</a>
								 <a href="{{ url('dashboard/rejectkyc') }}/{{$list->id}}" class="btn btn-default btn-block">Reject</a>
								 </td> 
							</tr> 
						
						<!-- View KYC ID Modal -->
            			<div id="viewkycIModal{{$list->id}}" class="modal fade" role="dialog">
            			  <div class="modal-dialog">
            
            			    <!-- Modal content-->
            			    <div class="modal-content">
            			      <div class="modal-body">
            			          <h4 class="modal-title" style="text-align:center;">KYC verification - ID card front view</h4>
                                    <img src="{{asset('app/qwery/123/qwerty/uploads/passport/'.$list->id_card)}}" style="max-width:100%; height:auto;">
            			      </div>
            			    </div>
            			  </div>
            			</div>
            			<!-- /view KYC ID Modal -->
            			
            				<!-- View KYC ID Modal -->
            			<div id="viewkycIIModal{{$list->id}}" class="modal fade" role="dialog">
            			  <div class="modal-dialog">
            
            			    <!-- Modal content-->
            			    <div class="modal-content">
            			      <div class="modal-body">
            			          <h4 class="modal-title" style="text-align:center;">KYC verification - ID card back view</h4>
                                    <img src="{{asset('app/qwery/123/qwerty/uploads/passport/'.$list->id_back)}}" style="max-width:100%; height:auto;">
            			      </div>
            			    </div>
            			  </div>
            			</div>
            			<!-- /view KYC ID Modal -->
            			
            			<!-- View KYC Passport Modal -->
            			<div id="viewkycPModal{{$list->id}}" class="modal fade" role="dialog">
            			  <div class="modal-dialog">
            
            			    <!-- Modal content-->
            			    <div class="modal-content">
            			      <div class="modal-body">
            			          <h4 class="modal-title" style="text-align:center;">KYC verification - Passport view</h4>
                                    <img src="{{asset('app/qwery/123/qwerty/uploads/passport/'.$list->passport)}}" style="max-width:100%; height:auto;">
            			      </div>
            			    </div>
            			  </div>
            			</div>
            			<!-- /view KYC Passport Modal -->
			
							@endforeach
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>                                
                        </div><br><br><br>
                    </div>
                    

        @include('modals')
		@include('footer')