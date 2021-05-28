<?php include 'include/header.php';?>
<?php $table_heading = "Deposite Category Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php

    $all = "" ;
    if( isset( $_GET['id'] ) )
    {
        $id = $_GET['id'] ;
        $sql = "SELECT * FROM `deposite_categories` " ;
        $all = mysqli_fetch_assoc( mysqli_query ( $con , $sql ) ) ;
    }

?>


<?php 
    
    $msgDelete = "" ;
    if(isset( $_GET['delete'] ) )
    {
        $id = $_GET['delete'] ;
        $sql = "UPDATE deposite_categories SET IS_DELETED = 1 WHERE DEPOSITE_CATEGORY_NO = '$id'" ;
        $result = mysqli_query ( $con , $sql ) ;
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
        $category = $_POST['CATEGORY_NAME'];
        $code = $_POST['CATEGORY_CODE'];
        $id = $_POST['id'];
        $cur = date( "Y-m-d") ;
        $sql = "update deposite_categories SET `DEPOSITE_CATEGORY_NAME` = '$category', `DEPOSITE_CATEGORY_CODE` ='$code', `UPDATED_ON` = '$cur' WHERE DEPOSITE_CATEGORY_NO = '$id'" ;
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
    if( isset( $_POST['save'] ))
    {
        $category = $_POST['CATEGORY_NAME'];
        $code = $_POST['CATEGORY_CODE'];
        $cur = date( "Y-m-d") ;
        $sql = "INSERT INTO deposite_categories SET `DEPOSITE_CATEGORY_NAME` = '$category', `DEPOSITE_CATEGORY_CODE` ='$code', `CREATED_ON` = '$cur'" ;
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
    <fieldset class = "scheduler-border">
        <legend class = "scheduler-border" > Category Setup</legend>
	<div class='form-group'>
		<label for='CATEGORY_NAME' class='control-label col-lg-3'>Category Name </label>
		<div class='col-lg-5'>
			<input class='form-control field_data' name='CATEGORY_NAME' type='text' value='<?php echo $all['DEPOSITE_CATEGORY_NAME'] ;?>' req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<input type = "hidden" name = "id" value = '<?php echo $all['DEPOSITE_CATEGORY_NO'] ;?>'>
	<div class='form-group'>
		<label for='CATEGORY_CODE' class='control-label col-lg-3'>Category Code 
			<span class='optional'>(Optional)</span>
		</label>
		<div class='col-lg-5'>
			<input class='form-control field_data' name='CATEGORY_CODE' type='text' value='<?php echo $all['DEPOSITE_CATEGORY_CODE'] ;?>' req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<?php if( $all != "" ){
	?>
	    <div class='form-group'>
		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
			<input type='submit' class='btn btn-primary' name= "update" value='Update'/>
		</div>
	</div>
	
	<?php
	    
	}
	else{
	
	?>
	<div class='form-group'>
		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
			<input type='submit' class='btn btn-primary' name= "save" value='Save'/>
		</div>
	</div>
	<?php } ?>
	</fieldset>
</form>


<form class='cmxform form-horizontal'>
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		<div class='form-group '>
			<div class='form-group'>
				<label for='srcCATEGORY_NAME' class='control-label col-lg-3'>Category Name</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='CATEGORY_NAME' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group'>
				<label for='srcCATEGORY_CODE' class='control-label col-lg-3'>Category Code</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='CATEGORY_CODE' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<label for='location' class='control-label col-lg-3'></label>
			<div class=' col-lg-5'>
				<input type='button' table_name = 'bdabashon_somiti_deposite_category_setups' class='btn btn-primary pull-right' id='btnSearch' value='Search' />
			</div>
		</div>
	</fieldset>
</form>



<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Category Name</th>
			<th>Category Code</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id='recordList'>
	    
	    <?php 
	        
	        $sql = "SELECT * FROM deposite_categories where IS_DELETED = '0' " ;
	        $result = mysqli_query( $con , $sql ) ;
	        $count = 1 ;
	        foreach ( $result as $value )
	        {
	            echo "<tr>" ;
	                    echo "<td>".$count ++ ."</td>" ;
	                    echo "<td>".$value['DEPOSITE_CATEGORY_NAME'] ."</td>" ;
	                    echo "<td>".$value['DEPOSITE_CATEGORY_NAME'] ."</td>" ;
	                    
	                    
	                    ?>
	                    
	                    <td class="text-center">
                                <div class="btn-group">
                                    <a href="deposit_category_setup.php?id=<?=$value['DEPOSITE_CATEGORY_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                    <!--<a href="actions/loan_approval.php?approve=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="Approve" class="btn btn-info" data-original-title="Edit"><i class="fa fa-check-square"></i></a>-->
                                    <a onclick="return confirm('Are you Sure to Delete?');" href="deposit_category_setup.php?delete=<?=$value['DEPOSITE_CATEGORY_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
                          title: 'Successfully Deleted!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                window.location.href='/submit/template/soft/deposit_category_setup.php' ;
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
                window.location.href='/submit/template/soft/deposit_category_setup.php' ;
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
                          title: 'Successfully Updated!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                window.location.href='/submit/template/soft/deposit_category_setup.php' ;
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
                window.location.href='/submit/template/soft/deposit_category_setup.php' ;
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
 