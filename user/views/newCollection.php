<?php
    $headerName = "New Collection";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<link rel="stylesheet" type="text/css" href="../public/cart.css" media="screen" />


<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <?php
                $sql = "SELECT s.*, b.Name, b.PhotoUrl, b.Id BookId, b.Description
                        FROM stock s 
                        INNER JOIN books b ON s.BookId = b.Id
                        WHERE s.UpdatedDate BETWEEN CURRENT_DATE - 6 AND CURRENT_DATE";
                $result = mysqli_query($con, $sql);
                $count = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                    $photoUrl = $row['PhotoUrl'];
                    $UnitPrice = $row['UnitPrice'];
                    $name = $row['Name'];
                    $description = $row['Description'];
                    $BookId = $row['BookId'];
            ?>
                        <div class="col-md-3" >
                            <div class="card">
                                <img src="<?php echo $photoUrl;?>" alt="No Image" style="width:100%; height: 100px;">
                                <h6><?php echo $name;?></h6>
                                <p class="price">৳: <?php echo $UnitPrice;?></p>
                                <p><?php echo substr((string)$description,0, 15);?></p>
                                <a href = "bookDetail.php?bookId=<?php echo $BookId?>"><button>Detail</button></a>
                            </div>
                        </div>
                        
            <?php 
                }
            ?>
            </div>
    </div>
</div>
    
<?php include("layout/footer.php");?>
