<?php
if (isset($_POST['action']) && $_POST['action'] == "addBankAccount") {
    addBankAccount($_POST['data']);
}


if( isset( $_POST['handMade'] ) &&  $_POST['handMade'] = 'handMadeSaveDataProject1' )
{
    include('../../../config/db_connection.php');
    
    $cur = date( "Y-m-d" ) ;
    $expense_head_no = $_POST['expense_head_no'] ;
    
    $date = $_POST['date'] ;
    $payment_mode = $_POST['payment_mode'] ;
    $bank_no = $_POST['bank_name'] ;
    $payment_amount = $_POST['payment_amount'] ;
    $cheque_no = $_POST['cheque_no'] ;
    $receive_remarks = $_POST['receive_remarks'] ;
    $account_no = $_POST['account_no'] ;
    
    $sql = "INSERT INTO acc_expenses SET `EXPENSE_HEAD_NO` = '$expense_head_no', `TRN_AMOUNT` = '$payment_amount', `PAYMENT_MODE` = '$payment_mode', 
    `BANK_NO` = '$bank_no', `BANK_ACCOUNT_NO` = '$account_no', `CHEQUE_NO` = '$cheque_no', `TRN_DATE` = '$date', `TRN_REMARKS` = '$receive_remarks' , CREATED_ON = '$cur'" ;
    $result = mysqli_query( $con , $sql ) ;
    if( $result )
    {
            $query = "SELECT CURRENT_BALANCE FROM acc_bank_accounts WHERE BANK_ACCOUNT_NO = '$account_no' " ;
            $ans = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
            $final_result = $ans['CURRENT_BALANCE'] - $payment_amount ;
            $query = "UPDATE acc_bank_accounts SET CURRENT_BALANCE = '$final_result' WHERE BANK_ACCOUNT_NO = '$account_no'" ;
            mysqli_query( $con, $query ) ;
            
            
            mysqli_query( $con , $update ) ;
        echo 1 ;
    }
    else
    {
        echo 0 ;
    }
 
    
}



if( isset( $_POST['handMadeSaveDataProject'] ) &&  $_POST['handMadeSaveDataProject'] = 'handMadeSaveDataProject' )
{
    include('../../../config/db_connection.php');
    
    $cur = date( "Y-m-d" ) ;
    $expense_head_no = $_POST['expense_head_no'] ;
    $project_no = $_POST['project_no'] ;
    $date = $_POST['date'] ;
    $payment_mode = $_POST['payment_mode'] ;
    $bank_no = $_POST['bank_name'] ;
    $payment_amount = $_POST['payment_amount'] ;
    $cheque_no = $_POST['cheque_no'] ;
    $receive_remarks = $_POST['receive_remarks'] ;
    $account_no = $_POST['account_no'] ;
    
    $sql = "INSERT INTO project_expenses SET `PROJECT_EXPENSE_HEAD_NO` = '$expense_head_no', `TRN_DATE` = '$date', 
    `PROJECT_NO` = '$project_no', `PAYMENT_MODE` = '$payment_mode', `BANK_NO` = '$bank_no', `BANK_ACCOUNT_NO` = '$account_no', 
    `CHEQUE_NO` = '$cheque_no', `EXPENSE_AMOUNT` = '$payment_amount', `REMARKS` = '$receive_remarks', `CREATED_ON` = '$cur'" ;
    $result = mysqli_query( $con , $sql ) ;
    if( $result )
    {
        if( $payment_mode == "1" ) 
        {
            $query = "SELECT CURRENT_BALANCE FROM acc_bank_accounts WHERE BANK_ACCOUNT_NO = '$account_no' " ;
            $ans = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
            $final_result = $ans['CURRENT_BALANCE'] - $payment_amount ;
            $query = "UPDATE acc_bank_accounts SET CURRENT_BALANCE = '$final_result' WHERE BANK_ACCOUNT_NO = '$account_no'" ;
            mysqli_query( $con, $query ) ;
        }
        else
        {
            $query = "SELECT `CASH_CURRENT_BALANCE` FROM acc_cash WHERE CASH_NO = 1 " ;
            $ans = mysqli_fetch_assoc( mysqli_query ( $con , $query ) ) ;
            $final_current_cash = intval ( $ans['CASH_CURRENT_BALANCE'] ) - intval( $payment_amount ) ;
            
            $update = "UPDATE acc_cash SET `CASH_CURRENT_BALANCE` = '$final_current_cash' WHERE `CASH_NO` = '1'" ;
            mysqli_query( $con , $update ) ;
        }
        echo 1 ;
    }
    else
    {
        echo 0 ;
    }
    
    
}

if (isset($_POST['action']) && $_POST['action'] == "saveReceivedPayment") {
    saveReceivedPayment($_POST['receiveInsertData'], $_POST['orderAmounts']);
}

if (isset($_POST['action']) && $_POST['action'] == "saveMadePayment") {
    saveMadePayment($_POST['paymentInsertData'], $_POST['orderAmounts']);
}

function adjustAccounts($operation, $accNo, $amount, $ChequeOrCash)
{
    include('../../../config/db_connection.php');

    if($ChequeOrCash=="2")
    {
        $sql="update acc_cash set CASH_CURRENT_BALANCE=CASH_CURRENT_BALANCE ".$operation." ".floatval($amount)." ";
        if(mysqli_query($con, $sql))
        {
            return true;

        }
        else
        {
            echo $sql;
        }

    }
    else
    {
        $sql="update acc_bank_accounts set CURRENT_BALANCE=CURRENT_BALANCE ".$operation." ".floatval($amount)." where BANK_ACCOUNT_NO='".$accNo."' ";
        if(mysqli_query($con, $sql))
        {
            return true;

        }
        else
        {
            echo $sql;
        }

    }

}


function saveMadePayment($data, $orderAmounts)
{
    include('../../../config/db_connection.php');

    // $date = date('Y-m-d H:i:s');
    mysqli_autocommit($con, false);
    if ($data[count($data) - 1][1] == "1") {

        for ($j = 0; $j < count($orderAmounts); $j++) {
            $sql = "update `inv_material_order_masters` SET PAID_AMOUNT=PAID_AMOUNT+" . floatval($orderAmounts[$j][1]) . " where ORDER_MASTER_NO='" . $orderAmounts[$j][0] . "' ";
            $result = mysqli_query($con, $sql);
        }
    } else {

        for ($j = 0; $j < count($orderAmounts); $j++) {
            $sql = "update `plan_outsourced_orders` SET PAID_AMOUNT=PAID_AMOUNT+" . floatval($orderAmounts[$j][1]) . " where OUTSOURCE_ORDER_NO='" . $orderAmounts[$j][0] . "' ";
            $result = mysqli_query($con, $sql);
        }
    }

   if($result)
    {

        $sql = "insert into acc_payment_masters set  PAYMENT_AMOUNT='" . $data[count($data) - 1][0] . "', IS_SUPPLIER_OR_VENDOR='".$data[count($data) - 1][1]."', SUPPLIER_OR_VENDOR_NO='".$data[count($data) - 1][2]."',PAYMENT_DATE='".$data[count($data) - 1][3]."' ";
        if (mysqli_query($con, $sql)) {
            
            $master = mysqli_insert_id($con);
            for ($i = 0; $i < count($data) - 1; $i++) {
                if(adjustAccounts('-', $data[$i][2], $data[$i][5], $data[$i][0])){
                    $sql = "insert into acc_payment_details set PAY_MODE_NO='" . $data[$i][0] . "',  BANK_NO='" . $data[$i][1] . "', BANK_ACCOUNT_NO='" . $data[$i][2] . "', AMOUNT='" . $data[$i][5] . "', CHEQUE_NO='" . $data[$i][6] . "', REMARKS='" . $data[$i][7] . "', PAYMENT_MASTER_NO='".$master."' ";
                    $result = mysqli_query($con, $sql);
                }
               
            }
            if ($result) {
                mysqli_commit($con);
                echo 1;
            } else {
                echo $sql;
            }
        } else {
            echo $sql;
        }
    }
    else
    {
        echo $sql;
    }


}



function saveReceivedPayment($data, $orderAmounts)
{
    include('../../../config/db_connection.php');

    // $date = date('Y-m-d H:i:s');
    mysqli_autocommit($con, false);
    for ($j = 0; $j < count($orderAmounts); $j++) {
        $sql = "update `sale_order_masters` SET RECEIVED_AMOUNT=RECEIVED_AMOUNT+" . floatval($orderAmounts[$j][1]) . " where ORDER_MASTER_NO='" . $orderAmounts[$j][0] . "' ";
        $result = mysqli_query($con, $sql);
    }
    if ($result) {

        $sql = "insert into acc_receive_masters set CUSTOMER_NO='" . $data[count($data) - 2][1] . "', RECEIVE_AMOUNT='" . $data[count($data) - 2][0] . "', RECEIVE_DATE='" . $data[count($data) - 2][2]. "' ";
        if (mysqli_query($con, $sql)) {
            $master = mysqli_insert_id($con);
            for ($i = 0; $i < count($data) - 2; $i++) {
                if(adjustAccounts('+', $data[$i][4], $data[$i][1], $data[$i][0])){

                $sql = "insert into acc_receive_details set PAY_MODE_NO='" . $data[$i][0] . "',  AMOUNT='" . $data[$i][1] . "', IS_HONORED='" . $data[$i][2] . "', BANK_NO='".$data[$i][3]."', BANK_ACCOUNT_NO='".$data[$i][4]."', HONORED_DATE='" . $data[$i][5] . "', RECEIVE_DETAILS='" . $data[$i][6] . "', RECEIVE_MASTER_NO='" . $master . "' ";
                $result = mysqli_query($con, $sql);
            }
        }
            if ($result) {
                mysqli_commit($con);
                echo 1;
            } else {
                echo $sql;
            }
        } else {
            echo $sql;
        }
    } else {
        echo $sql;
    }
}




function addBankAccount($data)
{
    include('../../../config/db_connection.php');
    $sql = "insert into acc_bank_accounts set BANK_NO='" . $data[0] . "', BRANCH_NAME='" . $data[1] . "',  ACCOUNT_NAME='" . $data[2] . "', ACCOUNT_NUMBER='" . $data[3] . "', CURRENT_BALANCE='" . $data[4] . "', ACCOUNT_DETAILS='" . $data[5] . "' ";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo 1;
    } else {
        echo $sql;
    }
}
