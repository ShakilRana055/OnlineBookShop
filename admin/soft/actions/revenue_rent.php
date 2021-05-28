<?php session_start( )?>

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

        if( isset( $_POST['update_final'] ) )
        {
            
            include ( "../../config/db_connection.php") ;
            $project_no = $_POST['project'] ;
            $name = $_POST['NAME'] ;
            $phone = $_POST['PHONE'] ;
            $email = $_POST['EMAIL'] ;
            $rent_amount = $_POST['RENT_AMOUNT'] ;
            $start_date = $_POST['START_DATE'] ;
            $advance_amount = $_POST['ADVANCE_AMOUNT'] ;
            $installment_amount = $_POST['INSTALLMENT_AMOUNT'] ;
            $number_of_installment = $_POST['NUMBER_OF_INSTALLMENT'] ;
            $installment_period = $_POST['INSTALLMENT_PERIOD'] ;
            $id_number = $_POST['id_number'] ;
            $emergency = $_POST['emergency'] ;
            $permanent = $_POST['permanent'] ;
            $handover_amount = $_POST['handover_amount'] ;
            $id = $_POST['id'] ;
            
            $query = "UPDATE revenue_part_rents SET `PROJECT_NO`= '$project_no', `NAME` = '$name', `PHONE`= '$phone', `EMAIL`= '$email', 
            `ID_NUMBER`= '$id_number', `EMERGENCY_CONTACT_NUMBER`= '$emergency', 
            `PERMANENT_ADDRESS` = '$permanent', `RENT_AMOUNT` = '$rent_amount', `ADVANCE_AMOUNT` = '$advance_amount', `HANDOVER_AMOUNT` = '$handover_amount',
            `INSTALLMENT_AMOUNT` = '$installment_amount', `NO_OF_INSTALLMENT` = '$number_of_installment', `DEAL_DATE` = '$start_date' where REVENUE_PART_RENT_NO = '$id' " ;
            echo $query ;
            $cur = date( "Y-m-d") ;
            $result = mysqli_query( $con , $query ) ;
            $day = convert( $installment_period ) ;
            $set_date = date("Y-m-d");
            if( $result )
            {
                

                $_SESSION['msgPositive'] = "success" ;
                 header( "location: ../revenue_part_rent.php" ) ;
            }
            else
            {
                $_SESSION['msgPositive'] = "error" ;
                header( "location: ../revenue_part_rent.php" ) ;
            }
            
        }
        
        if( isset ( $_POST['revenue_rent']) )
        {
            include ( "../../config/db_connection.php") ;
            $project_no = $_POST['project'] ;
            $name = $_POST['NAME'] ;
            $phone = $_POST['PHONE'] ;
            $email = $_POST['EMAIL'] ;
            $rent_amount = $_POST['RENT_AMOUNT'] ;
            $start_date = $_POST['START_DATE'] ;
            $advance_amount = $_POST['ADVANCE_AMOUNT'] ;
            $installment_amount = $_POST['INSTALLMENT_AMOUNT'] ;
            $number_of_installment = $_POST['NUMBER_OF_INSTALLMENT'] ;
            $installment_period = $_POST['RENT_PERIOD'] ;
            $id_number = $_POST['id_number'] ;
            $emergency = $_POST['emergency'] ;
            $permanent = $_POST['permanent'] ;
            $handover_amount = $_POST['handover_amount'] ;
            $profile_no = $_POST['profile_no'] ;
            $member = "SELECT MEMBER_NO from member_profiles where PROFILE_NO = '$profile_no'" ;
            $member_get = mysqli_fetch_assoc( mysqli_query ( $con , $member ));
            $member_no = $member_get['MEMBER_NO'] ;
            
            $query = "INSERT INTO `revenue_part_rents` SET `PROJECT_NO` = '$project_no', `NAME`='$name', `PHONE`='$phone', `EMAIL`= '$email', 
             `ID_NUMBER` = '$id_number', `EMERGENCY_CONTACT_NUMBER` = '$emergency', `PERMANENT_ADDRESS`='$permanent', `RENT_AMOUNT` = '$rent_amount', 
            `ADVANCE_AMOUNT`= '$advance_amount', `HANDOVER_AMOUNT` = '$handover_amount', 
            `INSTALLMENT_AMOUNT` = '$installment_amount', `NO_OF_INSTALLMENT` = '$number_of_installment', `DEAL_DATE`= '$start_date'" ;
            echo $query ;
            $result = mysqli_query( $con , $query ) ;
            $REVENUE_PART_RENT_NO = mysqli_insert_id( $con ) ;
            $set_date = date("Y-m-d") ;
            if( $result )
            {
                $cur = $start_date ;
                $day = convert( $installment_period ) ;
                
                for( $i = 1 ; $i <= $number_of_installment ; $i++ )
                {
                    $date = date_create($cur);
                    date_add($date,date_interval_create_from_date_string("$day days"));
                    $cur = date_format($date,"Y-m-d");
                    
                    $array = explode( "-" , $cur ) ;

                    $query = "INSERT INTO revenue_part_schedule SET `MEMBER_NO` = '$member_no', `PROFILE_NO` = '$profile_no', `INSTALLMENT_NUMBER` = '$i', `INSTALLMENT_AMOUNT` = '$installment_amount', `DAY` = '$array[2]', `MONTH` = '$array[1]', `YEAR` = '$array[0]', `IS_PAID` = 0 ,  `CREATED_ON` = '$start_date',REVENUE_PART_RENT_NO = '$REVENUE_PART_RENT_NO'" ;

                    echo "<br/>".$query ."<br/>" ;

                    mysqli_query( $con , $query ) ;

                }


                $_SESSION['msgPositive'] = "success" ;
                 header( "location: ../revenue_part_rent.php" ) ;
            }
            else
            {
                $_SESSION['msgPositive'] = "error" ;
                 header( "location: ../revenue_part_rent.php" ) ;
            }
        }




?>