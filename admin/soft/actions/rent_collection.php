<?php 

    function ValidCheckDate( $date1 , $cur )
    {
        $schedule_date = explode("-", $date1 ) ;
        $current = explode("-", $cur ) ;

        if( $schedule_date[0] <= $current[ 0 ] )
        {
            if( $schedule_date[1] <= $current[ 1 ] )
            {
                if( $schedule_date[2] <= $current[ 2 ] )
                {
                    return true ;
                }
                else
                {
                    return false ;
                }
            }
            else
            {
                return false ;
            }
        }
        else
        {
            return false ;
        }
    }

    if( isset( $_POST['information'] ) ) 
    {
        include ( "../../config/db_connection.php") ;
        $profile_no = $_POST['profile_no'] ;
        
        $sql = "SELECT FULL_NAME, MEMBER_ID, MOBILE, PRESENT_THANA, PRESENT_DISTRICT,PRESENT_HOUSE_NO,PRESENT_ROAD_NO FROM member_profiles WHERE PROFILE_NO = '$profile_no'" ;
        $result = mysqli_query( $con , $sql ) ;
        
        foreach( $result as $value )
        {
            echo "<tr>" ;
                    echo"<td>1</td>" ;
                    echo "<td>".$value['FULL_NAME']."</td>" ;
                    echo "<td>".$value['MEMBER_ID']."</td>" ;
                    echo "<td>".$value['MOBILE']."</td>" ;
                    
                    $address = $value['PRESENT_HOUSE_NO'].",".$value['PRESENT_ROAD_NO'].",".$value['PRESENT_THANA'].",".$value['PRESENT_DISTRICT'] ;
                    echo "<td>".$address."</td>" ;
            
            echo "</tr>" ;
        }
    }


    if( isset( $_POST['revenue_info'] ) ) 
    {
        include ( "../../config/db_connection.php") ;
        $revenue_no = $_POST['revenue_no'] ;
        
        $sql = "SELECT `NAME`, `PHONE`, `PERMANENT_ADDRESS` FROM revenue_part_rents WHERE `REVENUE_PART_RENT_NO`='$revenue_no'" ;
        $result = mysqli_query( $con , $sql ) ;
        
        foreach( $result as $value )
        {
            echo "<tr>" ;
                    echo"<td>1</td>" ;
                    echo "<td>".$value['NAME']."</td>" ;
                    
                    echo "<td>".$value['PHONE']."</td>" ;
                    
                    echo "<td>".$value['PERMANENT_ADDRESS']."</td>" ;
            
            echo "</tr>" ;
        }
    }

    if( isset( $_POST['profile_dues']) ) 
    {
        include ( "../../config/db_connection.php") ;
        $profile_no = $_POST['profile_no'] ;
        $query = "SELECT * FROM revenue_part_schedule WHERE PROFILE_NO = '$profile_no' AND IS_PAID = 0 " ;
        $i = 1 ;
        $cur = date("Y-m-d") ;
        // $cur = "2020-04-16" ;
        $result = mysqli_query( $con , $query ) ;
        $amount  = 0 ;
        foreach ($result  as  $value) {
            $schedule_date = $value['YEAR']."-".$value['MONTH']."-".$value['DAY'] ;
            
            if( ValidCheckDate( $schedule_date , $cur ) )
            {

                echo "<tr>";
     

                    echo "<td>".$i ++."</td>";
                    echo "<td>".$value['DAY']. "</td>";
                    echo "<td>".$value['MONTH']. "</td>";
                    echo "<td>".$value['YEAR']. "</td>";
                    echo "<td>".$value['INSTALLMENT_NUMBER']. "</td>";
                    echo "<td>".$value['INSTALLMENT_AMOUNT']. "</td>";
                    $amount += $value['INSTALLMENT_AMOUNT'] ;
                    $day = $value['DAY'];
                    $month = $value['MONTH'] ;
                    $year = $value['YEAR'];
                    $installment_number = $value['INSTALLMENT_NUMBER'] ;
                    $installment_amount = $value['INSTALLMENT_AMOUNT'];
                    $revenue_no = $value['REVENUE_PART_SCEHDULE_NO'] ;
                    
                    echo "<td><input type = 'checkbox' name = 'checkbox' class = 'sum' checked  DAY = '".$day."'  MONTH = '".$month."' YEAR = '".$year."' INSTALLMENT_NUMBER = '".$installment_number."' REVENUE_PART_SCEHDULE_NO = '".$revenue_no."' INSTALLMENT_AMOUNT = '".$installment_amount."'> </td>";
                echo "</tr>";
            }
        }
        echo "<tfooter id = 'tfoot_id'>";

                echo "<tr>";
                    echo "<td></td>" ;
                    echo "<th colspan = '4'>Total</th>" ;
                    echo "<th id = 'total'>".$amount."</th>" ;
                    echo "<td></td>";
                echo "</tr>";

            echo "</tfooter>";
    }


    if( isset( $_POST['revenue_dues']) ) 
    {
        include ( "../../config/db_connection.php") ;
        $revenue_no = $_POST['revenue_no'] ;
        $query = "SELECT * FROM revenue_part_schedule WHERE `REVENUE_PART_RENT_NO` = '$revenue_no' AND IS_PAID = 0 " ;
        $i = 1 ;
        $result = mysqli_query( $con , $query ) ;
        $cur = date( "Y-m-d" ) ;
        $amount  = 0 ;
        foreach ($result  as  $value) {
            $schedule_date = $value['YEAR']."-".$value['MONTH']."-".$value['DAY'] ;

            // if( ValidCheckDate( $schedule_date , $cur )  )
            // {
                    echo "<tr>";
                    echo "<td>".$i ++."</td>";
                    echo "<td>".$value['DAY']. "</td>";
                    echo "<td>".$value['MONTH']. "</td>";
                    echo "<td>".$value['YEAR']. "</td>";
                    echo "<td>".$value['INSTALLMENT_NUMBER']. "</td>";
                    echo "<td>".$value['INSTALLMENT_AMOUNT']. "</td>";
                    $amount += $value['INSTALLMENT_AMOUNT'] ;
                    $day = $value['DAY'];
                    $month = $value['MONTH'] ;
                    $year = $value['YEAR'];
                    $installment_number = $value['INSTALLMENT_NUMBER'] ;
                    $installment_amount = $value['INSTALLMENT_AMOUNT'];
                    $revenue_no = $value['REVENUE_PART_SCEHDULE_NO'] ;
                    
                    echo "<td><input type = 'checkbox' name = 'checkbox' class = 'sum' checked  DAY = '".$day."'  MONTH = '".$month."' YEAR = '".$year."' INSTALLMENT_NUMBER = '".$installment_number."' REVENUE_PART_SCEHDULE_NO = '".$revenue_no."' INSTALLMENT_AMOUNT = '".$installment_amount."'> </td>";
                echo "</tr>";
            // }
            
        }
        echo "<tfooter id = 'tfoot_id'>";

                echo "<tr>";
                    echo "<td></td>" ;
                    echo "<th colspan = '4'>Total</th>" ;
                    echo "<th id = 'total'>".$amount."</th>" ;
                    echo "<td></td>";
                echo "</tr>";

            echo "</tfooter>";
    }

    if( isset($_POST['collect_all'] ) )
    {
        $cur = date("Y-m-d") ;
        include ( "../../config/db_connection.php") ;
        $revenue_no = explode(",", $_POST['revenue_no']) ;
        $result = "" ;

        $deduction_amount = $_POST['deduction_amount'] ;
        $receive_amount = $_POST['paid'] ;
        $rent_schedule_no  = "" ;

        for( $i = 0 ; $i < count( $revenue_no ) ; $i ++ )
        {

            $id = $revenue_no[$i] ;
            $rent_schedule_no = $id ;
            $query = "UPDATE revenue_part_schedule SET IS_PAID = 1 , PAID_DATE = '$cur' WHERE `REVENUE_PART_SCEHDULE_NO`='$id'" ;
            $result = mysqli_query( $con , $query ) ;
        }


        $outstanding_amount = floatval( $receive_amount - $deduction_amount );
        if( $result ) 
        {
            $sql = "SELECT `REVENUE_PART_RENT_NO` FROM revenue_part_schedule WHERE REVENUE_PART_SCEHDULE_NO = '$rent_schedule_no'" ;

            $get_revenue_part_rent_no = mysqli_fetch_assoc( mysqli_query( $con , $sql ) ) ;
            $final_revenue_part_rent_no = $get_revenue_part_rent_no['REVENUE_PART_RENT_NO'] ;

            $insert_revenue_part_rent_collection = "INSERT INTO revenue_part_rent_collection SET `REVENUE_PART_RENT_NO` = '$final_revenue_part_rent_no', `RECEIVE_AMOUNT` = '$outstanding_amount', `DEDUCTION_AMOUNT` = '$deduction_amount', `TOTAL_AMOUNT` = '$receive_amount', `PAID_DATE` = '$cur'" ;

            $get_current_handover = "SELECT HANDOVER_AMOUNT FROM revenue_part_rents WHERE `REVENUE_PART_RENT_NO` = '$final_revenue_part_rent_no'" ;

            $get_current = mysqli_fetch_assoc( mysqli_query( $con , $get_current_handover ) ) ; 
            $get_final_current_handover_amount = intval( $get_current['HANDOVER_AMOUNT'] ) ;
            $outstanding_amount_handover = $get_final_current_handover_amount - intval($deduction_amount) ;

            $update_handover_amount = "UPDATE revenue_part_rents SET HANDOVER_AMOUNT = '$outstanding_amount_handover' WHERE REVENUE_PART_RENT_NO = '$final_revenue_part_rent_no'" ;
            mysqli_query( $con , $update_handover_amount ) ;
            mysqli_query( $con , $insert_revenue_part_rent_collection ) ;
            
            //update cash //
            
            $query = "SELECT `CASH_CURRENT_BALANCE` FROM acc_cash WHERE CASH_NO = 1" ;
            $get_current = mysqli_fetch_assoc( mysqli_query ( $con , $query ) ) ;
            $current_amount = floatval ( $get_current['CASH_CURRENT_BALANCE'] ) ;
            $final = $current_amount + floatval( $receive_amount ) ;
            $update = "UPDATE acc_cash SET `CASH_CURRENT_BALANCE` = '$final' WHERE CASH_NO = 1" ;
            mysqli_query( $con , $update ) ;
            
            //end cash//
            
            echo 1 ;
        }
        else
        {
            echo 0;
        }
    }

    if( isset($_POST['handoverAmount']) )
    {
        include ( "../../config/db_connection.php") ;
        $id = $_POST['revenue_no'] ;
        $query = "SELECT `HANDOVER_AMOUNT` FROM revenue_part_rents WHERE `REVENUE_PART_RENT_NO` = '$id'" ;
        $result = mysqli_fetch_assoc ( mysqli_query( $con , $query ) ) ;
        echo $result['HANDOVER_AMOUNT'];

    }

    if( isset($_POST['profile_hand'] )  )
    {
         include ( "../../config/db_connection.php") ;
         $profile_no = $_POST['profile_no'] ;
         $query = "SELECT revenue_part_rents.HANDOVER_AMOUNT FROM revenue_part_rents LEFT JOIN revenue_part_schedule ON revenue_part_schedule.REVENUE_PART_RENT_NO = revenue_part_rents.REVENUE_PART_RENT_NO WHERE revenue_part_schedule.PROFILE_NO = 23 LIMIT 1 " ;
          $result = mysqli_fetch_assoc ( mysqli_query( $con , $query ) ) ;
            echo $result['HANDOVER_AMOUNT'];
    }

?>

