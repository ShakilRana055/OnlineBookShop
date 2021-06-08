<?php 
    $headerName = '- Stock Report';
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
        font-weight: 600;
    }
</style>

<div class="row">
    <div class = "col-md-12">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Stock Report</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="stockList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>SellPrice</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqlQuery = "SELECT s.Id, b.Name, s.Quantity, s.UnitPrice, (s.Quantity * s.UnitPrice) TotalPrice, DATE(s.UpdatedDate) Date
                                        FROM stock s
                                        INNER JOIN books b ON b.Id = s.BookId";

                            $queryResult = mysqli_query($con, $sqlQuery);
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $id = $row['Id']; $name = $row['Name'];
                                $quantity = $row['Quantity'];
                                $unitPrice = $row['UnitPrice']; $totalPrice = $row['TotalPrice']; 
                                $date = $row['Date']; 

                                echo '<tr>
                                        <td>'.$name. '</td>
                                        <td>'.number_format($quantity, 2, '.', ','). '</td>
                                        <td>'. number_format($unitPrice, 2, '.', ',').'</td>
                                        <td>'.number_format($totalPrice, 2, '.', ',').'</td>
                                        <td>'.$date.'</td>
                                    </tr>';
                            }
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
        let selector = {
            stockList : $("#stockList"),
        }
        function PopulateTableData(){
            var stockList = selector.stockList.dataTable({
                    "processing": true,
                    "serverSide": false,
                    "filter": true,
                    "pageLength": 10,
                    "autoWidth": false,
                    'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                    "order": [[0, "desc"]],
                    "columnDefs": [
                            { "className": "custom", "targets": [0, 1, 2, 3,4] },
                        ],
                });
        }

        window.onload = PopulateTableData();
    })();

</script>