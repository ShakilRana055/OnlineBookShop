<?php

if( isset ( $_POST['expenseHead']) &&  $_POST['expenseHead'] == 'expenseHead' )
{
    include('../../../config/db_connection.php');
    $project_no = $_POST['project_no'] ;
    $sql = "SELECT PROJECT_EXPENSE_HEAD_NO, PROJECT_EXPENSE_HEAD_NAME FROM project_expense_heads WHERE PROJECT_NO = '$project_no' " ;
    $result = mysqli_query( $con , $sql ) ;
    echo "<option>Please Select One</option>" ;
    foreach( $result as $value )
    {
        echo "<option value = '".$value['PROJECT_EXPENSE_HEAD_NO']."'>".$value['PROJECT_EXPENSE_HEAD_NAME']."</option>" ;
    }
}

if( isset( $_POST['tableData12'] ) &&  $_POST['tableData12']  == 'tableData12')
{
    include('../../../config/db_connection.php');
    
    $sql = "SELECT * FROM acc_expenses LEFT JOIN acc_expense_heads ON acc_expense_heads.EXPENSE_HEAD_NO = acc_expenses.EXPENSE_HEAD_NO 
    LEFT JOIN acc_bank_accounts ON acc_bank_accounts.BANK_ACCOUNT_NO = acc_expenses.BANK_ACCOUNT_NO " ;
    
    $result = mysqli_query( $con , $sql ) ;
    $count = 1 ;
    foreach( $result as $value )
    {
        echo "<tr>";
                    
                    echo "<td>".$count ++ ."</td>" ;
                   
                    echo "<td>". $value['HEAD_NAME'] ."</td>" ;
                    echo "<td>". $value['TRN_DATE'] ."</td>" ;
                    echo "<td>". $value['ACCOUNT_NUMBER'] ."</td>" ;
                    echo "<td>". $value['BRANCH_NAME'] ."</td>" ;
                    echo "<td>". $value['TRN_AMOUNT'] ."</td>" ;
                    if( $value['PAYMENT_MODE'] == '1' )
                    {
                        echo "<td>Cheque</td>" ;
                    }
                    else
                    {
                        echo "<td>Cash</td>" ;
                    }
                    
                    echo "<td>". $value['CHEQUE_NO'] ."</td>" ;
                    
                    
        echo "<tr>" ;
    }
    
    
}

if( isset( $_POST['tableData'] ) &&  $_POST['tableData']  == 'tableData')
{
    include('../../../config/db_connection.php');
    $query = "SELECT project_expenses.*, projects.PROJECT_NAME, project_expense_heads.PROJECT_EXPENSE_HEAD_NAME FROM project_expenses LEFT JOIN projects ON projects.PROJECT_NO = project_expenses.PROJECT_NO 
    LEFT JOIN project_expense_heads ON project_expense_heads.PROJECT_EXPENSE_HEAD_NO = project_expenses.PROJECT_EXPENSE_HEAD_NO 
    LEFT JOIN acc_bank_accounts ON acc_bank_accounts.BANK_ACCOUNT_NO = project_expenses.BANK_ACCOUNT_NO" ;
    
    $result = mysqli_query( $con , $query ) ;
    $count = 1 ;
    foreach( $result as $value )
    {
        echo "<tr>";
                    
                    echo "<td>".$count ++ ."</td>" ;
                    echo "<td>". $value['PROJECT_NAME'] ."</td>" ;
                    echo "<td>". $value['PROJECT_EXPENSE_HEAD_NAME'] ."</td>" ;
                    echo "<td>". $value['TRN_DATE'] ."</td>" ;
                    echo "<td>". $value['ACCOUNT_NUMBER'] ."</td>" ;
                    echo "<td>". $value['BRANCH_NAME'] ."</td>" ;
                    echo "<td>". $value['EXPENSE_AMOUNT'] ."</td>" ;
                    if( $value['PAYMENT_MODE'] == '1' )
                    {
                        echo "<td>Cheque</td>" ;
                    }
                    else
                    {
                        echo "<td>Cash</td>" ;
                    }
                    
                    echo "<td>". $value['CHEQUE_NO'] ."</td>" ;
                    echo "<td>". $value['REMARKS'] ."</td>" ;
                    
        echo "<tr>" ;
    }
    
    
}

if (isset($_POST['action']) && $_POST['action'] == 'getBankAccountList') {

    getBankAccountList();
}
if (isset($_POST['action']) && $_POST['action'] == 'getReceivedPaymentList') {

    getReceivedPaymentList();
}
if (isset($_POST['action']) && $_POST['action'] == 'getCustomerCode') {

    getCustomerCode($_POST['masterId']);
}


if (isset($_POST['action']) && $_POST['action'] == 'getReceivedPrintArray') {

    getReceivedPrintArray($_POST['masterId']);
}

if (isset($_POST['action']) && $_POST['action'] == 'getReceivedInsertArray') {

    getReceivedInsertArray($_POST['masterId']);
}

if (isset($_POST['action']) && $_POST['action'] == 'getBanks') {

    getbanks();
}
if (isset($_POST['action']) && $_POST['action'] == 'getAccounts') {

    getAccounts($_POST['bankNo']);
}

if (isset($_POST['action']) && $_POST['action'] == 'getAccountInfo') {

    getAccountInfo($_POST['accNo']);
}
if (isset($_POST['action']) && $_POST['action'] == 'getSupplierOrVendor') {

    getSupplierOrVendor($_POST['payFor']);
}
if (isset($_POST['action']) && $_POST['action'] == 'getPaidPaymentList') {

    getPaidPaymentList();
}
if (isset($_POST['action']) && $_POST['action'] == 'getCurrentBalance') {

    getCurrentBalance($_POST['pay_mode'], $_POST['bank_name'], $_POST['acc_no']);
}
function getCurrentBalance($pay_mode, $bank_name, $acc_no)
{ 

    include('../../../config/db_connection.php');
    if($pay_mode!='1')
    {
    $sql='select CASH_CURRENT_BALANCE from acc_cash';
    $results=mysqli_query($con,$sql);
    if($results)
    {
        foreach($results as $result)
        {
            echo $result['CASH_CURRENT_BALANCE'];
        }
    }
    }
    else {
        $sql="select CURRENT_BALANCE from acc_bank_accounts where BANK_NO='".$bank_name."' and BANK_ACCOUNT_NO='".$acc_no."' ";
        $results=mysqli_query($con,$sql);
        if($results)
        {
            foreach($results as $result)
            {
                echo $result['CURRENT_BALANCE'];
            }
        }
    }

}




function getSupplierOrVendor($payFor)
{
    include('../../../config/db_connection.php');
    if ($payFor == '1') {
        $sql = "select * from gen_material_suppliers ";
        $results = mysqli_query($con, $sql);

        if ($results) {
            $data = "<option value='-1'>Please select</option>";
            foreach ($results as $result) {
                $data .= "<option value='" . $result['SUPPLIER_NO'] . "'>" . $result['SUPPLIER_NAME'] . "</option>";
            }
            echo $data;
        } else {
            echo $sql;
        }
    } else {
        $sql = "select * from gen_service_providers ";
        $results = mysqli_query($con, $sql);

        if ($results) {
            $data = "<option value='-1'>Please select</option>";

            foreach ($results as $result) {
                $data .= "<option value='" . $result['SERVICE_PROVIDER_NO'] . "'>" . $result['SERVICE_PROVIDER_NAME'] . "</option>";
            }
            echo $data;
        } else {
            echo $sql;
        }
    }
}




function getAccountInfo($accNo)
{
    include('../../../config/db_connection.php');
    $data = array();
    $sql = "select * from acc_bank_accounts where BANK_ACCOUNT_NO='" . $accNo . "'";
    $results = mysqli_query($con, $sql);

    if ($results) {
        while ($row = mysqli_fetch_assoc($results)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    } else {
        echo $sql;
    }
}


function getAccounts($bankNo)
{
    include('../../../config/db_connection.php');
    $data = "";
    $sql = "select * from acc_bank_accounts where BANK_NO='" . $bankNo . "'";
    $results = mysqli_query($con, $sql);
    if ($results) {
        $data .= "<option value='-1'>Select bank account</option>";
        foreach ($results as $result) {
            $data .= "<option value ='" . $result['BANK_ACCOUNT_NO'] . "'>" . $result['ACCOUNT_NUMBER'] . "</option>";
        }
        echo $data;
    } else {
        echo $sql;
    }
}



function getbanks()
{
    include('../../../config/db_connection.php');
    $data = "";
    $sql = "select * from acc_banks";
    $results = mysqli_query($con, $sql);
    if ($results) {
        $data .= "<option value='-1'>Select bank </option>";
        foreach ($results as $result) {
            $data .= "<option value ='" . $result['BANK_NO'] . "'>" . $result['BANK_NAME'] . "</option>";
        }
        echo $data;
    } else {
        echo $sql;
    }
}



function getReceivedPrintArray($masterId)
{
    include('../../../config/db_connection.php');

    $sql = "select acc_receive_details.*, acc_pay_modes.PAY_MODE_NAME, acc_banks.BANK_NAME, acc_bank_accounts.ACCOUNT_NUMBER  from acc_receive_details LEFT JOIN acc_pay_modes on acc_pay_modes.PAY_MODE_NO=acc_receive_details.PAY_MODE_NO LEFT JOIN acc_banks on acc_banks.BANK_NO=acc_receive_details.BANK_NO LEFT JOIN acc_bank_accounts on acc_bank_accounts.BANK_ACCOUNT_NO= acc_receive_details.BANK_ACCOUNT_NO where acc_receive_details.RECEIVE_MASTER_NO='".$masterId."'";
    $results = mysqli_query($con, $sql);
    if ($results) {
        $data = "";
        $i = 0;
        $j = 1;
        foreach ($results as $result) {
            //$table = array($result['PAY_MODE_NAME'],  $result['AMOUNT'], $result['IS_HONORED'], $result['HONORED_DATE'], $result['RECEIVE_DETAILS']);
            $data = "<tr>";
            $data .= "<td>" . $j . "</td>";
            $data .= "<td>" . $result['PAY_MODE_NAME'] . "</td>";
            $data .= "<td>" . $result['AMOUNT'] . "</td>";
            if ($result['IS_HONORED'] == 'Yes') {
                $data .= "<td>" . $result['IS_HONORED'] . "</td>";
                $data .= "<td>" . $result['BANK_NAME'] . "</td>";
                $data .= "<td>" . $result['ACCOUNT_NUMBER'] . "</td>";

                if ($result['HONORED_DATE'] == "0000-00-00") {
                    $data .= "<td class='text-center'>" . "<div class='form-group'><label for='re_honored_date' class='control-label col-lg-4'></label> <div class='col-lg-10'><input class='form-control re_honored_date' RECEIVE_DETAIL_NO=" . $result['RECEIVE_DETAIL_NO'] . " id='" . $i . "' type='date' req='1' is_int='1' /></div></div></td>";
                } else {
                    
                    $data .= "<td>" . $result['HONORED_DATE'] . "</td>";
                }
                $data .= "<td>" . $result['RECEIVE_DETAILS'] . "</td>";
            } else {
                if ($result['PAY_MODE_NO'] != "2") {
                    $data .= "<td class='text-center'>" . "<label class='switch switch-success col-lg-4'><input class='re_honored' RECEIVE_DETAIL_NO=" . $result['RECEIVE_DETAIL_NO'] . " type='checkbox'><span></span></label></div></div></td>";
                    $data.="<td > <div class='form-group'><select id='re_bank_name' class='form-control field_data '></select></div></td>";
                    $data.="<td><div class='form-group  '><select id='re_account_no' class='form-control field_data '></select></div></td>";

                    $data .= "<td class='text-center'>" . "<div class='form-group'><label for='re_honored_date' class='control-label col-lg-4'></label> <div class='col-lg-10'><input class='form-control re_honored_date' RECEIVE_DETAIL_NO=" . $result['RECEIVE_DETAIL_NO'] . " id='" . $i . "' type='date' req='1' is_int='1' /></div></div></td>";
                    $data .= "<td>" . $result['RECEIVE_DETAILS'] . "</td>";
                } else {
                    $data .= "<td>N/A</td>";
                    $data .= "<td>N/A</td>";
                    $data .= "<td>N/A</td>";
                    $data .= "<td>N/A</td>";
                    $data .= "<td>N/A</td>";
                }
            }
            $data .= "</tr>";
            $i++;
            $j++;
            echo $data;
        }
    } else {
        echo $sql;
    }
}


function getReceivedInsertArray($masterId)
{
    include('../../../config/db_connection.php');
    $data = array();
    $sql = "select * from acc_receive_details where RECEIVE_MASTER_NO='" . $masterId . "'";
    $results = mysqli_query($con, $sql);
    if ($results) {
        foreach ($results as $result) {
            $table = array($result['PAY_MODE_NO'], $result['AMOUNT'], $result['IS_HONORED'],$result['BANK_NO'],$result['BANK_ACCOUNT_NO'], $result['HONORED_DATE'], $result['RECEIVE_DETAILS']);
            array_push($data, $table);
        }
        echo json_encode($data);
    } else {
        echo $sql;
    }
}



function getCustomerCode($masterId)
{
    include('../../../config/db_connection.php');
    $sql = "select gen_customers.CUSTOMER_CODE from acc_receive_masters LEFT JOIN gen_customers ON gen_customers.CUSTOMER_NO=acc_receive_masters.CUSTOMER_NO where RECEIVE_MASTER_NO='" . $masterId . "'";
    $results = mysqli_query($con, $sql);
    if ($results) {
        foreach ($results as $result) {
            echo $result['CUSTOMER_CODE'];
        }
    } else {
        echo 0;
    }
}

function getReceivedPaymentList()
{
    include('../../../config/db_connection.php');

    $data = "";

    $sql = "select acc_receive_masters.*, gen_customers.CUSTOMER_NAME, gen_customers.CUSTOMER_CODE from acc_receive_masters LEFT JOIN gen_customers ON gen_customers.CUSTOMER_NO=acc_receive_masters.CUSTOMER_NO ";

    $results = mysqli_query($con, $sql);
    if ($results) {
        $i = 0;
        $j = 1;
        foreach ($results as $result) {
            $data = "<tr>";
            $data .= "<td>" . $j . "</td>";
            $data .= "<td>" . $result['CUSTOMER_NAME'] . "</td>";
            $data .= "<td>" . $result['CUSTOMER_CODE'] . "</td>";
            $data .= "<td>" . $result['RECEIVE_AMOUNT'] . "</td>";
            $data .= "<td>" . $result['RECEIVE_DATE'] . "</td>";


            $data .= "<td class='text-center'>" . "<div class='btn-group'><a href='?pagex=receive_payment&&root=Accounts&&master=" . $result['RECEIVE_MASTER_NO'] . "&&customer=" . $result['CUSTOMER_CODE'] . "'><button data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning'><i class=' fa fa-pencil'></i></button></a></div><div class='btn-group'><button data-toggle='tooltip' name='" . $result['RECEIVE_MASTER_NO'] . "deletbtn' title='Delete' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></button>" . "</div></td>";
            $data .= "</tr>";
            $i++;
            $j++;
            echo $data;
        }
    } else {

        echo $sql;
    }
}
function getSupplierVendor($type, $id)
{
    include('../../../config/db_connection.php');
    if ($type == 1) {
        $sql = "select * from gen_material_suppliers where SUPPLIER_NO='" . $id . "'";
        $results = mysqli_query($con, $sql);
        if ($results) {
            $data = array();
            foreach ($results as $result) {
                array_push($data, $result['SUPPLIER_NAME'], $result['SUPPLIER_CODE']);
            }
            return $data;
        }
    } else {
        $sql = "select * from gen_service_providers where SERVICE_PROVIDER_NO='" . $id . "'";
        $results = mysqli_query($con, $sql);
        if ($results) {
            $data = array();
            foreach ($results as $result) {
                array_push($data, $result['SERVICE_PROVIDER_NAME'], $result['SERVICE_PROVIDER_CODE']);
            }
            return $data;
        }
    }
}


function getPaidPaymentList()
{
    include('../../../config/db_connection.php');

    $data = "";

    $sql = "select * FROM `acc_payment_masters` ORDER by PAYMENT_DATE DESC";

    $results = mysqli_query($con, $sql);
    if ($results) {
        $i = 0;
        $j = 1;
        foreach ($results as $result) {
            if ($result['IS_SUPPLIER_OR_VENDOR'] == '1') {
                $supplierVendor = "Supplier";
            } else {
                $supplierVendor = "Vendor";
            }
            $data = "<tr>";
            $data .= "<td>" . $j . "</td>";
            $data .= "<td>" . $supplierVendor . "</td>";
            $data .= "<td>" . getSupplierVendor($result['IS_SUPPLIER_OR_VENDOR'], $result['SUPPLIER_OR_VENDOR_NO'])[0] . "</td>";
            $data .= "<td>" . getSupplierVendor($result['IS_SUPPLIER_OR_VENDOR'], $result['SUPPLIER_OR_VENDOR_NO'])[1] . "</td>";
            $data .= "<td>" . $result['PAYMENT_AMOUNT'] . "</td>";

            $data .= "<td>" . $result['PAYMENT_DATE'] . "</td>";


            $data .= "<td class='text-center'>" . "<div class='btn-group'><a href=''><button data-toggle='tooltip'   title='View details' class='btn btn-xs btn-success '><i class='fa fa-eye'></i></button></a></div><div class='btn-group'><a href='?pagex=print_payment_voucher&&root=Accounts'><button data-toggle='tooltip'   title='Print this payment' class='btn btn-xs btn-info'><i class='fa fa-print'></i></button></div></td>";
            $data .= "</tr>";
            $i++;
            $j++;
            echo $data;
        }
    } else {

        echo $sql;
    }
}



function getBankAccountList()
{
    include('../../../config/db_connection.php');

    $data = "";

    $sql = "select * from acc_bank_accounts";

    $results = mysqli_query($con, $sql);
    if ($results) {

        $i = 0;
        $j = 1;
        foreach ($results as $result) {
            $data = "<tr>";
            $data .= "<td>" . $j . "</td>";

            $data .= "<td style='display:none'>" . $result['BANK_ACCOUNT_NO'] . "</td>";
            $data .= "<td>" . $result['BANK_NO'] . "</td>";
            $data .= "<td>" . $result['BRANCH_NAME'] . "</td>";
            $data .= "<td>" . $result['ACCOUNT_NAME'] . "</td>";
            $data .= "<td>" . $result['ACCOUNT_NUMBER'] . "</td>";
            $data .= "<td>" . $result['CURRENT_BALANCE'] . "</td>";
            $data .= "<td>" . $result['ACCOUNT_DETAILS'] . "</td>";


            $data .= "<td class='text-center'>" . "<div class='btn-group'><button data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn' name='" . $result['BANK_ACCOUNT_NO'] . "editbtn' id='" . $result['BANK_ACCOUNT_NO'] . "' value='" . $i . "'><i class=' fa fa-pencil'></i>Edit</button>" . "<button data-toggle='tooltip' name='" . $result['BANK_ACCOUNT_NO'] . "deletbtn' title='Delete' class='btn btn-xs btn-danger deletebtn' id='" . $result['BANK_ACCOUNT_NO'] . "' value='" . $i . "'><i class='fa fa-times'></i>Delete</button>" . "</div></td>";
            $data .= "</tr>";
            $i++;
            $j++;
            echo $data;
        }
    } else {

        echo $sql;
    }
}
