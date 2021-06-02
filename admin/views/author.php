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
        <form id="authorCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Author</h5>
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
                        <button type="reset" class="btn btn-secondary" id="authorResetBtn">Reset</button>
                        <button type="button" id="authorCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Author List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="authorList" >
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

<div class="row">
    <div class="col-md-6">
        <form id="publicationCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse1" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Publication</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse1" class="collapse show">
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
                        <button type="reset" class="btn btn-secondary" id="publicationResetBtn">Reset</button>
                        <button type="button" id="publicationCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Publication List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="publicationList" >
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
        authorCreateForm : $("#authorCreateForm"),
        authorCreateBtn : $("#authorCreateBtn"),
        authorResetBtn: $("#authorResetBtn"),
        authorList: $("#authorList"),
        tableInformation: '',
        
        name: $("#Name"),
        edit: ".editSupplierInformation",
        delete: ".deleteSupplierInformation",
        id : '',
    };

    class Author{
        Save(){
            let formData = new FormData(selector.authorCreateForm[0]);
            formData.append("save", "save");
            let response = ajaxOperation.SaveAjax("../controller/Author.php", formData);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Added Author", "Success");
                selector.authorCreateForm[0].reset();
            }
            else{
                toastr.error("Duplicate Author Name", "Error");
            }
        }
        Update(id){
            let formData = new FormData(selector.authorCreateForm[0]);
            formData.append("Id", id);
            formData.append("Update", "Update");

            let response = ajaxOperation.SaveAjax("../controller/Author.php", formData);
            console.log(response);
            if(JSON.parse(response) === true){
                toastr.success("Successfully Updated Admin!", "Success");
                selector.authorCreateForm[0].reset();
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
        Delete(id){
            let response = ajaxOperation.GetAjaxByValue("../controller/Author.php", id);
            if(JSON.parse(response) === true){
                toastr.success("Author Deleted Successfully!", "Success");
            }
            else{
                toastr.error("Something went wrong", "Error");
            }
        }
    }
    let validator = selector.authorCreateForm.validate({
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
        var adminList = selector.authorList.dataTable({
            "processing": true,
            "serverSide": true,
            "filter": true,
            "pageLength": 3,
            "autoWidth": false,
            "lengthMenu": [[3, 10, 50, 100, 150, 200, 500], [3, 10, 50, 100, 150, 200, 500]],
            "order": [[0, "desc"]],
                "ajax": {
                    "url": "../controller/AuthorList.php",
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
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx editSupplierInformation" 
                                        name = "${full.Name}" id = "${full.Id}"
                                    ><i class="fa fa-check-circle" aria-hidden="true"></i>Edit</button >
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx deleteSupplierInformation" id = "${full.Id}" > <i class="fa fa-times" aria-hidden="true"></i>Delete</button >
                                </div>
                                </div>`;
                        }
                            
                    }
                ]
            });
            selector.tableInformation = adminList;
    }

    window.onload = GenerateTable();
    let process = new Author();
    selector.authorCreateBtn.click(function(){
        if($(this).text() === "Save" && selector.authorCreateForm.valid()){ 
            process.Save();
        }
        else if($(this).text() === "Update" && selector.authorCreateForm.valid()){
            process.Update(selector.id);
            $(this).text("Save");
        }
        selector.tableInformation.fnFilter();
    });
    
    $(document).on("click", selector.edit, function(){
        selector.name.val($(this).attr("name"));
        selector.id = $(this).attr("id");
        selector.authorCreateBtn.text("Update");
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

    selector.authorResetBtn.click(function(){
        selector.authorCreateBtn.text("Save");
    })
})();
    
</script>