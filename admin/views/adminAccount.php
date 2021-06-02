<?php 
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $sql = "SELECT * FROM `supplier` ORDER BY `Id` DESC";
    $adminList = mysqli_query($con, $sql);
?>

<style>
    .odd {
        background-color: #99ff99;
    }

    .even {
        background-color: #aa80ff;
    }
    .custom{
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-md-6">
        <form id="adminCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Admin</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse" class="collapse show">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for = "Name" class="control-label">Name</label>
                                    <input name = "Name" id = "Name" required class="form-control" />
                                    <span validation-for="Name" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label name = "Email" class="control-label"> Email</label>
                                    <input type = "email" name = "Email" id = "Email" class="form-control" />
                                    <span validation-for="Email" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Password" class="control-label">Password</label>
                                    <input type = "password" name="Password" id = "Password" class="form-control" />
                                    <span validation-for="Password" class="text-danger"></span>
                                </div>
                                <div id="passwordChecker"></div>
                                <div class="form-group">
                                    <label for="ConfirmPassword" class="control-label">Confirm Password</label>
                                    <input type = "password" name="ConfirmPassword" id = "ConfirmPassword" class="form-control" />
                                    <span validation-for="ConfirmPassword" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for = "Phone" class="control-label">Phone</label>
                                    <input type = "number" name = "Phone" id = "Phone" class="form-control" />
                                    <span validation-for="Phone" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for = "Photo" class="control-label">Photo</label>
                                    <input style = "border:none;" accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG" type = "file" name = "Photo" id = "Photo" class="form-control" />
                                    <span validation-for="Photo" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Address" class="control-label">Address</label>
                                    <textarea class="form-control" name = "Address" id="Address" cols="3"></textarea>
                                    <span validation-for="Address" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="adminResetBtn">Reset</button>
                        <button type="button" id="adminCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Admin List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="adminList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>

<script>
    let ajaxOperation = new AjaxOperation();
    let selector = {
        adminCreateForm : $("#adminCreateForm"),
        adminCreateBtn : $("#adminCreateBtn"),
        adminList: $("#adminList"),
        tableInformation: '',
        name: $("#Name"),
        phone: $("#Phone"),
        email: $("#Email"),
        address: $("#Address"),
        password: $("#Password"),
        confirmPassword: $("#ConfirmPassword"),
        designation: $("#Designation"),
        edit: ".editSupplierInformation",
        delete: ".deleteSupplierInformation",
        id : '',
        passwordChecker: $("#passwordChecker"),
        photo: $("#Photo"),
    };

    class CRUDOperation{
        Save(){
            let formData = new FormData(selector.adminCreateForm[0]);
            formData.append("save", "save");
            let photo = selector.photo.get(0);
            formData.append('Photo', photo.files);
            let response = ajaxOperation.SaveAjax("../controller/Admin.php", formData);
            console.log(response);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Added Admin", "Success");
                selector.adminCreateForm[0].reset();
                selector.passwordChecker.html("");
            }
            else{
                toastr.error("Duplicate Email", "Error");
            }
        }
        Update(id){
            let formData = new FormData(selector.adminCreateForm[0]);
            formData.append("Id", id);
            let photo = selector.photo.get(0);
            formData.append('Photo', photo.files);

            formData.append("Update", "Update");
            let response = ajaxOperation.SaveAjax("../controller/Admin.php", formData);
            console.log(response);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Updated Admin!", "Success");
                selector.adminCreateForm[0].reset();
            }
            else{
                toastr.error("Duplicate Phone Number", "Error");
            }
        }
        Delete(id){
            let response = ajaxOperation.GetAjaxByValue("../controller/Supplier.php", id);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Deleted Supplier!", "Success");
                selector.adminCreateForm[0].reset();
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
    }

    let validator = selector.adminCreateForm.validate({
                rules: {
                    Name: {
                        required: true,
                    },
                    Email: {
                        required: true,
                    },
                    Password: {
                        required: true,
                    },
                    ConfirmPassword: {
                        required: true,
                    },
                },
                messages: {
                    Name: "Name Field is required",
                    Email: "Email Field is required",
                    Password: "Password Field is required",
                    ConfirmPassword: "Confirm Password Field is required",
                },
                submitHandler: function (form) {

                }
            });

    function GenerateTable(){
        var adminList = selector.adminList.dataTable({
                "processing": true,
                "serverSide": true,
                "filter": true,
                "pageLength": 6,
                "autoWidth": false,
                "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                "order": [[0, "desc"]],
                    "ajax": {
                        "url": "../controller/AdminList.php",
                        "type": "POST",
                        "data": function (data) {

                        },
                        "complete": function (json) {

                        }
                    },
                    "columnDefs": [
                        { "className": "custom", "targets": [0, 1, 2, 3] },
                    ],
                    "columns": [
                        { "data": "Name", "name": "Name", "autowidth": true, "orderable": true },
                        {
                            "render": function (data, type, full, meta) {
                                return `${full.Phone} <br/> ${full.Email}`;
                            }
                        },
                        { "data": "Address", "name": "Address", "autowidth": true, "orderable": true },
                        {
                            "render": function (data, type, full, meta) {
                                if(full[0].LoggedUserType === "Admin"){
                                    if(full.Email !== "superadmin@gmail.com"){
                                            return `<button style="font-size: inherit;" class=" btn btn-primary dropdown-item btn-sm editSupplierInformation" 
                                                    name = "${full.Name}" phone = "${full.Phone}" email = "${full.Email}" address = "${full.Address}"
                                                    id = "${full.Id}"
                                                    >Edit</button >`;
                                    }
                                    else{
                                        return "";
                                    }
                                }
                                else{
                                    return `
                                        <div class="btn-group">
                                            <i class="fa fa-ellipsis-h" title = 'Actions' style = 'cursor:pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" >
                                            <button style="font-size: inherit;" class="dropdown-item btn-rx editSupplierInformation" 
                                                name = "${full.Name}" phone = "${full.Phone}" email = "${full.Email}" address = "${full.Address}"
                                                id = "${full.Id}"
                                            ><i class="fa fa-check-circle" aria-hidden="true"></i>Edit</button >
                                            <button style="font-size: inherit;" class="dropdown-item btn-rx deleteSupplierInformation" id = "${full.Id}" > <i class="fa fa-times" aria-hidden="true"></i>Delete</button >
                                        </div>
                                        </div>`;
                                }
                                
                            }
                        },
                    ]
                });
                selector.tableInformation = adminList;
    }

    let process = new CRUDOperation();

    window.onload = function(){
        GenerateTable();
    };

    selector.adminCreateBtn.click(function(){
        if($(this).text() === "Save" && selector.adminCreateForm.valid() && PasswordMatch() === true){ 
            process.Save();
        }
        else if($(this).text() === "Update" && selector.adminCreateForm.valid()){
            process.Update(selector.id);
            $(this).text("Save");
        }
        selector.tableInformation.fnFilter();
    });

    $(document).on("click", selector.edit, function(){
        selector.name.val($(this).attr("name"));
        selector.phone.val($(this).attr("phone"));
        selector.email.val($(this).attr("email"));
        selector.address.val($(this).attr("address"));
        selector.companyName.val($(this).attr("companyName"));
        selector.designation.val($(this).attr("designation"));
        selector.id = $(this).attr("id");
        selector.adminCreateBtn.text("Update");
    });

    $(document).on("click", selector.delete, function(){
        Swal.fire({
                    title: 'Are You Sure to Delete?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showConfirmButton: true,
                    allowEscapeKey: false,
                    allowOutsideClick: false,

                }).then((result) => {
                    if (result.value) {
                        process.Delete($(this).attr("id"));
                        selector.tableInformation.fnFilter();
                    }
                });
        
    });
    function PasswordMatch(){
        let password = selector.password.val();
        let confirmPassword = selector.confirmPassword.val();
        if(password === confirmPassword){
            selector.passwordChecker.html("Matched");
            selector.passwordChecker.css("color", "green");
        }
        else if(password !== confirmPassword){
            selector.passwordChecker.html("Not Matched");
            selector.passwordChecker.css("color", "red");
        }
        else{
            selector.passwordChecker.html("");
        }
        return true;
    }
    selector.password.keyup(PasswordMatch);
    selector.confirmPassword.keyup(PasswordMatch);
</script>