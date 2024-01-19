@include('header')
<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">All Withdrawals</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">All</li>
                                <li class="breadcrumb-item active"><a href="#">Withdrawals</a></li>
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
                                   Pending and Processed Withdrawals
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                         	<tr> 
								<th>ID</th> 
								<th>CLIENT NAME</th>
                                <th>AMOUNT REQUESTED</th>
                                <th>AMOUNT + CHARGES</th>
                                <th>PAYMENT MODE</th>
                                <th>RECIEVER'S EMAIL</th>
								<th>STATUS</th> 
                                <th>DATE</th>
                                <th>ACTION</th>
							</tr> 
                                        </thead>
                                        <tbody>
                                         @foreach($withdrawals as $deposit)
							<tr> 
								<th scope="row">{{$deposit->id}}</th>
                                <td>{{$deposit->duser->name}}</td>
								 <td>{{$deposit->amount}}</td> 
								 <td>{{$deposit->to_deduct}}</td> 
								 <td>{{$deposit->payment_mode}}</td> 
								 <td>{{$deposit->duser->email}}</td> 
                                 <td>{{$deposit->status}}</td> 
								 <td>{{$deposit->created_at}}</td> 
                                 <td>
                                @if($deposit->status =="Processed") 
                                 <a class="btn btn-success btn-block" href="#">Processed</a>
                                @else
                                <a class="btn btn-default btn-block" href="{{ url('dashboard/pwithdrawal') }}/{{$deposit->id}}">Process</a>
                                @endif
                                 <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#viewModal{{$deposit->id}}"><i class="fa fa-eye"></i> Mode</a>
                                  @if($deposit->status =="Pending") 
                                 <a href="{{ url('dashboard/dwithdrawal') }}/{{$deposit->id}}" class="btn btn-default btn-block"> Decline</a>
                                @endif
                                 </td> 
							</tr> 
							
						<!-- View info modal-->
							<div id="viewModal{{$deposit->id}}" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								<div class="modal-body">
								<h4 class="modal-title" style="text-align:center;">{{$deposit->duser->name}} withdrawal details.</strong></h4><br>
								    @if($deposit->payment_mode=='Bitcoin')
									<h3>BTC Wallet:</h3>
									<h4>{{$deposit->duser->btc_address}}</h4><br>
									@elseif($deposit->payment_mode=='Ethereum')
									<h3>ETH Wallet:</h3>
									<h4>{{$deposit->duser->eth_address}}</h4><br>
									@elseif($deposit->payment_mode=='Litecoin')
									<h3>LTC Wallet:</h3>
									<h4>{{$deposit->duser->ltc_address}}</h4><br>
									@elseif($deposit->payment_mode=='Bank transfer')
									<h4>Bank name: {{$deposit->duser->bank_name}}</h4><br>
									<h4>Account name: {{$deposit->duser->account_name}}</h4><br>
									<h4>Account number: {{$deposit->duser->account_no}}</h4>
									@else
									<h4>Get in touch with client. <br><br>{{$deposit->duser->email}}</h4>
									@endif
								</div>
								</div>
							</div>
							</div>
							<!--End View info modal-->
			
							@endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{$withdrawals->render()}}
                            </div>                                
                        </div><br><br><br>
                    </div>
                    

        @include('modals')
		@include('footer')