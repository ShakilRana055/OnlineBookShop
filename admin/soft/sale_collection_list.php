<?php include 'include/header.php';?>
<?php $table_heading = "Sale Collection List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php
	$is_search = "no" ;
	$search_result = "" ;

	if( isset($_POST['search']) )
	{
		$is_search = "yes" ;
		$MEMBER_ID = $_POST['MEMBER_ID'] ;
		$FROM_DATE = $_POST['FROM_DATE'] ;
		$TO_DATE = $_POST['TO_DATE'] ;

		$main_query = "SELECT PAID_DATE, `INSTALLMENT_AMOUNT`, `INSTALLMENT_NUMBER`,DAY,  MONTH, YEAR, member_profiles.FULL_NAME, member_profiles.MEMBER_ID FROM project_sales_schedule LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = project_sales_schedule.PROFILE_NO WHERE project_sales_schedule.IS_PAID = 1 " ;
		
		if( $MEMBER_ID != "" ) 
		{
			$get_member= "SELECT MEMBER_NO FROM member_profiles WHERE MEMBER_ID = '$MEMBER_ID'" ;
			$member_no = mysqli_fetch_assoc( mysqli_query( $con , $get_member ) ) ;
			$member = $member_no['MEMBER_NO'] ;
			$main_query .= " AND member_profiles.MEMBER_NO = '$member'" ;
		}
		if( $FROM_DATE != "" && $TO_DATE != "" )
		{
			$main_query .= " AND project_sales_schedule.PAID_DATE BETWEEN '$FROM_DATE' AND '$TO_DATE'"  ;
		}
		else if( $FROM_DATE != "" )
		{
			$main_query .= " AND project_sales_schedule.PAID_DATE >= '$FROM_DATE'" ;

		}
		else if( $TO_DATE != "" )
		{
			$main_query .= " AND project_sales_schedule.PAID_DATE <= '$TO_DATE'" ;
		}
		$main_query .= " ORDER BY project_sales_schedule.PROJECT_SCHEDULE_NO DESC LIMIT 50" ;
		
		$search_result = mysqli_query( $con , $main_query ) ;
	}

?>


<form class='cmxform form-horizontal' action="" method="post" >
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		<div class='form-group '>
			<div class='form-group'>
				<label for='srcMEMBER_ID' class='control-label col-lg-3'>Member ID</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='MEMBER_ID' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group'>
				<label for='srcFROM_DATE' class='control-label col-lg-3'>From Date</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='FROM_DATE' type='date' is_double = '0' />
				</div>
			</div>
			<div class='form-group'>
				<label for='srcTO_DATE' class='control-label col-lg-3'>To Date</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='TO_DATE' type='date' is_double = '0' />
				</div>
			</div>
			<label for='location' class='control-label col-lg-3'></label>
			<div class=' col-lg-5'>
				<input type='submit' name="search" class='btn btn-primary pull-right'  value='Search' />
			</div>
		</div>
	</fieldset>
</form>

<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Member Name</th>
			<th>Member ID</th>
			<th>Schedule Date</th>
			<th>Paid Date</th>
			<th>Paid Installment</th>
			<th>Amount</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id='recordList'>
		<?php 
			$count = 1 ;
			if( $is_search == "no" ) 
			{

				$sql = "select project_sales_schedule.*, member_profiles.FULL_NAME, member_profiles.MEMBER_ID , sum( `INSTALLMENT_AMOUNT`) SUM_AMOUNT, COUNT(INSTALLMENT_AMOUNT) as cnt from project_sales_schedule LEFT JOIN member_profiles ON member_profiles.MEMBER_NO = project_sales_schedule.MEMBER_NO WHERE project_sales_schedule.IS_PAID = 1 group by `PAID_DATE`  order by `PAID_DATE` desc LIMIT 50" ;
				$result = mysqli_query( $con , $sql ) ;
				
				foreach ($result as $value) {
					$schedule = $value['YEAR']."/".$value['MONTH']."/".$value['DAY'] ;
					echo "<tr>";
						echo "<td>".$count ++ . "</td>";
						echo "<td>".$value['FULL_NAME'] . "</td>";
						echo "<td>".$value['MEMBER_ID'] . "</td>";
						echo "<td>".$schedule."</td>";
						echo "<td>".$value['PAID_DATE'] . "</td>";
						echo "<td>".$value['cnt'] . "</td>";
						echo "<td>".$value['SUM_AMOUNT'] . "</td>";
					?>
					<td>
						<a href= "print_sale_voucher.php?member_no=<?php echo $value['MEMBER_NO'];?>&&paid_date=<?php echo $value['PAID_DATE']?>" data-toggle="tooltip" title="View" class="btn btn-info" data-original-title="View"><i class="fa fa-print"></i></a>
					</td>
					<?php
					echo "</tr>";
				}
			}
			else
			{
				$is_search = "no" ;

				foreach ( $search_result as $value ) 
				{
					$schedule = $value['YEAR']."/".$value['MONTH']."/".$value['DAY'] ;
					echo "<tr>";
						echo "<td>".$count ++ . "</td>";
						echo "<td>".$value['FULL_NAME'] . "</td>";
						echo "<td>".$value['MEMBER_ID'] . "</td>";
						echo "<td>".$schedule. "</td>";
						echo "<td>".$value['PAID_DATE'] . "</td>";
						echo "<td>".$value['INSTALLMENT_NUMBER'] . "</td>";
						echo "<td>".$value['INSTALLMENT_AMOUNT'] . "</td>";
					echo "</tr>";
				}

			}

		?>
	</tbody>

</table>









 <?php include 'include/footer.php';?>