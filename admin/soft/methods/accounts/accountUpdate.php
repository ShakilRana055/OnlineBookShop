<?php 
if (isset($_POST['action']) && $_POST['action'] == "updateBankAccount") {
    updateBankAccount($_POST['data'],$_POST['updateId']);
}
if (isset($_POST['action']) && $_POST['action'] == "updateReceivedPayment") {
    updateReceivedPayment($_POST['re_honored'],$_POST['re_honored_date']);
}

function updateReceivedPayment($re_honored, $re_honored_date)
{
    include('../../../config/db_connection.php');
    
    if($re_honored!=NULL || $re_honored!=""){
        for($i=0;$i<count($re_honored); $i++)
        {
            $sql = "update  acc_receive_details set IS_HONORED='" . $re_honored[$i][1] . "' where RECEIVE_DETAIL_NO='".$re_honored[$i][0]."' ";
            $result = mysqli_query($con, $sql);
        }
    
    }
        if($re_honored_date!=NULL){
        for($i=0;$i<count($re_honored_date); $i++)
        {
            $sql = "update  acc_receive_details set HONORED_DATE='" . $re_honored_date[$i][1] . "' where RECEIVE_DETAIL_NO='".$re_honored_date[$i][0]."' ";
            $result = mysqli_query($con, $sql);
        }
    }
    
    
    if ($result) {
        echo 1;
    } else {
        echo $sql;
    }
}

function updateBankAccount($data,$updateId)
{
    include('../../../config/db_connection.php');
    
    $sql = "update  acc_bank_accounts set BANK_NO='" . $data[0] . "', BRANCH_NAME='" . $data[1] . "',  ACCOUNT_NAME='" . $data[2] . "', ACCOUNT_NUMBER='" . $data[3] . "', CURRENT_BALANCE ='" . $data[4] . "', ACCOUNT_DETAILS='" . $data[5] . "' where BANK_ACCOUNT_NO='".$updateId."' ";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo 1;
    } else {
        echo $sql;
    }
}


?>