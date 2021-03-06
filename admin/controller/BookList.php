<?php
session_start();
include("../../connection/DatabaseConnection.php");
 $params = $columns = $totalRecords = $data = array();
 
 $params = $_REQUEST;
 
 $columns = array(
    0 => 'Name',
    1 => 'WarningQuantity',
    2 => 'PhotoUrl',
    3 => 'AuthorId',
    4 => 'CategoryId',
    5 => 'SubCategoryId',
    6 => 'PublicationId',
    7 => 'Id',
 );
 
 $where_condition = $sqlTot = $sqlRec = "";
 
 if( !empty($params['search']['value']) ) {
    $where_condition .= " WHERE ";
    $where_condition .= " ( auth.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR b.Name LIKE '%".$params['search']['value']."%' ";    
    $where_condition .= " OR ct.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR sb.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR pb.Name LIKE '%".$params['search']['value']."%' )";
 }
 
 $sql_query = "SELECT b.*, auth.Name AuthorName, ct.Name CategoryName, sb.Name SubCategoryName, pb.Name PublicationName
                FROM books b 
                INNER JOIN authors auth ON auth.Id = b.AuthorId 
                INNER JOIN category ct ON ct.Id = b.CategoryId 
                INNER JOIN subcategory sb ON sb.Id = b.SubCategoryId 
                INNER JOIN publications pb ON pb.Id = b.PublicationId";
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