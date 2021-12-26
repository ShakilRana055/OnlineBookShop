<?php
session_start();
include("../../connection/DatabaseConnection.php");
 $params = $columns = $totalRecords = $data = array();
 
 $params = $_REQUEST;
 
 $columns = array(
    0 => 'InvoiceNumber',
    1 => 'Name',
    2 => 'Id',
    3 => 'SubTotal',
    4 => 'GrandTotal',
    5 => 'DeliveryDate',
    6 => 'Status',
    7 => 'Email',
 );
 
 $where_condition = $sqlTot = $sqlRec = "";
 
 if( !empty($params['search']['value']) ) {
    $where_condition .= " WHERE ";
    $where_condition .= " ( us.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR inv.InvoiceNumber LIKE '%".$params['search']['value']."%' ";    
    $where_condition .= " OR us.Email LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR us.Phone LIKE '%".$params['search']['value']."%' )";
 }
 
 $sql_query = "SELECT inv.*, us.Name, us.Email, us.Phone, us.Address
                FROM invoice inv 
                INNER JOIN users us ON us.Id = inv.UserId";
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
    
    while( $row = mysqli_fetch_assoc($queryRecords) ) { 
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