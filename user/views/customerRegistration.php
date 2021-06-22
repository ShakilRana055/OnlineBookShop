<?php
    $headerName = "Home";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Registration</h2>
                            </div>

                            <form id = "customerRegistration" method="post">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <input type="text" class="form-control" name = "Name" id="Name" value="" placeholder="Name" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <input type="number" class="form-control" name = "Phone" id="phone" placeholder="Phone" value="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <input type="email" class="form-control" name = "Email" id="email" placeholder="Email" value="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <input type="password" class="form-control" name = "Password" id="password" placeholder="Password..." value="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <select class="w-100" name = "Division" id="country">
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
                                    <div class="col-6 mb-3">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password..." value="">
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <textarea name="Address" class="form-control w-100" id="Address" cols="30" rows="10" placeholder="Your Address here..."></textarea>
                                    </div>
                                    <div class = "col-12 mb-3">
                                        <button type = "reset" class = "btn btn-danger">Cancel</button>
                                        <button type = "button" class = "btn btn-success" id = "addCustomer">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>

<?php include("layout/footer.php");?>
<script>
    (function(){
        let ajaxOperation = new AjaxOperation();
        let selector = {
            customerRegistration: $("#customerRegistration"),
            addCustomer: $("#addCustomer"),
            password: $("#password"),
            confirmPassword: $("#confirmPassword"),
        }

        function PasswordValidator()
        {
            if(selector.password.val() == '' || selector.confirmPassword.val() == '')
            {
                toastr.error("Password Can't be empty", "Error!");
                return false;
            }
            else if(selector.password.val() !== selector.confirmPassword.val())
            {
                toastr.error("Password Doesn't match", "Error!");
                return false;
            }
            else{
                return true;
            }
            
        }

        selector.addCustomer.click(function(){
            let formData = new FormData(selector.customerRegistration[0]);
            formData.append('save', 'save');
            if(PasswordValidator() === true)
            {
                let response = ajaxOperation.SaveAjax("../controller/Registration.php", formData);
                
                if(JSON.parse(response) === true){
                    toastr.success("Registration Completed", "Success!");
                    $(".form-control").val('');
                }
                else
                    toastr.error("Something went wrong!", "Error");
            }
        });
        
    })();
</script>