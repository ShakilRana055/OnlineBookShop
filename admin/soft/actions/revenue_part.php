<?php session_start( ) ;?>

<?php 
    function convert( $day )
    {
        if( $day == "monthly")
        {
            return 30 ;
        }
        else if( $day == "weekly" )
        {
            return 7 ;
        }
        else if( $day == "yearly" )
        {
            return 365 ;
        }
        else if( $day == "15_days" )
        {
            return 15 ;
        }
        else if( $day == "3_month" )
        {
            return 90 ;
        }
        else if( $day == "6_month" )
        {
            return 180 ;
        }
    }


?>


<?php 
    if( isset( $_POST['paid_revenue_sale'] ) )
    {
        include ( "../../config/db_connection.php") ;
        
        //for view voucher purpuse 
        $_SESSION['project_schedule'] = $_POST['project_schedule'] ;
        $_SESSION['member_id'] = $_POST['member_id'] ;
        $_SESSION['profile_no'] = $_POST['profile_no'] ;
        
        
        $project_schedule_no = explode( "," , $_POST['project_schedule'] ) ;
        $cur = date ( "Y-m-d" ) ;
        $paid_amount = $_POST['paid_amount'] ;
        $result = "" ;
        for( $i = 0 ; $i < count ( $project_schedule_no ) ; $i ++ )
        {
            $id = $project_schedule_no[ $i ] ;
            $query = "UPDATE project_sales_schedule SET IS_PAID = 1 , PAID_DATE = '$cur' WHERE `PROJECT_SCHEDULE_NO` = '$id'" ;
            $result = mysqli_query( $con , $query ) ;
        }
        if( $result )
        {
            $query = "SELECT `CASH_CURRENT_BALANCE` FROM acc_cash WHERE CASH_NO = 1" ;
            $get_current = mysqli_fetch_assoc( mysqli_query ( $con , $query ) ) ;
            $current_amount = floatval ( $get_current['CASH_CURRENT_BALANCE'] ) ;
            $final = $current_amount + floatval( $paid_amount ) ;
            $update = "UPDATE acc_cash SET `CASH_CURRENT_BALANCE` = '$final' WHERE CASH_NO = 1" ;
            mysqli_query( $con , $update ) ;
            
            echo 1 ;
        }
        else
        {
            echo 0 ;
        }
        
    }


?>



<?php
    
    if( isset( $_POST['update'] ) )
    {
        include ( "../../config/db_connection.php") ;
        $handover_amount = $_POST['HAND_OVER_AMOUNT'] ;
        $deal_date= $_POST['DEAL_DATE'] ;
        $sales_amount= $_POST['SALES_AMOUNT'] ;
        $advance_amount= $_POST['ADVANCE_AMOUNT'] ;
        $permanent_address= $_POST['PERMANENT_ADDRESS'] ;
        $emergency_contact_no= $_POST['EMERGENCY_CONTACT_NO'] ;
        $id_no= $_POST['ID_NUMBER'] ;
        $email= $_POST['E_MAIL'] ;
        $mobile= $_POST['MOBILE'] ;
        $project_name = $_POST['project'] ;
        $name = $_POST['NAME'] ;
        $id = $_POST['id'] ;
        $query = "update revenue_part_sales SET `PROJECT_NO`= '$project_name', `NAME` = '$name', `PHONE` = '$mobile', `EMAIL` = '$email', 
        `ID_NUMBER` = '$id_no', `EMERGENCY_CONTACT_NUMBER` = '$emergency_contact_no', `PERMANENT_ADDRESS`= '$permanent_address', `SALE_AMOUNT` = '$sales_amount', 
        `HANDOVER_AMOUNT` = '$handover_amount', `SALE_DATE` = '$deal_date' where REVENUE_PART_SALE_NO = '$id'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            header( "Location: ../revenue_part_sales.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
           header( "Location: ../revenue_part_sales.php" ) ;
        }
    }
    
    if( isset( $_POST['revenue_part'] ))
    {
        
        include ( "../../config/db_connection.php") ;
        
        $handover_amount = $_POST['HAND_OVER_AMOUNT'] ;
        $deal_date= $_POST['DEAL_DATE'] ;
        $sales_amount= $_POST['SALES_AMOUNT'] ;
        $advance_amount= $_POST['ADVANCE_AMOUNT'] ;
        $permanent_address= $_POST['PERMANENT_ADDRESS'] ;
        $emergency_contact_no= $_POST['EMERGENCY_CONTACT_NO'] ;
        $id_no= $_POST['ID_NUMBER'] ;
        $email= $_POST['E_MAIL'] ;
        $mobile= $_POST['MOBILE'] ;
        $project_name = $_POST['project'] ;
        $name = $_POST['NAME'] ;
        $cur = date( "Y-m-d" ) ;
        $due_amount = $_POST['DUE_AMOUNT'] ;
        $additional_charge = $_POST['ADDITIONAL_CHARGE'] ;
        $outstanding_amount = $_POST['OUTSTANDING_AMOUNT'] ;
        $installment_number = $_POST['INSTALLMENT_NUMBER'] ;
        $installment_amount = $_POST['INSTALLMENT_AMOUNT'] ;
        $sales_period = $_POST['SALES_PERIOD'] ;
        $profile_no = $_POST['member_info'] ;
        
        $get_member_no = "SELECT MEMBER_NO FROM member_profiles WHERE PROFILE_NO = '$profile_no'" ;
        $give_ans = mysqli_fetch_assoc( mysqli_query( $con , $get_member_no ) ) ;
        $final_member_no = $give_ans['MEMBER_NO'] ;
        
        $query = "INSERT INTO revenue_part_sales SET `PROJECT_NO`= '$project_name', `NAME` = '$name', `PHONE` = '$mobile', `EMAIL` = '$email', 
        `ID_NUMBER` = '$id_no', `EMERGENCY_CONTACT_NUMBER` = '$emergency_contact_no', `PERMANENT_ADDRESS`= '$permanent_address', `SALE_AMOUNT` = '$sales_amount', 
        `HANDOVER_AMOUNT` = '$handover_amount', `SALE_DATE` = '$deal_date' , `MEMBER_NO` = '$final_member_no', `PROFILE_NO` = '$profile_no',  
        `DUE_AMOUNT` = '$due_amount', `ADDITIONAL_CHARGE` = '$additional_charge', `OUTSTANDING_AMOUNT` = '$outstanding_amount', 
        `TOTAL_INSTALLMENT` = '$installment_number', `INSTALLMENT_AMOUNT` = '$installment_amount', `INSTALLMENT_PERIOD` = '$sales_period',`CREATED_ON` = '$cur' " ;
        
        $created_date = date( "Y-m-d" ) ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            
            // //////////////generate revenue sale schedule //////////////////
            $get_PROJECT_SALE_NO = mysqli_insert_id( $con ) ;
            $day = convert( $sales_period ) ;
            $cur = $deal_date ;
            for( $i = 1 ; $i <= $installment_number ; $i ++ )
            {
                $date=date_create($cur);
                date_add($date,date_interval_create_from_date_string("$day days"));
                $cur = date_format($date,"Y-m-d");
                $array = explode( "-" , $cur ) ;
                
                $sql = "INSERT INTO project_sales_schedule SET `MEMBER_NO` = '$final_member_no', `PROFILE_NO` = '$profile_no', `PROJECT_SALE_NO` = '$get_PROJECT_SALE_NO', 
                `INSTALLMENT_AMOUNT` = '$installment_amount', `INSTALLMENT_NUMBER` = '$i', 
                `IS_PAID` = '0', `DAY` = '$array[2]', `MONTH` = '$array[1]', `YEAR` = '$array[0]', `CREATED_ON` = '$created_date'" ;
                mysqli_query( $con , $sql ) ;
            }
            
            
            header( "Location: ../revenue_part_sales.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
           header( "Location: ../revenue_part_sales.php" ) ;
        }
        
        
    }




?>