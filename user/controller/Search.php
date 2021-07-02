<?php
session_start();
include("../../connection/DatabaseConnection.php");
$userId = isset($_SESSION['customer']['Id']) ? $_SESSION['customer']['Id'] : '';
 $params = $columns = $totalRecords = $data = array();
 
 $params = $_REQUEST;
 
 $columns = array(
    0 => 'PhotoUrl',
    1 => 'Name',
    2 => 'Id',
    3 => 'Quantity',
    4 => 'Id',
 );
 
 $where_condition = $sqlTot = $sqlRec = "";
 
 if( !empty($params['search']['value']) ) {
    $where_condition .= " AND ";
    $where_condition .= " ( b.Name LIKE '%".$params['search']['value']."%' ";    
    $where_condition .= " OR a.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR pb.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR ct.Name LIKE '%".$params['search']['value']."%' ";
    $where_condition .= " OR sb.Name LIKE '%".$params['search']['value']."%' )";
 }
 
 if($userId == ''){
   $sql_query = "SELECT b.*, a.Name AuthorName, pb.Name PublicationName, ct.Name CategoryName, sb.Name SubCategoryName, st.UnitPrice,
   CASE WHEN st.Quantity > 0 THEN 1 ELSE 0 END IsAvailable, 0 as Ordered
   FROM books b 
   INNER JOIN category ct ON b.CategoryId = ct.Id
   INNER JOIN subcategory sb ON sb.Id = b.SubCategoryId
   INNER JOIN publications pb ON pb.Id = b.PublicationId
   INNER JOIN authors a on a.Id = b.AuthorId
   INNER JOIN stock st ON st.BookId = b.Id";
 }
 else{
    $sql_query = "SELECT b.*, a.Name AuthorName, pb.Name PublicationName, ct.Name CategoryName, sb.Name SubCategoryName, st.UnitPrice,
                  CASE WHEN st.Quantity > 0 THEN 1 ELSE 0 END IsAvailable
                  ,CASE WHEN EXISTS (SELECT * FROM temporder WHERE temporder.BookId = b.Id AND temporder.UserId = $userId) THEN 1 ELSE 0 END Ordered
                  FROM books b 
                  INNER JOIN category ct ON b.CategoryId = ct.Id
                  INNER JOIN subcategory sb ON sb.Id = b.SubCategoryId
                  INNER JOIN publications pb ON pb.Id = b.PublicationId
                  INNER JOIN authors a on a.Id = b.AuthorId
                  INNER JOIN stock st ON st.BookId = b.Id";
 }

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