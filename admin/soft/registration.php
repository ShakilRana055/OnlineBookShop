<?php include 'include/header.php';?>
<?php $table_heading = "Member Registration Form";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<style type="text/css">
    .error {
        color: red;
    }
</style>



<?php
    // auto generate 
    
    $query = "SELECT MEMBER_NO FROM members ORDER BY MEMBER_NO DESC LIMIT 1 " ;
    $member_id = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;

?>

<div >
            <!-- Form Validation Example Block -->
            <div class="block">
                <!-- Form Validation Example Title -->
                <div class="block-title" style="text-align:center">
                    
                </div>
                <!-- END Form Validation Example Title -->

                <!-- Form Validation Example Content -->
    <form id="form-validation" action="actions/registration.php" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"> <strong>Personal Information</strong></legend>
                        
                        
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="val_memberno">Member ID<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_memberno" value = "<?php echo $member_id['MEMBER_NO'] + 1 ?>" name="val_memberno" class="form-control ui-wizard-content" placeholder="Add Member ID" required="" aria-required="true" value="" >
                                    
                               
                            </div>
                        </div>
                            
                            
                            <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname">Full Name <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                    <input type="text" id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" placeholder="Member's Full Name" value="" >

                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_nationality">Nationality</label>
                            <div class="col-md-8">
                                
                            <select class="form-control search" style="width: 100%" name="val_nationality" id="val_nationality" tabindex="5">
                                <option value="Bangladeshi">Bangladeshi</option>
                                <option value="Afghanistani">Afghanistani</option>
                                <option value="Bhutani">Bhutani</option>
                                <option value="Indian">Indian</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Nepalian">Nepalian</option>
                                <option value="Pakistani">Pakistani</option>
                                <option value="Srilankan">Srilankan</option>
                                
                              </select>
                                
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_occupation">Occupation<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_occupation" name="val_occupation" class="form-control ui-wizard-content" placeholder="Member's Occupation" aria-required="true" value="" >
                                    
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_education">Educational<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_education" name="val_education" class="form-control ui-wizard-content" placeholder="Member's Education" aria-required="true" value="" >
                                    
                               
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_guardian">Guardian's Name<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_guardian" name="val_guardian" class="form-control ui-wizard-content" placeholder="Guardian's Name" required="" aria-required="true" value="" >
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mobile"> Mobile/Phone <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="mobile" name="mobile" class="form-control ui-wizard-content" placeholder="Mobile/Phone Number" required="" aria-required="true" value="" >
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="dob"> Date of Birth <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="date" id="dob" name="dob" class="form-control ui-wizard-content" placeholder="" required="" aria-required="true" value="" >
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_age">Age<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="number" step="any" id="val_age" name="val_age" disabled ="" class="form-control ui-wizard-content" placeholder="Member's Age" required="" aria-required="true" value="" >
                                    
                               
                            </div>
                        </div>
                        
            </div>
                    <div class="col-sm-6">
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="registration_date">Joining Date<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="date" id="registration_date" name="registration_date" class="form-control ui-wizard-content" placeholder="" required="" aria-required="true" value="" >
                                    
                               
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_FHname">Father/Husband Name<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_FHname" name="val_FHname" class="form-control ui-wizard-content" placeholder="Member's Father/Husband Name " aria-required="true" value="" >
                                    
                                
                            </div>
                        </div>    
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_mothername">Mother Name<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_mothername" name="val_mothername" class="form-control ui-wizard-content" placeholder="Member's Mother Name " required="" aria-required="true" value="" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_religion">Religion </label>
                            <div class="col-md-8">
                                
                                <select class="form-control search" style="width: 100%" name="val_religion" id="val_religion" >
                                <option value="Islam">Islam</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Judaism">Judaism</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Other">Other</option>
                                
                                
                              </select>
                                    
                               
                            </div>
                        </div>
                        
                
                        
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="example-textarea-input">Technical Skills</label>
                        <div class="col-md-8">
                            
                            <textarea id="val_skills" name="val_skills" rows="1" class="form-control" placeholder="Member technial skills" ></textarea>
                            
                        </div>
                        
                    </div>
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_relationguardian">Relation (Guardian)<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_relationguardian" name="val_relationguardian" class="form-control ui-wizard-content" placeholder="Relation With Guardian" required="" aria-required="true" value="" >
                                    
                              
                            </div>
                        </div>
                        
                        <div class="form-group">
                        	<label class="col-md-4 control-label" for="id_type">ID Type 
                        		
                        	</label>
                        	<div class="col-md-8">
                        		<select id="id_type" name="id_type" class="form-control">
                        			<option value="">Please select</option>
                        			<option value="nid">NID</option>
                        			<option value="birth">Birth Certificate</option>
                        		</select>
                        	</div>
                        </div>
                        
                        <div class="form-group" id = "nid_selector" >
                            <label class="col-md-4 control-label" for="nid"> ID <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="nid" name="nid" class="form-control ui-wizard-content" placeholder="ID number" required="" aria-required="true" value="" >
                                
                            </div>
                        </div>  
                        
                </div>

                </fieldset>
                        <!-- hand made !-->
                        
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><strong>Present Address</strong></legend>
                        
                    <div class="col-sm-6">
                     <div class="form-group">
                            <label class="col-md-4 control-label" for="val_houseNoPresent">Village/House No.<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_houseNoPresent" name="val_houseNoPresent" value="" class="form-control ui-wizard-content" placeholder="Enter House no" required="" aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_roadPresent">Road</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_roadPresent" value="" name="val_roadPresent" class="form-control ui-wizard-content" placeholder="Enter Road info/no."  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_blockPresent">Block</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_blockPresent" value="" name="val_blockPresent" class="form-control ui-wizard-content" placeholder="Enter block info"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_colonyPresent">Colony</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_colonyPresent" value="" name="val_colonyPresent" class="form-control ui-wizard-content" placeholder="Enter colony"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                        	<label class="col-md-4 control-label" for="val_districtPresent">District 
                        		<span class="text-danger">*</span>
                        	</label>
                        	<div class="col-md-8">
                        		<select id="val_districtPresent" style="width: 100%" name="val_districtPresent" class="form-control ui-wizard-content search">
                        			<option value="">Please select</option>
                        			<?php
                        			        $all64 = "Bagerhat,Bandarban,Barguna,Barisal,Bhola,Bogra,Brahmanbaria,Chandpur,Chittagong,Chuadanga,Comilla,Coxs Bazar,
                        			        Dhaka,Dinajpur,Faridpur,Feni,Gaibandha,Gazipur,Gopalganj,Habiganj,Jaipurhat,Jamalpur,Jessore,Jhalakati,Jhenaidah,
                        			        Khagrachari,Khulna,Kishoreganj,Kurigram,Kushtia,Lakshmipur,Lalmonirhat,Madaripur,Magura,Manikganj,Meherpur,Moulvibazar,
                        			        Munshiganj,Mymensingh,Naogaon,Narail,Narayanganj,Narsingdi,Natore,Nawabganj,Netrakona,Nilphamari,Noakhali,Pabna,
                        			        Panchagarh,Parbattya Chattagram,Patuakhali,Pirojpur,Rajbari,Rajshahi,Rangpur,Satkhira,Shariatpur,Sherpur,Sirajganj,
                        			        Sunamganj,Sylhet,Tangail,Thakurgaon" ;
                        			        
                        			        $district = explode( ",", $all64 ) ;
                        			        for( $i = 0 ; $i < count( $district ) ; $i ++ )
                        			        {
                        			            echo "<option value = '".$district[$i]."'>".$district[$i]."</option>" ;
                        			        }
                        			?>
                        			
                        			
                        		</select>
                        	</div>
                        </div>
 
                        
                </div>
                        
                <div class="col-sm-6">
  
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_lanePresent">Lane No.</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_lanePresent" value="" name="val_lanePresent" class="form-control ui-wizard-content" placeholder="Enter lane number"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_avenuePresent">Avenue</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_avenuePresent" value="" name="val_avenuePresent" class="form-control ui-wizard-content" placeholder="Enter avenue name"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_sectionPresent">Section</label>
                            <div class="col-md-8">
                               
                                    <input type="text" id="val_sectionPresent" value="" name="val_sectionPresent" class="form-control ui-wizard-content" placeholder="Enter section"  aria-required="true" >

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_thanaPresent">Thana<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_thanaPresent" value="" name="val_thanaPresent" class="form-control ui-wizard-content" placeholder="Enter Thana name" required="" aria-required="true" >
                                    
                               
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postPresent">Post office<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_postPresent" value="" name="val_postPresent" class="form-control ui-wizard-content" placeholder="Enter Post code" required="" aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postcodePresent">Post Code<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_postcodePresent" value="" name="val_postcodePresent" class="form-control ui-wizard-content" placeholder="Enter Post code"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                </div>
                        
                    
            </fieldset>                        


                        
                 <!--address details-->
                 <fieldset class="scheduler-border">
                 <legend class="scheduler-border"><strong>Permanent Address</strong></legend>
                    
                    <div>
                        <input type = "checkbox" id = "same" value = "Same" name = "same" class = "btn btn-primary"> Same as Permanent Address
                        
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_villagePermanent">Village/House No<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_villagePermanent" name="val_villagePermanent" class="form-control ui-wizard-content" placeholder="Enter village name" value="" aria-required="true" >
                                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_roadPermanent">Road</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_roadPermanent" value="" name="val_roadPermanent" class="form-control ui-wizard-content" placeholder="Enter Road"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_blockPermanent">Block</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_blockPermanent" value="" name="val_blockPermanent" class="form-control ui-wizard-content" placeholder="Enter block info"  aria-required="true" >
                                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_colonyPermanent">Colony</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_colonyPermanent" value="" name="val_colonyPermanent" class="form-control ui-wizard-content" placeholder="Enter colony"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                        	<label class="col-md-4 control-label" for="val_districtPermanent">District 
                        		<span class="text-danger">*</span>
                        	</label>
                        	<div class="col-md-8">
                        		<select id="val_zillaPermanent" style="width: 100%" name="val_districtPermanent" class="form-control ui-wizard-content search">
                        			<option value="">Please select</option>
                        			<?php
                        			        $all64 = "Bagerhat,Bandarban,Barguna,Barisal,Bhola,Bogra,Brahmanbaria,Chandpur,Chittagong,Chuadanga,Comilla,Coxs Bazar,
                        			        Dhaka,Dinajpur,Faridpur,Feni,Gaibandha,Gazipur,Gopalganj,Habiganj,Jaipurhat,Jamalpur,Jessore,Jhalakati,Jhenaidah,
                        			        Khagrachari,Khulna,Kishoreganj,Kurigram,Kushtia,Lakshmipur,Lalmonirhat,Madaripur,Magura,Manikganj,Meherpur,Moulvibazar,
                        			        Munshiganj,Mymensingh,Naogaon,Narail,Narayanganj,Narsingdi,Natore,Nawabganj,Netrakona,Nilphamari,Noakhali,Pabna,
                        			        Panchagarh,Parbattya Chattagram,Patuakhali,Pirojpur,Rajbari,Rajshahi,Rangpur,Satkhira,Shariatpur,Sherpur,Sirajganj,
                        			        Sunamganj,Sylhet,Tangail,Thakurgaon" ;
                        			        
                        			        $district = explode( ",", $all64 ) ;
                        			        for( $i = 0 ; $i < count( $district ) ; $i ++ )
                        			        {
                        			            echo "<option value = '".$district[$i]."'>".$district[$i]."</option>" ;
                        			        }
                        			?>
                        			
                        			
                        		</select>
                        	</div>
                        </div> 
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_lanePermanent">Lane No.</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_lanePermanent" value="" name="val_lanePermanent" class="form-control ui-wizard-content" placeholder="Enter lane number"  aria-required="true" >
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_avenuePermanent">Avenue</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_avenuePermanent" value="" name="val_avenuePermanent" class="form-control ui-wizard-content" placeholder="Enter section"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_sectionPermanent">Section</label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_sectionPermanent" value="" name="val_sectionPermanent" class="form-control ui-wizard-content" placeholder="Enter section"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_thanaPermanent">Thana/Sub-district<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_thanaPermanent" name="val_thanaPermanent" class="form-control ui-wizard-content" placeholder="enter Thana/upozilla name" required="" value="" aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postPermanent">Post Office<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_postPermanent" name="val_postPermanent" class="form-control ui-wizard-content" placeholder="Enter post name" required="" value="" aria-required="true" >
                                    
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postcodePermanent">Post Code<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_postcodePermanent" name="val_postcodePermanent" value="" class="form-control ui-wizard-content" placeholder="Enter Post code"  aria-required="true" >
                                    
                                
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    
                    

                 
                 <fieldset class = "scheduler-border">
                     <legend class = "scheduler-border"> Image Upload </legend>
                     
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="image">Photo <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="file" id="image" name="image"  >
                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-4 control-label" for="signature">Signature<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="file" id="signature" name="signature" >
                            </div>
                        </div>
                    </div>
                     
                 </fieldset>
                 
                 
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"> Nominee </legend>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-4 control-label" for="val_nominee">Nominee Name<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                
                                    <input type="text" id="val_nominee" name="val_nominee" class="form-control ui-wizard-content" placeholder="Nominee Name"  aria-required="true" value="" >
                                    <div class = "col-md-10 error" id="erval_nominee" >
                                    
                                    </div>
                                <input type = "hidden" id = "errornominee_name" name = "nominee_name" value = "" > 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_relationnominee">Relation(Nominee)<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                               
                                    <input type="text" id="val_relationnominee" name="val_relationnominee" class="form-control ui-wizard-content" placeholder="Relation With nominee"  aria-required="true" value="" >
                                    <div class = "col-md-10 error" id="erval_relationnominee" >
                                    
                                    </div>
                                    <input type = "hidden" id = "errornominee_relation" name = "nominee_relation" value = ""  >
                               
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="val_nomineeadd">Nominee Address<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <textarea id="val_nomineeadd" name="val_nomineeadd" rows="1" class="form-control" placeholder="Full nominee address" ></textarea>
                            <div class = "col-md-10 error" id="erval_nomineeadd" >
                                
                            </div>
                            <input type = "hidden" id = "errornominee_add" name = "nominee_add" value = "" >    
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                              <div class="form-group">
                            
                                <label class="col-md-4 control-label" for="val_mobilenominee">Mobile<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" id="val_mobilenominee" name="val_mobilenominee" class="form-control ui-wizard-content" placeholder="Nominee Mobile No." aria-required="true" value="" >
                                   <div class = "col-md-10 error" id="erval_mobilenominee" >
                                    
                                    </div>
                                <input type = "hidden" id = "errornominee_mobile" name = "nominee_mobile" value = "" > 
                                </div>
                            
                            </div>
                        </div>
                        
                        <div class = "col-md-6">
                        <div class="form-group">
                        	<label class="col-md-4 control-label" for="n_id_type">ID Type 
                        		<span class="text-danger">*</span>
                        	</label>
                        	<div class="col-md-8">
                        		<select id="n_id_type" name="n_id_type" class="form-control">
                        			<option value="">Please select</option>
                        			<option value="nid">NID</option>
                        			<option value="birth">Birth Certificate</option>
                        		</select>
                        		<div class = "col-md-6 error" id="ern_id_type" >
                                    
                                </div>
                                <input type = "hidden" id = "errornominee_id_type" name = "nominee_id_type" value = "" > 
                        	</div>
                        	
                        </div>
                        </div>
                        
                        
                        <div class="col-md-6" id = "n_nid_selector" >
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_nidnominee">ID No<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" id="val_nidnominee" name="val_nidnominee" class="form-control ui-wizard-content" placeholder="Nominee NID No."  aria-required="true" value="" >
                                   <div class = "col-md-10 error" id="erval_nidnominee" >
                                    
                                    </div>
                                    <input type = "hidden" id = "errornominee_id_no" name = "nominee_id_no" value = "" > 
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_pernominee">Percentage<span class="text-danger">*</span></label>
                                
                                <div class = "col-md-8">
                                    <input type="text" id="val_pernominee" name="val_pernominee" class="form-control ui-wizard-content" placeholder="Nominee Percentage"  aria-required="true" value="" >
                                  <div class = "col-md-10 error" id="erval_pernominee" >
                                    
                                    </div>
                                    <input type = "hidden" id = "errornominee_percentage" name = "nominee_percentage" value = "" > 
                                  </div>
                                  
                            </div>
                            
                        </div>
                    
                    
                    
                    <!-- Master Details !-->
                    
                    <div class="form-group form-actions">
                        <div class="col-lg-offset-11">
                            
                            <input type = "button" class="btn btn-sm btn-primary" id="add" value="Add">
                            
                           
                        </div>
                    </div>
                    <table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
                   <thead>
                      <tr>
                         <th>Nominee Name</th>
                         <th>Relation</th>
                         <th>Address</th>
                         <th>Mobile</th>
                         <th>ID No</th>
                         <th>ID Type</th>
                         <th>Percentage</th>
                         <th>Action</th>
                      </tr>
                   </thead>
                   <tbody id='recordList'></tbody>
                </table>
                              
                </fieldset>
                
                <!-- Hand Made !-->
                

                    
                    <div class="form-group form-actions">
                        <div class="col-lg-offset-10">
                            
                            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                            <button type="submit" name="insert" class="btn btn-sm btn-primary" id="add_member" value="Submit"><i class="fa fa-arrow-right"></i> Submit </button>
                            <span class="error"></span>
                           
                        </div>
                    </div>
                </form>
        </div>
    </div>
                
                
            </div>
            <!-- END Validation Block -->
        </div>



 <?php include 'include/footer.php';?> 

<!--<script type="text/javascript" src="../js/formValidation/formValidation.js"></script>       -->
 <script>
    
    function clear( ) 
    {
        $("#val_nominee").val( "" ) ;
        $("#val_relationnominee").val( "" );
        $("#val_nomineeadd").val( "" );
        $("#val_mobilenominee").val( "" );
        $("#val_nidnominee").val( "" ) ;
        $("#val_birthnominee").val( "" ) ;
        $("#val_pernominee").val( "" ) ;
        
    }
    
    function checkDuplicate( member , value  )
    {
        $.ajax( {
            
            url : "actions/check.php" ,
            method : "post",
            data : ({"member":member , "value": value } ) ,
            dataType: "html",
            success: function( Result )
            {
                
                if( Result == 1 )
                {
                    var show = "This Member ID `"+ value + "` Already Exist" ;

                    Swal.fire( show ) ;
                    
                    $("#val_memberno").focus( ) ;
                    $("#val_memberno").val("") ;
                    
                    
                }
                
            }
            
        }) ;
    }
    
    function checkMobile( mobile , value  )
    {
        $.ajax( {
            
            url : "actions/check.php" ,
            method : "post",
            data : ({"mobile":mobile , "value": value } ) ,
            dataType: "html",
            success: function( Result )
            {
                if( Result == 1 )
                {
                    var show = "This `" + value + "` is Already Exist" ;
                    Swal.fire( show ) ;
                    $("#mobile").focus( ) ;
                    $("#mobile").val("") ;
                }
                
            }
            
        }) ;
    }
    
    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
    
    $(document).ready(function()
    {
        
        //nominee Image and Sigature Option
            
            
            
            
        // end nominee Image and Signature Option
        
         var store_nom_image_name = "", store_nom_signature_name = "", nom_image_name = "", nom_signature_image = "", nom_name = ""; var nom_add = "" ; var nom_rel = ""; var nom_mob = "" ; var nom_per = "" ; var nom_id_type = "" ; var nom_id_no = "" ;
        // get Age
            
            $("#dob").on ( "change", function ( ) {
                var date = $("#dob").val( ).trim( ) ;
                var age = getAge( date.toString() ) ;
                $("#val_age").val( age ) ;
            }) ;
            
        
        // end get Age
        
        // Checking Duplicate Mobile or Member ID
        
        $("#val_memberno").on( "change", function( ) { 
            
            var value = $(this).val( ).trim() ;
            
            checkDuplicate( "member" , value ) ;
            
        }) ;
        
        $("#mobile").on( "change", function( ) { 
            
            var value = $(this).val( ).trim() ;
            checkMobile( "mobile" , value ) ;
            
        }) ;
        
        
        // end checking duplicate
        
        // adding master details value //
        
        
        
        // setting present address as permanent Address 
        
        
        $("#same").click(function() {
            if (this.checked) {
                
                var val_houseNoPresent = $("#val_houseNoPresent").val( ).trim() ;
                $("#val_villagePermanent").val( val_houseNoPresent ) ;
                
                var val_roadPresent = $("#val_roadPresent").val( ).trim() ;
                $("#val_roadPermanent").val( val_roadPresent ) ;
                
                var val_blockPresent = $("#val_blockPresent").val( ).trim() ;
                $("#val_blockPermanent").val( val_blockPresent ) ;
                
                var val_colonyPresent = $("#val_colonyPresent").val( ).trim() ;
                 $("#val_colonyPermanent").val( val_colonyPresent ) ;
                
                
                var val_districtPresent = $("#val_districtPresent").val( ).trim() ;
                console.log( val_districtPresent ) ;
                $("#val_zillaPermanent option:selected").val( val_districtPresent ) ;
                console.log( $("#val_zillaPermanent").val() ) ;
               
                
                var val_lanePresent = $("#val_lanePresent").val( ).trim() ;
                $("#val_lanePermanent").val( val_lanePresent ) ;
                
                var val_avenuePresent = $("#val_avenuePresent").val( ).trim() ;
                $("#val_avenuePermanent").val( val_avenuePresent ) ;
                
                var val_sectionPresent = $("#val_sectionPresent").val( ).trim() ;
                $("#val_sectionPermanent").val( val_sectionPresent ) ;
                
                var val_postPresent = $("#val_postPresent").val( ).trim() ;
                $("#val_postPermanent").val( val_postPresent ) ;
                
                var val_thanaPresent = $("#val_thanaPresent").val( ).trim() ;
                $("#val_thanaPermanent").val( val_thanaPresent ) ;
                
                var val_postcodePresent = $("#val_postcodePresent").val( ).trim() ;
                $("#val_postcodePermanent").val( val_postcodePresent ) ;
            }
            else
            {
                $("#val_thanaPermanent").val( "" ) ;
                $("#val_postPermanent").val( "" ) ;
                $("#val_sectionPermanent").val( "" ) ;
                $("#val_lanePermanent").val( "" ) ;
                $("#val_zillaPermanent").val( "" ) ;
                $("#val_colonyPermanent").val( "" ) ;
                $("#val_blockPermanent").val( "" ) ;
                $("#val_roadPermanent").val( "" ) ;
                $("#val_villagePermanent").val( "" ) ;
            }
        });
        
        //nominee image 
            $( "#nom_image" ).on( "change" , function( e ){
                        
                        nom_image_name = e.target.files[0].name;
                        console.log( nom_image_name ) ;
                        
                        
            }) ;
        $( "#nom_signature" ).on( "change" , function( e ){
                        
                        nom_signature_image = e.target.files[0].name;
                        console.log( nom_signature_image ) ;
            }) ;
        //end nominee image
        // Master Details
        $( "#add").on ( "click", function( ){

            
            var name = $("#val_nominee").val( ).trim( ) ;
            var relation = $("#val_relationnominee").val( ).trim( ) ;
            var address = $("#val_nomineeadd").val( ).trim( ) ;
            var mobile = $("#val_mobilenominee").val( ).trim( ) ;
            var nid = $("#val_nidnominee").val( ).trim( ) ;
            var birth =  $("#n_id_type").val( ).trim( ) ;
            var percentage = $("#val_pernominee").val( ).trim( ) ;
            
           
            //Nominee Image portion
            
                store_nom_image_name = store_nom_image_name.concat( nom_image_name ) ;
                store_nom_image_name = store_nom_image_name.concat( "#" ) ;
                
                store_nom_signature_name = store_nom_signature_name.concat( nom_signature_image ) ;
                store_nom_signature_name = store_nom_signature_name.concat( "#" ) ;
                
                //update hidden field
                
                $("#nom_image_name1").val( store_nom_image_name ) ;
                $("#nom_signature1").val( store_nom_signature_name ) ;
                
                //end update hidden field
                
                console.log( store_nom_image_name ) ;
                console.log( store_nom_signature_name ) ;
            
            //end
            
            nom_name = nom_name.concat( name ) ;
            nom_name = nom_name.concat("#") ;
            
            
            nom_rel = nom_rel.concat( relation ) ;
            nom_rel = nom_rel.concat( "#" ) ;
            
            
            nom_add = nom_add.concat( address ) ;
            nom_add = nom_add.concat("#") ;
            
            
            nom_mob = nom_mob.concat( mobile ) ;
            nom_mob = nom_mob.concat("#") ;
            
            
            nom_per = nom_per.concat( percentage ) ;
            nom_per = nom_per.concat("#") ;
            
            
            nom_id_type = nom_id_type.concat( birth ) ;
            nom_id_type = nom_id_type.concat("#") ;
            
            
            nom_id_no = nom_id_no.concat( nid ) ;
            nom_id_no = nom_id_no.concat("#") ;
            
            //updating hidden value field //
            
            $("#errornominee_name").val( nom_name ) ;
            $("#errornominee_relation").val( nom_rel ) ;
            $("#errornominee_add").val( nom_add ) ;
            $("#errornominee_mobile").val(nom_mob ) ;
            $("#errornominee_id_type").val(nom_id_type ) ;
            $("#errornominee_id_no").val(nom_id_no ) ;
            $("#errornominee_percentage").val( nom_per ) ;

            
            // master details validation 
            
            // if( percentage=="" ){
            //     $("#val_pernominee").focus();
            //     $("#erval_pernominee").text("please enter Percentage");
            //     return false;
                
            // }
            // else
            // {
            //     $("#erval_pernominee").text("");
            // }
            
            // if(address == ""){
            //     $("#val_nomineeadd").focus();
            //     $("#erval_nomineeadd").text("please enter Address");
            //     return false;
            // }
            // else
            // {
            //     $("#erval_nomineeadd").text("");
            // }
            // if(relation==""){
            //     $("#val_relationnominee").focus();
            //     $("#erval_relationnominee").text("please enter Relation");
            //     return false;
            // }
            // else
            // {
            //     $("#erval_relationnominee").text("");
            // }
            
            // if( name ==""){
            //     $("#val_nominee").focus();
            //     $("#erval_nominee").text("please enter Relation");
            //     return false;
            // }
            // else
            // {
            //     $("#erval_nominee").text("");
            // }
            // if( mobile ==""){
            //     $("#val_mobilenominee").focus();
            //     $("#erval_mobilenominee").text("please enter Mobile Number");
            //     return false;
            // }
            // else
            // {
            //     $("#erval_mobilenominee").text("");
            // }
            
            // if( $("#n_id_type").val( ).trim( ) == "" )
            // {
            //     $( "#n_id_type").focus( ) ;
            //     $("#ern_id_type").text("please Select One");
            //     return false ;
            // }
            // else
            // {
            //     $("#ern_id_type").text("");
            // }
            // if( nid == "" )
            // {
            //     $( "#val_nidnominee").focus( ) ;
            //     $("#erval_nidnominee").text("please enter ID No");
            //     return false ;
            // }
            // else
            // {
            //     $("#erval_nidnominee").text("");
            // }
            
            
            //End master details validation
            
            
            var html = "" ;
            var inner = "" ;
            html += "<tr>" ;
            inner += "<td>"+name+"</td>" ;
            inner += "<td>"+relation+"</td>" ;
            inner += "<td>"+address+"</td>" ;
            inner += "<td>"+mobile+"</td>" ;
            inner += "<td>"+nid+"</td>" ;
            inner += "<td>"+birth+"</td>" ;
            inner += "<td>"+percentage+"</td>" ;
            inner += "<td> <a nominee_name = '"+name+"' nominee_relation = '"+relation+"' nominee_address = '"+ address +"' nominee_mobile = '"+ mobile +"' nominee_nid = '"+ nid +
                        
                      "' nominee_birth = '"+ birth +"' nominee_percentage = '"+ percentage +"' class='can_edit btn btn-primary' style='cursor: pointer;'>Edit</a><a nominee_name = '"+name+"' nominee_relation = '"+relation+"' nominee_address = '"+ address +"' nominee_mobile = '"+ mobile +"' nominee_nid = '"+ nid +
                        
                      "' nominee_birth = '"+ birth +"' nominee_percentage = '"+ percentage +"' class='can_delete btn btn-danger' style='cursor: pointer;'>Delete</a></td>";
            html += inner ;
            html += "</tr>";
            
            if( $(this).val() == "Add" ) 
            {
                $("#recordList").append(html) ;
                $("#hidden").append(html) ;
            }
            else
            {
                $("#recordList tr").each( function( ){
                    if( $(this).attr("is_edit") == 1 )
                    {
                        $(this).html(inner) ;
                        $("#add").val("Add") ;
                    }
                    else if( $( this ).attr("is_delete") == 1 )
                    {
                        $("#add").val("Add") ;
                    }
                }) ;
            }
            clear( ) ;
        }) ;
        
        $( document ).on ( "click", ".can_edit", function( ) 
        {
            
            $("#recordList tr").each( function( ){
                
                $(this).removeAttr("is_edit") ;
                
            }) ;
            
            $(this).closest('tr').attr('is_edit' , 1 ) ;
            $("#val_nominee").val( $(this).attr( "nominee_name" ) );
            $("#val_relationnominee").val( $(this).attr( "nominee_relation" ) );
            $("#val_nomineeadd").val( $(this).attr( "nominee_address" ) );
            $("#val_mobilenominee").val( $(this).attr( "nominee_mobile" ) );
            $("#val_nidnominee").val( $(this).attr( "nominee_nid" ) );
            $("#val_birthnominee").val( $(this).attr( "nominee_birth" ) );
            $("#val_pernominee").val( $(this).attr( "nominee_percentage" ) );
            $("#add").val("Update") ;
            
        }) ;
        
        // End master details
        
        $("#add_member").on( "click", function( ){ 
            
            var name = [] ;
            var relation = [] ;
            var address = [] ;
            var mobile = [] ;
            var nid = [] ;
            var birth = [] ;
            var percentage = [] ;
            name.push( $( this ).attr('"#val_nominee"') ) ;
            relation.push( $( this ).attr('"#val_relationnominee"') ) ;
            address.push( $( this ).attr('"#val_nomineeadd"') ) ;
           
            mobile.push( $( this ).attr('"#val_mobilenominee"') ) ;
            nid.push( $( this ).attr('"#val_nidnominee"') ) ;
            birth.push( $( this ).attr('"#val_birthnominee"') ) ;
            percentage.push( $( this ).attr('"#val_pernominee"') ) ;
            
            $.post( "actions/master.php", { n_name : name, n_relation:relation , n_address : address, n_mobile: mobile, n_id: nid , n_id_type : birth,
                  n_percentage: percentage }, function ( data ){ 
                      if( data == 1 )
                      {
                          alert( "yes!" ) ;
                      }
                      
                  }) ;
        }) ;
        
        
        
        
        

        <?php
        if( isset($_SESSION['msgPositive']) == "success" ) 
                    {?>
                        
                        Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Recorded!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msgPositive']) ;
            }
            else if( isset($_SESSION['msgPositive']) == "error" ) { ?>

                 Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msgPositive']) ;
                
             }?>
    });
 </script>

