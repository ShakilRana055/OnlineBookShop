<?php 
    $headerName = '- Password Change';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<div class="row">
    <div class="col-md-6">
        <form id="changePasswordForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Change Password</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse" class="collapse show">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="NewPassword" class="control-label">New Password</label>
                                    <input type="password" id="NewPassword" name = "NewPassword" class="form-control" />
                                    <span validation-for="NewPassword" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmPassword" class="control-label">Confirm Password</label>
                                    <input type="password" id="ConfirmPassword" name="ConfirmPassword" class="form-control" />
                                    <span validation-for="ConfirmPassword" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="changePasswordReset">Reset</button>
                        <button type="button" id="changePasswordBtn" class="btn btn-primary">Change</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("layout/footer.php"); ?>

<script>
    (function () {
        let ajaxOperation = new AjaxOperation();
        let selector = {
            newPassword: $("#NewPassword"),
            confirmPassword: $("#ConfirmPassword"),
            changePasswordForm: $("#changePasswordForm"),
            changePasswordBtn: $("#changePasswordBtn"),
            changePasswordReset: $("#changePasswordReset"),
        };

        selector.changePasswordBtn.click(function () {
            let newPassword = selector.newPassword.val();
            let confirmPassword = selector.confirmPassword.val();
            if (newPassword === confirmPassword) {
                let formData = new FormData(selector.changePasswordForm[0]);
                formData.append("Update", "update");
                let data = ajaxOperation.SaveAjax("../controller/ChangePassword.php", formData);
               
                if (JSON.parse(data) === true) {
                    toastr.success("Successfully Changed!", "Success");
                    $(".form-control").val("");
                }
                else {
                    toastr.error("Something went wrong!", "Error");
                }
            }
            else {
                toastr.error("Password doesn't match!", "Error");
            }
        })

    })();
</script>