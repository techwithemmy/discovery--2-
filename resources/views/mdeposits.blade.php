@include('header')
<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">All Deposits</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">All</li>
                                <li class="breadcrumb-item active"><a href="#">Deposits</a></li>
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
        
         <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group mb-2">
                                   Pending and Processed Deposits
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                           <tr> 
								<th>ID</th> 
								<th>CLIENT NAME</th>
								<th>CLIENT EMAIL</th>
                                <th>AMOUNT</th>
                                <th>PAYMENT MODE</th>
                                <th>PLANS</th>
								<th>STATUS</th> 
                                <th>DATE</th>
                                <th>ACTION</th>
							</tr> 
                                        </thead>
                                        <tbody>
                                           @foreach($deposits as $deposit)
							<tr> 
								<th scope="row">{{$deposit->id}}</th>
                                <td>{{$deposit->duser->name}}</td>
                                <td>{{$deposit->duser->email}}</td> 
								 <td>${{$deposit->amount}}</td> 
								 <td>{{$deposit->payment_mode}}</td>
								 @if(isset($deposit->dplan->name)) 
								 <td>{{$deposit->dplan->name}}</td>
								 @else
								 <td>Account funds</td>
								 @endif
                                 <td>{{$deposit->status}}</td> 
								 <td>{{$deposit->created_at}}</td> 
                                 <td> 
                                 <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#popModal{{$deposit->id}}" title="View payment proof">
								     <i class="fa fa-eye"></i> Proof
								     </a>
								      @if($deposit->hashurl =='')
								      <a href="#" class="btn btn-default btn-block"><i class="fa fa-hashtag"></i> No Hash</a>
								      @else
								     <a href="https://www.blockchain.com/btc/tx/{{($deposit->hashurl)}}" class="btn btn-default btn-block"><i class="fa fa-hashtag"></i> Hash</a>
								      @endif
								     <a href="{{ url('dashboard/deldeposit') }}/{{$deposit->id}}" class="btn btn-default btn-block"><i class="fa fa-trash"></i> Delete</a>
								     @if($deposit->status =='Pending')
                                 <a class="btn btn-default btn-block" href="{{ url('dashboard/pdeposit') }}/{{$deposit->id}}">Process</a>
                                 @endif
                                 </td> 
							</tr> 
							
							<!-- POP Modal -->
			<div id="popModal{{$deposit->id}}" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-body">
				  			        <h4 class="modal-title" style="text-align:center;">{{$deposit->duser->name}} proof of payment</h4>
                        <img src="{{asset('app/qwery/123/qwerty/uploads/proof/'.$deposit->proof)}}" style="max-width:100%; height: auto;"><br>
                      
			      </div>
			    </div>
			  </div>
			</div>
			<!-- /POP Modal -->
			
							@endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{$deposits->render()}}
                            </div>                                
                        </div><br><br><br>
                    </div>
                    

        @include('modals')
		@include('footer')