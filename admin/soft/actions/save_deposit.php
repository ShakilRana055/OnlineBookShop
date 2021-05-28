<?php session_start();?>
<?php
    if( isset( $_POST [ "saveAll" ] ) ) 
    {
        include ( "../../config/db_connection.php") ;
        
        $deposit_head_array = explode ( "," , $_POST['DEPOSITE_HEAD_NO_ARRAY'] );
        $amount_array = explode ( "," , $_POST['AMT_ARRAY'] ) ;
        $month_array = explode ( "," , $_POST['MONTH_ARRAY'] ) ;
        $year_array = explode ( "," , $_POST['YEAR_ARRAY'] ) ;
        $member_no =  $_POST['member_id']  ;
        $profile_no =  $_POST['profile_no'] ;
        $paid_amount = $_POST['paid_amount'] ;
        $cur = date( "Y-m-d" ) ;
        
        
        
        $insert_master = "INSERT INTO member_depsoit_masters SET `PROFILE_NO` = '$profile_no', `MEMBER_NO` = '$member_no',
        `DATE` = '$cur', `AMOUNT` = '$paid_amount', `CREATED_ON` = '$cur'" ;
        

        
        $insert_details="" ;
        mysqli_query ( $con , $insert_master ) ;
        $last_master_id = mysqli_insert_id( $con ) ;
        
        $_SESSION['master_no'] = $last_master_id ;
        
        $result = "" ;
       
        for( $i = 0 ; $i < count ( $deposit_head_array ) ; $i ++ )
        {
            
            $insert_details = "INSERT INTO member_deposit_details SET `DEPOSIT_MASTER_NO` = '$last_master_id', 
            `DEPOSITE_HEAD_NO` = '$deposit_head_array[$i]', `DEPOSIT_AMOUNT` = '$amount_array[$i]', 
            `YEAR` = '$year_array[$i]', `MONTH` = '$month_array[$i]' , `CREATED_ON` = '$cur'" ;
            if( $deposit_head_array[$i] == '-1' )
            {
                $update = "UPDATE loan_schedule SET IS_PAID = 1 WHERE PROFILE_NO = '$profile_no' AND SCHEDULE_MONTH = '$month_array[$i]' AND
                SCHEDULE_YEAR = '$year_array[$i]'" ;
                mysqli_query( $con , $update ) ;
            }
            
            $result = mysqli_query( $con , $insert_details ) ;
        }
        
        if( $result )
        {
            // update cash //
            $query = "SELECT `CASH_CURRENT_BALANCE` FROM acc_cash WHERE CASH_NO = 1" ;
            $get_current = mysqli_fetch_assoc( mysqli_query ( $con , $query ) ) ;
            $current_amount = floatval ( $get_current['CASH_CURRENT_BALANCE'] ) ;
            $final = $current_amount + floatval( $paid_amount ) ;
            $update = "UPDATE acc_cash SET `CASH_CURRENT_BALANCE` = '$final' WHERE CASH_NO = 1" ;
            mysqli_query( $con , $update ) ;
            
            // check is loan Finished //
            
            $check_for_loan_dues = "SELECT * FROM loan_schedule WHERE IS_PAID = 0" ;
            $check_for_loan_dues_result = mysqli_num_rows ( mysqli_query( $con , $check_for_loan_dues ) ) ;
            if( $check_for_loan_dues_result == 0 )
            {
                $update_member_profiles = "UPDATE member_profiles SET IS_TAKEN = 0 WHERE MEMBER_NO = '$member_no'" ;
                mysqli_query( $con , $update_member_profiles ) ;
            }
            
            //end //
            
            echo 1 ;
        }
        else
        {
            echo $insert_details ;
        }
        
        
    }


?>