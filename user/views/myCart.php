<?php
    $headerName = "My Cart";
    include("layout/topbar.php");
    include("layout/sidebar.php");
    include("../controller/InvoiceStatus.php");
?>
<style>
    table thead th, tbody td{
        text-align:center;
    }
    table tfoot td{
        text-align:right;
    }
</style>

<div class="section-padding-100">
        <div class="cart-title mt-50">
            <h2>My Cart</h2>
        </div>
    <table class="table table-bordered table-responsive table-hover" id = "myCartInformation">
        <thead>
            <tr style = "background-color: #d9b3ff;">
                <th>Invoice Number</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Grand Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="">
            <?php 
                $userId = $_SESSION['customer']['Id'];
                $query = "SELECT * FROM `invoice` WHERE `UserId` = '$userId' ORDER BY Id DESC";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result))
                {
                    $InvoiceNumber = $row['InvoiceNumber'];
                    $InvoiceDate = $row['InvoiceDate'];
                    $Status = $row['Status'];
                    $GrandTotal = $row['GrandTotal'];
                    $Id = $row['Id'];
                    $className = '';
                    if($Status == Status::Pending()){
                        $className = "badge badge-pill badge-primary";
                    }
                    else if($Status == Status::Shipment()){
                        $className = "badge badge-pill badge-info";
                    }
                    else{
                        $className = "badge badge-pill badge-success";
                    }
                ?>
                    <tr>
                        <td><?php echo $InvoiceNumber;?></td>
                        <td><?php echo $InvoiceDate;?></td>
                        <td>
                            <span class="<?php echo $className;?>"><?php echo $Status;?></span>
                        </td>
                        <td>৳<?php echo $GrandTotal;?>/-</td>
                        <td><a href = "cartDetails.php"><button class = "btn btn-info btn-sm">Detail</button></a></td>
                    </tr>
                <?php }

            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table> 
</div>


<?php include("layout/footer.php");?>

<script>
    window.onload = function(){
        $("#myCartInformation").dataTable();
    }
</script>