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
        <form id="categoryCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Category</h5>
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
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="categoryResetBtn">Reset</button>
                        <button type="button" id="categoryCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
    <form id="subCategoryCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse1" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Sub-Category</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse1" class="collapse show">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for = "subCategoryName" class="control-label">Name</label>
                                    <input name = "Name" id = "subCategoryName" required class="form-control" />
                                    <span validation-for="subCategoryName" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="subCategoryResetBtn">Reset</button>
                        <button type="button" id="subCategoryCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Category List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="categoryList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Sub-Category List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="subCategoryList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Name</th>
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
(function(){
    let ajaxOperation = new AjaxOperation();
    let selector = {
        categoryCreateForm : $("#categoryCreateForm"),
        categoryCreateBtn : $("#categoryCreateBtn"),
        categoryResetBtn: $("#categoryResetBtn"),
        categoryList: $("#categoryList"),
        tableInformation: '',
        
        name: $("#Name"),
        edit: ".editCategoryInformation",
        delete: ".deleteCategoryInformation",
        id : '',
    };

    class Category{
        Save(){
            let formData = new FormData(selector.categoryCreateForm[0]);
            formData.append("save", "save");
            let response = ajaxOperation.SaveAjax("../controller/Category.php", formData);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Added Category", "Success");
                selector.categoryCreateForm[0].reset();
            }
            else{
                toastr.error("Duplicate Category Name", "Error");
            }
        }
        Update(id){
            let formData = new FormData(selector.categoryCreateForm[0]);
            formData.append("Id", id);
            formData.append("Update", "Update");

            let response = ajaxOperation.SaveAjax("../controller/Category.php", formData);
            console.log(response);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Updated Category!", "Success");
                selector.categoryCreateForm[0].reset();
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
        Delete(id){
            let response = ajaxOperation.GetAjaxByValue("../controller/Category.php", id);
            if(JSON.parse(response) === true){
                toastr.success("Category Deleted Successfully!", "Success");
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
    }
    let validator = selector.categoryCreateForm.validate({
                rules: {
                    Name: {
                        required: true,
                    },
                },
                messages: {
                    Name: "Name Field is required",
                },
                submitHandler: function (form) {

                }
            });
    
    function GenerateTable(){
        var adminList = selector.categoryList.dataTable({
            "processing": true,
            "serverSide": true,
            "filter": true,
            "pageLength": 5,
            "autoWidth": false,
            "lengthMenu": [[5, 10, 50, 100, 150, 200, 500], [5, 10, 50, 100, 150, 200, 500]],
            "order": [[0, "desc"]],
                "ajax": {
                    "url": "../controller/CategoryList.php",
                    "type": "POST",
                    "data": function (data) {
                    },
                    "complete": function (json) {

                    }
                },
                "columnDefs": [
                    { "className": "custom", "targets": [0, 1] },
                ],
                "columns": [
                    { "data": "Name", "name": "Name", "autowidth": true, "orderable": true },
                    {
                        "render": function (data, type, full, meta) {
                            return `
                                <div class="btn-group">
                                    <i class="fa fa-ellipsis-h" title = 'Actions' style = 'cursor:pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu" >
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx editCategoryInformation" 
                                        name = "${full.Name}" id = "${full.Id}"
                                    ><i class="fa fa-check-circle" aria-hidden="true"></i>Edit</button >
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx deleteCategoryInformation" id = "${full.Id}" > <i class="fa fa-times" aria-hidden="true"></i>Delete</button >
                                </div>
                                </div>`;
                        }
                            
                    }
                ]
            });
            selector.tableInformation = adminList;
    }

    window.onload = GenerateTable();
    let process = new Category();
    selector.categoryCreateBtn.click(function(){
        if($(this).text() === "Save" && selector.categoryCreateForm.valid()){ 
            process.Save();
        }
        else if($(this).text() === "Update" && selector.categoryCreateForm.valid()){
            process.Update(selector.id);
            $(this).text("Save");
        }
        selector.tableInformation.fnFilter();
    });
    
    $(document).on("click", selector.edit, function(){
        selector.name.val($(this).attr("name"));
        selector.id = $(this).attr("id");
        selector.categoryCreateBtn.text("Update");
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

    selector.categoryResetBtn.click(function(){
        selector.categoryCreateBtn.text("Save");
    })
})();
</script>

<script>
(function(){
    let ajaxOperation = new AjaxOperation();
    let selector = {
        subCategoryCreateForm : $("#subCategoryCreateForm"),
        subCategoryCreateBtn : $("#subCategoryCreateBtn"),
        subCategoryResetBtn: $("#subCategoryResetBtn"),
        subCategoryList: $("#subCategoryList"),
        tableInformation: '',
        
        name: $("#subCategoryName"),
        edit: ".editSubCategoryInformation",
        delete: ".deleteSubCategoryInformation",
        id : '',
    };

    class SubCategory{
        Save(){
            let formData = new FormData(selector.subCategoryCreateForm[0]);
            formData.append("save", "save");
            let response = ajaxOperation.SaveAjax("../controller/SubCategory.php", formData);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Added Sub-Category", "Success");
                selector.subCategoryCreateForm[0].reset();
            }
            else{
                toastr.error("Duplicate Sub-Category Name", "Error");
            }
        }
        Update(id){
            let formData = new FormData(selector.subCategoryCreateForm[0]);
            formData.append("Id", id);
            formData.append("Update", "Update");

            let response = ajaxOperation.SaveAjax("../controller/SubCategory.php", formData);
            
            if(JSON.parse(response) === true){
                toastr.success("Successfully Updated Sub-Category!", "Success");
                selector.subCategoryCreateForm[0].reset();
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
        Delete(id){
            let response = ajaxOperation.GetAjaxByValue("../controller/SubCategory.php", id);
            if(JSON.parse(response) === true){
                toastr.success("Deleted Successfully!", "Success");
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
    }
    let validator = selector.subCategoryCreateForm.validate({
                rules: {
                    subCategoryName: {
                        required: true,
                    },
                },
                messages: {
                    subCategoryName: "Name Field is required",
                },
                submitHandler: function (form) {

                }
            });
    
    function GenerateTable(){
        var adminList = selector.subCategoryList.dataTable({
            "processing": true,
            "serverSide": true,
            "filter": true,
            "pageLength": 5,
            "autoWidth": false,
            "lengthMenu": [[5, 10, 50, 100, 150, 200, 500], [5, 10, 50, 100, 150, 200, 500]],
            "order": [[0, "desc"]],
                "ajax": {
                    "url": "../controller/SubCategoryList.php",
                    "type": "POST",
                    "data": function (data) {
                    },
                    "complete": function (json) {

                    }
                },
                "columnDefs": [
                    { "className": "custom", "targets": [0, 1] },
                ],
                "columns": [
                    { "data": "Name", "name": "Name", "autowidth": true, "orderable": true },
                    {
                        "render": function (data, type, full, meta) {
                            return `
                                <div class="btn-group">
                                    <i class="fa fa-ellipsis-h" title = 'Actions' style = 'cursor:pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu" >
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx editSubCategoryInformation" 
                                        name = "${full.Name}" id = "${full.Id}"
                                    ><i class="fa fa-check-circle" aria-hidden="true"></i>Edit</button >
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx deleteSubCategoryInformation" id = "${full.Id}" > <i class="fa fa-times" aria-hidden="true"></i>Delete</button >
                                </div>
                                </div>`;
                        }
                            
                    }
                ]
            });
            selector.tableInformation = adminList;
    }

    window.onload = GenerateTable();
    let process = new SubCategory();

    selector.subCategoryCreateBtn.click(function(){
        if($(this).text() === "Save" && selector.subCategoryCreateForm.valid()){ 
            process.Save();
        }
        else if($(this).text() === "Update" && selector.subCategoryCreateForm.valid()){
            process.Update(selector.id);
            $(this).text("Save");
        }
        selector.tableInformation.fnFilter();
    });
    
    $(document).on("click", selector.edit, function(){
        selector.name.val($(this).attr("name"));
        selector.id = $(this).attr("id");
        selector.subCategoryCreateBtn.text("Update");
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

    selector.subCategoryResetBtn.click(function(){
        selector.subCategoryCreateBtn.text("Save");
    })
})();
</script>