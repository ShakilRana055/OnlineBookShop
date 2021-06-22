<?php 
    session_start();
    include("../../connection/DatabaseConnection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Online Book Shop | <?php echo $headerName;?></title>

    <!-- Favicon  -->
    <link rel="icon" href="../public/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="../public/css/core-style.css">
    <link rel="stylesheet" href="../public/style.css">
    <!-- Data Table -->
    <link href="../../admin/public/layout/lib/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="../../admin/public/layout/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../../admin/public/layout/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="../../admin/public/layout/lib/toastr/toastr.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="../public/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->
