<?php 

    include ( "../../config/db_connection.php") ;
    $name = explode ( "," , $_POST['name'] );
    $relation = explode ( "," ,  $_POST['relation']) ;
    $address = explode ( "," ,  $_POST['address']) ;
    $mobile = explode ( "," ,  $_POST['mobile']) ;
    $nid = explode ( "," , $_POST['nid']) ;
    $birth = explode ( "," , $_POST['birth']) ;
    $percentage = explode ( "," ,  $_POST['percentage']) ;
    $date = date( "Y/m/d") ;
    mysqli_autocommit( $con , FALSE ) ;
    
    for( $i = 0 ; $i < count( $name ) ; $i ++ )
    {
        $query = "INSERT INTO SET NOM_NAME = '$name[$i]', NOM_ADDRESS = '$address[$i]', NOM_MOBILE= '$mobile[$i]', 
        NOM_NID = '$nid[$i]', NOM_BIRTH = '$birth[$i]',NOM_PERCENTAGE = '$percentage[$i]', CREATED_ON = '$date',
        NOM_RELATION = '$relation[$i]' " ;
        mysqli_query( $con , $query ) ;
    }
    

?>