<?php
    $headerName = "Book Detail";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<?php
    $bookId = $_GET['bookId'];
    $sqlQuery = "SELECT b.*, p.Name PublicationName, c.Name CategoryName, s.Name SubCategoryName, st.Quantity, st.UnitPrice
                FROM books b
                INNER JOIN authors a ON b.AuthorId = a.Id
                INNER JOIN publications p ON p.Id = b.PublicationId
                INNER JOIN category c ON c.Id = b.CategoryId
                INNER JOIN subcategory s ON s.Id = b.SubCategoryId
                INNER JOIN stock st ON st.BookId = b.Id
                WHERE b.Id = '$bookId'";
    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
?>

<div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(<?php echo $queryResult['PhotoUrl'];?>);">
                                    </li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="<?php echo $queryResult['PhotoUrl'];?>">
                                            <img class="d-block w-100" src="<?php echo $queryResult['PhotoUrl'];?>" alt="First slide">
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">৳: <?php echo $queryResult['UnitPrice'];?></p>
                            
                                <h3><?php echo $queryResult['Name'];?></h3>
                            
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <p class="avaibility">
                                    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> 
                                    <?php echo $queryResult['Quantity'] > 0 ? "Available": "Not Available";?>
                                </p>
                            </div>

                            <div class="short_overview my-5">
                                <p><?php echo $queryResult['Description'];?></p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix" method="post">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <button type="submit" title = "Add to Cart" name="addtocart" value="5" class="btn btn-success btn-lg btn-block"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include("layout/footer.php");?>