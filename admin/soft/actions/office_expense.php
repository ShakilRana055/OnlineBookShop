<?php session_start( ); ?>
<?php
    
    if( isset( $_POST['category'] ) )
    {
        session_start(  ) ;
        include ( "../../config/db_connection.php") ;
        $CATEGORY_NAME = $_POST['CATEGORY_NAME'] ;
        $CATEGORY_CODE = $_POST['CATEGORY_CODE'] ;
        $date = date( "Y/m/d") ;
        $user_no =$_SESSION['user']['user_no'];
        $query = "insert into acc_expense_categories set CATEGORY_NAME = '$CATEGORY_NAME', CATEGORY_CODE = '$CATEGORY_CODE', CREATED_ON = '$date',CREATED_BY='$user_no'" ;
        echo $query ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            header( "location: ../category_setup.php") ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            header( "location: ../category_setup.php") ;
        }
        
    }


?>