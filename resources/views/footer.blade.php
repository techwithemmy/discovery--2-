
                </div>                                
                        </div>
                    </div>
                </div>
                <!-- END: Card DATA-->
            </div>    
               
        </main>
        <!-- END: Content-->
<!--Start of Tawk.to Script-->
<style>
    
footer {
  background-color: #EAEDD0;
  text-align: center;
  width: 100%;
  position: fixed;
  bottom: 0;
}
</style>
<!--End of Tawk.to Script-->
 <!-- START: Footer-->
        <footer class="site-footer"><strong><font color="#000">Auto-Trade:</font><font color="green"> {{Auth::user()->trade_mode}}</font></strong>&nbsp;&nbsp;
        @if((Auth::user()->type =='0')&&(Auth::user()->acct_form =='forex'))
        <strong> <font color="#000">Active Signal Fee:</font><font color="teal"> ${{Auth::user()->sig}}</font></strong>
        @endif
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if(Auth::user()->stat =='1')
<script>
Swal.fire('{{Auth::user()->notify}}')
</script>
@endif

       </footer>
        <!-- END: Footer-->

   <!-- START: Template JS-->
        <script src="/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="/dist/vendors/moment/moment.js"></script>
        <script src="/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="/dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script> 
        <!-- END: Template JS-->
        
        <!-- START: APP JS-->
        <script src="/dist/js/app.js"></script>
        <!-- END: APP JS-->

        <!-- START: Page Vendor JS-->
        <script src="/dist/vendors/amcharts/core.js"></script>
        <script src="/dist/vendors/amcharts/charts.js"></script>
        <script src="/dist/vendors/amcharts/animated.js"></script>
        <script src="/dist/vendors/amcharts/amchartsdark.js"></script>
        <script src="/dist/vendors/amcharts/plugins/timeline.js"></script>
        <script src="/dist/vendors/amcharts/plugins/bullets.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->
        <script src="/dist/js/amcharts.script.js"></script>
        <!-- END: Page Script JS-->
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="381ac06c-63f3-461c-be07-9c9df9bc01f5";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    </body>
    <!-- END: Body-->
</html>
