<?php 
    include("layout/topbar.php");
    include("layout/sidebar.php");
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
    <div class="col-md-12">
        <form id="bookCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Add Book</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="Collapse" class="collapse show">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for = "Name" class="control-label">Name</label>
                                    <input name = "Name" id = "Name" required class="form-control" />
                                    <span validation-for="Name" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label name = "WarningQuantity" class="control-label"> Warning Quantity</label>
                                    <input type = "number" value = "1" min = "1" name = "WarningQuantity" id = "WarningQuantity" class="form-control" />
                                    <span validation-for="WarningQuantity" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for = "Photo" class="control-label">Photo</label>
                                    <input style = "border:none;" accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG" type = "file" name = "Photo" id = "Photo" class="form-control" />
                                    <span validation-for="Photo" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Description" class="control-label">Description</label>
                                    <textarea class="form-control" name = "Description" id="Description" cols="3"></textarea>
                                    <span validation-for="Description" class="text-danger"></span>
                                </div>
                            </div>
                            <div class = "col-md-6">
                                <div class="form-group">
                                    <label for="AuthorId" class="control-label">Author Name</label>
                                    <select class="form-control select2" id="AuthorId" name = "AuthorId">
                                        <option value = "">------Select------</option>
                                        <?php 
                                            $sql = "SELECT Id, Name FROM authors";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                $id = $row['Id']; $name = $row['Name'];
                                                echo "<option value = '$id'>$name</option>";
                                            }
                                        ?>
                                    </select>
                                    <span validation-for="AuthorId" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="CategoryId" class="control-label">Category</label>
                                    <select class="form-control select2" id="CategoryId" name = "CategoryId">
                                        <option value = "">------Select------</option>
                                        <?php 
                                            $sql = "SELECT Id, Name FROM category";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                $id = $row['Id']; $name = $row['Name'];
                                                echo "<option value = '$id'>$name</option>";
                                            }
                                        ?>
                                    </select>
                                    <span validation-for="CategoryId" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="SubCategoryId" class="control-label">Sub Category</label>
                                    <select class="form-control select2" id="SubCategoryId" name = "SubCategoryId">
                                        <option value = "">------Select------</option>
                                        <?php 
                                            $sql = "SELECT Id, Name FROM subcategory";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                $id = $row['Id']; $name = $row['Name'];
                                                echo "<option value = '$id'>$name</option>";
                                            }
                                        ?>
                                    </select>
                                    <span validation-for="SubCategoryId" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="PublicationId" class="control-label">Publisher</label>
                                    <select class="form-control select2" id="PublicationId" name = "PublicationId">
                                        <option value = "">------Select------</option>
                                        <?php 
                                            $sql = "SELECT Id, Name FROM publications";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                $id = $row['Id']; $name = $row['Name'];
                                                echo "<option value = '$id'>$name</option>";
                                            }
                                        ?>
                                    </select>
                                    <span validation-for="PublicationId" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="bookResetBtn">Reset</button>
                        <button type="button" id="bookCreateBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("layout/footer.php"); ?>

<script>

(function(){
    $(".select2").select2();
    let ajaxOperation = new AjaxOperation();
    let selector = {
        bookCreateForm : $("#bookCreateForm"),
        bookCreateBtn : $("#bookCreateBtn"),
        bookResetBtn: $("#bookResetBtn"),
        tableInformation: '',

        name: $("#Name"),
        warningQuantity: $("#WarningQuantity"),
        photo: $("#Photo"),
        description: $("#Description"),
        authorId: $("#AuthorId"),
        categoryId: $("#CategoryId"),
        subCategoryId: $("#SubCategoryId"),
        publisherId: $("#PublisherId"),
        id : '',
    };

    class Book{
        Save(){
            let formData = new FormData(selector.bookCreateForm[0]);
            formData.append("save", "save");
            let photo = selector.photo.get(0);
            formData.append('Photo', photo.files);
            let response = ajaxOperation.SaveAjax("../controller/Book.php", formData);
            
            if(JSON.parse(response) === true){
                toastr.success("Successfully Added Book", "Success");
                selector.bookCreateForm[0].reset();
            }
            else{
                toastr.error("Duplicate Book Name", "Error");
            }
        }
    }

    let validator = selector.bookCreateForm.validate({
            rules: {
                Name: {
                    required: true,
                },
                WarningQuantity: {
                    required: true,
                },
                AuthorId: {
                    required: true,
                },
                CategoryId: {
                    required: true,
                },
                SubCategoryId: {
                    required: true,
                },
                PublicationId: {
                    required: true,
                },
            },
            messages: {
                Name: "Name is required",
                WarningQuantity: "Warning Quantity is required",
                AuthorId: "Author name is required",
                CategoryId: "Category Name is required",
                SubCategoryId: "Sub-Category Name is required",
                PublicationId: "Publisher Name is required",
            },
            submitHandler: function (form) {
            }
        });
    
    let process = new Book();
    selector.bookCreateBtn.click(function(){
        if($(this).text() === "Save" && selector.bookCreateForm.valid()){ 
            process.Save();
        }
        else{
            toastr.error("Please fill up the required field", "Error");
        }
    });
})();

</script>