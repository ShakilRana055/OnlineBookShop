<?php
    $headerName = "Shop";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<link rel="stylesheet" type="text/css" href="../public/cart.css" media="screen" />

<form action = "" method = "post">
<div class="shop_sidebar_area">

    <div class="widget catagory mb-50">
        <h6 class="widget-title mb-30">Catagories</h6>

        <div class="catagories-menu">
            <ul>
                <?php
                    $query = "SELECT Id, Name FROM `category`";
                    $queryResult = mysqli_query($con, $query);
                    foreach( $queryResult as $value)
                    { 
                        ?>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "Category[]" value="<?php echo $value['Id'];?>" id="<?php echo $value['Name'].$value['Id'];?>">
                            <label class="form-check-label Category" for="<?php echo $value['Name'].$value['Id'];?>"><?php echo $value['Name'];?></label>
                        </div>
                    <?php }
                ?>
            </ul>
        </div>
    </div>
    
    <div class="widget catagory mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Sub Categories</h6>

        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul>
            <?php
                    $query = "SELECT `Id`, `Name` FROM `subcategory`";
                    $queryResult = mysqli_query($con, $query);
                    foreach( $queryResult as $value)
                    {
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "SubCategory[]" value="<?php echo $value['Id'];?>" id="<?php echo $value['Name'].$value['Id'];?>">
                            <label class="form-check-label subCategory" for="<?php echo $value['Name'].$value['Id'];?>"><?php echo $value['Name'];?></label>
                        </div>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </div>

        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Price</h6>
            <span id="slider_value" style="color:red;">0</span>
            <div>
                <?php 
                    $maxMin = "SELECT MAX(UnitPrice) MaxPrice, MIN(UnitPrice)MinPrice, round((MAX(UnitPrice) + MIN(UnitPrice))/2)MidPrice
                                FROM stock";
                    $maxMinResult = mysqli_fetch_assoc(mysqli_query($con, $maxMin));
                ?>
                <input width="200" type="range" min="0" max="<?php echo $maxMinResult['MaxPrice'];?>" name="sliderPrice" value="0" onchange="show_value(this.value);"><span><?php echo $maxMinResult['MaxPrice'];?></span>
            </div>
        </div>
    <div class="widget catagory mb-50">
        <div class="catagories-menu">
            <ul>
                <li><div> <button type = "submit" name = "filterAll" class = "btn btn-success btn-sm">Filter</button></div></li>
            </ul>
        </div>
    </div>
</div>
</form>
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <?php
                $sql = '';
                if(isset($_POST['filterAll'])){
                    $categories = isset($_POST['Category']) ? $_POST['Category'] : array();
                    $subCategories = isset($_POST['SubCategory']) ? $_POST['SubCategory'] : array();
                    $sliderPrice = $_POST['sliderPrice'];
                    $categoryId = '';
                    $subCategoryId = '';

                    for($i = 0; $i < count($categories); $i++){
                        $categoryId .= $categories[$i].',';
                    }

                    for($i = 0; $i < count($subCategories); $i++){
                        $subCategoryId .= $subCategories[$i].',';
                    }
                    
                    $categoryId = substr($categoryId,0, strlen($categoryId) - 1);
                    $subCategoryId = substr($subCategoryId,0, strlen($subCategoryId) - 1);

                    $sql = "SELECT s.*, b.Name, b.PhotoUrl, b.Description, ct.Id CategoryId, sct.Id SubCategoryId
                            FROM stock s
                            INNER JOIN books b ON b.Id = s.BookId
                            INNER JOIN category ct ON ct.Id = b.CategoryId
                            INNER JOIN subcategory sct ON sct.Id = b.SubCategoryId
                            WHERE 1 = 1 ";
                    if($categoryId != ''){
                        $sql .= "AND ct.Id IN($categoryId) ";
                    }
                    if($subCategoryId != ''){
                        $sql .= "AND sct.Id IN($subCategoryId) ";
                    }
                    if($sliderPrice != 0){
                        $sql .= "AND s.UnitPrice BETWEEN 0 AND $sliderPrice";
                    }
                }
                else{
                    $sql = "SELECT s.*, b.Name, b.PhotoUrl, b.Description, ct.Id CategoryId, sct.Id SubCategoryId
                    FROM stock s
                    INNER JOIN books b ON b.Id = s.BookId
                    INNER JOIN category ct ON ct.Id = b.CategoryId
                    INNER JOIN subcategory sct ON sct.Id = b.SubCategoryId";
                }
                $res_data = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($res_data))
                {
                    $photoUrl = $row['PhotoUrl'];
                    $UnitPrice = $row['UnitPrice'];
                    $name = $row['Name'];
                    $description = $row['Description'];
                    $BookId = $row['BookId'];
                    ?>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="<?php echo $photoUrl;?>" alt="No Image" style="width:100%; height: 100px;">
                                <h6><?php echo substr((string)$name,0, 13);?></h6>
                                <p class="price">৳: <?php echo $UnitPrice;?></p>
                                
                                <p style = "background-color: #ffb3d9;">
                                    <a href="bookDetail.php?bookId=<?php echo $BookId;?>" class = "btn" data-toggle="tooltip"title="Detail">
                                    <img src="../public/img/core-img/info.png" height = "30" width = "30" alt=""></a>
                                    
                                    
                                    <?php 
                                        if(isset($_SESSION['customer']['Id']))
                                        {
                                            $userId = $_SESSION['customer']['Id'];
                                            $tempQuery = "SELECT Id FROM `temporder` WHERE `UserId` = '$userId' AND `BookId` = '$BookId'";
                                            $tempResult = mysqli_query($con, $tempQuery);
                                            if(mysqli_num_rows($tempResult) == 0)
                                            { ?>
                                                <a class = "addToCart btn" bookId = "<?php echo $BookId;?>" title="Add to Cart">
                                                <img src="../public/img/core-img/cart.jpg" height = "30" width = "30" alt=""></a>
                                       
                                            <?php }
                                        }
                                        else
                                        { ?>
                                            <a class = "addToCart btn" bookId = "<?php echo $BookId;?>" title="Add to Cart">
                                            <img src="../public/img/core-img/cart.jpg" height = "30" width = "30" alt=""></a>
                                    <?php } ?>
                                   
                                </p>
                            </div>
                        </div>
                    <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>


<script>
    function show_value(x)
    {
        document.getElementById("slider_value").innerHTML=x;
    }
    (function(){

        

        let ajaxOperation = new AjaxOperation();
        let selector = {
            addToCart: ".addToCart",
        }
        function AddToCart(bookId)
        {
            let response = ajaxOperation.GetAjaxByValue("../controller/Shop.php", bookId);
            

            if(response == "login"){
                toastr.error("Please Login First", "Error!");
            }
            else if(response == "exist"){
                toastr.error("Already Added into Cart", "Error");
            }
            else if( response == "success"){
                toastr.success("Added to the Cart", "Success!");
            }
            else if(response == "error"){
                toastr.error("Something went wrong", "Error!");
            }  
        }
        $(document).on("click", selector.addToCart, function(){
            let bookId = $(this).attr("bookId");
            AddToCart(bookId);
        });
    })();
</script>
