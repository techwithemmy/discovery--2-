@include('header')


<!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Referral</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Active</li>
                                <li class="breadcrumb-item active"><a href="#">Referrals</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
        @if(Session::has('message'))
                <div class="alert alert-primary" style="text-align:center;" role="alert">
                                    {{ Session::get('message') }}
                                </div>
        @endif
        
        @if(count($errors) > 0)
         @foreach ($errors->all() as $error)
         <div class="alert alert-primary" role="alert">
                             {{ $error }}
                                </div>
         @endforeach
        @endif

                <div class="row">
                    <div class="col-12 col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group mb-2">
                                   Referral Link - <font color="red"><u>{{Auth::user()->ref_link}}</u></font>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                             <tr> 
								<th>CLIENT NAME</th>
                                <th>CLIENT INV. PLAN</th>
                                <th>CLIENT STATUS</th>
                                <th>REF LEVEL</th>
                                <th>DATE</th>
							</tr> 
                                        </thead>
                                        <tbody>
                                    @foreach($team as $client)
							<tr> 
								 <td>{{$client->name}}</td> 
								 @if(isset($client->dplan->name)) 
								 <td>{{$client->dplan->name}}</td>
								 @else
								 <td>NULL</td>
								 @endif 
                                 <td>{{$client->status}}</td> 
                                 <td>{{$client->status}}</td> 
                                 <td>{{$client->created_at}}</td>
							</tr> 
							@endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>                                
                        </div><br><br><br>
                    </div>
		

		@include('footer')