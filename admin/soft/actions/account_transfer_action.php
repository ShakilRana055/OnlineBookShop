<?php 
	session_start();
	include ( "../../config/db_connection.php") ;
	if( isset($_POST['insert'] ) ) 
	{

	    $currentDateTime = date('Y-m-d');
	    $val_fullname =  trim ( $_POST['val_fullname'] ) ;
	    $val_FHname =  trim ( $_POST['val_FHname'] ) ;
	    $val_age =  trim ( $_POST['val_age'] ) ;
	    $val_education =  trim ( $_POST['val_education'] ) ;
	    $val_skills = trim (  $_POST['val_skills'] ) ;
	    $val_guardian =  trim ( $_POST['val_guardian'] ) ;
	    $val_nominee =  trim ( $_POST['val_nominee'] ) ;
	    $val_memberno =  trim ( $_POST['val_memberno'] ) ;
	    $val_nomineeadd =  trim ( $_POST['val_nomineeadd'] ) ;
	    $val_occupation =  trim ( $_POST['val_occupation'] ) ;
	    $val_relationguardian =  trim ( $_POST['val_relationguardian'] ) ;
	    $val_relationnominee =  trim ( $_POST['val_relationnominee'] ) ;
	    $val_villagePermanent =  trim ( $_POST['val_villagePermanent'] ) ;
	    $val_postPermanent =  trim ( $_POST['val_postPermanent'] ) ;
	    $val_thanaPermanent =  trim ( $_POST['val_thanaPermanent'] ) ;
	    $val_districtPermanent =  trim ( $_POST['val_districtPermanent'] ) ;
	    $val_postcodePermanent =  trim ( $_POST['val_postcodePermanent'] ) ;
	    $val_houseNoPresent =  trim ( $_POST['val_houseNoPresent'] ) ;
	    $val_roadPresent =  trim ( $_POST['val_roadPresent'] ) ;
	    $val_avenuePresent =  trim ( $_POST['val_avenuePresent'] ) ;
	    $val_blockPresent =  trim ( $_POST['val_blockPresent'] ) ;
	    $val_sectionPresent =  trim ( $_POST['val_sectionPresent'] ) ;
	    $val_lanePresent =  trim ( $_POST['val_lanePresent'] ) ;
	    $val_nationality =  trim ( $_POST['val_nationality'] ) ;
	    $val_religion =  trim ( $_POST['val_religion'] ) ;
	    $val_colonyPresent =  trim ( $_POST['val_colonyPresent'] ) ;
	    $val_thanaPresent =  trim ( $_POST['val_thanaPresent'] ) ;
	    $val_districtPresent =  trim ( $_POST['val_districtPresent'] ) ;
	    $val_postPresent =  trim ( $_POST['val_postPresent'] ) ;
	    $val_mothername =  trim ( $_POST['val_mothername'] ) ;
	    $val_nidnominee =  trim ( $_POST['val_nidnominee'] ) ;
	    $val_mobilenominee =  trim ( $_POST['val_mobilenominee'] ) ;
	    $msgPositive = "";
        $nid =  trim ( $_POST['nid'] ) ;
        $mobile =  trim ( $_POST['mobile'] ) ;
        $nominee = trim ( $_POST['val_pernominee'] ) ; 
	    $reason =  trim ( $_POST['reason'] ) ;
	    $from_no =  trim ( $_POST['pre_member'] ) ;
	    //$to_no = $_POST['new_member'] ) ;
        
        
        // needed nominne to add 
        
        $nominee_name=explode( "#" ,  $_POST['nominee_name'] );
        $nominee_relation= explode( "#" , $_POST['nominee_relation']);
        $nominee_add= explode( "#" , $_POST['nominee_add'] );
        $nominee_mobile= explode( "#" , $_POST['nominee_mobile'] );
        $nominee_id_type= explode( "#" , $_POST['nominee_id_type'] );
        $nominee_id_no=explode( "#" ,  $_POST['nominee_id_no'] );
        $nominee_percentage= explode( "#" , $_POST['nominee_percentage'] );
        
        // end nominee
        
        
        
        
        $getMemberNo = "select MEMBER_NO from members where MEMBER_ID = '$from_no'" ;
        $another = mysqli_fetch_assoc( mysqli_query( $con , $getMemberNo ) ) ;
        $member_no = $another['MEMBER_NO'] ;
        
	    $query = "update member_profiles set IS_CLOSED = '1' , CLOSING_DATE = '$currentDateTime' where MEMBER_NO = '$member_no' " ;
	    

	    $transfer = "insert into transfer_table set FROM_PROFILE = '$member_no' , TO_PROFILE = '$to_no', REASON = '$reason' , DATE = '$currentDateTime', CREATED_ON = '$currentDateTime'" ;
        
	    $new_query = "insert into member_profiles set FULL_NAME='$val_fullname', FATHER_HUSBAND_NAME='$val_FHname',PERMANENT_VILLAGE='$val_villagePermanent',
		    PERMANENT_POST='$val_postPermanent',PERMANENT_THANA='$val_thanaPermanent',PERMANENT_DISTRICT='$val_districtPermanent',PERMANENT_POSTCODE='$val_postcodePermanent',
		    PRESENT_HOUSE_NO='$val_houseNoPresent',PRESENT_LANE_NO='$val_lanePresent',PRESENT_ROAD_NO='$val_roadPresent',PRESENT_AVENUE='$val_avenuePresent',
		    PRESENT_BLOCK='$val_blockPresent',PRESENT_SECTION='$val_sectionPresent',PRESENT_COLONY='$val_colonyPresent',PRESENT_THANA='$val_thanaPresent',
		    PRESENT_DISTRICT='$val_districtPresent',PRESENT_POSTCODE='$val_postPresent',NATIONALITY='$val_nationality',RELIGION='$val_religion',
		    PROFESSION='$val_occupation',AGE='$val_age',MOTHER_NAME='$val_mothername',NOMINEE_NID='$val_nidnominee',NOMINEE_MOBILE='$val_mobilenominee',
		    EDUCATION_QUALIFICATION='$val_education',PRACTICAL_QUALIFICATION='$val_skills',GUARDIAN_NAME='$val_guardian',GUARDIAN_RELATION='$val_relationguardian',
		    NOMINATED_PERSON_NAME='$val_nominee',NOMINATED_RELATION='$val_relationnominee',NOMINEE_ADDRESS='$val_nomineeadd',JOINING_DATE='$currentDateTime',
		    IS_APPROVED=0, CREATED_ON = '$currentDateTime', MEMBER_NO = '$member_no' , MOBILE = '$mobile' , NID = '$nid',NOMINEE_PERCENT = '$nominee' ";
		   
		// $closed_account = mysqli_query( $con , $query ) ;
		// $insert_transfer = mysqli_query( $con , $transfer ) ;
		// $new_entry = mysqli_query( $con , $new_query ) ;

		if( mysqli_query( $con , $query ) )
		{
			if( mysqli_query( $con , $new_query )  )
			{
				$to_profile = mysqli_insert_id( $con ) ;

				$get = "select PROFILE_NO from member_profiles where MEMBER_NO = '$member_no'" ;
				$update_profile_query = "update member_profiles set IS_TRANSFER = 1 where MEMBER_NO = '$member_no'" ;
				mysqli_query( $con , $update_profile_query ) ;

				$get2 = mysqli_fetch_assoc ( mysqli_query( $con , $get ) ) ;
				$profile_no = $get2['PROFILE_NO'] ;


				$transfer = "UPDATE transfer_accounts SET `PROFILE_NO` = '$profile_no', `TO_PROFILE_NO`= '$to_profile', `TRANSFER_REASON`= '$reason', `TRANSFER_DATE`= '$currentDateTime', `CREATED_ON` = '$currentDateTime'"
				
				if( mysqli_query( $con , $transfer ) )
				{
					
					$update_members = "update members set IS_TRANSFER = '1', TRANSFER_DATE = '$currentDateTime' where MEMBER_ID = '$member_no' " ;
					
					if( mysqli_query( $con , $update_members ) )
					{
					    
            
                        for( $i = 0 ; $i < count( $nominee_name ) ; $i ++ )
                        {
                            if( $nominee_name[$i] != "")
                            {
                                $query13 = "insert into nominees set PROFILE_NO = '$profile_no', NOMINEE_NAME = '$nominee_name[$i]', NOMINEE_RELATION = '$nominee_relation[$i]', NOMINEE_ADDRESS = '$nominee_add[$i]', 
                                NOMINEE_MOBILE = '$nominee_mobile[$i]', NOMINEE_NID = '$nominee_id_no[$i]', NOMINEE_ID_TYPE = '$nominee_id_type[$i]', 
                                NOMINEE_PERCENTAGE = '$nominee_percentage[$i]'" ;
                                echo $query13 ;
                                mysqli_query(  $con , $query13 ) ;
                            }
                        }
                        
                        //end
            						
						$_SESSION['msgPositive'] = "success" ;
				    // 	header("Location: ../account_transfer.php"); 
					}
					else
						$_SESSION['msgPositive'] = "error" ;
				}
				else
					$_SESSION['msgPositive'] = "error" ;
				
			}
			else
				$_SESSION['msgPositive'] = "error" ;
			
		}
		else
			$_SESSION['msgPositive'] = "error" ;

	}

?>