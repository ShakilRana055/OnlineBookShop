
<?php
    if( isset ( $_POST['dailyExpense'] ) && $_POST['dailyExpense'] != NULL )
    {
        include ( "../../config/db_connection.php") ;
        $date = $_POST['date'] ;
        $amount = $_POST['amount'] ;
        $expense_no = $_POST['expense_no'] ;
        $remark = $_POST['remark'] ;
        $current = date("Y/m/d") ;
        $query = "insert into acc_expenses set EXPENSE_HEAD_NO = '$expense_no', TRN_AMOUNT = '$amount', TRN_DATE = '$date',
                    TRN_REMARKS = '$remark', CREATED_ON = '$current' " ;
        //echo $query ;
        
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            echo 1 ;
        }
        else
        {
            echo 0 ;
        }
        
    }
    
    
    if( isset ( $_POST['table'] ) && $_POST['table'] != NULL )
    {
        include ( "../../config/db_connection.php") ;
        $query = "SELECT * FROM acc_expenses INNER JOIN acc_expense_heads ON acc_expense_heads.EXPENSE_HEAD_NO = acc_expenses.EXPENSE_HEAD_NO" ;
        
         //echo "<td>"."here"."</td>" ;
        
        $result = mysqli_query( $con , $query ) ;
        $count = 1 ;
        foreach( $result as $value )
        {
            echo "<tr>" ;
                 
                 echo "<td>".$count."</td>" ;
                 echo "<td>".$value['TRN_DATE']."</td>" ;
                 echo "<td>".$value['TRN_AMOUNT']."</td>" ;
                 echo "<td>".$value['HEAD_NAME']."</td>" ;
                 echo "<td>".$value['TRN_REMARKS']."</td>" ;
                 echo "<td>".""."</td>" ;
                 $count ++ ;
                 
            echo "</tr>" ;
        }
    }

?>