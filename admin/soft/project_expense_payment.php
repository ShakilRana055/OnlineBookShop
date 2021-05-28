<?php include 'include/header.php';?>
<?php $table_heading = "Project Expense Payment";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<form class='cmxform form-horizontal' action="" id="raw_material_supplier_form">
    <div class='form-group'><label for='material_category' class='control-label col-lg-4'>Select Project Name </label>
        <div class='col-lg-4'>
            <select id='pay_for' class='form-control field_data search' style = "width:100%;">

                <option value="-1">Please Select One</option>
                             <?php
                                    $sql = "SELECT * FROM `projects` where IS_DELETED=0 ";
                                    $result1 = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($result1)):
                                ?>
                                    <option value="<?=$row['PROJECT_NO']?>"><?=$row['PROJECT_NAME']?></option>
                <?php endwhile;?>

            </select>
        </div>
    </div>
    
    <div class='form-group'><label for='expense_head' class='control-label col-lg-4'>Select Expense Head </label>
        <div class='col-lg-4'>
            <select id='expense_head' class='form-control field_data search' style = "width:100%;">

                <!-- ON change expense head here-->

            </select>
        </div>
    </div>
    
    
    <div class='form-group'><label for='payment_date' class='control-label col-lg-4'>Payment Date </label>
        <div class='col-lg-4'><input class='form-control field_data' id='payment_date' type='date' value='' req='1' is_double='0' /></div>
    </div>
</form>






<form class='cmxform form-horizontal' action="" id="make_payment_form">

    <div>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Make new payment</legend>



            <div class="col-sm-6">

                <div class='form-group'><label for='material_name' class='control-label col-lg-4'>Payment method </label>
                    <div class='col-lg-7'>
                        <select id='payment_method' class='form-control field_data '>
                            <option value="1">Cheque</option>
                            <option value="2">Cash</option>
                        </select>
                    </div>
                </div>
                <div class='form-group cheque'><label for='bank_name' class='control-label col-lg-4'>Select Bank</label>
                    <div class='col-lg-7'>
                        <select id='bank_name' class='form-control field_data '>
                                
                        </select>
                    </div>
                </div>

                <div class='form-group cheque'><label for='account_no' class='control-label col-lg-4'>Select Account</label>
                    <div class='col-lg-7'>
                        <select id='account_no' class='form-control field_data '>

                        </select>
                    </div>
                </div>
                <div class='form-group cheque'><label for='account_name' class='control-label col-lg-4'>Account name </label>
                    <div class='col-lg-7'><input class='form-control field_data' id='account_name' type='text' value='' req='1' is_double='0' disabled /></div>
                </div>




            </div>
            <div class="col-sm-6">

                <div class='form-group cheque'><label for='branch_name' class='control-label col-lg-4'>Branch name </label>
                    <div class='col-lg-7'><input class='form-control field_data' id='branch_name' type='text' value='' req='1' is_double='0' disabled /></div>
                </div>

                <div class='form-group'><label for='payment_amount' class='control-label col-lg-4'>Payment amount</label>
                    <div class='col-lg-7'><input class='form-control field_data' id='payment_amount' type='number' value='' req='1' is_int='1' />
                        <span style='color:red'>
                            <p>Current Balance: <strong id='current_balance'>0.00</strong> BDT</p>
                        </span>
                    </div>
                </div>



                <div class='form-group cheque'><label for='cheque_no' class='control-label col-lg-4'>Cheque no.</label>
                    <div class='col-lg-7'><input class='form-control field_data' id='cheque_no' type='number' value='' req='1' is_int='1' /></div>
                </div>
                <div class='form-group'><label for='receive_remarks' class='control-label col-lg-4'>Remarks </label>
                    <div class='col-lg-7'><textarea class='form-control field_data' id='receive_remarks' req='1' rows='1'></textarea></div>
                </div>
                <div class='form-group'>
                    <div class='pull-right'>
                        <input type='button' class='btn btn-primary' table_name='sd_xass' id='add_receive' value='Pay' />
                    </div>
                </div>

            </div>
        </fieldset>

    </div>




</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Project Name</th>
			<th>Expense Head Name</th>
			<th>Date</th>
			<th>Account Number</th>
			<th>Branch Name</th>
			<th>Payment Amount</th>
			<th>Payment Method</th>
			<th>Cheque No</th>
		</tr>
	</thead>
	<tbody id='record'></tbody>
</table>


 <?php include 'include/footer.php';?>
 
 
 <script>
    var paymentInsertData = [];
    var paymentPrintData = [];
    var customerData = [];
    var customerCode = "";
    var customerNo = "";
    var html = "";
    var ajaxStatus = "";
    var masterId = "<?php
                    if (isset($_GET['master'])) {
                        echo $_GET['master'];
                    } else echo "";
                    ?>";
    var orderAmounts = [];
    var selectedAccounts = [];

    
    function getTableData( tableData )
    {
        $.ajax( {
            url: "methods/accounts/accountRetrieve.php",
            method : "post",
            data: ({ "tableData": tableData }),
            dataType: "html",
            success: function( Result )
            {
                $("#record").html( Result ) ;
            }
            
        } ) ;
    }
    
    function handMadeSaveData( handMadeSaveDataProject , expense_head_no, date ,payment_mode, bank_name,  account_no ,  account_name ,  branch_name, 
    payment_amount, cheque_no, receive_remarks , project_no )
            {
                $.ajax( { 
                    url: "methods/accounts/accountInserts.php" ,
                    method: "post",
                    data: ({ "handMadeSaveDataProject":handMadeSaveDataProject , "expense_head_no":expense_head_no , "date":date ,"payment_mode":payment_mode, "bank_name":bank_name,
                    "account_no": account_no ,  "account_name":account_name ,  "branch_name":branch_name, "payment_amount":payment_amount, 
                    "cheque_no":cheque_no, "receive_remarks":receive_remarks, "project_no": project_no }),
                    dataType: "html",
                    success: function(Result) {
                        if( Result == 1 )
                        {
                            Swal.fire({
                                position: 'top-middle',
                                type: 'success',
                                title: "Saved successfully",
                                showConfirmButton: false,
                                timer: 1500
                            }) ;
                            getTableData( "tableData" ) ;
                        }
                        else
                        {
                             Swal.fire({
                                position: 'top-middle',
                                type: 'error',
                                title: "Error",
                                showConfirmButton: false,
                                timer: 1500
                            }) ;
                        }
                    },
                    error: function(xhr, thrownError, ajaxOptions) {
        
                    }
                });
            }

    
    function getExpenseHead( expenseHead , project_no )
    {
        $.ajax( { 
            
            url: "methods/accounts/accountRetrieve.php",
            method : "post",
            data: ({ "expenseHead": expenseHead  , "project_no": project_no }),
            dataType: "html",
            success: function( Result )
            {
                $("#expense_head").html( Result ) ;
            }
            
        }) ;
    }
    
    function getBanks(action) {
        $.ajax({
            url: "methods/accounts/accountRetrieve.php",
            method: "post",
            data: ({
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                $("#bank_name").html(Result);
            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });
    }



    function getAccounts(bankNo, action) {
        $.ajax({
            url: "methods/accounts/accountRetrieve.php",
            method: "post",
            data: ({
                "bankNo": bankNo,
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                $("#account_no").html(Result);

            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });
    }

    function getCurrentBalance(action) {
        var pay_mode = $("#payment_method option:selected").val();
        var bank_name = $("#bank_name").val();
        var acc_no = $("#account_no").val();

        $.ajax({
            url: "methods/accounts/accountRetrieve.php",
            method: "post",
            data: ({
                "pay_mode": pay_mode,
                "bank_name": bank_name,
                "acc_no": acc_no,
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                if (!$.trim(Result)) {
                    $("#current_balance").html('0.00');

                } else {
                    $("#current_balance").html(Result);
                }



            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });
    }

    function getAccountInfo(accNo, action) {
        $.ajax({
            url: "methods/accounts/accountRetrieve.php",
            method: "post",
            data: ({
                "accNo": accNo,
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                var data = JSON.parse(Result);
                $("#account_name").val(data[0].ACCOUNT_NAME);
                $("#branch_name").val(data[0].BRANCH_NAME);

            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });
    }

    function getSupplierOrVendor(payFor, action) {
        //console.log(payFor);
        $.ajax({
            url: "methods/accounts/accountRetrieve.php",
            method: "post",
            data: ({
                "payFor": payFor,
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                $("#pay_for_selector").html(Result);

            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });
    }

    function getSupplierVendorOrders(payFor, receiver, action) {
        $.ajax({
            url: "methods/orders/orderRetrieves.php",
            method: "post",
            data: ({
                'payFor': payFor,
                'receiver': receiver,
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                $("#customer_orders").html(Result);



            },
            error: function(xhr, thrownError, ajaxOptions) {}
        });

    }

    function printTable(data) {
        for (var i = 0; i < data.length; i++) {
            html += '<tr id="' + i + 'rowunique">';
            html += "<td>" + i + "</td>";
            for (var j = 0; j < data[i].length; j++) {
                if (j == 3 || j == 4) {
                    html += "<td id=" + j + " style='display:none'>" + data[i][j] + "</td>";
                } else {
                    html += "<td id=" + j + ">" + data[i][j] + "</td>";
                }

            }
            html += "<td class='text-center'>" + "<div class='btn-group'><button data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn' name='" + i + "editbtn' id='" + i + "'><i class=' fa fa-pencil'></i>Edit</button>" + "<button data-toggle='tooltip' name='" + i + "deletbtn' title='Delete' class='btn btn-xs btn-danger deletebtn' id='" + i + "'><i class='fa fa-times'></i>Delete</button>" + "</div></td></tr>";
        }
        $("#recordList").html(html);
        html = "";
    }

    function calculateTableAmount() {
        var totalAmount = 0
        $(".receive_amount").each(function() {
            var get_amount = Number($(this).val());
            if (isNaN(get_amount)) {
                get_amount = 0;
            }
            totalAmount += get_amount;

        });

        return totalAmount;
    }

    function calculateArrayAmount(paymentInsertData) {
        var totalAmount = 0;
        for (i = 0; i < paymentInsertData.length; i++) {
            totalAmount = parseFloat(totalAmount) + parseFloat(paymentInsertData[i][5]);

        }

        return totalAmount;
    }

    function calculateArrayCurrentBalance(payMode, bankName, acccNo, paymentInsertData) {
        var totalAmount = 0;
        for (i = 0; i < paymentInsertData.length; i++) {
            if (paymentInsertData[i][0] == '2') {

                totalAmount = parseFloat(totalAmount) + parseFloat(paymentInsertData[i][5]);
                // console.log(totalAmount);
            } else {
                if (bankName == paymentInsertData[i][1] && acccNo == paymentInsertData[i][2]) {
                    totalAmount = parseFloat(totalAmount) + parseFloat(paymentInsertData[i][5]);
                }
            }


        }
        return totalAmount;
    }


    function saveMadePayment(paymentInsertData, orderAmounts, action) {
        $.ajax({
            url: "methods/accounts/accountInserts.php",
            method: "post",
            data: ({
                "paymentInsertData": paymentInsertData,
                "orderAmounts": orderAmounts,
                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {
                paymentInsertData.splice(0, paymentInsertData.length);
                paymentPrintData.splice(0, paymentPrintData.length);
                orderAmounts.splice(0, orderAmounts.length);
                printTable(paymentPrintData);
                
                $("#pay_for_selector").trigger('change');
                $("#save_receive").hide();
                if (Result == 1) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: "Saved successfully",
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: "Something wrong!!",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });

    }




    $(document).ready(function() {
        getSupplierOrVendor($("#pay_for option:selected").val(), 'getSupplierOrVendor');
        getBanks("getBanks");

        $("#pay_for").change(function() {
            if ($("#pay_for option:selected").val() == '2') {
                $("#pay_for_label").html('Select service provider')
            } else {
                $("#pay_for_label").html('Select supplier')
            }
            getSupplierOrVendor($("#pay_for option:selected").val(), 'getSupplierOrVendor');
        });

        $("#pay_for_selector").change(function() {

            getSupplierVendorOrders($("#pay_for option:selected").val(), $("#pay_for_selector option:selected").val(), 'getSupplierVendorOrders');
        });



        $("#payment_method").change(function() {

            getCurrentBalance('getCurrentBalance');

            if ($("#payment_method option:selected").val() == "1") {
                $(".cheque").show();

            } else {
                
                $(".cheque").hide();
            }

        });

        $("#bank_name").change(function() {
            getCurrentBalance('getCurrentBalance');
            getAccounts($("#bank_name option:selected").val(), 'getAccounts');
            setTimeout(disableSelected, 500, selectedAccounts);

        });
        $("#account_no").change(function() {
            getCurrentBalance('getCurrentBalance');
            getAccountInfo($("#account_no option:selected").val(), 'getAccountInfo');
        });

        /////////////////////////////////////////////////////payFor

        $(document).on('keyup', '.receive_amount', function() {

            var index = $(this).prop("id");
            var inputAmount = parseFloat($(this).val());

            var dueAmount = (parseFloat($('#customer_orders tr').eq(index).find('td').eq(7).text()));
            if (inputAmount > dueAmount) {
                Swal.fire({
                    position: 'top-end',
                    type: 'warning',
                    title: "Can't receive more than due amount",
                    showConfirmButton: false,
                    timer: 1500
                })
                $(this).val("0");
                $(this).focus();

            }



        });



        $("#payment_amount").keyup(function() {
            if( parseFloat($("#current_balance").text())< parseFloat($("#payment_amount").val()) )
            {
                Swal.fire({
                    position: 'top-end',
                    type: 'warning',
                    title: "Exceeding current balance",
                    showConfirmButton: false,
                    timer: 1500
                })
                $(this).focus();
                $(this).val('0')

            }

        });
        
        $( "#pay_for" ).on( "change", function( ) { 
             
             var project_no = $( "#pay_for option:selected").val( ) ;
             getExpenseHead( "expenseHead" , project_no ) ;
             
        }) ;

        
        $("#add_receive").click(function() {

            
////////////////////////////////handMade Insert Data ////////////////////////////////////////////////////////////////////
            var project_no = $("#pay_for" ).val() ;
            var expense_head_no = $("#expense_head" ).val() ;
            var date = $("#payment_date" ).val() ;
            var payment_mode = $("#payment_method" ).val() ;
            var bank_name = $("#bank_name" ).val() ;
            var account_no= $("#account_no" ).val( ) ;
            var account_name = $("#account_name" ).val( ) ;
            var branch_name = $("#branch_name" ).val( ) ;
            var payment_amount = $("#payment_amount" ).val( ) ;
            var cheque_no= $("#cheque_no" ).val( ) ;
            var receive_remarks = $("#receive_remarks" ).val( ) ;
            
            handMadeSaveData( "handMadeSaveDataProject" , expense_head_no, date ,payment_mode, bank_name,  account_no ,  account_name ,  branch_name, 
    payment_amount, cheque_no, receive_remarks , project_no ) ;
            
/////////////////////////////// end HandMade Insert Data // /////////////////////////////////////
            
            
            if ($("#payment_method option:selected").val() == "1") {

                // insert data
                var bank_name_val = $("#bank_name option:selected").val();
                var account_no_val = $("#account_no option:selected").val();
                // print data
                var bank_name = $("#bank_name option:selected").text();
                var account_no = $("#account_no option:selected").text();
                var account_name = $("#account_name").val();
                var branch_name = $("#branch_name").val();
                var cheque_no = $("#cheque_no").val();

            } else {

                // $("#payment_method option:selected").prop('disabled', 'disabled')
                // insert data
                var bank_name_val = "";
                var account_no_val = "";
                // print data
                var bank_name = "";
                var account_no = "";
                var account_name = "";
                var branch_name = "";
                var cheque_no = "";

            }
            var payment_method_val = $("#payment_method option:selected").val();
            var payment_method = $("#payment_method option:selected").text();
            var payment_amount = $("#payment_amount").val();
            var receive_remarks = $("#receive_remarks").val();

            selectedAccounts.push(account_no_val);
            paymentPrintData.push([payment_method, bank_name, account_no, account_name, branch_name, payment_amount, cheque_no, receive_remarks]);
            paymentInsertData.push([payment_method_val, bank_name_val, account_no_val, account_name, branch_name, payment_amount, cheque_no, receive_remarks]);
            printTable(paymentPrintData);

            

            $("#make_payment_form")[0].reset();
            $("#payment_method").trigger('change');


            if (calculateArrayAmount(paymentInsertData) == calculateTableAmount() && calculateArrayAmount(paymentInsertData) > 0) {

                $("#save_receive").show();
            } else {
                $("#save_receive").hide();
            }

        });

        $(document).on('click', '.editbtn', function() {

            var id = $(this).attr('id');
            getBanks("getBanks");
            getAccounts(paymentInsertData[id][1], 'getAccounts');

            $("#payment_method").val(paymentInsertData[id][0]);
            $("#payment_method").trigger('change');
            $("#account_name").val(paymentInsertData[id][3]);
            $("#branch_name").val(paymentInsertData[id][4]);
            // $("#payment_date").val(paymentInsertData[id][5]);
            $("#payment_amount").val(paymentInsertData[id][5]);
            $("#cheque_no").val(paymentInsertData[id][6]);
            $("#receive_remarks").val(paymentInsertData[id][7]);
            setTimeout(updateDropdowns, 500, paymentInsertData, id);

            function updateDropdowns(data, id) {
                $("#bank_name").val(data[id][1]);
                $("#account_no").val(data[id][2]);
                
                selectedAccounts.splice(id,1);
                disableSelected(selectedAccounts);
                paymentInsertData.splice(id, 1);

                if (calculateArrayAmount(paymentInsertData) == calculateTableAmount() && calculateArrayAmount(paymentInsertData) > 0) {
                    $("#save_receive").show();
                } else {
                    $("#save_receive").hide();
                }
            }

            paymentPrintData.splice(id, 1);
            printTable(paymentPrintData);

        });

        $(document).on('click', '.deletebtn', function() {
            var id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This can't be undone",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    selectedAccounts.splice(id,1);
                    paymentPrintData.splice(id, 1);
                    paymentInsertData.splice(id, 1);
                    printTable(paymentPrintData);
                    disableSelected(selectedAccounts);
                    if (calculateArrayAmount(paymentInsertData) == calculateTableAmount() && calculateArrayAmount(paymentInsertData) > 0) {
                        $("#save_receive").show();
                    } else {
                        $("#save_receive").hide();
                    }
                }
            })

        });

        $(document).on('click', '#save_receive', function() {
            //supplier data
            var payTo = $('#pay_for_selector option:selected').val();

            //calculating total receive amount
            var payment_date = $("#payment_date").val();

            paymentInsertData.push([calculateArrayAmount(paymentInsertData), $("#pay_for option:selected").val(), payTo, payment_date]);




            //pushing individual received amounts for orders
            $(".receive_amount").each(function() {
                orderAmounts.push([$(this).attr('ORDER_MASTER_NO'), $(this).val()]);

            });

            saveMadePayment(paymentInsertData, orderAmounts, "saveMadePayment");

        });
        
        getTableData("tableData") ;
    });
</script>