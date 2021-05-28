<?php include 'include/header.php';?>
<?php $table_heading = "Deposit Scame Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php

    $msg = "" ;
    if( isset ( $_POST['save']) )
    {
        $profile_no = $_POST['SELECT_MEMBER'] ;
        $deposit_head_no = $_POST['SELECT_DEPOSIT_HEAD'] ;
        $deposit_amount = $_POST['DEPOSIT_AMOUNT'] ;
        $calendar_year = $_POST['CALENDER_YEAR'] ;
        $calender_month = $_POST['CALENDER_MONTH'] ;
        $cur = date( "Y-m-d") ;
        $query = "SELECT MEMBER_NO FROM member_profiles where PROFILE_NO = '$profile_no'" ;
        
        $setMember = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
        $sql = "INSERT INTO depsoit_scams SET  `DEPOSIT_HEAD_NO`= '$deposit_head_no', `DEPOSIT_AMOUNT`= '$deposit_amount', 
        `CALENDAR_YEAR`= '$calendar_year', `CALENDAR_MONTH` = '$calender_month', MEMBER_NO = '".$setMember['MEMBER_NO']."' , CREATED_ON = '$cur' " ;
        // echo $sql ;
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


<?php 
    
    $all = "" ;
    if( isset( $_GET['deposit_scame_no'] ) )
    {
        $id = $_GET['deposit_scame_no']  ;
        $sql = "SELECT * FROM depsoit_scams LEFT JOIN member_profiles ON member_profiles.MEMBER_NO = 
	        depsoit_scams.MEMBER_NO LEFT JOIN deposite_heads ON deposite_heads.DEPOSITE_HEAD_NO = depsoit_scams.DEPOSIT_HEAD_NO WHERE DEPOSIT_SCAM_NO = '$id' " ;
	   //echo $sql ;
	   $all = mysqli_fetch_assoc ( mysqli_query ( $con , $sql ) ) ; 
    }

?>


<?php
    
    $updated_msg = "" ;
    
    if( isset( $_POST['update'] ) ) 
    {
        $all = "" ;
        
        $profile_no = $_POST['SELECT_MEMBER'] ;
        $deposit_head_no = $_POST['SELECT_DEPOSIT_HEAD'] ;
        $deposit_amount = $_POST['DEPOSIT_AMOUNT'] ;
        $calendar_year = $_POST['CALENDER_YEAR'] ;
        $calender_month = $_POST['CALENDER_MONTH'] ;
        $cur = date( "Y-m-d") ;
        $id = $_POST['id'] ;
        
        $query = "SELECT MEMBER_NO FROM member_profiles where PROFILE_NO = '$profile_no'" ;
        
        $setMember = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
        
        $sql = "UPDATE depsoit_scams SET `DEPOSIT_HEAD_NO` = '$deposit_head_no', `DEPOSIT_AMOUNT` = '$deposit_amount', 
        `CALENDAR_YEAR`= '$calendar_year', `CALENDAR_MONTH` = '$calender_month', MEMBER_NO = '".$setMember['MEMBER_NO']."' , UPDATED_ON = '$cur' WHERE `DEPOSIT_SCAM_NO` = '$id'" ;
        
        $result = mysqli_query( $con , $sql ) ;
        if( $result )
        {
            $updated_msg = "success" ;
        }
        else
        {
            $updated_msg = "error" ;
        }
    }

?>


<form class='cmxform form-horizontal' action = "" method = "post"enctype = "multipart/form-data">
	<div class='form-group'>
	    
	    <input type = "hidden" name = "id" value = "<?php echo $all['DEPOSIT_SCAM_NO']?>">
	    <div class="form-group">
    	<label class="col-md-3 control-label" for="SELECT_MEMBER"> Select Member </label>
    	<div class="col-md-5">
    		<select id="SELECT_MEMBER" name="SELECT_MEMBER" class="form-control search" style = "width:100%">
    			<!--Something to do here-->
    			
    			<?php
    			if( $all != ""){
    			    if( $all['PROFILE_NO']  != "" ){ 
    			        echo "<option value = '".$all['PROFILE_NO']."'>".$all['FULL_NAME']."(".$all['MEMBER_ID'].")</option>" ;
    			    }
    			    else
    			    {
    			        echo "<option value = '-1'>All Members</option>" ;
    			    }
    			}
    			$sql = "SELECT PROFILE_NO, FULL_NAME, MEMBER_ID FROM member_profiles" ;
    			$result = mysqli_query( $con , $sql ) ;
    			
    			echo "<option value = '-1'>All Members</option>" ;
    			foreach( $result as $value )
    			{
    			    echo "<option value = '".$value['PROFILE_NO']."'>".$value['FULL_NAME']."(".$value['MEMBER_ID'].")</option>" ;
    			}
    			
    			?>
    			
    		</select>
    	</div>
    </div>
    
    <div class="form-group">
    	<label class="col-md-3 control-label" for="SELECT_DEPOSIT_HEAD"> Select Deposit Head</label>
    	<div class="col-md-5">
    		<select id="SELECT_DEPOSIT_HEAD" name="SELECT_DEPOSIT_HEAD" class="form-control search" style = "width:100%">
    			<!--Something to do here-->
    			<?php
    			    if( $all != ""){
    			        echo "<option value = '".$all['DEPOSITE_HEAD_NO']."'>".$all['DEPOSITE_HEAD_NAME']."</option>" ;
    			   
    			}
        			$sql = "SELECT DEPOSITE_HEAD_NO,DEPOSITE_HEAD_NAME FROM deposite_heads" ;
        			$result = mysqli_query( $con , $sql ) ;
        			echo "<option>Please Select One</option>" ;
        			foreach( $result as $value )
        			{
        			    echo "<option value = '".$value['DEPOSITE_HEAD_NO']."'>".$value['DEPOSITE_HEAD_NAME']."</option>" ;
        			}
        			
        		
    			?>
    			
    		</select>
    	</div>
    </div>
	    
	    

	<div class='form-group'>
		<label for='DEPOSIT_AMOUNT' class='control-label col-lg-3'>Deposit Amount </label>
		<div class='col-lg-5'>
			<input class='form-control field_data' name='DEPOSIT_AMOUNT' type='number' value="<?php echo $all['DEPOSIT_AMOUNT']?>" req='1' is_double = '1' />
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="CALENDER_YEAR"> Calender Year </label>
    	<div class="col-md-5">
    		<select id="CALENDER_YEAR" name="CALENDER_YEAR" class="form-control search" style = "width:100%">
    			<!--Something to do here-->
    			<?php
    			    
    			    if( $all != ""){
    			        echo "<option value = '".$all['CALENDAR_YEAR']."'>".$all['CALENDAR_YEAR']."</option>" ;
    			   
    			}
    			    
    			    $cur_year = intval( date("Y") ) ;
    			    for( $i = $cur_year ; $i >= 1900 ; $i -- )
    			    {
    			        echo "<option value = '$i'>".$i."<option>" ;
    			    }
    			    
    			
    			?>
    			
    		</select>
    	</div>
    </div>
    
    <div class="form-group">
    	<label class="col-md-3 control-label" for="CALENDER_MONTH"> Calendar Month </label>
    	<div class="col-md-5">
    		<select id="CALENDER_MONTH" name="CALENDER_MONTH" class="form-control search" style = "width:100%">
    			<!--Something to do here-->
    			<?php
    			if( $all != ""){
    			        echo "<option value = '".$all['CALENDAR_MONTH']."'>".$all['CALENDAR_MONTH']."</option>" ;
    			   
    			}
    			    $all12 = "JANUARY,FEBRUARY , MARCH ,APRIL, MAY ,JUNE, JULY, AUGUST, SEPTEMBER, OCTOBER, NOVEMBER, DECEMBER";
    			    $month = explode( "," , $all12 ) ;
    			    for( $i = 0 ; $i < count( $month ) ; $i ++ )
    			    {
    			        $j = $i + 1 ;
    			        echo "<option value = '$j'>".$month[$i]."</option>" ;
    			    }
    			?>
    			
    		</select>
    	</div>
    </div>
	<?php 
	    
	    if( $all == "" )
	    {
	        ?>
	        <div class='form-group'>
        		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
        			<input type='submit' class='btn btn-primary' name = "save" value='Save'/>
        		</div>
        	</div>
	        
	        <?php
	    }else
	    {
	        ?>
	        <div class='form-group'>
        		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
        			<input type='submit' class='btn btn-primary' name = "update" value='Update'/>
        		</div>
        	</div>
	        
	        <?php
	    }
	
	
	?>
	
</form>





<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Member Name</th>
			<th>Deposit Head</th>
			<th>Deposit Amount</th>
			<th>Calender Year</th>
			<th>Calender Month</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id='recordList'>
	    
	    <?php
	        
	        $sql = "SELECT depsoit_scams.DEPOSIT_SCAM_NO, member_profiles.FULL_NAME, member_profiles.`PROFILE_NO`, deposite_heads.DEPOSITE_HEAD_NAME, 
	        `DEPOSIT_AMOUNT`,`CALENDAR_YEAR`,`CALENDAR_MONTH` FROM depsoit_scams LEFT JOIN member_profiles ON member_profiles.MEMBER_NO = 
	        depsoit_scams.MEMBER_NO LEFT JOIN deposite_heads ON deposite_heads.DEPOSITE_HEAD_NO = depsoit_scams.DEPOSIT_HEAD_NO" ;
	        
	        $result = mysqli_query( $con , $sql ) ;
	        $count = 1 ;
	        foreach( $result as $value )
	        {
	            echo "<tr>" ;
	                    echo "<td>".$count ++ ."</td>" ;
	                    if( $value['FULL_NAME'] != "" )
	                    { 
	                        echo "<td>".$value['FULL_NAME'] ."</td>" ;
	                    }
	                    else
	                    {
	                        echo "<td>"."All Members"."</td>" ;
	                    }
	                    echo "<td>".$value['DEPOSITE_HEAD_NAME'] ."</td>" ;
	                    echo "<td>".$value['DEPOSIT_AMOUNT'] ."</td>" ;
	                    echo "<td>".$value['CALENDAR_YEAR'] ."</td>" ;
	                    echo "<td>".$value['CALENDAR_MONTH'] ."</td>" ;
	                    
	                    ?>
	                    
	                    <td class="text-center">
                                <div class="btn-group">
                                    <a href="deposit_scame_setup.php?deposit_scame_no=<?=$value['DEPOSIT_SCAM_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                    <!--<a href="actions/loan_approval.php?approve=<?=$value['LOAN_NO']?>" data-toggle="tooltip" title="Approve" class="btn btn-info" data-original-title="Edit"><i class="fa fa-check-square"></i></a>-->
                                    <!--<a onclick="return confirm('Are you Sure Want to Delete?');" href="actions/loan_approval.php?delete=<?=$value['DEPOSIT_SCAM_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>-->
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
        
            if( $updated_msg == "success" ) 
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Updated Successfully!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                
                <?php
            }
            else if( $updated_msg == "error" )
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
 
 