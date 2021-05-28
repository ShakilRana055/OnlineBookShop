<?php 
	
	
	
	if( isset( $_POST['forwhom'] ) )
	{
	    include ( "../../config/db_connection.php") ;
	    $id = $_POST['PROJECT_REVENUE_NO'] ;
	    $sql = "SELECT FOR_WHOM FROM project_revenue WHERE PROJECT_REVENUE_NO = '$id'" ;
	    $result = mysqli_fetch_assoc( mysqli_query( $con , $sql ) ) ;
	    echo $result['FOR_WHOM'] ;
	    
	}
	
	if( isset( $_POST['profile_noaction'] ) )
	{
	    include ( "../../config/db_connection.php") ;
	    $profile_no = $_POST['profile_noaction'] ;
	    $sql = "SELECT FULL_NAME , `PRESENT_HOUSE_NO`, `PRESENT_LANE_NO`, `PRESENT_ROAD_NO`, 
	    `PRESENT_AVENUE`, `PRESENT_BLOCK`, `PRESENT_SECTION`, `PRESENT_COLONY`, `PRESENT_THANA`, `PRESENT_DISTRICT`, 
	    `PRESENT_POSTCODE`, `PRESENT_POST_OFFICE`, `MOBILE`, `NID` FROM member_profiles WHERE PROFILE_NO = '$profile_no'" ;
	 
	    $results =  mysqli_query( $con , $sql )  ;

	   $data = array( ) ;

	   foreach( $results as $value )
	   {
	       array_push($data, $value);
	   }
	   echo json_encode($data);
	}
	
	
	if( isset( $_POST['checkit']) )
	{
	    include ( "../../config/db_connection.php") ;
	    $project_no = $_POST['project_no'] ;
	    $sql = "SELECT FOR_WHOM FROM project_revenue WHERE PROJECT_NO = '$project_no'" ;
	    $result = mysqli_fetch_assoc( mysqli_query( $con , $sql ) ) ;
	    echo $result['FOR_WHOM'] ;
	}
	
	
	
	if( isset($_POST['responsible']) && $_POST['responsible'] != NULL )
	{
		include ( "../../config/db_connection.php") ;
		$query = "select MEMBER_NO, FULL_NAME from member_profiles " ;
		$result = mysqli_query ( $con , $query ) ;
		echo "<option value = ''>Please Select one</option>" ;
		foreach( $result as $value )
		{
		    echo "<option value = '".$value['MEMBER_NO']."'>".$value['FULL_NAME']."</option>";
		}
	}
	
	if( isset( $_POST['revenue_setup']) && $_POST['revenue_setup'] != NULL)
	{
	    include ( "../../config/db_connection.php") ;
	     
	     $project_no = $_POST['project_no'] ;
	     
	     $radio = $_POST['radio'] ;
	     $revenue_type = $_POST['revenue_type'] ;
	     $rent_period = $_POST['rent_period'] ;
	     $part_project = $_POST['part_project'] ;
	     $district = $_POST['district'] ;
	     $location = $_POST['location'] ;
	     $sl_no = $_POST['sl_no'] ;
	     $title_name = $_POST['title_name'] ;
	     $current = date("Y-m-d") ;
	     
	     $query = "insert into project_revenue set PROJECT_NO = '$project_no', FOR_WHOM  = '$radio',
	     REVENUE_TYPE  = '$revenue_type', RENT_PERIOD  = '$rent_period',PART_OF_PROJECT  = '$part_project', 
	     DISTRICT   = '$district', LOCATION = '$location',SL_NO = '$sl_no',TITLE_NAME = '$title_name',
	     CREATED_ON = '$current' " ;
	   //   echo $query ;
	     $result = mysqli_query( $con , $query ) ;
	    if( $result )
	    {
	        echo 1 ;
	    }
	    else
	    {
	        echo 0 ;
	    }
	  
	}
	
	if( isset($_POST['headName']) && $_POST['headName'] != NULL)
	{
	    include ( "../../config/db_connection.php") ;
	    $project_no = $_POST['project_no'] ;
	    $query = "SELECT `PROJECT_EXPENSE_HEAD_NO`,`PROJECT_EXPENSE_HEAD_NAME` FROM project_expense_heads WHERE PROJECT_NO = '$project_no' " ;
	    $result = mysqli_query( $con , $query ) ;
	    echo "<option value = ''>Please Select one</option>" ;
	    
	    foreach( $result as $value )
	    {
	        echo "<option value = '".$value['PROJECT_EXPENSE_HEAD_NO']."'>".$value['PROJECT_EXPENSE_HEAD_NAME']."</option>";
	    }

	    
	}
	
	if( isset($_POST['search']) && $_POST['search'] != NULL )
	{
		getSearchResult( $_POST['member_id'] , $_POST['mobile'] ) ;
	}

	if( isset($_POST['loan']) == "saveLoan" && $_POST['loan'] != NULL )
	{
		saveLoan( $_POST[ 'member_id' ] , $_POST['apply_date'] , $_POST['loan_amount'], $_POST['refer_member_id'] ) ;
	}
	
	if( isset($_POST['project']) && $_POST['project'] != NULL )
	{
	    saveProject( $_POST[ 'name' ] , $_POST['location'] , $_POST['details'], $_POST['start_date'], $_POST['responsible'], $_POST['remark']) ;
	    //saveProject( $_POST['name']), $_POST['location']) , $_POST['details']), $_POST['start_date']), $_POST['responsible']), $_POST['remark']) ) ;
	}
	
	if( isset( $_POST['project_expense']) && $_POST['project_expense'] != NULL)
	{
	    saveProjectExpense( $_POST[ 'date' ] , $_POST['amount'] , $_POST['project_no'], $_POST['remark'] , $_POST['expense_no']  ) ;
	}
	
	if( isset( $_POST['saveProjectWise']) && $_POST['saveProjectWise'] != NULL)
	{
	    saveProjectWise( $_POST[ 'project_no' ] , $_POST['expense_head'] , $_POST['expense_code'] ) ;
	}
	
	
	function saveProjectWise( $project_no , $expense_head, $expense_code)
	{
	    include ( "../../config/db_connection.php") ;
	    $current_date = date( "Y/m/d") ;
	    $query = "insert into project_expense_heads set PROJECT_NO = '$project_no' , PROJECT_EXPENSE_HEAD_NAME = '$expense_head', PROJECT_EXPENSE_HEAD_CODE = '$expense_code', CREATED_TIME = '$current_date' ";
	   // echo $query ;
	    $result = mysqli_query( $con , $query ) ;
	    if( $result )
	    {
	        echo 1 ;
	    }
	    else
	    {
	        echo 0 ;
	    }
	}
	
	if( isset( $_POST['wise']) && $_POST['wise'] != NULL)
	{
	    include ( "../../config/db_connection.php") ;
	    $query = "select PROJECT_NAME , PROJECT_NO from projects";
	    $result = mysqli_query ( $con , $query ) ;
	    
	    echo "<option value=''>Please Select One</option>" ;
	    foreach ( $result as $value )
	    {
	        echo "<option value = '".$value['PROJECT_NO']."' >".$value['PROJECT_NAME']."</option>";
	    }
	}
	
	if( isset( $_POST['project_name']) && $_POST['project_name'] != NULL)
	{
	    include ( "../../config/db_connection.php") ;
	    $query = "select PROJECT_NAME , PROJECT_NO from projects";
	    $result = mysqli_query( $con , $query ) ;
	    echo "<option value=''>Please Select One</option>";
	    foreach ( $result as $value )
	    {
	        echo "<option value = '".$value['PROJECT_NO']."' >".$value['PROJECT_NAME']."</option>";
	    }
	}
	
	
	function saveProjectExpense( $date , $amount , $project_no , $remark , $expense_no )
	{
	    include ( "../../config/db_connection.php") ;
	    $currentDate = date( "Y/m/d" ) ;
	    $query  = "INSERT INTO project_expenses SET `PROJECT_EXPENSE_HEAD_NO`= '$expense_no',`TRN_DATE`= '$date',`PROJECT_NO` = '$project_no',`EXPENSE_AMOUNT` = '$amount',`REMARKS` = '$remark', `CREATED_ON` = '$currentDate' " ; 
	   
	    $result = mysqli_query ( $con , $query ) ;
	    if( $result )
	    {
	        echo 1 ;
	    }
	    else
	    {
	        echo 0 ;
	    }
	}
	
	
	function saveProject( $name, $location , $details, $start_date, $responsible , $remark )
	{
	    include ( "../../config/db_connection.php") ;
	    $current_date = date("Y/m/d");
	    $query = "INSERT INTO projects set PROJECT_NAME = '$name', LOCATION = '$location', DETAILS = '$details' , START_DATE = '$start_date',
	                RESPONSIBLE_MEMBER_NO = '$responsible', REMARKS = '$remark', CREATED_ON = '$current_date'" ;
	    $result = mysqli_query( $con , $query ) ;
	    if( $result )
	    {
	        echo 1 ;
	    }
	    else
	    {
	        echo 0 ;
	    }
	}

	function getSearchResult( $member , $mobile )
	{
		include ( "../../config/db_connection.php") ;
		
		$query = "" ;
		
		if( $member != "" )
		{
			$query = "SELECT * FROM member_profiles INNER JOIN members ON member_profiles.MEMBER_NO = members.MEMBER_NO WHERE members.MEMBER_ID = '$member'" ;
		}
		else if( $mobile != "" )
		{
			$query = "SELECT * FROM member_profiles INNER JOIN members ON member_profiles.MEMBER_NO = members.MEMBER_NO WHERE MOBILE = '$mobile' " ;
		}

		if( $query )
		{
			$result = mysqli_query( $con , $query ) ;
			foreach ($result as $value) 
			{
				echo "<tr>";
					echo "<td>".$value['MEMBER_NO']."</td>";
					echo "<td class = 'member_id'>".$value['MEMBER_ID']."</td>";
					echo "<td>".$value['FULL_NAME']."</td>";
					echo "<td>".$value['MOBILE']."</td>";
					echo "<td>"."<img src='save.jpg' height = '".'50'."' width = '".'50'."'>"."</td>";
					echo "<td>".""."</td>";
					echo "<td>".$value['JOINING_DATE']."</td>";
					
				echo "</tr>" ;
			}
		}
		else
		{
			echo 0 ;
		}
	}

	function saveLoan( $member_id , $apply_date , $loan_amount, $refer_member_id )
	{
		include ( "../../config/db_connection.php") ;
		
		$get_member_info = "SELECT members.MEMBER_NO, member_profiles.PROFILES_NO FROM members INNER JOIN member_profiles ON members.MEMBER_NO = member_profiles.MEMBER_NO WHERE members.MEMBER_ID = '$member_id' " ;
		
		$get_refer_info = "SELECT members.MEMBER_NO, member_profiles.PROFILES_NO FROM members INNER JOIN member_profiles ON members.MEMBER_NO = member_profiles.MEMBER_NO WHERE members.MEMBER_ID = '$refer_member_id' " ;

		
		$currentDate = date("Y/m/d") ;
		$member_info_result = mysqli_query( $con , $get_member_info ) ;
		$refer_info_result = mysqli_query( $con , $get_refer_info ) ;

		if( $member_info_result && $refer_info_result )
		{
			foreach ( $member_info_result as $value ) 
			{ 
				$save = "INSERT INTO loan_table SET MEMBER_NO = '".$value['MEMBER_NO']."', PROFILE_NO = '".$value['PROFILES_NO']."', APPLY_DATE = '$apply_date' , LOAN_AMOUNT = '$loan_amount', IS_APPROVED = '0', CREATED_ON = '$currentDate' , IS_LOAN_FEE_PAID = '0'";
				
				mysqli_query( $con , $save ) ;
				
			}

			$findQuery = "SELECT LOAN_NO FROM loan_table ORDER BY LOAN_NO DESC LIMIT 1 " ;
			
			$findQueryResult = mysqli_fetch_assoc ( mysqli_query( $con , $findQuery ) );
			
			foreach ( $refer_info_result as  $value) {
				$save = "UPDATE loan_table SET REFER_MEMBER_NO = '".$value['MEMBER_NO']."', REFER_PROFILE_NO = '".$value['PROFILES_NO']."' WHERE LOAN_NO = '".$findQueryResult['LOAN_NO']."'";
				mysqli_query( $con , $save ) ;

			}
			echo 1 ;
		}
		else
		{
			echo 0 ;
		}
	}

?>