<?php
    $headerName = "Shop";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<link rel="stylesheet" type="text/css" href="../public/cart.css" media="screen" />
<div class="shop_sidebar_area">
    <!-- ##### Single Widget ##### -->
    <div class="widget catagory mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Catagories</h6>

        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul>
                <?php
                    $query = "SELECT Id, Name FROM `category`";
                    $queryResult = mysqli_query($con, $query);
                    foreach( $queryResult as $value)
                    {
                        echo "<li><a href = '#'>".$value['Name']."</a><li>";
                    }
                ?>
            </ul>
        </div>
    </div>

    <!-- ##### Single Widget ##### -->
    <div class="widget brands mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Sub Categories</h6>

        <div class="widget-desc">
            <!-- Single Form Check -->

            <?php
                    $query = "SELECT `Id`, `Name` FROM `subcategory`";
                    $queryResult = mysqli_query($con, $query);
                    foreach( $queryResult as $value)
                    {
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "SubCategory[]" value="<?php echo $value['Id'];?>" id="<?php echo $value['Name'].$value['Id'];?>">
                            <label class="form-check-label" for="<?php echo $value['Name'].$value['Id'];?>"><?php echo $value['Name'];?></label>
                        </div>
                    <?php
                    }
                ?>
        </div>
    </div>
        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Price</h6>

            <div class="widget-desc">
                <div class="slider-range">
                    <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1000" data-label-result="">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    <div class="range-price">$10 - $1000</div>
                </div>
            </div>
        </div>
</div>
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;
                
                $total_pages_sql = "SELECT COUNT(*)
                                    FROM stock s 
                                    INNER JOIN books b ON b.Id = s.BookId";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $sql = "SELECT s.*, b.Name, b.PhotoUrl, b.Description
                        FROM stock s 
                        INNER JOIN books b ON b.Id = s.BookId LIMIT $offset, $no_of_records_per_page";
                $res_data = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($res_data)){
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
                                
                                <p>
                                    <a href="bookDetail.php?bookId=<?php echo $BookId;?>" class = "btn" data-toggle="tooltip"title="Detail">
                                    <img src="../public/img/core-img/info.png" height = "30" width = "30" alt=""></a>
                                
                                    <a class = "addToCart btn" bookId = "<?php echo $BookId;?>" title="Add to Cart">
                                    <img src="../public/img/core-img/cart.jpg" height = "30" width = "30" alt=""></a>
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
            else if( response == "success"){
                toastr.success("Added to the Cart", "Success!");
            }
            else if(response == "error"){
                toastr.error("Something went wrong", "Error!");
            }  
        }
        $(document).on("click", selector.addToCart, function(){
            let bookId = $(this).attr("bookId");
            //AddToCart(bookId);
            // console.log(bookId);
        });
    })();
</script>
