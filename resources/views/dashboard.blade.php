@include('header')
<!-- ADMIN DISPLAY STARTS-->

@if(Auth::user()->type =='1')
<main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">ADMIN DASHBORD</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                
                 <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"></div>
                        </div>
                    </div></div>
                <!-- END: Breadcrumbs-->

 <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/traffic.png" alt="wallet" class="float-right" />
                                <h6 class="card-title font-weight-bold">REGISTERED USERS</h6>
                                <h6 class="card-subtitle mb-2 text-muted">All time users</h6>
                                <h2>@foreach($total_users as $total_users)
						    @if(!empty($total_users->count))
							{{$total_users->count}}
							@else
							No Users
							@endif
							@endforeach</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last day
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/money.png" alt="money" class="float-right" />
                                <h6 class="card-title font-weight-bold">TOTAL DEPOSITS</h6>
                                <h6 class="card-subtitle mb-2 text-muted">All time deposits</h6>
                                <h2>@foreach($total_depositeds as $total_depositeds)
						    @if(!empty($total_depositeds->count))
							{{$settings->currency}}{{$total_depositeds->count}}
							@else
							{{$settings->currency}}0.00
							@endif
							@endforeach</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last week
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/cart.png" alt="cart" class="float-right" />
                                <h6 class="card-title font-weight-bold">PENDING WITHDRAWALS</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Awaiting Processing</h6>
                                <h2>@foreach($pwithdrawals as $pwithdrawals)
						    @if(!empty($pwithdrawals->count))
							{{$pwithdrawals->count}}
							@else
							0
							@endif
							@endforeach</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>% </span> than last week
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/wallet.png" alt="wallet" class="float-right" />
                                <h6 class="card-title font-weight-bold">TOTAL PAYOUT</h6>
                                <h6 class="card-subtitle mb-2 text-muted">All time disbursment</h6>
                                <h2>@foreach($prwithdrawals as $prwithdrawals)
						    @if(!empty($prwithdrawals->count))
							{{$settings->currency}}{{$prwithdrawals->count}}
							@else
							{{$settings->currency}} 0
							@endif
							@endforeach </h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>% </span> all time referral
                            </div>
                        </div>
                        <br><br><br>
                    </div>
        


@endif
<!-- ADMIN DISPLAY ENDS-->
<!-- USER DISPLAY STARTS-->


@if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='crypto'))

 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"> <b>Welcome to your Portfolio</b></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                 <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/wallet.png" alt="wallet" class="float-right" />
                                <h6 class="card-title font-weight-bold">Investment Balance</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Today</h6>
                                <h2>{{$settings->currency}}{{ number_format(Auth::user()->account_bal, 2, '.', ',')}}</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last day
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/money.png" alt="money" class="float-right" />
                                <h6 class="card-title font-weight-bold">Total Deposit</h6>
                                <h6 class="card-subtitle mb-2 text-muted">This Week</h6>
                                <h2>@foreach($deposited as $deposited)
						    @if(!empty($deposited->count))
							{{$settings->currency}}{{$deposited->count}}
							@else
							{{$settings->currency}}0.00
							@endif
							@endforeach</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last week
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/cart.png" alt="cart" class="float-right" />
                                <h6 class="card-title font-weight-bold">All Time Profit</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Total ROI</h6>
                                <h2>{{$settings->currency}}{{ number_format(Auth::user()->roi, 2, '.', ',')}}</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last week
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/wallet.png" alt="wallet" class="float-right" />
                                <h6 class="card-title font-weight-bold">Referral Bonus</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Earnings for referral</h6>
                                <h2>{{$settings->currency}}{{ number_format($ref_earnings, 2, '.', ',')}} </h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> all time referral
                            </div>
                        </div>
                    </div>
 
  <div class="col-12  col-lg-12 col-xl-12 mt-3">
                        <div class="card">
 <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_6e482"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.MediumWidget(
  {
  "symbols": [
    [
      "BITSTAMP:BTCUSD|12M"
    ],
    [
      "BINANCE:ETHUSDT|12M"
    ],
    [
      "BINANCE:DOGEUSDT|12M"
    ],
    [
      "BINANCE:SHIBUSDT|12M"
    ],
    [
      "BITSTAMP:XRPUSD|12M"
    ]
  ],
  "chartOnly": false,
  "width": "100%",
  "height": 400,
  "locale": "en",
  "colorTheme": "light",
  "gridLineColor": "rgba(42 ,46, 57, 0)",
  "fontColor": "#787B86",
  "isTransparent": false,
  "autosize": false,
  "showFloatingTooltip": true,
  "scalePosition": "no",
  "scaleMode": "Normal",
  "fontFamily": "Trebuchet MS, sans-serif",
  "noTimeScale": false,
  "chartType": "area",
  "lineColor": "#2962FF",
  "bottomColor": "rgba(41, 98, 255, 0)",
  "topColor": "rgba(41, 98, 255, 0.3)",
  "container_id": "tradingview_6e482"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
  {
  "width": "100%",
  "height": 490,
  "defaultColumn": "overview",
  "screener_type": "crypto_mkt",
  "displayCurrency": "BTC",
  "colorTheme": "light",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
        

@endif


@if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='forex'))


 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"> <b>Forex Portfolio</b></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                 <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/wallet.png" alt="wallet" class="float-right" />
                                <h6 class="card-title font-weight-bold">Investment Balance</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Today</h6>
                                <h2>{{$settings->currency}}{{ number_format(Auth::user()->account_bal, 2, '.', ',')}}</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last day
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/money.png" alt="money" class="float-right" />
                                <h6 class="card-title font-weight-bold">Total Deposit</h6>
                                <h6 class="card-subtitle mb-2 text-muted">This Week</h6>
                                <h2>@foreach($deposited as $deposited)
						    @if(!empty($deposited->count))
							{{$settings->currency}}{{$deposited->count}}
							@else
							{{$settings->currency}}0.00
							@endif
							@endforeach</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last week
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/cart.png" alt="cart" class="float-right" />
                                <h6 class="card-title font-weight-bold">All Time Profit</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Total ROI</h6>
                                <h2>{{$settings->currency}}{{ number_format(Auth::user()->roi, 2, '.', ',')}}</h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> than last week
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="/dist/images/wallet.png" alt="wallet" class="float-right" />
                                <h6 class="card-title font-weight-bold">Referral Bonus</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Earnings for referral</h6>
                                <h2>{{$settings->currency}}{{ number_format($ref_earnings, 2, '.', ',')}} </h2>
                                <span class="text-success"><i class="ion ion-android-arrow-dropup"></i> <script>document.write(Math.ceil(Math.random() * 49))</script>%</span> all time referral
                            </div>
                        </div>
                    </div>
 
  <div class="col-12  col-lg-12 col-xl-12 mt-3">
                        <div class="card">
                 <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
  {
  "colorTheme": "light",
  "dateRange": "12M",
  "showChart": true,
  "locale": "en",
  "largeChartUrl": "",
  "isTransparent": false,
  "showSymbolLogo": true,
  "showFloatingTooltip": true,
  "width": "100%",
  "height": "660",
  "plotLineColorGrowing": "rgba(41, 98, 255, 1)",
  "plotLineColorFalling": "rgba(41, 98, 255, 1)",
  "gridLineColor": "rgba(42, 46, 57, 0)",
  "scaleFontColor": "rgba(120, 123, 134, 1)",
  "belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
  "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
  "belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
  "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
  "symbolActiveColor": "rgba(41, 98, 255, 0.12)",
  "tabs": [
    {
      "title": "Forex",
      "symbols": [
        {
          "s": "FX:EURUSD"
        },
        {
          "s": "FX:GBPUSD"
        },
        {
          "s": "FX:USDJPY"
        },
        {
          "s": "FX:USDCHF"
        },
        {
          "s": "FX:AUDUSD"
        },
        {
          "s": "FX:USDCAD"
        }
      ],
      "originalTitle": "Forex"
    }
  ]
}
  </script>
</div>
<!-- TradingView Widget END -->  

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-heat-map.js" async>
  {
  "width": "100%",
  "height": 400,
  "currencies": [
    "EUR",
    "USD",
    "JPY",
    "GBP",
    "CHF",
    "AUD",
    "CAD",
    "NZD",
    "CNY"
  ],
  "isTransparent": false,
  "colorTheme": "light",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
</div>
@endif

                    <br><br><br>
                    
        @include('modals')
	@include('footer')
	