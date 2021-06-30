</div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.php">
                                <img src="../../admin/views/htmlHelper/bookShop.jpg" height = "50" width ="50" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite">                       
                            &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.php">Shop</a>
                                        </li>
                                        <?php if(isset($_SESSION['customer']['Id'])){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="cart.php">Shopping Cart</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="myCart.php">My Cart</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="../public/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../public/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../public/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="../public/js/plugins.js"></script>
    <!-- Active js -->
    <script src="../public/js/active.js"></script>

    <!--DataTable Js -->
    <script src="../../admin/public/layout/lib/DataTables/datatables.min.js"></script>
    <script src="../../admin/public/layout/assets/plugins/select2/select2.min.js"></script>
    <script src = "../../ajax-library/AjaxOperation.js"></script>
    <script src="../../admin/public/layout/assets/plugins/chartjs/chart.min.js"></script>

    <script src="../../admin/public/layout/lib/toastr/toastr.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
   

                                            

</body>

</html>