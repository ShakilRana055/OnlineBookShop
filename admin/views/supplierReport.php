<?php 
    $headerName = '- Supplier Report';
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
                    <h5 class="m-0 p-0" style="color: #fff;">Supplier Report</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="supplierReportList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Supplier Name</th>
                            <th>Sub Total</th>
                            <th>Grand Total</th>
                            <th>Dues</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqlQuery = "SELECT p.SupplierId, s.Name, Round(SUM(p.SubTotal)) SubTotal, Round(SUM(p.GrandTotal)) GrandTotal, Round(SUM(p.Dues)) Dues
                                        FROM purchase p 
                                        INNER JOIN supplier s ON s.Id = p.SupplierId
                                        GROUP BY p.SupplierId, s.Name";

                            $queryResult = mysqli_query($con, $sqlQuery);
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $id = $row['SupplierId']; $name = $row['Name'];
                                $SubTotal = $row['SubTotal'];
                                $GrandTotal = $row['GrandTotal']; $Dues = $row['Dues']; 

                                echo '<tr>
                                        <td>'.$name. '</td>
                                        <td>'.number_format($SubTotal, 2, '.', ','). '</td>
                                        <td>'. number_format($GrandTotal, 2, '.', ',').'</td>
                                        <td>'.number_format($Dues, 2, '.', ',').'</td>
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
            supplierReportList : $("#supplierReportList"),
        }
        function PopulateTableData(){
            var supplierReportList = selector.supplierReportList.dataTable({
                    "processing": true,
                    "serverSide": false,
                    "filter": true,
                    "pageLength": 10,
                    "autoWidth": false,
                    'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                    "order": [[0, "desc"]],
                    "columnDefs": [
                            { "className": "custom", "targets": [0, 1, 2, 3] },
                        ],
                });
        }

        window.onload = PopulateTableData();
    })();

</script>