@include('header')

<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Fund Account</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Fund Account</li>
                                <li class="breadcrumb-item active"><a href="#">Deposit</a></li>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#depositModal">Make New Deposit</button>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>AMOUNT</th>
                                                <th>PAYMENT MODE</th>
                                                <th>STATUS</th>
                                                <th>DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deposits as $deposit)
							<tr> 
								<th scope="row">{{$deposit->id}}</th>
								 <td>{{$deposit->amount}}</td> 
								 <td>{{$deposit->payment_mode}}</td> 
                                 <td>{{$deposit->status}}</td> 
								 <td>{{$deposit->created_at}}</td> 
							</tr> 
							@endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>                                
                        </div><br><br><br>
                    </div>
                    

        @include('modals')
		@include('footer')