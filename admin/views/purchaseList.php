<?php 
    $headerName = '- Purchase Details';
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
                    <h5 class="m-0 p-0" style="color: #fff;">Purchase List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="purchaseList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Invoice Number</th>
                            <th>Supplier Name</th>
                            <th>Sub Total</th>
                            <th>Discount</th>
                            <th>Grand Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqlQuery = "SELECT p.*, sp.Name
                            FROM purchase p
                            INNER JOIN supplier sp ON sp.Id = p.SupplierId";

                            $queryResult = mysqli_query($con, $sqlQuery);
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $id = $row['Id']; $name = $row['Name'];
                                $invoiceNumber = $row['InvoiceNumber'];
                                $subTotal = $row['SubTotal']; $grandTotal = $row['GrandTotal']; 
                                $discount = $row['Discount']; $purchaseDate = $row['PurchaseDate'];

                                echo '<tr>
                                    <td>'.$invoiceNumber. '</td>
                                    <td>'.$name.'</td>
                                    <td>'.number_format($subTotal, 2, '.', ','). '</td>
                                    <td>'. number_format($discount, 2, '.', ',').'</td>
                                    <td>'.number_format($grandTotal, 2, '.', ',').'</td>
                                    <td>'.$purchaseDate.'</td>
                                    <td>'."<button class = 'btn btn-warning btn-sm purchaseInformation' invoiceNumber = '$invoiceNumber' >View</button>".'</td></tr>';
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
    let ajaxOperation = new AjaxOperation();
    let modalOperation = new ModalOperation();
    
    let words = new Array();
    words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';
    words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';
    words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';
    words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';
    words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';
    words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';
    words[90] = 'Ninety';
    
    let selector = {
        purchaseList : $("#purchaseList"),
        purchaseInformation: ".purchaseInformation",
        purchaseBtnInformationReport: "#purchaseBtnInformationReport",
        purchaseInformationReport: "purchaseInformationReport",
    }

    let modal = {
        informationModalDiv: "#informationModalDiv",
        informationModal: "#informationModal",
        modalHeading : $("#modalHeading"),
    }

    function PopulateTableData(){
        var purchaseList = selector.purchaseList.dataTable({
                "processing": true,
                "serverSide": false,
                "filter": true,
                "pageLength": 10,
                "autoWidth": false,
                'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                "order": [[0, "desc"]],
                "columnDefs": [
                        { "className": "custom", "targets": [0, 1, 2, 3,4,5,6] },
                    ],
                });
    
    }

    window.onload = PopulateTableData();

    function convertNumberToWords(amount) {
        amount = amount.toString();
        var attempt = amount.split(".");
        var number = attempt[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        return words_string;
    }

    $(document).on("click", selector.purchaseInformation, function(){
        let invoiceNumber = $(this).attr("invoiceNumber");
        let response = ajaxOperation.GetAjaxHtmlByValue("htmlHelper/purchaseDetail.php", invoiceNumber);
        modalOperation.ModalStatic(modal.informationModal);
        modal.modalHeading.text("Purchase Detail");
        modalOperation.ModalOpenWithHtml(modal.informationModal, modal.informationModalDiv, response);
        
        let number = $("#getConversionNumber").val();

        let amountInWords = convertNumberToWords(Number(number));
        let fraction = number.split(".");
        if(Number(fraction[1]) > 0){
            let fractionalNumber = fraction[1].toString();
            amountInWords += " point " + words[Number(fractionalNumber[0])];
        }
        
        $("#amountInWords").text(amountInWords);
    });

    $(document).on("click", selector.purchaseBtnInformationReport, function(){
        printDiv(selector.purchaseInformationReport);
    })

})();

</script>