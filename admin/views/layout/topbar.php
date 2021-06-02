<?php session_start();?>
<?php include("../../connection/DatabaseConnection.php")?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Book Shop</title>


    <!-- App favicon -->
    <link rel="shortcut icon" href="../public/layout/assets/images/favicon.ico">

    <!--  Font Awesome 5.12.0-->
    <link href="../public/layout/fonts/fontawesome-free-5.12.0-web/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../public/layout/fonts/fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet" />

    <!-- Plugins css -->
    <link href="../public/layout/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="../public/layout/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../public/layout/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../public/layout/assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="../public/layout/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="../public/layout/assets/plugins/filter/magnific-popup.css" rel="stylesheet" />

    <!-- App css -->
    <link href="../public/layout/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../public/layout/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="../public/layout/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="../public/layout/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../public/layout/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />

    <!-- Data Table -->
    <link href="../public/layout/lib/DataTables/datatables.min.css" rel="stylesheet" />

    <!-- dropify -->
    <link href="../public/layout/assets/plugins/dropify/css/dropify.min.css" rel="stylesheet">

    <!-- toaster notification style -->
    <link href="../public/layout/lib/toastr/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/layout/css/site.css" />
    <link href="../public/layout/css/custom.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet" />
</head>
<body>

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="/Dashboard/Index" class="logo">
            <h4 style = "color: purple; font-weight: 900; margin-bottom:0px !important">Online Book Shop</h4>
                <span>
                <img src="../public/layout/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
            </a>
            
        </div>
        <!--end logo-->
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-right mb-0">

                <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <h6 class="dropdown-item-text">
                                Notifications (18)
                            </h6>
                            <div class="slimscroll notification-list">
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                    <p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                                </a>
                            </div>
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img id="userImage" src="<?php echo $_SESSION['user']['PhotoUrl'];?>" alt="profile-user" class="rounded-circle" />
                        <span class="ml-1 nav-user-name hidden-sm" id="userName"> <?php echo $_SESSION['user']['Name'];?><i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        
                        <a asp-action="LogOut" asp-controller="Login" class="dropdown-item"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" id="right_sidebarbtn" class="nav-link">
                        <i class="fas fa-hashtag" style="font-size:25px;color:#ffffff" aria-hidden="true"></i>
                    </a>
                </li>
            </ul><!--end topbar-nav-->
            <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="button-menu-mobile nav-link waves-effect waves-light">
                            <i class="dripicons-menu nav-icon"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fas fa-search"></i></a>
                            </form>
                        </li>
                </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <!----Right Sidebar-->
    <div id="right_sidebar" class="animated" style="display:none;">
    </div>
