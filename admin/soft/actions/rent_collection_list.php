<?php

	if( isset( $_POST['all_member']))
	{
		include ( "../../config/db_connection.php") ;
		$sql = "SELECT revenue_part_schedule.* , member_profiles.FULL_NAME, member_profiles.MEMBER_ID, SUM(`INSTALLMENT_AMOUNT`)as Summation, COUNT(`INSTALLMENT_NUMBER`) as Num FROM revenue_part_schedule LEFT JOIN member_profiles ON member_profiles.MEMBER_NO = revenue_part_schedule.MEMBER_NO WHERE IS_PAID = 1 AND revenue_part_schedule.MEMBER_NO > 0 GROUP BY PAID_DATE ORDER BY PAID_DATE DESC LIMIT 50 " ;
		$result = mysqli_query( $con , $sql ) ;

		$count = 1 ;
		foreach ($result as $value) {
			echo "<tr>";
				$schedule = $value['YEAR']."/".$value['MONTH']."/".$value['DAY'];
				echo "<td>".$count ++ ."</td>" ;
				echo "<td>".$value['FULL_NAME']."</td>" ;
				echo "<td>".$value['MEMBER_ID']."</td>" ;
				echo "<td>".$value['PAID_DATE']."</td>" ;
				echo "<td>".$schedule."</td>" ;
				echo "<td>".$value['Num']."</td>" ;
				echo "<td>".$value['Summation']."</td>" ;
				echo "<td><a href='rent_collection_voucher_member.php?member_no=".$value['MEMBER_NO']."&&paid_date=".$value['PAID_DATE']."' data-toggle='tooltip' title='View' class='btn btn-success' date-original-tittle = 'View'> <i class = 'fa fa-print'></i></a></td> ";
			echo "</tr>";
		}
	}

	if( isset($_POST['member_search'] ) )
	{
		include ( "../../config/db_connection.php") ;

		$member_member_id = $_POST['member_member_id'] ;
		$member_from_date = $_POST['member_from_date'] ;
		$member_to_date = $_POST['member_to_date'] ;
		
		$main_query = "SELECT revenue_part_schedule.* , member_profiles.FULL_NAME, member_profiles.MEMBER_ID, SUM(`INSTALLMENT_AMOUNT`)as Summation, COUNT(`INSTALLMENT_NUMBER`) as Num FROM revenue_part_schedule LEFT JOIN member_profiles ON member_profiles.MEMBER_NO = revenue_part_schedule.MEMBER_NO WHERE IS_PAID = 1 AND revenue_part_schedule.MEMBER_NO > 0 " ;

		if( $member_member_id != "" )
		{
			$get_member= "SELECT MEMBER_NO FROM member_profiles WHERE MEMBER_ID = '$member_member_id'" ;
			$member_no = mysqli_fetch_assoc( mysqli_query( $con , $get_member ) ) ;
			$member = $member_no['MEMBER_NO'] ;
			$main_query .= " AND member_profiles.MEMBER_NO = '$member'" ;
		}

		if( $member_from_date != "" && $member_to_date != "" )
		{
			$main_query .= " AND revenue_part_schedule.PAID_DATE BETWEEN '$member_from_date' AND '$member_to_date'"  ;
		}
		else if( $member_from_date != "" )
		{
			$main_query .= " AND revenue_part_schedule.PAID_DATE >= '$member_from_date'" ;

		}
		else if( $member_to_date != "" )
		{
			$main_query .= " AND revenue_part_schedule.PAID_DATE <= '$member_to_date'" ;
		}
		$main_query .= " GROUP BY PAID_DATE ORDER BY PAID_DATE DESC LIMIT 50" ;
		// echo $main_query ;
		$result = mysqli_query( $con , $main_query ) ;
		$count = 1 ;
		foreach ($result as $value) 
		{
			echo "<tr>";
				$schedule = $value['YEAR']."/".$value['MONTH']."/".$value['DAY'];
				echo "<td>".$count ++ ."</td>" ;
				echo "<td>".$value['FULL_NAME']."</td>" ;
				echo "<td>".$value['MEMBER_ID']."</td>" ;
				echo "<td>".$value['PAID_DATE']."</td>" ;
				echo "<td>".$schedule."</td>" ;
				echo "<td>".$value['Num']."</td>" ;
				echo "<td>".$value['Summation']."</td>" ;
				echo "<td><a href='rent_collection_voucher_member.php?member_no=".$value['MEMBER_NO']."&&paid_date=".$value['PAID_DATE']."' data-toggle='tooltip' title='View' class='btn btn-success' date-original-tittle = 'View'> <i class = 'fa fa-print'></i></a></td> ";
			echo "</tr>";
		}
	}



	if( isset($_POST['all_other'] ) )
	{
		include ( "../../config/db_connection.php") ;

		$sql = "SELECT revenue_part_schedule.* , revenue_part_rents.NAME, revenue_part_rents.PHONE, SUM(revenue_part_schedule.INSTALLMENT_AMOUNT) as Summation, COUNT( revenue_part_schedule.`INSTALLMENT_NUMBER` ) as Num FROM revenue_part_schedule LEFT JOIN revenue_part_rents ON revenue_part_rents.REVENUE_PART_RENT_NO = revenue_part_schedule.REVENUE_PART_RENT_NO WHERE IS_PAID = 1 AND MEMBER_NO = 0 GROUP BY PAID_DATE ORDER BY PAID_DATE DESC LIMIT 50" ;
		$result = mysqli_query( $con , $sql ) ;
		$count = 1 ;
		foreach ($result as $value) {
			echo "<tr>";
				$schedule = $value['YEAR']."/".$value['MONTH']."/".$value['DAY'];
				echo "<td>".$count ++ ."</td>" ;
				echo "<td>".$value['NAME']."</td>" ;
				echo "<td>".$value['PHONE']."</td>" ;
				echo "<td>".$value['PAID_DATE']."</td>" ;
				echo "<td>".$schedule."</td>" ;
				echo "<td>".$value['Num']."</td>" ;
				echo "<td>".$value['Summation']."</td>" ;
				echo "<td><a href='rent_collection_voucher_other.php?revenue_rent_no=".$value['REVENUE_PART_RENT_NO']."&&paid_date=".$value['PAID_DATE']."' data-toggle='tooltip' title='View' class='btn btn-success' date-original-tittle = 'View'> <i class = 'fa fa-print'></i></a></td> ";
			echo "</tr>";
		}
	}

	if( isset($_POST['other_search'] ) ) 
	{
		include ( "../../config/db_connection.php") ;
		$other_mobile = $_POST['other_mobile'] ;
		$other_from_date = $_POST['other_from_date'] ;
		$other_to_date = $_POST['other_to_date'] ;

		$main_query = "SELECT revenue_part_schedule.* , revenue_part_rents.NAME, revenue_part_rents.PHONE, SUM(revenue_part_schedule.INSTALLMENT_AMOUNT) as Summation, COUNT( revenue_part_schedule.`INSTALLMENT_NUMBER` ) as Num FROM revenue_part_schedule LEFT JOIN revenue_part_rents ON revenue_part_rents.REVENUE_PART_RENT_NO = revenue_part_schedule.REVENUE_PART_RENT_NO WHERE IS_PAID = 1 AND MEMBER_NO = 0" ;

		if( $other_mobile != "" )
		{
			$main_query .= " AND revenue_part_rents.PHONE = '$other_mobile'" ;
		}

		if( $other_from_date != "" && $other_to_date != "" )
		{
			$main_query .= " AND revenue_part_schedule.PAID_DATE BETWEEN '$other_from_date' AND '$other_to_date'"  ;
		}
		else if( $other_from_date != "" )
		{
			$main_query .= " AND revenue_part_schedule.PAID_DATE >= '$other_from_date'" ;

		}
		else if( $other_to_date != "" )
		{
			$main_query .= " AND revenue_part_schedule.PAID_DATE <= '$other_to_date'" ;
		}
		$main_query .= " GROUP BY PAID_DATE ORDER BY PAID_DATE DESC LIMIT 50" ;

		$result = mysqli_query( $con , $main_query ) ;
		$count = 1 ;
		foreach ($result as $value) {
			echo "<tr>";
				$schedule = $value['YEAR']."/".$value['MONTH']."/".$value['DAY'];
				echo "<td>".$count ++ ."</td>" ;
				echo "<td>".$value['NAME']."</td>" ;
				echo "<td>".$value['PHONE']."</td>" ;
				echo "<td>".$value['PAID_DATE']."</td>" ;
				echo "<td>".$schedule."</td>" ;
				echo "<td>".$value['Num']."</td>" ;
				echo "<td>".$value['Summation']."</td>" ;
				echo "<td><a href='rent_collection_voucher_other.php?revenue_rent_no=".$value['REVENUE_PART_RENT_NO']."&&paid_date=".$value['PAID_DATE']."' data-toggle='tooltip' title='View' class='btn btn-success' date-original-tittle = 'View'> <i class = 'fa fa-print'></i></a></td> ";
			echo "</tr>";
		}

	}

?>