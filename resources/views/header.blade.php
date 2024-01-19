<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->

<head>
        <meta charset="UTF-8">
        <title>{{$settings->site_name}} | {{$title}}</title>
        <link rel="shortcut icon" href="/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="/dist/vendors/simple-line-icons/css/simple-line-icons.css"> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

        <!-- END Template CSS-->

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="/dist/vendors/morris/morris.css"> 
        <link rel="stylesheet" href="/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> 
        <link rel="stylesheet" href="/dist/vendors/chartjs/Chart.min.css"> 
        <link rel="stylesheet" href="/dist/vendors/starrr/starrr.css">  
        <link rel="stylesheet" href="/dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="/dist/vendors/ionicons/css/ionicons.min.css"> 
        <link rel="stylesheet" href="/dist/vendors/cryptofont/cryptofont.css"> 

       
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="/dist/css/main.css">
                <script>
             
jQuery(document).ready(function($) {
  $(".toggle").click(function() {
    $(".toggle").toggleClass("active");
    $("body").toggleClass("night");
    $.cookie("toggle", $(".toggle").hasClass('active'));
  });

  if ($.cookie("toggle") == "true") {
    $(".toggle").addClass("active");
    $("body").addClass("night");
  }
});
        </script>
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->
    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <img src="/dist/images/logo.png" alt="logo" width="20" class="img-fluid"/>
        </div>
        <!-- END: Pre Loader-->
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
        <!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header h4 mb-0 align-self-center d-flex">  
                    <a class="horizontal-logo align-self-center d-flex d-lg-none">
                         <span class="h5 align-self-center mb-0 ">iPONGDEV</span>              
                    </a>
                    <a href="#" class="sidebarCollapse ml-2" id="collapse"><i class="icon-menu body-color"></i></a>
                </div>
                <div class="d-inline-block position-relative">
                    <button id="tourfirst" data-toggle="dropdown" aria-expanded="false" class="btn btn-primary p-2 rounded mx-3 h4 mb-0 line-height-1 d-none d-lg-block">
                        <span class="text-white font-weight-bold h5"><span class="icon-wallet mr-2 h6  mb-0"></span>{{$settings->currency}}{{ number_format(Auth::user()->account_bal, 2, '.', ',')}}</span></button>
                
                </div>

                
                <div class="navbar-right ml-auto">
                    <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
        
                        <li class="mr-1 d-inline-block my-auto"><h6>@if($settings->enable_kyc =="yes")@if(Auth::user()->account_verify=='Verified')<img src="/verified.png" width="20" height="20"> Verified</a>
				    @else
				   <a><font color="red">{{Auth::user()->account_verify}}</font></a><br> <a href="#" data-toggle="modal" data-target="#verifyModal"><font color="red">VERIFY ACCOUNT</font></a>
				    @endif
				    @endif</h6></li>
                        
                        <li class="mr-1 d-inline-block my-auto d-block d-lg-none">
                           </i>                               
                            </a>
                        </li>                        
                        
                        
                         
                         
                          <!-- Notification Page-->  
                        <li class="dropdown align-self-center mr-1 d-inline-block">
                            <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                                <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-right border   py-0">
                                <li>
                                    <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                        <div class="media">
                                            <img src="/images/{{$settings->logo}}" alt="" class="d-flex mr-3 img-fluid rounded-circle w-50">
                                            <div class="media-body">
                                                <h6>{{$settings->update}}</h6>
                                                <hr>
                                               <p class="mb-0 text-success"> From Admin</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                         <!-- End Notification-->  
                         
                         
                          <!-- START: Header Profile-->  
                        <li class="dropdown user-profile d-inline-block py-1 mr-2">
                            <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false"> 
                                <div class="media">
                                    <div class="media-body align-self-center d-none d-sm-block mr-2">
                                        <p class="mb-0 text-uppercase line-height-1"><b>{{ Auth::user()->name }}</b><br/><span> </span></p>

                                    </div>
                                    @if(Auth::user()->photo =='')
         <img src="/profilep.png" alt=""  class="d-flex img-fluid rounded-circle" width="45">
        @else
         <img src="/profilep.png" alt="" class="d-flex img-fluid rounded-circle" width="45">
        @endif
                                </div>
                            </a>
                            
                            <div class="dropdown-menu  dropdown-menu-right p-0">
                                <a href="{{ url('dashboard/changepassword') }}" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-pencil mr-2 h6 mb-0"></span> Profile</a>
                                <a href="{{ url('dashboard/accountdetails') }}" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-user mr-2 h6 mb-0"></span> Payment Details</a>
                               
                                    <div class="dropdown-divider"></div>
                                <div class="dropdown-divider"></div>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                    <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </div>
        <!-- END: Header-->

             

        <!-- START: Main Menu-->
        <div class="sidebar">
            <a href="#" class="sidebarCollapse float-right h6 dropdown-menu-right mr-2 mt-2 position-absolute d-block d-lg-none">
                <i class="icon-close"></i>
            </a>
            <!-- START: Logo-->
            <a href="#" class="sidebar-logo d-flex">
                <span class="h5 align-self-center mb-0">V-ASSETS</span>        
            </a>
            <!-- END: Logo-->
            
            <!-- ADMIN: Menu START-->
            
            @if(Auth::user()->type =='1')
            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown active"><a href="{{ url('/dashboard') }}"><i class="icon-home"></i>HOME</a> 
                </li>
                <!---<li class="dropdown"><a href="{{ url('dashboard/plans') }}"><i class="icon-present"></i> PACKAGES</a>-->
                </li>
                <li class="dropdown"><a href="{{ url('dashboard/manageusers') }}"><i class="icon-people"></i> USERS</a>
                </li>
                <li class="dropdown"><a href="#"><i class="icon-grid"></i>FUNCTIONS</a>
                    <div> 
                        <ul>
                            <li><a href="{{ url('dashboard/mdeposits') }}"><i class="icon-arrow-down-circle"></i> MANAGE DEPOSITS</a></li>
                            <li><a href="{{ url('dashboard/mwithdrawals') }}"><i class="icon-arrow-up-circle"></i> MANAGE WITHDRAWALS</a></li>                       
                        </ul> 
                    </div>

                </li>
                <li class="dropdown"><a href="{{ url('dashboard/kyc') }}"><i class="icon-eye"></i>VERIFICATION</a>
                </li>
                
                <li class="dropdown"><a href="{{ url('dashboard/settings') }}"><i class="icon-settings"></i>SETTINGS</a>
                </li>
                <li class="dropdown"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-logout"></i>Logout</a>
                    
                <li><a href="#"><i class=" "></i></a></li>

                </li>
                

            </ul>
                   
            <!-- END: Menu-->
        </div>
            
            @endif
             <!-- ADMIN: Menu END-->
             
            <!-- USER: Menu STRAT-->
            @if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='forex'))
            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown active"><a href="{{ url('/dashboard') }}"><i class="icon-home"></i>Dashboard</a> 
                </li>
                <li class="dropdown"><a href="{{ url('dashboard/deposits') }}"><i class="icon-wallet"></i>Fund Account</a>
                </li>
                <li class="dropdown"><a href="{{ url('dashboard/withdrawals') }}"><i class="icon-basket"></i>Withdrawal</a>
                </li>
                 <li class="dropdown"><a href="{{ url('dashboard/mplans') }}"><i class="icon-grid"></i>Upgrade</a>
                <li class="dropdown"><a href="{{ url('dashboard/tradinghistory') }}"><i class="icon-grid"></i>Trade History</a>
                   <!--- <div> 
                        <ul>
                            <li><a href="{{ url('dashboard/mplans') }}"><i class="icon-loop"></i> Activate Package</a></li>
                            <li><a href="{{ url('dashboard/myplans') }}"><i class="icon-eye"></i> Current Package</a></li>
                            <li><a href="{{ url('dashboard/tradinghistory') }}"><i class="icon-compass"></i> Transaction ROI</a></li>                        
                        </ul> 
                    </div>-->

                </li>

                <li class="dropdown"><a href="#"><i class="icon-user"></i>Profile</a>
                    <div> 
                        <ul>
                            <li><a href="{{ url('dashboard/changepassword') }}"><i class="icon-user-following"></i> Personal Account</a></li>
                            <li><a href="{{ url('dashboard/accountdetails') }}"><i class="icon-pencil"></i> Update Payment Details</a></li>
                        </ul> 
                    </div>

                </li>
                <li class="dropdown"><a href="{{ url('dashboard/referuser') }}"><i class="icon-link"></i>Referral</a>
                </li>
                <li class="dropdown"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-logout"></i>Logout</a>
                    
                <li><a href="#"><i class=" "></i></a></li>

                </li>
                

            </ul>
                   @endif
                   
                   
                    @if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='crypto'))
            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown active"><a href="{{ url('/dashboard') }}"><i class="icon-home"></i>Dashboard</a> 
                </li>
                <li class="dropdown"><a href="{{ url('dashboard/deposits') }}"><i class="icon-wallet"></i>Fund Account</a>
                </li>
                <li class="dropdown"><a href="{{ url('dashboard/withdrawals') }}"><i class="icon-basket"></i>Withdrawal</a>
                </li>
                 <li class="dropdown"><a href="{{ url('dashboard/mplans') }}"><i class="icon-grid"></i>Purchase Plan</a>
                 <li class="dropdown"><a href="{{ url('dashboard/myplans') }}"><i class="icon-grid"></i>Active Plans</a>
                <li class="dropdown"><a href="{{ url('dashboard/tradinghistory') }}"><i class="icon-grid"></i>Trade History</a>
                   <!--- <div> 
                        <ul>
                            <li><a href="{{ url('dashboard/mplans') }}"><i class="icon-loop"></i> Activate Package</a></li>
                            <li><a href="{{ url('dashboard/myplans') }}"><i class="icon-eye"></i> Current Package</a></li>
                            <li><a href="{{ url('dashboard/tradinghistory') }}"><i class="icon-compass"></i> Transaction ROI</a></li>                        
                        </ul> 
                    </div>-->

                </li>

                <li class="dropdown"><a href="#"><i class="icon-user"></i>Profile</a>
                    <div> 
                        <ul>
                            <li><a href="{{ url('dashboard/changepassword') }}"><i class="icon-user-following"></i> Personal Account</a></li>
                            <li><a href="{{ url('dashboard/accountdetails') }}"><i class="icon-pencil"></i> Update Payment Details</a></li>
                        </ul> 
                    </div>

                </li>
                <li class="dropdown"><a href="{{ url('dashboard/referuser') }}"><i class="icon-link"></i>Referral</a>
                </li>
                <li class="dropdown"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-logout"></i>Logout</a>
                    
                <li><a href="#"><i class=" "></i></a></li>

                </li>
                

            </ul>
                   @endif
            <!-- END: Menu-->
        </div>
        <!-- END: Main Menu-->
        
