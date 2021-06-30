<?php 
    $headerName = '- Customer';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<style>
    .odd {
        background-color: #b3ffff;
    }

    .even {
        background-color: #b3b3ff;
    }
    .custom{
        text-align: center;
        font-weight: 600;
    }
    table tr th, tr td{
        text-align: center;
    }
</style>

<div class="row">
    <div class = "col-md-12">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Customer List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="customerList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `users` WHERE UserType = 'Customer'";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $Name = $row['Name'];
                                $Phone = $row['Phone'];
                                $Email = $row['Email'];
                                $Address = $row['Address'];
                            ?>
                                <tr>
                                    <td><?php echo $Name;?></td>
                                    <td><?php echo $Phone;?></td>
                                    <td><?php echo $Email;?></td>
                                    <td><?php echo $Address;?></td>
                                </tr>
                           <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include("layout/footer.php"); ?>
<script>
    (function(){
        $("#customerList").dataTable();
    })();
</script>