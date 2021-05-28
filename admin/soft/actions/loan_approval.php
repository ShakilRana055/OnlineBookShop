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
    
    
    
    if( isset( $_GET['approve'] ) )
    {
        include ( "../../config/db_connection.php") ;
        $id = $_GET['approve'] ;
        $sql = "UPDATE loans SET `IS_APPROVED` = 1 WHERE LOAN_NO = '$id'" ;
        $result = mysqli_query( $con , $sql ) ;
        $cur = date ( "Y-m-d" ) ;
        if( $result ) 
        {
            $query = "SELECT * FROM `loans` WHERE `LOAN_NO` = '$id'" ;
            $ans = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
            
            $member_no = $ans['MEMBER_NO'] ;
            $profile = $ans['PROFILE_NO'] ;
            $number = $ans['NUMBER_OF_INSTALLMENT'] ;
            $loan_amount = $ans['LOAN_AMOUNT'] ;
            $installment_amount = $ans['INSTALLMENT_AMOUNT'] ;
            $check = $ans['LOAN_PERIOD'] ;
            
            //update is_pending and is_taken //
            
            $update = "UPDATE member_profiles SET IS_PENDING = 0, IS_TAKEN = 1 WHERE MEMBER_NO = '$member_no'" ;
            mysqli_query( $con , $update ) ;
            
            $day = convert( $check ) ;
             for( $i = 1 ; $i <= $number ; $i ++ )
             {
                
                $date=date_create($cur);
                date_add($date,date_interval_create_from_date_string("$day days"));
                $cur = date_format($date,"Y-m-d");
                
                $array = explode( "-" , $cur ) ;
                $query = "INSERT INTO  loan_schedule SET `LOAN_NO` = '$id', `MEMBER_NO` = '$member_no', `PROFILE_NO` = '$profile', `INSTALLMENT_NUMBER` = '$i', 
                `INSTALLMENT_AMOUNT` = '$installment_amount', SCHEDULE_YEAR = '$array[0]' , SCHEDULE_MONTH = '$array[1]', SCHEDULE_DAY = '$array[2]', `CREATED_ON` = '$cur'" ;
                mysqli_query( $con , $query ) ;
             }
            
            
            
            $_SESSION['msg'] = "success" ;
             header("location: ../loan_approval.php") ;
        }
        else
        {
            $_SESSION['msg'] = "error" ;
            header("location: ../loan_approval.php") ;
        }
    }
    
    if( isset( $_GET['delete']) )
    {
        include ( "../../config/db_connection.php") ;
        $id = $_GET['delete'] ;
        $sql = "UPDATE loans SET IS_DELETED = 1 WHERE LOAN_NO = '$id'" ;
        $result = mysqli_query( $con , $sql ) ;
        if( $result )
        {
            $_SESSION['msg'] = "success" ;
            header("location: ../loan_approval.php") ;
        }
        else
        {
            $_SESSION['msg'] = "error" ;
            header("location: ../loan_approval.php") ;
        }
    }

?>