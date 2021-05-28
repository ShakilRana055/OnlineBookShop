<?php 
	session_start();
	include ( "../../config/db_connection.php") ;
	if( isset($_POST['insert'] ) ) 
	{
	    $currentDateTime = date('Y-m-d');
        $val_fullname = $_POST['val_fullname'];
        $val_FHname = $_POST['val_FHname'];
        $val_age = $_POST['val_age'];
        $val_education = $_POST['val_education'];
        $val_skills = $_POST['val_skills'];
        $val_guardian = $_POST['val_guardian'];
        $val_nominee = $_POST['val_nominee'];
        $val_memberno = $_POST['val_memberno'];
        $val_nomineeadd = $_POST['val_nomineeadd'];
        $val_occupation = $_POST['val_occupation'];
        $val_relationguardian = $_POST['val_relationguardian'];
        $previous = $_POST['previous'] ;
       
       // permanent Information
        $val_villagePermanent = $_POST['val_villagePermanent'];
        $val_postPermanent = $_POST['val_postPermanent'];
        $val_thanaPermanent = $_POST['val_thanaPermanent'];
        $val_districtPermanent = $_POST['val_districtPermanent'];
        $val_postcodePermanent = $_POST['val_postcodePermanent'];
        $val_roadPermanent = $_POST['val_roadPermanent'];
        $val_blockPermanent = $_POST['val_blockPermanent'];
        $val_colonyPermanent = $_POST['val_colonyPermanent'];
        $val_districtPermanent = $_POST['val_districtPermanent'];
        $val_lanePermanent = $_POST['val_lanePermanent'];
        $val_avenuePermanent = $_POST['val_avenuePermanent'];
        $val_sectionPermanent = $_POST['val_sectionPermanent'];
        $val_thanaPermanent = $_POST['val_thanaPermanent'];
        $val_postPermanent = $_POST['val_postPermanent'];
        $val_postcodePermanent = $_POST['val_postcodePermanent'];
        
        // present information
        $val_houseNoPresent = $_POST['val_houseNoPresent'];
        $val_roadPresent = $_POST['val_roadPresent'];
        $val_avenuePresent = $_POST['val_avenuePresent'];
        $val_blockPresent = $_POST['val_blockPresent'];
        $val_sectionPresent = $_POST['val_sectionPresent'];
        $val_lanePresent = $_POST['val_lanePresent'];
        $val_colonyPresent = $_POST['val_colonyPresent'];
        $val_thanaPresent = $_POST['val_thanaPresent'];
        $val_districtPresent = $_POST['val_districtPresent'];
        $val_postPresent = $_POST['val_postPresent'];
        $val_postcodePresent = $_POST['val_postcodePresent'];
        $registration_date = $_POST['registration_date'];
        
        $val_nationality = $_POST['val_nationality'];
        $val_religion = $_POST['val_religion'];
        
        
        
        $val_mothername = $_POST['val_mothername'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $nid = $_POST['nid'];
        $birth = $_POST['birth_certificate']; 
        $image = $_FILES['image']['name'];
        $signature = $_FILES['signature']['name'] ;
        $target = "image/".basename($image);
        
        $signature_name = "image/".basename( $signature ) ;
        $registration_date = $_POST['registration_date'];

	    
	    
	    $reason = $_POST['reason'];
	    $from_no = $_POST['pre_member'];
	    //$to_no = $_POST['new_member'];
        
        
        // needed nominne to add 
        
        $nominee_name=explode( "#" ,  $_POST['nominee_name'] );
        $nominee_relation= explode( "#" , $_POST['nominee_relation']);
        $nominee_add= explode( "#" , $_POST['nominee_add'] );
        $nominee_mobile= explode( "#" , $_POST['nominee_mobile'] );
        $nominee_id_type= explode( "#" , $_POST['nominee_id_type'] );
        $nominee_id_no=explode( "#" ,  $_POST['nominee_id_no'] );
        $nominee_percentage= explode( "#" , $_POST['nominee_percentage'] );
        
        // end nominee
        echo "previouse number = " ;
        echo $previous ;
        
        $get_member_no_and_profile_no_old = "SELECT MEMBER_NO, PROFILE_NO FROM member_profiles WHERE MEMBER_ID = '$previous'" ;
        echo $get_member_no_and_profile_no_old ;
        //echo "get_member_no_and_profile_no_old = ".$get_member_no_and_profile_no_old ."<br/>";
        $get_member_no_ =  mysqli_query( $con , $get_member_no_and_profile_no_old ) ;
        $get_member_no_and_profile_no = mysqli_fetch_assoc( $get_member_no_ ) ;
        echo "Member no " ; 
        echo $get_member_no_and_profile_no['MEMBER_NO'] ;
        // Start old member account
        
        $close_member_table = "UPDATE members SET IS_TRANSFER = '1' , TRANSFER_DATE = '$currentDateTime' WHERE MEMBER_NO = '".$get_member_no_and_profile_no['MEMBER_NO']."'" ;
        //echo "close_member_table = ".$close_member_table ."<br/>";
        
        $close_member_profile = "UPDATE member_profiles SET IS_CLOSED = '1' WHERE PROFILE_NO = '".$get_member_no_and_profile_no['PROFILE_NO']."'" ;
         //echo "close_member_profile = ".$close_member_profile ."<br/>";
        // end close member account
        
        //start new entry
        $insert_data_into_member = "INSERT INTO members SET `JOINING_DATE`= '$currentDateTime',`IS_TRANSFER` = 0" ;
        //echo "insert_data_into_member = ".$insert_data_into_member ."<br/>";
        mysqli_query( $con , $insert_data_into_member ) ;
        $member_no1 = mysqli_insert_id( $con ) ;
        
        $insert_new_member = "INSERT INTO member_profiles SET `MEMBER_NO`= '$member_no1', `MEMBER_ID`= '$val_memberno', `FULL_NAME`= '$val_fullname', `FATHER_HUSBAND_NAME`= '$val_FHname', 
        `PERMANENT_VILLAGE`= '$val_villagePermanent', `PERMANENT_POST`= '$val_postPresent', `PERMANENT_THANA`= '$val_thanaPermanent', 
        `PERMANENT_DISTRICT`= '$val_districtPermanent', `PERMANENT_POSTCODE`= '$val_postcodePermanent', `PRESENT_HOUSE_NO`= '$val_houseNoPresent',
        `PRESENT_LANE_NO`= '$val_lanePresent', `PRESENT_ROAD_NO`= '$val_roadPresent', `PRESENT_AVENUE`= '$val_avenuePresent', `PRESENT_BLOCK`= '$val_blockPresent',
        `PRESENT_SECTION`= '$val_sectionPresent', `PRESENT_COLONY`= '$val_colonyPresent', `PRESENT_THANA`= '$val_thanaPresent', `PRESENT_DISTRICT`= '$val_districtPresent',
        `PRESENT_POSTCODE`= '$val_postcodePresent', `PRESENT_POST_OFFICE`= '$val_postPresent', `PERMANENT_ROAD`= '$val_roadPermanent', 
        `PERMANENT_SECTION`= '$val_sectionPermanent', `PERMANENT_BLOCK`= '$val_blockPermanent', `PERMANENT_COLONY`= '$val_colonyPermanent', `PERMANENT_LANE`= '$val_lanePermanent', 
        `PERMANENT_AVENUE`= '$val_avenuePermanent', `NATIONALITY`= '$val_nationality', `RELIGION`= '$val_religion', 
        `PROFESSION`= '$val_occupation', `AGE`= '$val_age', `MOBILE`= '$mobile', `NID`= '$nid', `MOTHER_NAME`= '$val_mothername', `EDUCATION_QUALIFICATION`= '$val_education', `PRACTICAL_QUALIFICATION`= '$val_skills',
        `GUARDIAN_NAME`= '$val_guardian',`GUARDIAN_RELATION`= '$val_relationguardian', `IMG_URL`= '$image', `SIGNATURE_URL`= '$signature', 
        `JOINING_DATE`= '$currentDateTime', `IS_APPROVED`= '0', REGISTRATION_DATE = '$registration_date'";
        echo "insert_new_member = ".$insert_new_member ."<br/>";
        
        $insert_data_into_transfer_table = "INSERT INTO transfer_accounts SET `PROFILE_NO` = '".$get_member_no_and_profile_no['PROFILE_NO']."',`TRANSFER_REASON`= '$reason' , `TRANSFER_DATE` = '$currentDateTime'" ;
        // end new entry 
        //echo "insert_data_into_transfer_table = ".$insert_data_into_transfer_table ."<br/>";
        
        
		if( mysqli_query( $con , $close_member_table ) )
		{
		    if( mysqli_query( $con , $close_member_profile ) )
		    {
		            if( mysqli_query( $con , $insert_new_member ) )
		            {
		                if( mysqli_query( $con , $insert_data_into_transfer_table ) )
		                {
		                    move_uploaded_file( $_FILES['image']['tmp_name'] , $target ) ;
                            move_uploaded_file( $_FILES['signature']['tmp_name'] , $signature_name) ;
                            for( $i = 0 ; $i < count( $nominee_name ) ; $i ++ )
                            {
                                if( $nominee_name[$i] != "")
                                {
                                    $query13 = "insert into nominees set MEMBER_NO = '$member_no1', NOMINEE_NAME = '$nominee_name[$i]', NOMINEE_RELATION = '$nominee_relation[$i]', NOMINEE_ADDRESS = '$nominee_add[$i]', 
                                    NOMINEE_MOBILE = '$nominee_mobile[$i]', NOMINEE_NID = '$nominee_id_no[$i]', NOMINEE_ID_TYPE = '$nominee_id_type[$i]', 
                                    NOMINEE_PERCENTAGE = '$nominee_percentage[$i]'" ;
                                    
                                    mysqli_query(  $con , $query13 ) ;
                                }
                            }
                            
                            $_SESSION['msgPositive'] = "success" ;
                              header("Location: ../account_transfer.php"); 
		                }
		                else
		                {
		                    $_SESSION['msgPositive'] = "error" ;
		                     header("Location: ../account_transfer.php"); 
		                }
		            }
		            else
		                {
		                    $_SESSION['msgPositive'] = "error" ;
		                     header("Location: ../account_transfer.php"); 
		                }
		        }
		        
		    }
		    
			

	}
	

?>