<?php include 'include/header.php';?>
<?php $table_heading = "Category Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$tbl_name="acc_expense_categories";        //your table name
$targetpage = "category_setup.php";  //your file name  (the name of this file)
$user_no =$_SESSION['user']['user_no'];
$CURR_TIME = date('Y-m-d H:i:s');
$mgs = '';
if(isset($_GET['delete']))
{
    $ID = $_GET['delete'];
    
    $sql = "UPDATE $tbl_name SET `IS_DELETED` = 1 ,`DELETED_BY` = '$user_no', `DELETED_ON` = '$CURR_TIME' WHERE EXPENSE_CATEGORY_NO= $ID";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $mgs = "Data Delete Successfully!";
        $class = "green_color alert alert-success col-md-6 alert-dismissable";
        echo "<meta http-equiv='refresh' content='0;url=category_setup.php'>";
    }
    else
    {
        $mgs = "Data Delete Fail!";
        $class = "red_color alert alert-warning alert-dismissable col-md-6";
    }
}
if(isset($_POST['submit']))
{
       	$CATEGORY_CODE  = trim($_POST['CATEGORY_CODE']);
      $CATEGORY_NAME  = trim($_POST['CATEGORY_NAME']);
     
    
    $SQL = "SELECT * FROM $tbl_name WHERE CATEGORY_CODE='$CATEGORY_CODE' ";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):
        
        $sql = "INSERT INTO $tbl_name (`CATEGORY_CODE`, `CATEGORY_NAME` ,`CREATED_BY` , `CREATED_ON`) VALUES( '$CATEGORY_CODE','$CATEGORY_NAME','$user_no', '$CURR_TIME')";
        
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $mgs = "Data Insert Successfully!";
            $class = "green_color alert alert-success col-md-6 alert-dismissable";
        }
        else
        {
            $mgs = "Data Insert Fail!";
            $class = "red_color alert alert-warning alert-dismissable col-md-6";
        }
    else:
      $mgs = "Duplicate Data";
       $class = "red_color alert alert-warning alert-dismissable col-md-6";
    endif;
}
if(isset($_POST['update']))
{
      $id=$_GET['edit'];
     
  
     	$CATEGORY_CODE  = trim($_POST['CATEGORY_CODE']);
      $CATEGORY_NAME  = trim($_POST['CATEGORY_NAME']);
    
    
        
        $sql = "UPDATE $tbl_name SET CATEGORY_CODE='$CATEGORY_CODE',CATEGORY_NAME='$CATEGORY_NAME' WHERE EXPENSE_CATEGORY_NO='$id'";
        
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $mgs = "Data Update Successfully!";
            $class = "green_color alert alert-success col-md-6 alert-dismissable";
           echo "<meta http-equiv='refresh' content='0;url=category_setup.php'>";
        }
        else
        {
            $mgs = "Data Update Fail!";
            $class = "red_color alert alert-warning alert-dismissable col-md-6";
        }
    
}
?>
<?php
if(isset($_GET['edit'])):
    $id = $_GET['edit'];

     $sql = "SELECT * FROM $tbl_name WHERE `EXPENSE_CATEGORY_NO`= '$id' ";
     $result = mysqli_fetch_array(mysqli_query($con,$sql));

    ?>
    
<style>
    .error
    {
        color: red ; 
    }
</style>

<form class="cmxform form-horizontal "  method="post" enctype="multipart/form-data" >
    <fieldset class = "scheduler-border">
        <legend class = "scheduler-border"> Category Setup</legend> 
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="EXPENSE_CATEGORY_NO" value="<?=$result['EXPENSE_CATEGORY_NO']?>" />
            </div>
        </div>
            
        <div class="form-group ">
            <label class="control-label col-lg-3">Catagory Code:</label>
           <div class="col-lg-5">
                <input class=" form-control"  name="CATEGORY_CODE" type="text" value="<?=$result['CATEGORY_CODE']?>"  />

            </div>
            
        </div>
        
        
        <div class="form-group ">
            <label for="CATEGORY_NAME" class="control-label col-lg-3">Catagory Name:</label>
           <div class="col-lg-5">
                <input class=" form-control"  name="CATEGORY_NAME" type="text" value="<?=$result['CATEGORY_NAME']?>"/>

            </div>
            
        </div>
         
        
        <div class="form-group">
            <div class="col-lg-offset-7">
                <input type="submit" class="btn btn-primary"  name="update" value="Update" />

            </div>
        </div>
        </div>
        </fieldset>
    </form>

    <?php
else:
    ?>

    <form class="cmxform form-horizontal "  method="post" enctype="multipart/form-data">
        <fieldset class = "scheduler-border">
        <legend class = "scheduler-border"> Category Setup</legend> 
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>

        </div>
        <div class="form-group ">
            <label class="control-label col-lg-3">Catagory Code:</label>
           <div class="col-lg-5">
                <input class=" form-control"  name="CATEGORY_CODE" type="text"  />

            </div>
            
        </div>
        
        
        <div class="form-group ">
            <label for="CATEGORY_NAME" class="control-label col-lg-3">Catagory Name:</label>
           <div class="col-lg-5">
                <input class=" form-control"  name="CATEGORY_NAME" type="text" />

            </div>
            
        </div>
        
        <div class="form-group">
            <div class="col-lg-offset-7">
                <input type="submit" class="btn btn-primary"  name="submit" value="Add" />

            </div>
        </div>
        </fieldset>
    </form>

    <?php
        endif;
    ?>
 
 
<?php 

    $get_search_result = "" ;
    $is_search = "no" ;
    if( isset( $_POST['search'] ) )
    {
        $is_search = "yes" ;
        $get_category_code = $_POST['CATEGORY_CODE'] ;
        $get_category_name = $_POST['CATEGORY_NAME'] ;
        $query = "" ;
        if( $get_category_code != "" )
        {
            $query = "SELECT * FROM `acc_expense_categories` WHERE `CATEGORY_CODE` = '$get_category_code'" ;
        }
        else if( $get_category_name != "" )
        {
            $query = "SELECT * FROM acc_expense_categories WHERE `CATEGORY_NAME` LIKE '%".$get_category_name."%' " ;
        }
        $get_search_result = mysqli_query( $con , $query ) ;
    }

?>     
     
<form class='cmxform form-horizontal' action = "" method = "post" enctype = "multipart/form-data">
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		<div class='col-md-4 '>
			<div class='form-group'>
				<label for='srcCATEGORY_CODE' class='control-label col-lg-5'>Category Code</label>
				<div class='col-lg-7'>
					<input class='form-control src_data' name='CATEGORY_CODE' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
		</div>
		<div class='col-md-4 '>
			<div class='form-group'>
				<label for='srcCATEGORY_NAME' class='control-label col-lg-5'>Category Name</label>
				<div class='col-lg-7'>
					<input class='form-control src_data' name='CATEGORY_NAME' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
		</div>
		<div class='col-md-4 '>
			<div class='form-group'>
				
				<div class='col-lg-4'>
					<input type='submit' table_name = 'gen_categories' class='btn btn-primary pull-right' name = "search" id='btnSearch' value='Search' />
				</div>
			</div>
		</div>
			
	</fieldset>
</form>

    <?php
    $where = "";
    
    
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    
    /* 
       First get total number of rows in data table. 
       If you have a WHERE clause in your query, make sure you mirror it here.
    */
    $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE $tbl_name.`IS_DELETED` = 0 $where";
    $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
    $total_pages = $total_pages['num'];
    
    /* Setup vars for query. */
    $limit = 15; 
    if(isset($_GET['page']))
    {                               //how many items to show per page
        $page = $_GET['page'];
    }
    else
    $page = 1;
    
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 0
    
    /* Get data. */
  
   
    $sql = "SELECT * FROM $tbl_name WHERE $tbl_name.`IS_DELETED` = 0 $where  LIMIT $start, $limit";
    $result = mysqli_query($con,$sql);


    
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1
    
    /* 
        Now we apply our rules and draw the pagination object. 
        We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    {   
        $pagination .= "<div class=\"pagination\">";
        //previous button
        if ($page > 1) 
            $pagination.= "<a href=\"$targetpage?page=$prev\"><< previous</a>";
        else
            $pagination.= "<span class=\"disabled\"><< previous</span>";    
        
        //pages 
        if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">next >></a>";
        else
            $pagination.= "<span class=\"disabled\">next >></span>";
        $pagination.= "</div>\n";       
    }
?>


<div style="overflow: auto;">
    <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
        <tr>
            <th><center>Sl</center></th>
            <th><center>Category Code</center></th>
            <th><center>Category Name</center></th>
             
            <th><center>Action</center></th>
            
         </tr>
         <?php
            if( $is_search == "yes" )
            {
                $count = 1 ;
                foreach( $get_search_result as $value )
                {
                    echo "<tr>" ;
                        
                        echo "<td>".$count ++."</td>" ;
                        echo "<td>".$value['CATEGORY_CODE']."</td>" ;
                        echo "<td>".$value['CATEGORY_NAME']."</td>" ;
                        ?>
                        <td>
                           <center> 
                           <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$value['EXPENSE_CATEGORY_NO']?>"  class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$value['EXPENSE_CATEGORY_NO']?>" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i></a>
                           
                            </center>
                        </td>
                                
                        <?php
                    echo "</tr>" ;
                }
                $is_search = "no" ;
            }
            else{
         ?>
        <?php $i=$page*$limit-$limit+1; while($row = mysqli_fetch_array($result)):?>
            <tr>
                <td><center><?=$i++?></center></td>
                <td><?=$row['CATEGORY_CODE']?></td>
                <td><?=$row['CATEGORY_NAME']?></td>
                
                <td>
                   <center> 
                   <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['EXPENSE_CATEGORY_NO']?>"  class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                    <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['EXPENSE_CATEGORY_NO']?>" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i></a>
                   
                    </center>
                </td>
            </tr>
        <?php endwhile;
        }?>
    </table>
</div>
<?=$pagination?>
    
    <!---main content end---->
<?php include 'include/footer.php';?>

<script>
    $(document).ready(function(){
        
        $("#btnAdd").click(function(){
            var add = $("#add").val( ).trim( ) ;
            if( add == "-1")
            {
                $("#error").text( "Please Select one" ) ;
                return false ;
            }
            else
            {
                 $("#error").text( "" ) ;
            }
            
        });
        
    });
</script>


