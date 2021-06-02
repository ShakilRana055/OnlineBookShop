<?php
session_start();
include("../../connection/DatabaseConnection.php");
 $params = $columns = $totalRecords = $data = array();
 
 $params = $_REQUEST;
 
 $columns = array(
    0 => 'Name',
    1 => 'Email',
    2 => 'Address',
    3 => 'Id' 
 );
 
 $where_condition = $sqlTot = $sqlRec = "";
 
 if( !empty($params['search']['value']) ) {
    $where_condition .= " WHERE ";
    $where_condition .= " ( Name LIKE '%".$params['search']['value']."%' ";    
    $where_condition .= " OR Phone LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR Email LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR Address LIKE '%".$params['search']['value']."%' )";
 }
 
 $sql_query = "SELECT * FROM `users`";
 $sqlTot .= $sql_query;
 $sqlRec .= $sql_query;
 
 if(isset($where_condition) && $where_condition != '') {
 
    $sqlTot .= $where_condition;
    $sqlRec .= $where_condition;
 }
 
 $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
 
 $queryTot = mysqli_query($con, $sqlTot) or die("Database Error:". mysqli_error($con));
 
 $totalRecords = mysqli_num_rows($queryTot);
 
 $queryRecords = mysqli_query($con, $sqlRec) or die("Error to Get the Post details.");
    
    $userType = array( "LoggedUserType" => $_SESSION['user']['UserType']);

    while( $row = mysqli_fetch_assoc($queryRecords) ) { 
        $row[] = $userType;
        $data[] = $row;
    } 
 $json_data = array(
    "draw"            => intval( $params['draw'] ),   
    "recordsTotal"    => intval( $totalRecords ),  
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data
    );
 
 echo json_encode($json_data);
?>