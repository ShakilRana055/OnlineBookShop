<?php
    $headerName = "Home";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Registration</h2>
                            </div>

                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name = "Name" id="Name" value="" placeholder="Name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="number" class="form-control" id="phone" placeholder="Phone" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="Email" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="password" class="form-control" id="password" placeholder="Password..." value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password..." value="">
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <select class="w-100" id="country">
                                        <?php 
                                            $division = "
                                            Dhaka Division,
                                            Barisal Division,
                                            Chittagong Division,
                                            Khulna Division,
                                            Mymensingh Division,
                                            Rajshahi Division,
                                            Rangpur Division,
                                            Sylhet Division
                                            ";
                                            $divisions = explode(",", $division);
                                            for ($i=0; $i < count($divisions); $i++) { 
                                                $name = $divisions[$i];
                                                echo "<option value = '$name'>$name</option>";
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <textarea name="Address" class="form-control w-100" id="Address" cols="30" rows="10" placeholder="Your Address here..."></textarea>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>$140.00</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>$140.00</span></li>
                            </ul>

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="img/core-img/paypal.png" alt=""></label>
                                </div>
                            </div>

                            <div class="cart-btn mt-100">
                                <a href="#" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include("layout/footer.php");?>
<script>
    (function(){
        $(".select2").select2();
    })();
</script>