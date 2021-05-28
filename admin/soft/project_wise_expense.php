<?php include 'include/header.php';?>
<?php $table_heading = "Project Expnese";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<style type="text/css">
    .error {
        color: red;
    }
</style>

<?php 
    
    $get_result = "" ; 
    if( isset( $_GET['edit'] ) && isset( $_GET['project_no'] ))
    {
        
        $expense_head_no = $_GET['edit'] ;
        $project_no = $_GET['project_no'] ;
        $query = "SELECT PROJECT_EXPENSE_HEAD_NO, PROJECT_EXPENSE_HEAD_NAME, PROJECT_EXPENSE_HEAD_CODE, projects.PROJECT_NAME, projects.PROJECT_NO FROM project_expense_heads LEFT JOIN projects ON 
            projects.PROJECT_NO = project_expense_heads.PROJECT_NO WHERE PROJECT_EXPENSE_HEAD_NO = '$expense_head_no' AND projects.PROJECT_NO = '$project_no' " ;
        
        $get_result = mysqli_fetch_assoc ( mysqli_query ( $con , $query ) ) ;
        //print_r( $get_result ) ;
        
    }

?>


<?php
    
    if( isset ( $_GET['delete'] ) ) 
    {
        $id = $_GET['delete'] ;
        $query = "update project_expense_heads set IS_DELETED = '1'  where PROJECT_EXPENSE_HEAD_NO = '$id'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            echo "<meta http-equiv='refresh' content='0;url=project_wise_expense.php'>";
            //header( "location: project_wise_expense.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            echo "<meta http-equiv='refresh' content='0;url=project_wise_expense.php'>";
            //header( "location: project_wise_expense.php" ) ;
        }
    }
    
    
 if( isset( $_POST['submit'] ) )
    {
        $project_no = $_POST['project_name'] ;
        $expense_head = $_POST['expense_head'] ;
        $expense_code = $_POST['expense_code'] ;
        
        $query = "insert into project_expense_heads SET `PROJECT_NO` = '$project_no',`PROJECT_EXPENSE_HEAD_NAME`= '$expense_head', 
        `PROJECT_EXPENSE_HEAD_CODE` = '$expense_code'" ;
        //echo $query ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            echo "<meta http-equiv='refresh' content='0;url=project_wise_expense.php'>";
            //header( "location: project_wise_expense.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            echo "<meta http-equiv='refresh' content='0;url=project_wise_expense.php'>";
            //header( "location: project_wise_expense.php" ) ;
        }
    }


    if( isset( $_POST['update'] ) )
    {
        echo "update" ;
        $id = $_POST['id'] ;
        $project_no = $_POST['project_name'] ;
        $expense_head = $_POST['expense_head'] ;
        $expense_code = $_POST['expense_code'] ;
        
        $query = "UPDATE project_expense_heads SET `PROJECT_NO` = '$project_no',`PROJECT_EXPENSE_HEAD_NAME`= '$expense_head', 
        `PROJECT_EXPENSE_HEAD_CODE` = '$expense_code' where PROJECT_EXPENSE_HEAD_NO = '$id'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            echo "<meta http-equiv='refresh' content='0;url=project_wise_expense.php'>";
            //header( "location: project_wise_expense.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            echo "<meta http-equiv='refresh' content='0;url=project_wise_expense.php'>";
           // header( "location: project_wise_expense.php" ) ;
        }
    }


?>

    <form action="" id="prpject_wise_expense" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Project wise Expense Head </legend>
                    <input type = "hidden" name = "id" value = "<?php echo $get_result['PROJECT_EXPENSE_HEAD_NO']?>">
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="project_name"> Project Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="project_name" name="project_name" class="form-control">
                    <!--<option value = "<?php echo $get_result['PROJECT_NO']; ?>"> <?php echo $get_result['PROJECT_NAME'];?> </option>-->
                    <option>Please select one</option>
                    <?php
                    $query = "SELECT PROJECT_NO, PROJECT_NAME FROM projects" ;
                        // $query = "SELECT PROJECT_EXPENSE_HEAD_NO, PROJECT_EXPENSE_HEAD_NAME, PROJECT_EXPENSE_HEAD_CODE, projects.PROJECT_NAME, projects.PROJECT_NO FROM project_expense_heads LEFT JOIN projects ON 
                        // projects.PROJECT_NO = project_expense_heads.PROJECT_NO " ;
                        
                        $result = mysqli_query( $con , $query ) ;
                    
                        foreach( $result as $value )
                        {
                            echo "<option value = '".$value['PROJECT_NO']."'>".$value['PROJECT_NAME']."</option>" ;
                        }
                    
                    ?>
                    
                    
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Expense Head</label>
                        <div class="col-md-6">
                            <input type="text" id="expense_head" value ="<?php echo $get_result['PROJECT_EXPENSE_HEAD_NAME'];?>" name="expense_head" class="form-control" placeholder="Expense Head ">
                            
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Expense Code</label>
                        <div class="col-md-6">
                            <input type="text" id="expense_code" value ="<?php echo $get_result['PROJECT_EXPENSE_HEAD_CODE'];?>" name="expense_code" class="form-control" placeholder="Expense Code.. ">
                            
                        </div>
                    <?php if( isset( $_GET['edit'] ) && isset( $_GET['project_no'] )) 
                    {
                        ?>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-lg-offset-8">
                            <input type="submit" name="update" class="btn btn-sm btn-primary" id="update" value = "Update">
                            <span id = "error" > </span>
                            </div>

                    </div>
                    <?php } else { ?>
                    </div>
                        <div class="form-group form-actions">
                            <div class="col-lg-offset-8">
                            <input type="submit" name="submit" class="btn btn-sm btn-primary" value = "Save" >
                            <span id = "error" > </span>
                            </div>

                    </div>
                    <?php }?>
                    </fieldset>
</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>Serial No</th>
         <th>Project Name</th>
         <th>Expense Head</th>
         <th>Expense Code</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'></tbody>
   
        <?php 
            
            $count = 1 ;
            $query = "SELECT PROJECT_EXPENSE_HEAD_NO, PROJECT_EXPENSE_HEAD_NAME, PROJECT_EXPENSE_HEAD_CODE, projects.PROJECT_NAME, projects.PROJECT_NO FROM project_expense_heads LEFT JOIN projects ON projects.PROJECT_NO = project_expense_heads.PROJECT_NO WHERE project_expense_heads.IS_DELETED = 0 " ;
            $result = mysqli_query( $con , $query ) ;
            foreach( $result as $value )
            {
                echo "<tr>" ;
                        echo "<td>".$count."</td>" ;
                        
                        echo "<td>".$value['PROJECT_NAME']."</td>" ;
                        echo "<td>".$value['PROJECT_EXPENSE_HEAD_NAME']."</td>" ;
                        echo "<td>".$value['PROJECT_EXPENSE_HEAD_CODE']."</td>" ;
                        ?>
                        <td class="text-center">
                        <div class="btn-group">
                        <a href="project_wise_expense.php?edit=<?=$value['PROJECT_EXPENSE_HEAD_NO']?>&&project_no=<?=$value['PROJECT_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="project_wise_expense.php?delete=<?=$value['PROJECT_EXPENSE_HEAD_NO']?>" onclick="return confirm('Are you Sure Want to Delete?');" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                        <?php
                        $count ++ ;
                        
                 echo "</tr>" ;
            }
            
        ?>
        
</table>



 <?php include 'include/footer.php';?>
 
 
 <!--<script type="text/javascript" src="../js/validation-init.js"></script>-->
 
 
 <script>
     
     $(document).ready( function( )
     {
         <?php
                if( isset( $_SESSION['msgPositive'] )== "success")
                {
                    ?>
                       
                    //   swal("Success!", "Data Save Successfully", "success");     
                    Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Success!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                            
                    <?php
                    unset( $_SESSION['msgPositive'] ) ;
                }
                else if(isset( $_SESSION['msgPositive'] )== "error" )
                {
                    ?>
                        Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php
                    unset( $_SESSION['msgPositive'] ) ;
                    
                }
                ?>
         
     }) ;
     
     
 </script>
 
 