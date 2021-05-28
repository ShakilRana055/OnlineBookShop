<?php include 'include/header.php';?>
<?php $table_heading = "Deposit Summary";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php 
    
    $all_info = "" ;
    $is_search = "no" ;
    if( isset( $_POST['search']) )
    {
        $is_search = "yes" ;
        $member_id = $_POST['MEMBER_NO'] ;
        $from_date = $_POST['from_date'] ;
        $to_date = $_POST['to_date'] ;
        
        $last_add = "ORDER BY DEPOSIT_MASTER_NO DESC limit 50 " ;
        $sql = "SELECT `DATE`, `AMOUNT`, member_profiles.MEMBER_ID, member_profiles.FULL_NAME, `DEPOSIT_MASTER_NO` 
        FROM member_depsoit_masters LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = member_depsoit_masters.PROFILE_NO WHERE 
        member_depsoit_masters.IS_DELETED = 0 " ;
	        
	   if( $member_id != "" )
	   {
	       $sql .= "AND member_profiles.MEMBER_ID = '$member_id'" ;
	   }
	   if( $from_date != "" && $to_date != "" )
	   {
	       $sql .= " AND member_depsoit_masters.DATE BETWEEN '$from_date' AND '$to_date'" ;
	   }
	   else if( $from_date != "" )
	   {
	       $sql .= " AND member_depsoit_masters.DATE >= '$from_date'" ;
	   }
	   else if( $to_date != "" )
	   {
	       $sql .= " AND member_depsoit_masters.DATE <= '$to_date'" ;
	   }
	   
	   $sql .= $last_add ;
	   
	   echo $sql ;
	   
	   $all_info = mysqli_query( $con , $sql ) ;
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
                        <label class="col-md-3 control-label" for="example-text-input">From Date</label>
                        <div class="col-md-6">
                            <input type="date" id="from_date" name="from_date" class="form-control" >
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">To Date</label>
                        <div class="col-md-6">
                            <input type="date" id="to_date" name="to_date" class="form-control" >
                            
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

                    
<table class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
	<thead>
		<tr>
			<th>SL No.</th>
			<th>Name</th>
			<th>Member ID</th>
			<th>Amount</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="recordList">
	    
	    <?php 
	    if( $is_search == "no" ){
	        $sql = "SELECT `DATE`, `AMOUNT`, member_profiles.MEMBER_ID, member_profiles.FULL_NAME, `DEPOSIT_MASTER_NO` FROM 
	        member_depsoit_masters LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = member_depsoit_masters.PROFILE_NO 
	        ORDER BY DEPOSIT_MASTER_NO DESC limit 50 " ;
	        
	        $result = mysqli_query( $con , $sql ) ;
	        $count = 1 ;
	        foreach(  $result as $value )
	        {
	            echo "<tr>" ;
	                echo "<td>".$count ++."</td>" ;
	                echo "<td>".$value['FULL_NAME']."</td>" ;
	                echo "<td>".$value['MEMBER_ID']."</td>" ;
	                echo "<td>".$value['AMOUNT']."</td>" ;
	                echo "<td>".$value['DATE']."</td>" ;
	            ?>
	            
	            <td class="text-center">
                        <div class="btn-group">
                            <a href="deposit_details_list.php?show_it=<?php echo $value['DEPOSIT_MASTER_NO'];?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="View"><i class="fa fa-eye"></i></a>
                             <a href= "print_vauchar.php?master_no=<?php echo $value['DEPOSIT_MASTER_NO'];?>" data-toggle="tooltip" title="View" class="btn btn-info" data-original-title="View"><i class="fa fa-print"></i></a>
                                             
                        </div>
                </td>
	            
	            
	            <?php
	            echo "</tr>" ;
	        }
	    }
	    else
	    {
	        $is_search = "no" ;
	        $count = 1 ;
	        foreach(  $all_info as $value )
	        {
	            echo "<tr>" ;
	                echo "<td>".$count ++."</td>" ;
	                echo "<td>".$value['FULL_NAME']."</td>" ;
	                echo "<td>".$value['MEMBER_ID']."</td>" ;
	                echo "<td>".$value['AMOUNT']."</td>" ;
	                echo "<td>".$value['DATE']."</td>" ;
	            ?>
	            
	            <td class="text-center">
                        <div class="btn-group">
                            <a href="deposit_details_list.php?show_it=<?php echo $value['DEPOSIT_MASTER_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="View"><i class="fa fa-eye"></i></a>
                            <a href="#" data-toggle="tooltip" title="View" class="btn btn-info" data-original-title="View"><i class="fa fa-print"></i></a>
                                      
                        </div>
                </td>
	            
	            
	            <?php
	            echo "</tr>" ;
	        }
	    }
	    
	    ?>
	    
	</tbody>
</table>


 <?php include 'include/footer.php';?>