<?php
    $cartPending = 0;
    if(isset($_SESSION['customer']['Name']))
    {
        $id = $_SESSION['customer']['Id'];
        $sql = "SELECT count(1) Cart
                FROM temporder
                WHERE UserId = '$id'
                group by UserId";
        $cartResult = mysqli_fetch_assoc(mysqli_query($con, $sql));
        $cartPending = $cartResult['Cart'];
    }
?>

<div class="main-content-wrapper d-flex clearfix">

<div class="mobile-nav">
    <!-- Navbar Brand -->
    <div class="amado-navbar-brand">
        <a href="index.html"><img src="../public/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Navbar Toggler -->
    <div class="amado-navbar-toggler">
        <span></span><span></span><span></span>
    </div>
</div>

<header class="header-area clearfix"  >
    
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    
    <div class="logo">
        <a href="index.php">
            <img src="../../admin/views/htmlHelper/bookShop.jpg" alt=""></a>
    </div>
    
    <nav class="amado-nav">
        <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <?php 
            if(isset($_SESSION['customer']['Name']))
            {?>
                <li><a href="myCart.php">My Cart</a></li>
                <li><a href="editProfile.php">Edit Profile</a></li>
                <li><a href="../controller/LogOut.php">Log out</a></li>
            <?php
            }else {?>
                <li><a href="login.php">Login</a></li>
                <li><a href="customerRegistration.php">Registration</a></li>
            <?php
            }
            ?>
            
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="newCollection.php" class="btn amado-btn mb-15 btn-info">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
    <?php 
        if(isset($_SESSION['customer']['Name']))
        {?>
            <a href="cart.php" class="cart-nav">
                <img src="../public/img/core-img/cart.png" alt=""> Cart <span>(<?php echo $cartPending;?>)</span>
            </a>
        <?php
        }
    ?>
        
        <a href="search.php" class="search-nav"><img src="../public/img/core-img/search.png" alt=""> Search</a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>
</header>
<!-- Header Area End -->