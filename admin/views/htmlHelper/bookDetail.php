<?php include("../../../connection/DatabaseConnection.php");?>
<?php
    $id = $_GET['search'];
    $sql = "SELECT * FROM books WHERE Id = '$id'";
    $QueryResult = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>

<form id="bookEditCreateForm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for = "Name" class="control-label">Name</label>
                <input name = "Name" value = "<?php echo $QueryResult['Name'];?>" id = "Name" required class="form-control" />
                <span validation-for="Name" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label name = "WarningQuantity" class="control-label"> Warning Quantity</label>
                <input type = "number" value = "<?php echo $QueryResult['WarningQuantity'];?>"  min = "1" name = "WarningQuantity" id = "WarningQuantity" class="form-control" />
                <span validation-for="WarningQuantity" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for = "Photo" class="control-label">Photo</label>
                <input style = "border:none;" accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG" type = "file" name = "Photo" id = "Photo" class="form-control" />
                <span validation-for="Photo" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="Description" class="control-label">Description</label>
                <textarea class="form-control" name = "Description" id="Description" cols="3"><?php echo $QueryResult['Description'];?></textarea>
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
                            if($QueryResult['AuthorId'] == $id){
                                echo "<option value = '$id' selected = 'selected'>$name</option>";
                            }
                            else{
                                echo "<option value = '$id'>$name</option>";
                            }
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
                            if($QueryResult['CategoryId'] == $id){
                                echo "<option value = '$id' selected = 'selected'>$name</option>";
                            }
                            else{
                                echo "<option value = '$id'>$name</option>";
                            }
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
                            if($QueryResult['SubCategoryId'] == $id){
                                echo "<option value = '$id' selected = 'selected'>$name</option>";
                            }
                            else{
                                echo "<option value = '$id'>$name</option>";
                            }
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
                            if($QueryResult['PublicationId'] == $id){
                                echo "<option value = '$id' selected = 'selected'>$name</option>";
                            }
                            else{
                                echo "<option value = '$id'>$name</option>";
                            }
                        }
                    ?>
                </select>
                <span validation-for="PublicationId" class="text-danger"></span>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal" id="">Cancel</button>
            <button type="button" id="bookEditBtn" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>