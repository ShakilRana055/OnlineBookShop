<?php
    // database connection
    include("../../connection/DatabaseConnection.php");

    if(isset($_POST['save'])){
        try 
        {
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $Phone = $_POST['Phone'];
            $Address = $_POST['Address'];
            $CompanyName = $_POST['CompanyName'];
            $Designation = $_POST['Designation'];

            $PhotoUrl = '';

            $sql = "INSERT INTO `supplier`(`Name`, `Email`, `Phone`, `Address`,`PhotoUrl`,`CompanyName`, `Designation`, `CreatedDate`) 
                    VALUES ('$Name','$Email','$Phone','$Address','$PhotoUrl', '$CompanyName','$Designation','$currentDate')";
            
            //$image = time().trim( $_FILES['image']['name'] );
            //$target = "image/".basename($image);
            //$member_no1 = mysqli_insert_id( $con ) ;
            //move_uploaded_file( $_FILES['image']['tmp_name'] , $target ) ;

            $result = mysqli_query($con , $sql);
            if($result != null){
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        } 
        catch (Throwable $th) {
            echo json_encode($th);
        }
        
    }

    if(isset($_POST["draw"])){
        $draw = $_POST["draw"];
        $start = $_POST["start"];
        $length = $_POST["length"];
        $sortColumn = $_POST["columns[".$_POST["order[0][column]"]."][name]"];
        $sortColumnDir = $_POST["order[0][dir]"];
        $searchValue = strtolower($_POST["search[value]"]);

        $pageSize = length != null ? (int) length : 0;
        $skip = start != null ? (int) start : 0;
        $recordsTotal = 0;

        $sql = "SELECT * FROM `supplier` ORDER BY Id DESC";
        $supplierList = mysql_fetch_array(mysqli_query($con, $sql));
        //echo json_encode($supplierList);
        #region Filtering table data
        // searching 
        // if (searchValue != null)
        // {
        //     try
        //     {
        //         var filterBrandList = brandList.Where(
        //             x => x.Name.ToLower().Contains(searchValue) ||
        //             x.Code.ToLower().Contains(searchValue) ||
        //             x.Description.ToLower().Contains(searchValue)).ToList();
        //         brandList = filterBrandList;
        //     }
        //     catch (Exception ex)
        //     {
        //         throw ex;
        //     }
        // }

        #endregion

        $lists = $supplierList;

        //total number of rows count     
        $recordsTotal = Count($lists);

        //Paging     
        $data = $supplierList;
        $jsonData = array();
        $jsonData["draw"] = $draw;
        $jsonData["recordsFiltered"] = $recordsTotal;
        $jsonData["recordsTotal"] = $recordsTotal;
        $jsonData["data"] = $data;
        echo json_encode($jsonData);
        //Returning Json Data    
        //return Json(new { draw = draw, recordsFiltered = recordsTotal, recordsTotal = recordsTotal, data = data });
    
    }

?>

