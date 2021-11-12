<?php 
    $headerName = '- Top 10 Sales';
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
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Top 10 Sales</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="top10SalesList">
                    <thead style="background-color: #ffd9b3;">
                        <tr style="text-align:center;">
                            <th>Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $className = ""; $count = 1;
                            $sql = "SELECT bk.Name, bk.PhotoUrl, SUM(Quantity) Quantity
                                    FROM invoicedetail inv 
                                    INNER JOIN books bk ON bk.Id = inv.BookId
                                    GROUP BY bk.Name, bk.PhotoUrl
                                    ORDER BY Quantity DESC LIMIT 10";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['Name'];
                                $photoUrl = $row['PhotoUrl'];
                                $quantity = $row['Quantity'];
                                $className = $count % 2 == 1 ? "odd" : "even";
                                $count++;
                        ?>
                                <tr class= "<?php echo $className;?>" style="text-align:center;">
                                    <td>
                                        <?php echo $name;?>
                                    </td>
                                    <td>
                                        <img src="<?php echo $photoUrl;?>" width="50" height="50" title="@item.ProductName" alt="No image" />
                                    </td>
                                    <td>
                                    <?php echo $quantity;?>
                                    </td>
                                </tr>
                                <?php 
                            }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Top 10 Sales</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <canvas id="top10PieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>
<script>
    (function () {
        let selector = {
            label: [],
            quantityCount: [],
            backgroundColor: [],
            top10SalesList: $("#top10SalesList"),
        }
        let ajaxOperation = new AjaxOperation();
        function ChartInformation() {
            let response = ajaxOperation.GetAjaxByValue("../controller/Top10Sales.php", "search");
            let backgroundColor = ['red', 'orange', 'yellow', 'green', 'brown', 'blue', 'purple', 'pink', 'teal', 'DarkOrange'];
            let data = JSON.parse(response);
            let j = 0;
            for (let i = 0; i < data.bookName.length; i++) {
                selector.backgroundColor.push(backgroundColor[j++]);
            }
            selector.label = data.bookName;
            selector.quantityCount = data.quantity;
            Top10PieChart();
        }
        function Top10PieChart() {
            var ctx = document.getElementById('top10PieChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: selector.label,
                    datasets: [{
                        backgroundColor: selector.backgroundColor,
                        data: selector.quantityCount,
                    }]
                },
                options: {
                    animation: {
                        animateScale: true
                    }
                }
            });
        }
        window.onload = function () {
            selector.top10SalesList.dataTable({"order": [[2, "desc"]]});
            ChartInformation();
        }
    })();
</script>