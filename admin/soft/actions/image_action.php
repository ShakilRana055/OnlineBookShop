

<?php

    if( isset ( $_POST['submit'] ) ) 
    {
        include ( "../../config/db_connection.php") ;
        $image = $_FILES['image']['name'];
        echo $image ;
        $target = "image/".basename($image);
        $query = "insert into image set IMAGE_NAME = '$image' " ;
        $result = mysqli_query( $con , $query ) ;
        move_uploaded_file( $_FILES['image']['tmp_name'] , $target ) ;
    }





?>