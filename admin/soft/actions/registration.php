<?php
session_start() ;
include ( "../../config/db_connection.php") ;

    if( isset ($_POST['insert'] ) ) 
    {
        $currentDateTime = date('Y-m-d');
        $val_fullname = trim( $_POST['val_fullname'] );
        $val_FHname = trim( $_POST['val_FHname'] );
        $val_age = trim( $_POST['val_age'] );
        $val_education = trim( $_POST['val_education'] );
        $val_skills = trim( $_POST['val_skills'] );
        $val_guardian = trim( $_POST['val_guardian'] );
        $val_nominee = trim( $_POST['val_nominee'] );
        $val_memberno = trim( $_POST['val_memberno'] );
        $val_nomineeadd = trim( $_POST['val_nomineeadd'] );
        $val_occupation = trim( $_POST['val_occupation'] );
        $val_relationguardian = trim( $_POST['val_relationguardian'] );
       
       
       // permanent Information
        $val_villagePermanent = trim( $_POST['val_villagePermanent'] );
        $val_postPermanent = trim( $_POST['val_postPermanent'] );
        $val_thanaPermanent = trim( $_POST['val_thanaPermanent'] );
        $val_districtPermanent = trim( $_POST['val_districtPermanent'] );
        $val_postcodePermanent = trim( $_POST['val_postcodePermanent'] );
        $val_roadPermanent = trim( $_POST['val_roadPermanent'] );
        $val_blockPermanent = trim( $_POST['val_blockPermanent'] );
        $val_colonyPermanent = trim( $_POST['val_colonyPermanent'] );
        $val_districtPermanent = trim( $_POST['val_districtPermanent'] );
        $val_lanePermanent = trim( $_POST['val_lanePermanent'] );
        $val_avenuePermanent = trim( $_POST['val_avenuePermanent'] );
        $val_sectionPermanent = trim( $_POST['val_sectionPermanent'] );
        $val_thanaPermanent = trim( $_POST['val_thanaPermanent'] );
        $val_postPermanent = trim( $_POST['val_postPermanent'] );
        $val_postcodePermanent = trim( $_POST['val_postcodePermanent'] );
        
        // present information
        $val_houseNoPresent = trim( $_POST['val_houseNoPresent'] );
        $val_roadPresent = trim( $_POST['val_roadPresent'] );
        $val_avenuePresent = trim( $_POST['val_avenuePresent'] );
        $val_blockPresent = trim( $_POST['val_blockPresent'] );
        $val_sectionPresent = trim( $_POST['val_sectionPresent'] );
        $val_lanePresent = trim( $_POST['val_lanePresent'] );
        $val_colonyPresent = trim( $_POST['val_colonyPresent'] );
        $val_thanaPresent = trim( $_POST['val_thanaPresent'] );
        $val_districtPresent = trim( $_POST['val_districtPresent'] );
        $val_postPresent = trim( $_POST['val_postPresent'] );
        $val_postcodePresent = trim( $_POST['val_postcodePresent'] );
        $registration_date = trim( $_POST['registration_date'] );
        
        $val_nationality = trim( $_POST['val_nationality'] );
        $val_religion = trim( $_POST['val_religion'] );
        
        
        
        $val_mothername = trim( $_POST['val_mothername'] );
        $mobile = trim( $_POST['mobile'] );
        $dob = trim( $_POST['dob'] );
        $nid = trim( $_POST['nid'] );
        $birth = trim( $_POST['birth_certificate'] ); 
        
        $image = time().trim( $_FILES['image']['name'] );
        $signature = time().trim( $_FILES['signature']['name'] ) ;
        $target = "image/".basename($image);
        
        $signature_name = "image/".basename( $signature ) ;
        $registration_date = trim( $_POST['registration_date'] );
        
        
        
        // needed nominne to add 
        
        $nominee_name=explode( "#" ,  $_POST['nominee_name'] );
        $nominee_relation= explode( "#" , $_POST['nominee_relation']);
        $nominee_add= explode( "#" , $_POST['nominee_add'] );
        $nominee_mobile= explode( "#" , $_POST['nominee_mobile'] );
        $nominee_id_type= explode( "#" , $_POST['nominee_id_type'] );
        $nominee_id_no=explode( "#" ,  $_POST['nominee_id_no'] );
        $nominee_percentage= explode( "#" , $_POST['nominee_percentage'] );
        
        // end nominee
        
        // members table 
        $memberInsert = "insert into members set  JOINING_DATE = '$currentDateTime', CREATED_ON = '$currentDateTime' " ;
        mysqli_query( $con, $memberInsert ) ;
        
        
        $member_no1 = mysqli_insert_id( $con ) ;
        
        
        $query = "INSERT INTO member_profiles SET `MEMBER_NO`= '$member_no1', `MEMBER_ID`= '$val_memberno', `FULL_NAME`= '$val_fullname', `FATHER_HUSBAND_NAME`= '$val_FHname', 
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
        
        
        
        $result = mysqli_query( $con , $query ) ;
        
        
        if($result)
        {
            
            move_uploaded_file( $_FILES['image']['tmp_name'] , $target ) ;
            move_uploaded_file( $_FILES['signature']['tmp_name'] , $signature_name) ;
            
            //inserting data into nominees table
            
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
            
            //end
            
             $_SESSION['msgPositive'] = "success" ;
             header("Location: ../registration.php"); 
        }
        else
        {
             $_SESSION['msgPositive'] = "error" ;
             header("Location: ../registration.php");
        }
        
        
    }


?>