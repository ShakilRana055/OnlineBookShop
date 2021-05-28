<?php include 'include/header.php';?>
<?php $table_heading = "Project Expnese";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php
$tbl_name="project_expenses";        //your table name
$targetpage = "project_expense.php";  //your file name  (the name of this file)
$user_no =$_SESSION['user']['user_no'];
$CURR_TIME = date('Y-m-d H:i:s');
$mgs = '';
if(isset($_GET['delete']))
{
    $ID = $_GET['delete'];
    
    $sql = "UPDATE $tbl_name SET `IS_DELETED`=1,`DELETED_BY`='$user_no',`DELETED_ON`= '$CURR_TIME' WHERE PROJECT_EXPENSE_NO= $ID";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        $mgs = "Data Delete Successfully!";
        $class = "green_color alert alert-success col-md-6 alert-dismissable";
        echo "<meta http-equiv='refresh' content='0;url=project_expense.php'>";
    }
    else
    {
        $mgs = "Data Delete Fail!";
        $class = "red_color alert alert-warning alert-dismissable col-md-6";
    }
}
if(isset($_POST['submit']))
{
       	  $DATE = trim($_POST['transfer_date']);
       	 $PROJECT_NAME= trim($_POST['PROJECT_NO']);
       	  $PROJECT_EXPENSE_HEAD_NAME=trim($_POST['PROJECT_EXPENSE_HEAD_NO']);
      $EXPENSE_AMOUNT= trim($_POST['EXPENSE_AMOUNT']);
      $REMARKS = trim($_POST['REMARKS']);
     
    
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `PROJECT_NO` = '$PROJECT_NAME' AND `PROJECT_EXPENSE_HEAD_NO`='$PROJECT_EXPENSE_HEAD_NAME'";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):
        
        $sql = "INSERT INTO $tbl_name (`TRN_DATE`,`PROJECT_NO`,`PROJECT_EXPENSE_HEAD_NO`,`EXPENSE_AMOUNT`,`REMARKS`,`CREATED_BY`,`CREATED_ON`,`IS_DELETED`) VALUES('$DATE','$PROJECT_NAME','$PROJECT_EXPENSE_HEAD_NAME','$EXPENSE_AMOUNT','$REMARKS','$user_no','$CURR_TIME',0)";
       
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
     
   $DATE = trim($_POST['transfer_date']);
       	 $PROJECT_NAME= trim($_POST['PROJECT_NO']);
       	  $PROJECT_EXPENSE_HEAD_NAME=trim($_POST['PROJECT_EXPENSE_HEAD_NO']);
      $EXPENSE_AMOUNT= trim($_POST['EXPENSE_AMOUNT']);
      $REMARKS = trim($_POST['REMARKS']);
    
    
        
        $sql = "UPDATE $tbl_name SET TRN_DATE='$DATE',PROJECT_NO='$PROJECT_NAME',PROJECT_EXPENSE_HEAD_NO='$PROJECT_EXPENSE_HEAD_NAME',EXPENSE_AMOUNT='$EXPENSE_AMOUNT',REMARKS='$REMARKS',UPDATED_BY='$user_no' ,UPDATED_ON='$CURR_TIME' WHERE PROJECT_EXPENSE_NO='$id'";
        
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $mgs = "Data Update Successfully!";
            $class = "green_color alert alert-success col-md-6 alert-dismissable";
           echo "<meta http-equiv='refresh' content='0;url=project_expense.php'>";
        }
        else
        {
            $mgs = "Data Update Fail!";
            $class = "red_color alert alert-warning alert-dismissable col-md-6";
        }
    
}
?>
<?php
$result11 = "";
if(isset($_GET['edit'])):
    $id = $_GET['edit'];

     $sql = "SELECT project_expenses.PROJECT_EXPENSE_NO,project_expenses.PROJECT_NO,project_expenses.PROJECT_EXPENSE_HEAD_NO,projects.PROJECT_NAME ,project_expense_heads.PROJECT_EXPENSE_HEAD_NAME, project_expenses.TRN_DATE, project_expenses.EXPENSE_AMOUNT,project_expenses.REMARKS FROM project_expenses INNER JOIN projects ON projects.PROJECT_NO = project_expenses.PROJECT_NO INNER JOIN project_expense_heads ON project_expenses.PROJECT_EXPENSE_HEAD_NO = project_expense_heads.PROJECT_EXPENSE_HEAD_NO   WHERE  $tbl_name.`PROJECT_EXPENSE_NO`= '$id' ";
     
     $result11 = mysqli_fetch_array(mysqli_query($con,$sql));

    ?>
    
<style>
    .error
    {
        color: red ; 
    }
</style>

<form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
    <fieldset class = "scheduler-border">
        <legend class = "scheduler-border">Project Expenses</legend> 
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="PROJECT_EXPENSE_NO" value="<?=$result11['PROJECT_EXPENSE_NO']?>" />
            </div>
        </div>
            
        <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Date <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="date"  name="transfer_date" class="form-control" placeholder="" value="<?=$result11['TRN_DATE']?>">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="PROJECT_NO"> Project Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                         <select class="form-control search" name="PROJECT_NO" id="add" style="width: 100%" >
                              <option value="<?=$result11['PROJECT_NO']?>"><?=$result11['PROJECT_NAME']?></option>
                             <option value="-1">-- Select Name --</option>
                             <?php
                                    $sql = "SELECT * FROM `projects` where IS_DELETED=0 ";
                                    $result1 = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($result1)):
                                ?>
                                    <option value="<?=$row['PROJECT_NO']?>"><?=$row['PROJECT_NAME']?></option>
                                <?php endwhile;?>
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="PROJECT_EXPENSE_HEAD_NO"> Expense Head Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select class="form-control search" name="PROJECT_EXPENSE_HEAD_NO"  style="width: 100%" >
                             <option value="<?=$result11['PROJECT_EXPENSE_HEAD_NO']?>"><?=$result11['PROJECT_EXPENSE_HEAD_NAME']?></option> 
                             <option value="-1">-- Select Name --</option>
                             <?php
                                    $sql = "SELECT * FROM `project_expense_heads` where IS_DELETED=0 ";
                                    $result1 = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($result1)):
                                ?>
                                    <option value="<?=$row['PROJECT_EXPENSE_HEAD_NO']?>"><?=$row['PROJECT_EXPENSE_HEAD_NAME']?></option>
                                <?php endwhile;?>
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Amount<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="amount" name="EXPENSE_AMOUNT" class="form-control" placeholder="Amount " value="<?=$result11['EXPENSE_AMOUNT']?>">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="REMARKS">Remarks</label>
                        <div class="col-md-6">
                           <textarea class="form-control" name="REMARKS"><?=$result11['REMARKS']?></textarea>
                            
                        </div>
                    </div>
         
        
        <div class="form-group">
            <div class="col-lg-offset-8">
                <input type="submit" class="btn btn-primary"  name="update" value="Update" />

            </div>
        </div>
        </div>
        </fieldset>
    </form>

    <?php
else:
    ?>

    <form action="" id="project_expense" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Project Expense  </legend>
                        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
                             <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>

                        </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Date <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="date" id="" name="transfer_date" class="form-control" placeholder="">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for=""> Project Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                         <select class="form-control search" name="PROJECT_NO"  style="width: 100%" >
                              
                             <option value="-1">-- Select Name --</option>
                             <?php
                                    $sql = "SELECT * FROM `projects` where IS_DELETED=0 ";
                                    $result1 = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($result1)):
                                ?>
                                    <option value="<?=$row['PROJECT_NO']?>"><?=$row['PROJECT_NAME']?></option>
                                <?php endwhile;?>
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" > Expense Head Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select class="form-control search" name="PROJECT_EXPENSE_HEAD_NO"  style="width: 100%" >
                              
                             <option value="-1">-- Select Name --</option>
                             <?php
                                    $sql = "SELECT * FROM `project_expense_heads` where IS_DELETED=0 ";
                                    $result1 = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($result1)):
                                ?>
                                    <option value="<?=$row['PROJECT_EXPENSE_HEAD_NO']?>"><?=$row['PROJECT_EXPENSE_HEAD_NAME']?></option>
                                <?php endwhile;?>
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Amount<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="EXPENSE_AMOUNT" class="form-control" placeholder="Amount ">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Remarks</label>
                        <div class="col-md-6">
                           <textarea class="form-control"  name="REMARKS"></textarea>
                            
                        </div>
                    </div>
                    
                        <div class="form-group">
            <div class="col-lg-offset-8">
                <input type="submit" class="btn btn-primary"  name="submit" value="Save" />

            </div>
        </div>
       </fieldset>
</form>

    <?php
        endif;
    ?>
     
     
     

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
  
   
    $sql = "SELECT project_expenses.PROJECT_EXPENSE_NO,projects.PROJECT_NAME ,project_expense_heads.PROJECT_EXPENSE_HEAD_NAME, project_expenses.TRN_DATE, project_expenses.EXPENSE_AMOUNT,project_expenses.REMARKS FROM project_expenses INNER JOIN projects ON projects.PROJECT_NO = project_expenses.PROJECT_NO INNER JOIN project_expense_heads ON project_expenses.PROJECT_EXPENSE_HEAD_NO = project_expense_heads.PROJECT_EXPENSE_HEAD_NO WHERE $tbl_name.IS_DELETED=0 $where  LIMIT $start, $limit";
   
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
            <th><center>Date</center></th>
            <th><center>Project Name</center></th>
            <th><center>Expense Head Name</center></th>
             <th><center>Amount</center></th>
            <th><center>Remarks</center></th>
            <th><center>Action</center></th>
            
         </tr>
    <?php $i=$page*$limit-$limit+1; while($row = mysqli_fetch_array($result)):?>
        <tr>
            <td><center><?=$i++?></center></td>
            <td><?=$row['TRN_DATE']?></td>
            <td><?=$row['PROJECT_NAME']?></td>
            <td><?=$row['PROJECT_EXPENSE_HEAD_NAME']?></td>
             <td><?=$row['EXPENSE_AMOUNT']?></td>
              <td><?=$row['REMARKS']?></td>
            
            
            
            
            <td>
               <center>
                   
                   
                   
                   
                   
                    <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['PROJECT_EXPENSE_NO']?>"  class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                        <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['PROJECT_EXPENSE_NO']?>" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i></a></center>
            </td>
        </tr>
    <?php endwhile;?>
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






 
 
 