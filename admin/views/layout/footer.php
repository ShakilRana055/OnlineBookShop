</div><!-- container -->

            <footer class="footer text-center text-sm-left">
                &copy; <?php echo date('Y')?> Online Book Shop

                <span class="text-muted d-none d-sm-inline-block float-right">Created <i class="mdi mdi-heart text-danger"></i> by Punom & Pritom</span>
            </footer><!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->


    <!-- jQuery  -->
    <script src="../public/layout/assets/js/jquery.min.js"></script>
    <script src="../public/layout/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../public/layout/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../public/layout/assets/js/metisMenu.min.js"></script>
    <script src="../public/layout/assets/js/waves.min.js"></script>
    <script src="../public/layout/assets/js/jquery.slimscroll.min.js"></script>
    <script src="../public/layout/assets/js/lodash.min.js"></script>
    <!-- Plugins js -->
    <script src="../public/layout/assets/plugins/moment/moment.js"></script>
    <script src="../public/layout/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../public/layout/assets/plugins/select2/select2.min.js"></script>
    <script src="../public/layout/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="../public/layout/assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="../public/layout/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="../public/layout/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

    <script src="../public/layout/assets/plugins/filter/isotope.pkgd.min.js"></script>
    <script src="../public/layout/assets/plugins/filter/masonry.pkgd.min.js"></script>
    <script src="../public/layout/assets/plugins/filter/jquery.magnific-popup.min.js"></script>
    <script src="../public/layout/assets/pages/jquery.gallery.inity.js"></script>



    <script src="../public/layout/assets/pages/jquery.forms-advanced.js"></script>

    <!-- App js -->
    <script src="../public/layout/assets/js/app.js"></script>

    <!-- <script src="../public/layout/lib/bootstrap/dist/js/bootstrap.min.js"></script> -->

    <!-- dropify -->
    <script src="../public/layout/assets/plugins/dropify/js/dropify.min.js"></script>
    <script src="../public/layout/assets/pages/jquery.form-upload.init.js"></script>

    <!-- Rx js -->
    <script src="../public/layout/js/ObjectifyForm.js"></script>
    <script src="../public/layout/js/dateFormatter.js"></script>
    <script src="../public/layout/js/convert.js"></script>
    <script src="../public/layout/js/convert_amount.js"></script>

    <!--DataTable Js -->
    <script src="../public/layout/lib/DataTables/datatables.min.js"></script>

    <!-- toaster notification script -->
    <script src="../public/layout/lib/toastr/toastr.min.js"></script>

    <script src="../public/layout/js/site.js" asp-append-version="true"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.all.min.js"></script>

    <!--jquery frontend validation script -->
    <script src="../public/layout/lib/jquery-validation/dist/jquery.validate.min.js"></script>

    <!-- layout initialization like datepicker and select2 -->

    <script src="../public/layout/Pages/Layout.js"></script>
    <!-- <script src="~/AjaxLibrary/AjaxOperation.js"></script> -->

    <!-- @* sweet alert2 *@ -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <!--  block ui js *@ -->
    <script src="../public/layout/assets/plugins/block-ui/block-UI.js"></script>
    <script src="../public/layout/assets/plugins/chartjs/chart.min.js"></script>
    <script src="../public/layout/Pages/Print.js"></script>
    <script src = "../../ajax-library/AjaxOperation.js"></script>
    <script>
        function MobileNumberCheck(mobileNumber){
            let isOk = true;
            for(let i = 0 ; i < mobileNumber.size(); i ++){
                if(mobileNumber[i] >= '0' && mobileNumber[i] <= '9' || mobileNumber[i] == '+'){
                    continue
                }
                else{
                    isOk = false;
                }
            }
            return isOk;
        }
    </script>
</body>
</html>


<div id="informationModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="exampleModalLabel"><i class="fa fa-universal-access"><span id="modalHeading">Add Role</span> </i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="informationModalDiv">

            </div>
        </div>
    </div>
</div>