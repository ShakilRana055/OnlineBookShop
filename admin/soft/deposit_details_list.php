<?php include 'include/header.php';?>
<?php $table_heading = "Deposit Details";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

               
<table class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
	<thead>
		<tr>
			<th>SL No.</th>
			<th>Head Name</th>
			<th>Deposit Amount</th>
			<th>Month</th>
			<th>Year</th>
		</tr>
	</thead>
	<tbody id="recordList">
	    
	    <?php 
	        
	        if( isset( $_GET['show_it']) )
	        {
	            $id = $_GET['show_it'] ;
	        
    	        $sql = "SELECT `DEPOSIT_AMOUNT`, `YEAR`, `MONTH` , deposite_heads.DEPOSITE_HEAD_NAME,`AMOUNT`, 
    	        member_profiles.MEMBER_ID, member_profiles.FULL_NAME, member_deposit_details.`DEPOSIT_MASTER_NO` 
    	        FROM member_depsoit_masters LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = member_depsoit_masters.PROFILE_NO 
    	        LEFT JOIN member_deposit_details ON member_deposit_details.DEPOSIT_MASTER_NO = member_depsoit_masters.DEPOSIT_MASTER_NO LEFT 
    	        JOIN deposite_heads on member_deposit_details.DEPOSITE_HEAD_NO = deposite_heads.DEPOSITE_HEAD_NO WHERE member_depsoit_masters.DEPOSIT_MASTER_NO = '$id'
    	        ORDER BY member_deposit_details.DEPOSIT_DETAILS_NO DESC LIMIT 50 " ;
    	        
    	        $result = mysqli_query( $con , $sql ) ;
    	        $count = 1 ;
    	        foreach(  $result as $value )
    	        {
    	            echo "<tr>" ;
    	                echo "<td>".$count ++."</td>" ;
    	                echo "<td>".$value['DEPOSITE_HEAD_NAME']."</td>" ;
    	                echo "<td>".$value['DEPOSIT_AMOUNT']."</td>" ;
    	                echo "<td>".$value['MONTH']."</td>" ;
    	                echo "<td>".$value['YEAR']."</td>" ;
    	                
    	            ?>

    	            
    	            
    	            <?php
    	            echo "</tr>" ;
	            }
	        }
	    ?>
	    
	</tbody>
</table>


 <?php include 'include/footer.php';?>