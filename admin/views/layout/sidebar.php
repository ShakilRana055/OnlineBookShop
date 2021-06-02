<div class="page-wrapper">
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <div class="main-icon-menu" id="customScroll" >
                <nav class="nav" style = "margin-top: 100px !important;">
                    <a href="#menuDashboard" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title=""
                       data-original-title="Dashboard">
                        <i class="mdi mdi-view-dashboard"></i>
                    </a>
                    <a href="#menuUsers" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Users">
                        <i class="fas fa-user-tie"></i>
                    </a>
                    <a href="#generalSetup" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title=""
                       data-original-title="Book Attributes">
                        <i class="fab fa-connectdevelop"></i>
                    </a>
                    <a href="#inventoryManagement" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title=""
                       data-original-title="Inventory">
                        <i class="fas fa-warehouse"></i>
                    </a>
                    <a href="#SalesManagement" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title=""
                       data-original-title="Sales Management">
                        <i class="fas fa-cash-register"></i>
                    </a>
                    <a href="#reportManagement" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title=""
                       data-original-title="Report">
                        <i class="fas fa-chart-pie"></i>
                    </a>
                    <a href="#mainSettings" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title=""
                       data-original-title="Settings">
                        <i class="dripicons-gear"></i>
                    </a>

                </nav><!--end nav-->
            </div><!--end main-icon-menu-->

            <div class="main-menu-inner">
                <div class="menu-body slimscroll">
                    <div id="menuDashboard" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Home</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Dashboard</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a asp-controller="Dashboard" asp-action="Index">Dashboard</a></li>
                                    <li><a asp-controller="Product" asp-action="Index">Add Product</a></li>
                                    <li><a asp-controller="Inventory" asp-action="Index">Purchase</a></li>
                                    <li><a asp-controller="SalesInvoice" asp-action="Index">Add Sale</a></li>
                                    <li><a asp-controller="SalesInvoice" asp-action="Top10Sale">Top 10 Sale</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="menuUsers" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Users</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Users</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href = "supplier.php">Supplier</a></li>
                                    <li><a href = "#">Customer</a></li>
                                    <li><a href = "adminAccount.php">Admin Account</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="generalSetup" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Book Attributes</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Book Attributes</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href = "author.php">Author & Publication</a></li>
                                    <li><a href = "category.php">Category & Sub-Category</a></li>
                                    <li><a href = "#">Add Book</a></li>
                                    <li><a href = "#">Book List</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="inventoryManagement" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Inventory Management</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Inventory</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a asp-controller="Inventory" asp-action="Index">Purchase</a></li>
                                    <li><a asp-controller="Inventory" asp-action="PurchaseList">Purchase List</a></li>
                                    <li><a asp-controller="Inventory" asp-action="AccountPay">Accounts Payable</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="SalesManagement" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Sales Management</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Sale Management</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a asp-controller="SalesInvoice" asp-action="Index">Add Sale</a></li>
                                    <li><a asp-controller="SalesInvoice" asp-action="SalesInvoiceList">Sales List</a></li>
                                    <li><a asp-controller="SalesInvoice" asp-action="AccountReceivable">Account Receivable</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div id="reportManagement" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Report</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Report</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a asp-controller="Report" asp-action="StockReport">Stock Report</a></li>
                                    <li><a asp-controller="Report" asp-action="SupplierReport">Supplier Report</a></li>
                                    <li><a asp-controller="Report" asp-action="CustomerReport">Customer Report</a></li>
                                    <li><a asp-controller="Report" asp-action="RevenueAndLoss">Income Statement</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div id="mainSettings" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Settings</h6>
                        </div>
                        <ul class="nav metismenu" id="main_menu_side_nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="dripicons-document"></i><span class="w-100">Setting</span>
                                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a asp-controller="Setting" asp-action="SendEmailToSupplier">Email to Supplier</a></li>
                                    <li><a asp-controller="Setting" asp-action="SendEmailToCustomer">Email to Customer</a></li>
                                    <li><a asp-controller="Setting" asp-action="ChangePassword">Change Password</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div><!--end menu-body-->
            </div><!-- end main-menu-inner-->
        </div>
        <!-- end left-sidenav-->
        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <div id="CommonNav" class="row bg-white" style="margin:-15px -15px 10px -15px;display:none;">
                    <div class="col-lg-9">

                    </div><!-- end col-->
                    <div class="col-lg-3">
                        <a href="#" id="CloseCommonNav" style="right:5px;position:absolute;">
                            <i class="fa fa-times text-dark" aria-hidden="true"></i>
                        </a>
                        <div class="card box-shadow" style="margin-bottom:0; margin:20px 5px 10px 5px;">
                            <div class="card-body dash-info-carousel">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item">
                                            <div class="row" style="margin-left:2px;">
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Project Launch Date</h4>
                                                        <div class="my-3">
                                                            <img src="~/layout/assets/images/widgets/p-1.svg" alt="" height="60" class="">
                                                        </div>
                                                        <h2 class="project-title mb-1">Marketech World</h2>
                                                        <p class="mb-1 text-muted"><span class="mr-2 text-secondary font-14"><b>190 Days</b></span> Tuesday, 25 July 2019</p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div><!--end carousel-item-->
                                        <div class="carousel-item">
                                            <div class="row" style="margin-left:2px;">
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Project Launch Date</h4>
                                                        <div class="my-3">
                                                            <img src="~/layout/assets/images/widgets/p-2.svg" alt="" height="60" class="">
                                                        </div>
                                                        <h2 class="project-title mb-1">Book My World</h2>
                                                        <p class="mb-1 text-muted"><span class="mr-2 text-secondary font-14"><b>130 Days</b></span> Tuesday, 25 July 2019</p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div><!--end carousel-item-->

                                        <div class="carousel-item">
                                            <div class="row" style="margin-left:2px;">
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Project Launch Date</h4>
                                                        <div class="my-3">
                                                            <img src="~/layout/assets/images/widgets/p-3.svg" alt="" height="60" class="">
                                                        </div>
                                                        <h2 class="project-title mb-1">Organic Farming</h2>
                                                        <p class="mb-1 text-muted"><span class="mr-2 text-secondary font-14"><b>100 Days</b></span> Tuesday, 25 July 2019</p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div><!--end carousel-item-->
                                        <div class="carousel-item active">
                                            <div class="row" style="margin-left:2px;">
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Project Launch Date</h4>
                                                        <div class="my-3">
                                                            <img src="~/layout/assets/images/widgets/p-4.svg" alt="" height="60" class="">
                                                        </div>
                                                        <h2 class="project-title mb-1">Transfer money</h2>
                                                        <p class="mb-1 text-muted"><span class="mr-2 text-secondary font-14"><b>85 Days</b></span> Tuesday, 25 July 2019</p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div><!--end carousel-item-->

                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div>
                </div><!--end row-->