<?php 
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $sql = "SELECT * FROM `supplier` ORDER BY `Id` DESC";
    $supplierList = mysqli_query($con, $sql);
?>



<div class="row">
    <div class="col-md-6">
        <form id="supplierCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Supplier</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse" class="collapse show">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for = "Name" class="control-label">Name</label>
                                    <input name = "Name" id = "Name" class="form-control" />
                                    <span asp-validation-for="Name" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label name = "Phone" class="control-label">Phone</label>
                                    <input name = "Phone" id = "Phone" class="form-control" />
                                    <span asp-validation-for="Phone" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label name = "Email" class="control-label"> Email</label>
                                    <input name = "Email" id = "Email" class="form-control" />
                                    <span asp-validation-for="Email" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Address" class="control-label">Address</label>
                                    <textarea class="form-control" name = "Address" id="Address" cols="3"></textarea>
                                    <span asp-validation-for="Address" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for = "Photo" class="control-label">Photo</label>
                                    <input type = "file" name = "Photo" id = "Photo" style="border:none;" class="form-control" />
                                    <span asp-validation-for="Photo" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="CompanyName" class="control-label">Company Name</label>
                                    <input name="CompanyName" id = "CompanyName" class="form-control" />
                                    <span asp-validation-for="CompanyName" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for = "Designation" class="control-label">Designation</label>
                                    <input name = "Designation" id = "Designation" class="form-control" />
                                    <span asp-validation-for="Designation" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="supplierResetBtn">Reset</button>
                        <button type="button" id="supplierCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Supplier List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="supplierList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_array($supplierList)){
                                echo "<tr>
                                        <td>".$row['Name']."</td>
                                        <td>".$row['Phone']."<br>".$row['Email']."</td>
                                        <td>".$row['Address']."</td>
                                </tr>";
                            }
                        ?>
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
        supplierCreateForm : $("#supplierCreateForm"),
        supplierCreateBtn : $("#supplierCreateBtn"),
        supplierList: $("#supplierList"),
        tableInformation: '',
    };

    class CRUDOperation{
        Save(){
            var formData = new FormData(selector.supplierCreateForm[0]);
            formData.append("save", "save");
            let response = ajaxOperation.SaveAjax("../controller/Supplier.php", formData);
            
            if(JSON.parse(response) === true){
                toastr.success("Successfully Added Supplier", "Success");
                selector.supplierCreateForm[0].reset();
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
    }

    let process = new CRUDOperation();

    selector.supplierCreateBtn.click(function(){
        process.Save();
    });

    window.onload = function(){
        selector.supplierList.DataTable();
    };

</script>