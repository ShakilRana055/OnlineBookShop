<?php include 'include/header.php';?>
<?php $table_heading = "Bank Accounts Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>



<form class='cmxform form-horizontal' action="" id="add_bank_acc_form">
    <div>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Add new bank account</legend>


            <div class="col-sm-6">

                <div class='form-group'><label for='bank_name' class='control-label col-lg-4'>Select bank </label>
                    <div class='col-lg-7'>
                        <select id="bank_name" class="form-control field_data">
                            s
                        </select>
                    </div>
                </div>

                <div class='form-group cheque'><label for='branch_name' class='control-label col-lg-4'>Branch name</label>
                    <div class='col-lg-7'><input class='form-control field_data' id='branch_name' type='text' value='' req='1' is_int='1' /></div>
                </div>

                <div class='form-group cheque'><label for='account_name' class='control-label col-lg-4'>Account name</label>
                    <div class='col-lg-7'><input class='form-control field_data' id='account_name' type='text' value='' req='1' is_int='1' /></div>
                </div>




            </div>
            <div class="col-sm-6">

                <div class='form-group'><label for='account_no' class='control-label col-lg-4'>Account no. </label>
                    <div class='col-lg-7'><input class='form-control field_data' id='account_no' type='text' value='' req='1' is_double='0' /></div>
                </div>
                <div class='form-group'><label for='swift_code' class='control-label col-lg-4'>SWIFT code</label>
                    <div class='col-lg-7'><input class='form-control field_data' id='swift_code' type='number' value='' req='1' is_int='1' /></div>
                </div>


                <div class='form-group'><label for='details' class='control-label col-lg-4'>Details </label>
                    <div class='col-lg-7'><textarea class='form-control field_data' id='details' req='1' rows='1'></textarea></div>
                </div>

                <div class='form-group'>
                    <div class='col-lg-offset-9'><input type='button' class='btn btn-primary' table_name='sd_xass' id='add_account' value='Add account' /></div>
                </div>

            </div>
        </fieldset>

    </div>




</form>
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
    <thead>
        <tr>

            <th>Sl.</th>
            <th>Bank name</th>
            <th>Branch name</th>
            <th>Account name</th>
            <th>Account no.</th>
         
            <th>SWIFT code</th>
            <th>Details</th>
            <th>Actions</th>

        </tr>
    </thead>

    <tbody id='recordList'></tbody>



    <tfoot>

    </tfoot>

</table>


 <?php include 'include/footer.php';?>


<script>
    var updateId = "";

    //initializing array
    var data = [];

    function getBankAccountList(action) {
        $.ajax({
            url: "methods/accounts/accountRetrieve.php",
            method: "post",
            data: ({

                "action": action
            }),
            dataType: "html",
            success: function(Result, xhr) {

               
                $("#recordList").html(Result);

            },
            error: function(xhr, thrownError, ajaxOptions) {}
        });

    }
    function getBanks(action)
    {
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

    function addBankAccount(data, action) {
        $.ajax({
            url: "methods/accounts/accountInserts.php",
            method: "post",
            data: ({
                "data": data,
                "action": action
            }),
            dataType: "html",
            success: function(Result) {
                data.splice(0, data.length);
                
                $("#add_bank_acc_form")[0].reset();
                getBankAccountList('getBankAccountList');
                if (Result == 1) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Account added successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: 'Oops!! something went wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            },
            error: function(xhr, thrownError, ajaxOptions) {

            }
        });
    }


    function updateBankAccount(data, updateId, action) {
        $.ajax({
            url: "methods/accounts/accountUpdate.php",
            method: "post",
            data: ({
                "data": data,
                "updateId": updateId,
                "action": action
            }),
            dataType: "html",
            success: function(Result) {
                console.log(Result);

                data.splice(0, data.length);
                getBankAccountList('getBankAccountList');
                $("#add_bank_acc_form")[0].reset();
                if (Result == 1) {

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Account updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: 'Oops!! something went wrong',
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
        getBanks('getBanks');


        getBankAccountList('getBankAccountList');
        $("#add_account").click(function() {
            var bank_name = $("#bank_name option:selected").val();
            var branch_name = $("#branch_name").val();
            var account_name = $("#account_name").val();
            var account_no = $("#account_no").val();
            var swift_code = $("#swift_code").val();
            var details = $("#details").val();

            //pushing data to array variable
            data.push(bank_name, branch_name, account_name, account_no, swift_code, details);

            if ($("#add_account").val() == "Update") {
                updateBankAccount(data, updateId, "updateBankAccount");
            } else {
                addBankAccount(data, "addBankAccount");
            }

            $("#add_account").val("Add account");

        });


        $(document).on('click', '.editbtn', function() {
            var id = $(this).attr('id');
            var index = $(this).attr('value');

            $("#bank_name").val($('#recordList tr').eq(index).find('td').eq(2).text());
            $("#branch_name").val($('#recordList tr').eq(index).find('td').eq(3).text());
            $("#account_name").val($('#recordList tr').eq(index).find('td').eq(4).text());
           
            $("#account_no").val($('#recordList tr').eq(index).find('td').eq(5).text());
            $("#swift_code").val($('#recordList tr').eq(index).find('td').eq(6).text());
            $("#details").val($('#recordList tr').eq(index).find('td').eq(7).text());


            updateId = id;
            $("#add_account").val("Update");

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

                }
            })

        });
    });
</script>