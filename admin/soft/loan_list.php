<?php include 'include/header.php';?>
<?php $table_heading = "Loan List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php 
    function getName( $profile_no )
    {
        include ( "../config/db_connection.php") ;
        $sql = "select FULL_NAME from member_profiles where PROFILE_NO = '$profile_no' " ;
        
        $ans =  mysqli_fetch_assoc ( mysqli_query( $con , $sql ) )  ;
        
        return $ans['FULL_NAME'] ;
    }

?>


<?php 

    $is_search = "no" ;
    $execute_result = "" ;
    if( isset( $_POST['search'] ) )
    {
        $is_search = "yes" ;
        $member_id = $_POST['MEMBER_NO'] ;
        $mobile = $_POST['MOBILE_NO'] ;
        $sql = "SELECT * FROM `loans` LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = loans.PROFILE_NO 
        WHERE loans.IS_DELETED = 0 AND loans.IS_APPROVED = 1" ;
        
        if( $member_id != "" ) 
        {
            $sql .= " AND member_profiles.MEMBER_ID = '$member_id'" ;
        }
        if( $mobile != "" )
        {
            $sql .= " AND member_profiles.MOBILE = '$mobile'" ;
        }
        
        $execute_result = mysqli_query( $con , $sql ) ;
    }
    

?>


<form action="" id="form-validation" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Search </legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Member ID</label>
                        <div class="col-md-6">
                            <input type="text" id="MEMBER_NO" name="MEMBER_NO" class="form-control" placeholder="Please Enter Member ID">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Mobile No.</label>
                        <div class="col-md-6">
                            <input type="text" id="MOBILE_NO" name="MOBILE_NO" class="form-control" placeholder="Please Enter Mobile Number">
                            
                        </div>
                    </div>


                        <div class="form-group form-actions">
                            <div class="col-lg-offset-8">
                            <button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
                            <span id = "error" > </span>
                            </div>

                            </div>
        </fieldset>
        </form>



<form>
<fieldset class = "scheduler-border" >
<legend class = "scheduler-border" > Applier List </legend>
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Member Name</th>
			<th>Apply Date</th>
			<th>Loan Amount</th>
			<th>Reference Member Name</th>
			
			<th>Number of Installment</th>
			<th>Installment Amount</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody id='recordList'>
	    
	    <?php 
	        $count = 1 ;
	        if( $is_search == "no")
	        {
    	        $query = "SELECT * FROM loans LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = loans.PROFILE_NO 
    	        WHERE loans.IS_APPROVED = 1  AND loans.IS_DELETED = 0" ;
    	        $result = mysqli_query( $con , $query ) ;
    	        
    	        foreach( $result as $value )
    	        {
    	            echo "<tr>";
    	                
    	                echo "<td>".$count ++ ."</td>" ;
    	                echo "<td>".getName( $value['PROFILE_NO'] )."</td>" ;
    	                echo "<td>".$value['APPLY_DATE']."</td>" ;
    	                echo "<td>".$value['LOAN_AMOUNT']."</td>" ;
    	                echo "<td>".getName( $value['REFER_PROFILE_NO'] )."</td>" ;
    	                echo "<td>".$value['NUMBER_OF_INSTALLMENT']."</td>" ;
    	                echo "<td>".$value['INSTALLMENT_AMOUNT']."</td>" ;
    	                ?>
    	                <td class="text-center">
                                <div class="btn-group">
                                    <a href="loan_view.php?loan_no=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-eye"></i></a>
                                    
                                    <a onclick="return confirm('Are you Sure Want to Delete?');" href="actions/loan_approval.php?delete=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </td>
    	                
    	                <?php
    	            echo "</tr>" ;
    	        }
	        }
	        else
	        {
	            foreach( $execute_result as $value )
	            {
	                echo "<tr>";
    	                
    	                echo "<td>".$count ++ ."</td>" ;
    	                echo "<td>".$value['FULL_NAME'] ."</td>" ;
    	                echo "<td>".$value['APPLY_DATE']."</td>" ;
    	                echo "<td>".$value['LOAN_AMOUNT']."</td>" ;
    	                echo "<td>".getName( $value['REFER_PROFILE_NO'] )."</td>" ;
    	                echo "<td>".$value['NUMBER_OF_INSTALLMENT']."</td>" ;
    	                echo "<td>".$value['INSTALLMENT_AMOUNT']."</td>" ;
    	                ?>
    	                <td class="text-center">
                                <div class="btn-group">
                                    <a href="loan_view.php?loan_no=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-eye"></i></a>
                                    <!--<a href="actions/loan_approval.php?approve=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="Approve" class="btn btn-info" data-original-title="Edit"><i class="fa fa-check-square"></i></a>-->
                                    <a onclick="return confirm('Are you Sure Want to Delete?');" href="actions/loan_approval.php?delete=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </td>
    	                
    	                <?php
    	            echo "</tr>" ;
	            }
	        }
	    
	    
	    ?>
	    
	    
	</tbody>
</table>

</fieldset>
</form>

 <?php include 'include/footer.php';?>
 
<script>
    
    $( document ).ready( function( ) {
        
         <?php
        if( isset($_SESSION['msg']) == "success" ) 
                    {?>
                        
                        Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Done!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msg']) ;
            }
            else if( isset($_SESSION['msg']) == "error" ) { ?>

                 Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msgPositive']) ;
                
             }?>
        
    }) ;
    
    
    
</script>