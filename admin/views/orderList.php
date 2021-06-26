<?php 
    $headerName = '- Order Details';
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
</style>

<div class="row">
    <div class = "col-md-12">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Order List</h5>
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="orderList" >
                    <thead style = "background-color: #ffd9b3;"> 
                        <tr>
                            <th>Invoice Number</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Sub-Total</th>
                            <th>Grand-Total</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
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
        orderList : $("#orderList"),
        proceedToNextLevel : ".proceedToNextLevel",
        viewOrderInformation: ".viewOrderInformation",
        purchaseBtnInformationReport: "#purchaseBtnInformationReport",
        viewOrderInformationReport: "viewOrderInformationReport",
        tableInformation : '',
    }

    let modal = {
        informationModalDiv: "#informationModalDiv",
        informationModal: "#informationModal",
        modalHeading : $("#modalHeading"),
    }

    function PopulateTableData(){
        var orderList = selector.orderList.dataTable({
            "processing": true,
            "serverSide": true,
            "filter": true,
            "pageLength": 10,
            "autoWidth": false,
            'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
            "order": [[0, "desc"]],
                "ajax": {
                    "url": "../controller/OrderList.php",
                    "type": "POST",
                    "data": function (data) {
                    },
                    "complete": function (json) {

                    }
                },
                "columnDefs": [
                    { "className": "custom", "targets": [0, 1,2,3,4,5,6,7] },
                ],
                "columns": [
                    { "data": "InvoiceNumber", "name": "InvoiceNumber", "autowidth": true, "orderable": true },
                    { "data": "Name", "name": "Name", "autowidth": true, "orderable": true },
                    { 
                        "render": function (data, type, full, meta) {
                            return `${full.Phone} </br>${full.Email} </br>${full.Address}`;
                        }
                    },
                    { "data": "SubTotal", "name": "SubTotal", "autowidth": true, "orderable": true },
                    { "data": "GrandTotal", "name": "GrandTotal", "autowidth": true, "orderable": true },
                    { "data": "InvoiceDate", "name": "OrderDate", "autowidth": true, "orderable": true },
                    { 
                        "render": function (data, type, full, meta) {
                            let className = '';
                            if(full.Status === "PENDING")
                            {
                                className = "badge badge-pill badge-primary";
                            }
                            else if(full.Status === "SHIPMENT"){
                                className = "badge badge-pill badge-danger";
                            }
                            else{
                                className = "badge badge-pill badge-success";
                            }
                            return `<span class="${className}">${full.Status}</span>`;
                        }
                    },
                    {
                        "render": function (data, type, full, meta) {
                            let btnName = '';
                            if(full.Status === "PENDING")
                            {
                                btnName = `<button style="font-size: inherit;" class="dropdown-item btn-rx proceedToNextLevel" 
                                            id = "${full.Id}" nextLevelName = "SHIPMENT" > 
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>Shipment</button >`;
                            }
                            else if(full.Status === "SHIPMENT"){
                                btnName = `<button style="font-size: inherit;" class="dropdown-item btn-rx proceedToNextLevel" 
                                            id = "${full.Id}" nextLevelName = "DELIVERED" > 
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>Delivered</button >`;
                            }
                            else{
                                btnName = "";
                            }
                            return `
                                <div class="btn-group">
                                    <i class="fa fa-ellipsis-h" title = 'Actions' style = 'cursor:pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu" >
                                    <button style="font-size: inherit;" class="dropdown-item btn-rx viewOrderInformation" 
                                         id = "${full.Id}" invoiceNumber = "${full.InvoiceNumber}"
                                    ><i class="fa fa-info-circle" aria-hidden="true"></i>Info</button >
                                    ${btnName}
                                </div>
                                </div>`;
                        }
                            
                    }
                ]
        });
        selector.tableInformation = orderList;
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

    $(document).on("click", selector.viewOrderInformation, function(){
        let invoiceNumber = $(this).attr("invoiceNumber");
        let response = ajaxOperation.GetAjaxHtmlByValue("htmlHelper/orderDetail.php", invoiceNumber);
        modalOperation.ModalStatic(modal.informationModal);
        modal.modalHeading.text("Order Detail");
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
        printDiv(selector.viewOrderInformationReport);
    });
    
    $(document).on("click", selector.proceedToNextLevel, function(){
        let LevelName = $(this).attr("nextLevelName");
        let Id = $(this).attr("id");
        let jsonData = {
            UpdateStatus: "UpdateStatus",
            LevelName,
            Id
        };
        let response = ajaxOperation.SavePostAjax("../controller/Order.php", jsonData);
        console.log(JSON.parse(response));
        if(JSON.parse(response) === true){
            selector.tableInformation.fnFilter();
            toastr.success("Proceeded to next Level", "Success!");
        }
        else{
            toastr.error("Proceed to next Level", "Error!");
        }
    });

})();

</script>