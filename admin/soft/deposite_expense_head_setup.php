<?php include 'include/header.php';?>
<?php $table_heading = "Deposite Head Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php

    $all = "" ;
    if( isset( $_GET['edit'] ) ) 
    {
        $id = $_GET['edit'] ;
        $sql = "SELECT * FROM `deposite_heads` LEFT JOIN deposite_categories ON deposite_categories.DEPOSITE_CATEGORY_NO = deposite_heads.DEPOSITE_CATEGORY_NO 
        WHERE `DEPOSITE_HEAD_NO` = '$id' " ;
        
        
        $all = mysqli_fetch_assoc( mysqli_query( $con , $sql ) ) ;
        
    }

?>

<?php
    $msgDelete = "" ;
    if( isset( $_GET['delete'] ) ) 
    {
        $id = $_GET['delete'] ;
        $sql = "UPDATE deposite_heads SET IS_DELETED = 1 WHERE DEPOSITE_HEAD_NO = '$id'" ;
        $result = mysqli_query( $con , $sql ) ;
        if( $result )
        {
            $msgDelete = "success" ;
        }
        else
        {
            $msgDelete = "error" ;
        }
    }

?>


<?php 
    $msgUpdate = "" ;
    if( isset( $_POST['update'] ) )
    {
        $category_no = $_POST['category_no'] ;
        $name = $_POST['EXPENSE_HEAD_NAME'] ;
        $code = $_POST['EXPENSE_HEAD_CODE'] ;
        $cur = date( "Y-m-d") ;
        $id = $_POST['id'] ;
        $sql = "update deposite_heads SET `DEPOSITE_CATEGORY_NO` = '$category_no', `DEPOSITE_HEAD_NAME` = '$name', `DEPOSITE_HEAD_CODE` = '$code', UPDATED_ON = '$cur' where DEPOSITE_HEAD_NO = '$id'";
        $result = mysqli_query( $con , $sql ) ;
        if( $result )
        {
            $msgUpdate = "success" ;
        }
        else
        {
            $msgUpdate = "error" ;
        }
    }


?>


<?php
    
    $msg = "" ;
    if( isset ( $_POST['save'] ))
    {
        $category_no = $_POST['category_no'] ;
        $name = $_POST['EXPENSE_HEAD_NAME'] ;
        $code = $_POST['EXPENSE_HEAD_CODE'] ;
        $cur = date( "Y-m-d") ;
        
        $sql = "INSERT INTO deposite_heads SET `DEPOSITE_CATEGORY_NO` = '$category_no', `DEPOSITE_HEAD_NAME` = '$name', `DEPOSITE_HEAD_CODE` = '$code', CREATED_ON = '$cur'";
        $result = mysqli_query( $con , $sql ) ;
        if( $result )
        {
            $msg = "success" ;
        }
        else
        {
            $msg = "error" ;
        }
    }

?>


<form class='cmxform form-horizontal' action = "" method = "post" enctype = "multipart/form-data">
    
    <div class="form-group">
    	<label class="col-md-3 control-label" for="category_no"> Deposite Category Name</label>
    	<div class="col-md-5">
    		<select id="category_no" name="category_no" class="form-control search" style = "width:100%">
    			<!--Something to do here-->
    			
    			<?php 
    			    if( $all != "" )
    			    {
    			        echo "<option value = '".$all['DEPOSITE_CATEGORY_NO']."'>".$all['DEPOSITE_CATEGORY_NAME']."</option>" ;
    			    }
    			    $sql = "SELECT DEPOSITE_CATEGORY_NO, DEPOSITE_CATEGORY_NAME FROM deposite_categories" ;
    			    $result = mysqli_query( $con , $sql ) ;
    			    echo "<option value = ''>Please Select One</option>" ;
    			    foreach( $result as $value )
    			    {
    			        echo "<option value = '".$value['DEPOSITE_CATEGORY_NO']."'>".$value['DEPOSITE_CATEGORY_NAME']."</option>" ;
    			    }
    			?>
    		</select>
    	</div>
    </div>
        <input type = "hidden" name = "id" value = '<?php echo $all['DEPOSITE_HEAD_NO'] ;?>'>
	<div class='form-group'>
		<label for='EXPENSE_HEAD_NAME' class='control-label col-lg-3'> Head Name </label>
		<div class='col-lg-5'>
			<input class='form-control field_data' name='EXPENSE_HEAD_NAME' type='text' value='<?php echo $all['DEPOSITE_HEAD_NAME'] ;?>' req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<div class='form-group'>
		<label for='EXPENSE_HEAD_CODE' class='control-label col-lg-3'>Head Code </label>
		<div class='col-lg-5'>
			<input class='form-control field_data' name='EXPENSE_HEAD_CODE' type='text' value='<?php echo $all['DEPOSITE_HEAD_CODE'] ;?>' req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<?php 
	if( $all != "" )
	{
	    ?>
	    <div class='form-group'>
		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
			<input type='submit' class='btn btn-primary' name = "update"  value='Update'/>
		</div>
	</div>
	    
	    <?php
	}
	else
	{ ?>
	<div class='form-group'>
		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
			<input type='submit' class='btn btn-primary' name = "save"  value='Save'/>
		</div>
	</div>
	
	<?php
	    
	}
	?>
	
	
</form>


<form class='cmxform form-horizontal'>
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		<div class='form-group '>
			<div class='form-group'>
				<label for='srcEXPENSE_HEAD_NAME' class='control-label col-lg-3'>Expense Head Name</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='EXPENSE_HEAD_NAME' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group'>
				<label for='srcEXPENSE_HEAD_CODE' class='control-label col-lg-3'>Expense Head Code</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='EXPENSE_HEAD_CODE' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<label for='location' class='control-label col-lg-3'></label>
			<div class=' col-lg-5'>
				<input type='submit' table_name = 'somiti_deposite_expense_heads' class='btn btn-primary pull-right' id='btnSearch' value='Search' />
			</div>
		</div>
	</fieldset>
</form>

<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Category Name</th>
			<th> Head Name</th>
			<th> Head Code</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id='recordList'>
	    
	    <?php 
	        
	        $sql = "SELECT * FROM `deposite_heads` LEFT JOIN deposite_categories ON deposite_categories.DEPOSITE_CATEGORY_NO = deposite_heads.DEPOSITE_CATEGORY_NO 
	        WHERE deposite_heads.IS_DELETED = 0 " ;
	        
	        $result = mysqli_query( $con , $sql ) ;
	        $count = 1 ;
	        foreach ( $result as $value )
	        {
	            echo "<tr>" ;
	                    echo "<td>".$count ++ ."</td>" ;
	                    echo "<td>".$value['DEPOSITE_CATEGORY_NAME'] ."</td>" ;
	                    echo "<td>".$value['DEPOSITE_HEAD_NAME'] ."</td>" ;
	                    echo "<td>".$value['DEPOSITE_HEAD_CODE'] ."</td>" ;
	                    
	                    ?>
	                    
	                    <td class="text-center">
                                <div class="btn-group">
                                    <a href="deposite_expense_head_setup.php?edit=<?=$value['DEPOSITE_HEAD_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                    
                                    <a onclick="return confirm('Are you Sure Want to Delete?');" href="deposite_expense_head_setup.php?delete=<?=$value['DEPOSITE_HEAD_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </td>
	                    
	                    <?php
	            echo "</tr>" ;
	        }
	        
	    
	    ?>
	    
	</tbody>
</table>



 <?php include 'include/footer.php';?>
 
 
 <script>
     
     $( document ).ready( function( ) {
         
         
         <?php
        
            if( $msgDelete == "success" ) 
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: ' Deleted Successfully!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                window.location.href='/submit/template/soft/deposite_expense_head_setup.php' ;
                <?php
            }
            else if( $msgDelete == "error" )
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                window.location.href='/submit/template/soft/deposite_expense_head_setup.php' ;
                <?php
            }
        
        ?>
         
         
         <?php
        
            if( $msgUpdate == "success" ) 
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: ' Updated Successfully!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                window.location.href='/submit/template/soft/deposite_expense_head_setup.php' ;
                <?php
            }
            else if( $msgUpdate == "error" )
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                window.location.href='/submit/template/soft/deposite_expense_head_setup.php' ;
                <?php
            }
        
        ?>
         
         
         <?php
        
            if( $msg == "success" ) 
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Insterted!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                <?php
            }
            else if( $msg == "error" )
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
            }
        
        ?>
         
     }) ;
     
     
 </script>
 