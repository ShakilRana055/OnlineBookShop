<?php include 'include/header.php';?>
<?php $table_heading = "Member Registration Form";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<style type="text/css">
    .error {
        color: red;
    }
</style>


<div class="block" style="margin-left:20px; margin-right:20px;">
                <!-- Basic Form Elements Title -->
                <div class="block-title">

                <!-- END Form Elements Title -->
                
                <!-- Basic Form Elements Content -->
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
                        <label class="col-md-3 control-label" for="example-text-input">Mobile No.</label>
                        <div class="col-md-6">
                            <input type="text" id="MOBILE_NO" name="MOBILE_NO" class="form-control" placeholder="Please Enter Mobile Number">
                            
                        </div>
                    </div>


                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
                            <span id = "error" > </span>
                            </div>

                            </div>
                    </fieldset>
                </form>
               </div>


<div id="page-content">

    <!-- Datatables Content -->
    <div class="block full">
       
        <fieldset class="scheduler-border">
            <legend class="scheduler-border"> Search Result </legend>
        
        <div class="table-responsive">
            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Member No </th>
                        
                        <th class="text-center"> Name </th>
                        <th class="text-center"> Mobile/Phone </th>
                        
                        <th class="text-center"> Address </th>
                    </tr>
                </thead>
                <tbody>
                   <!-- something to do here !-->

                        <?php 
                            include ( "../config/db_connection.php" ) ;
                            if( isset($_POST['search'] ) ) 
                            {
                                $query = "";
                                $mobile = $_POST[ 'MOBILE_NO' ] ;
                                $member = $_POST[ 'MEMBER_NO' ] ;
                                if( $member != NULL )
                                {
                                     $query = "SELECT * FROM member_profiles INNER JOIN members ON member_profiles.MEMBER_NO = members.MEMBER_NO WHERE members.MEMBER_ID = '$member'" ;
                                }
                                else if( $mobile != NULL)
                                {
                                    $query = "select * from member_profiles where MOBILE = '$mobile'" ;
                                }
                               
                                
                                if( $query != "" )
                                {
                                    $result = mysqli_query( $con , $query ) ;
                                    foreach ($result as $value) 
                                    {
                                        echo "<tr>";
                                            //$_SESSION['MEMBER_ID'] = $value['MEMBER_ID'] ;

                                            echo "<td>".$value['MEMBER_NO']. "</td>";
                                            echo "<td>".$value['FULL_NAME']."</a></td>";
                                            //echo "<td>".$value['FULL_NAME']. "</td>";
                                            echo "<td>".$value['MOBILE']. "</td>";
                                            echo "<td>".$value['PERMANENT_THANA']. ", ".$value['PERMANENT_DISTRICT']."</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        ?>


                </tbody>
            </table>
        </div>
        </fieldset>
    </div>
    <!-- END Datatables Content -->
</div>
<!-- END Page Content -->
</div>


<div >
            <!-- Form Validation Example Block -->
            <div class="block">
                <!-- Form Validation Example Title -->
                <div class="block-title" style="text-align:center">
                    
                </div>
                <!-- END Form Validation Example Title -->

                <!-- Form Validation Example Content -->
    <form id="form-validation" action="actions/account_transfer_action.php" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data" >
                    
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Transfer Information</legend>
                        <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Transfer Reason<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="reason" name="reason" class="form-control" placeholder="Transfer Reason">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Member ID<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="pre_member" name="pre_member" class="form-control" placeholder="Member ID">
                            
                        </div>
                    </div>
                    </fieldset>
                    
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"> <strong>Personal Information</strong></legend>
                        
                        <div class="col-sm-6">
                            <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname">Full Name <span class="text-danger">*</span> </label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" placeholder="Member's Full Name" value="" >
                                    
                                
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_FHname">Father/Husband Name<span class="text-danger">*</span> </label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_FHname" name="val_FHname" class="form-control ui-wizard-content" placeholder="Member's Father/Husband Name " aria-required="true" value="" tabindex="3">
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_nationality">Nationality</label>
                            <div class="col-md-6">
                                
                            <select class="form-control" name="val_nationality" id="val_nationality" tabindex="5">
                                <option value="Bangladesh">Bangladeshi</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="India">India</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Srilanka">Srilanka</option>
                                
                              </select>
                                
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_occupation">Occupation<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_occupation" name="val_occupation" class="form-control ui-wizard-content" placeholder="Member's Occupation" aria-required="true" value="" tabindex="7">
                                    
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_education">Educational<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_education" name="val_education" class="form-control ui-wizard-content" placeholder="Member's Education" aria-required="true" value="" tabindex="9">
                                    
                               
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_guardian">Guardian's Name<span class="text-danger">*</span> </label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_guardian" name="val_guardian" class="form-control ui-wizard-content" placeholder="Guardian's Name" required="" aria-required="true" value="" tabindex="11">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mobile"> Mobile/Phone <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="mobile" name="mobile" class="form-control ui-wizard-content" placeholder="Mobile/Phone Number" required="" aria-required="true" value="" tabindex="11">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="dob"> Date of Birth <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="date" id="dob" name="dob" class="form-control ui-wizard-content" placeholder="" required="" aria-required="true" value="" tabindex="11">
                                
                            </div>
                        </div>
                        
                    </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="val_memberno">Member ID<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_memberno" name="val_memberno" class="form-control ui-wizard-content" placeholder="Add Member ID" required="" aria-required="true" value="" tabindex="2">
                                    
                               
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_mothername">Mother Name<span class="text-danger">*</span> </label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_mothername" name="val_mothername" class="form-control ui-wizard-content" placeholder="Member's Mother Name " required="" aria-required="true" value="" tabindex="4">
                                    
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_religion">Religion </label>
                            <div class="col-md-6">
                                
                                <select class="form-control" name="val_religion" id="val_religion" tabindex="6">
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
                            <label class="col-md-4 control-label" for="val_age">Age<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="number" step="any" id="val_age" name="val_age" class="form-control ui-wizard-content" placeholder="Member's Age" required="" aria-required="true" value="" tabindex="8">
                                    
                               
                            </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="example-textarea-input">Technical Skills</label>
                        <div class="col-md-6">
                            
                            <textarea id="val_skills" name="val_skills" rows="1" class="form-control" placeholder="Member technial skills" tabindex="10"></textarea>
                            
                        </div>
                        
                    </div>
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_relationguardian">Relation (Guardian)<span class="text-danger">*</span> </label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_relationguardian" name="val_relationguardian" class="form-control ui-wizard-content" placeholder="Relation With Guardian" required="" aria-required="true" value="" tabindex="12">
                                    
                              
                            </div>
                        </div>
                        
                        <div class="form-group">
                        	<label class="col-md-4 control-label" for="id_type">ID Type 
                        		<span class="text-danger">*</span>
                        	</label>
                        	<div class="col-md-6">
                        		<select id="id_type" name="id_type" class="form-control">
                        			<option value="">Please select</option>
                        			<option value="nid">NID</option>
                        			<option value="birth">Birth Certificate</option>
                        		</select>
                        	</div>
                        </div>
                        
                        <div class="form-group" id = "nid_selector" style = "display:none;">
                            <label class="col-md-4 control-label" for="nid"> NID <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="nid" name="nid" class="form-control ui-wizard-content" placeholder="NID number" required="" aria-required="true" value="" tabindex="11">
                                
                            </div>
                        </div>
                        
                        <div class="form-group" id = "birth_selector" style = "display:none;">
                            <label class="col-md-4 control-label" for="birth_certificate"> Birth Certificate <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="text" id="birth_certificate" name="birth_certificate" class="form-control ui-wizard-content" placeholder="Birth Certificate Number" required="" aria-required="true" value="" tabindex="11">
                                
                            </div>
                        </div>
                        
                        </div>

                </fieldset>
                        <!-- hand made !-->
                        
                 <!--address details-->
                 <fieldset class="scheduler-border">
                 <legend class="scheduler-border"><strong>Permanent Address</strong></legend>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_villagePermanent">Village<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_villagePermanent" name="val_villagePermanent" class="form-control ui-wizard-content" placeholder="Enter village name" value="" aria-required="true" tabindex="18">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postPermanent">Post Office<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_postPermanent" name="val_postPermanent" class="form-control ui-wizard-content" placeholder="Enter post name" required="" value="" aria-required="true" tabindex="19">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postcodePermanent">Post Code<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_postcodePermanent" name="val_postcodePermanent" value="" class="form-control ui-wizard-content" placeholder="Enter Post code" required="" aria-required="true" tabindex="22">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_thanaPermanent">Thana/Sub-district<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_thanaPermanent" name="val_thanaPermanent" class="form-control ui-wizard-content" placeholder="enter Thana/upozilla name" required="" value="" aria-required="true" tabindex="20">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_districtPermanent">District<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_zillaPermanent" name="val_districtPermanent" value="" class="form-control ui-wizard-content" placeholder="Enter District name" required="" aria-required="true" tabindex="21">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    
                    
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><strong>Present Address</strong></legend>
                        <div>
                        <input type = "button" id = "same" value = "Same" name = "same" class = "btn btn-primary">
                        <input type = "button" id = "cancel1" value = "Cancel" name = "same" class = "btn btn-danger">
                        </div>
                    <div class="col-sm-6">
                     <div class="form-group">
                            <label class="col-md-4 control-label" for="val_houseNoPresent">Village/House No.<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_houseNoPresent" name="val_houseNoPresent" value="" class="form-control ui-wizard-content" placeholder="Enter House no" required="" aria-required="true" tabindex="23">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_roadPresent">Road</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_roadPresent" value="" name="val_roadPresent" class="form-control ui-wizard-content" placeholder="Enter Road info/no."  aria-required="true" tabindex="25">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_blockPresent">Block</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_blockPresent" value="" name="val_blockPresent" class="form-control ui-wizard-content" placeholder="Enter block info"  aria-required="true" tabindex="27">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_colonyPresent">Colony</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_colonyPresent" value="" name="val_colonyPresent" class="form-control ui-wizard-content" placeholder="Enter colony"  aria-required="true" tabindex="29">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_districtPresent">District<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_districtPresent" value="" name="val_districtPresent" class="form-control ui-wizard-content" placeholder="Enter district name" required="" aria-required="true" tabindex="31">
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                </div>
                        
                <div class="col-sm-6">
  
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_lanePresent">Lane No.</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_lanePresent" value="" name="val_lanePresent" class="form-control ui-wizard-content" placeholder="Enter lane number"  aria-required="true" tabindex="24">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_avenuePresent">Avenue</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_avenuePresent" value="" name="val_avenuePresent" class="form-control ui-wizard-content" placeholder="Enter avenue name"  aria-required="true" tabindex="26">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_sectionPresent">Section</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_sectionPresent" value="" name="val_sectionPresent" class="form-control ui-wizard-content" placeholder="Enter section"  aria-required="true" tabindex="28">
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_thanaPresent">Thana<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_thanaPresent" value="" name="val_thanaPresent" class="form-control ui-wizard-content" placeholder="Enter Thana name" required="" aria-required="true" tabindex="30">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_postPresent">Post Code<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="val_postPresent" value="" name="val_postPresent" class="form-control ui-wizard-content" placeholder="Enter Post code" required="" aria-required="true" tabindex="32">
                                    
                                </div>
                            </div>
                        </div>
                        
                </div>
                        
                    
            </fieldset>
                 
                 <fieldset class = "scheduler-border">
                     <legend class = "scheduler-border"> Image Upload </legend>
                     
                     <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-4 control-label" for="image">Photo <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
                                    <input type="file" id="image" name="image"  >
                                    
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-md-4 control-label" for="signature">Signature<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                
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
                            <div class="col-md-6">
                                
                                    <input type="text" id="val_nominee" name="val_nominee" class="form-control ui-wizard-content" placeholder="Nominee Name"  aria-required="true" value="" tabindex="13">
                                    <div class = "col-md-10 error" id="erval_nominee" >
                                    
                                    </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="val_relationnominee">Relation(Nominee)<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                               
                                    <input type="text" id="val_relationnominee" name="val_relationnominee" class="form-control ui-wizard-content" placeholder="Relation With nominee"  aria-required="true" value="" tabindex="14">
                                    <div class = "col-md-10 error" id="erval_relationnominee" >
                                    
                                    </div>
                               
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="val_nomineeadd">Nominee Address<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <textarea id="val_nomineeadd" name="val_nomineeadd" rows="1" class="form-control" placeholder="Full nominee address" tabindex="15"></textarea>
                            <div class = "col-md-10 error" id="erval_nomineeadd" >
                                    
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                              <div class="form-group">
                            
                                <label class="col-md-4 control-label" for="val_mobilenominee">Mobile<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="val_mobilenominee" name="val_mobilenominee" class="form-control ui-wizard-content" placeholder="Nominee Mobile No." aria-required="true" value="" tabindex="17">
                                   <div class = "col-md-10 error" id="erval_mobilenominee" >
                                    
                                    </div>
                                
                                </div>
                            
                            </div>
                        </div>
                        
                        <div class = "col-md-6">
                        <div class="form-group">
                        	<label class="col-md-4 control-label" for="n_id_type">ID Type 
                        		<span class="text-danger">*</span>
                        	</label>
                        	<div class="col-md-6">
                        		<select id="n_id_type" name="n_id_type" class="form-control">
                        			<option value="">Please select</option>
                        			<option value="nid">NID</option>
                        			<option value="birth">Birth Certificate</option>
                        		</select>
                        		<div class = "col-md-6 error" id="ern_id_type" >
                                    
                                </div>
                        	</div>
                        	
                        </div>
                        </div>
                        
                        
                        <div class="col-md-6" id = "n_nid_selector" >
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_nidnominee">ID No<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" id="val_nidnominee" name="val_nidnominee" class="form-control ui-wizard-content" placeholder="Nominee NID No."  aria-required="true" value="" tabindex="16">
                                   <div class = "col-md-10 error" id="erval_nidnominee" >
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_relationnominee">Percentage<span class="text-danger">*</span></label>
                                
                                <div class = "col-md-6">
                                    <input type="text" id="val_pernominee" name="val_pernominee" class="form-control ui-wizard-content" placeholder="Nominee Percentage"  aria-required="true" value="" tabindex="16">
                                  <div class = "col-md-10 error" id="erval_pernominee" >
                                    
                                    </div>
                                  </div>
                                  
                            </div>
                            
                        </div>
                    
                    <!-- Master Details !-->
                    
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-5">
                            
                            <input type = "button" class="btn btn-sm btn-primary" id="add" value="Add">
                            <!--<button type="submit"  class="btn btn-sm btn-primary" id="add" value="Add">Add </button>-->
                            <!--<span class="error"></span>-->
                           
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
                        <div class="col-md-8 col-md-offset-5">
                            
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

<script type="text/javascript" src="../js/formValidation/formValidation.js"></script>       
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
    
    $(document).ready(function()
    {
        
        // setting present address as permanent Address 
        
        $( "#same").on( "click", function ( )
        {
            console.log( "here") ;
            var val_villagePermanent = $("#val_villagePermanent").val( ).trim() ;
            var val_postPermanent = $("#val_postPermanent").val( ).trim() ;
            var val_postcodePermanent = $("#val_postcodePermanent").val( ).trim() ;
            var val_thanaPermanent = $("#val_thanaPermanent").val( ).trim() ;
            var val_zillaPermanent = $("#val_zillaPermanent").val( ).trim() ;
            console.log( val_villagePermanent ) ;
            $("#val_houseNoPresent").val( val_villagePermanent ) ;
            
            $("#val_postPresent").val( val_postcodePermanent ) ;
            $("#val_thanaPresent").val( val_thanaPermanent ) ;
            $("#val_districtPresent").val( val_zillaPermanent ) ;
            
        }) ;
        
        // Cancel Present address from permanent 
        $( "#cancel1" ).on ( "click" , function ( )
        {
                 $("#val_houseNoPresent").val( "" ) ;
                
                $("#val_postPresent").val( "" ) ;
                $("#val_thanaPresent").val( "" ) ;
                $("#val_districtPresent").val( "" ) ;
                    
        }) ;
        // Master Details
        $( "#add").on ( "click", function( ){

            
            var name = $("#val_nominee").val( ).trim( ) ;
            var relation = $("#val_relationnominee").val( ).trim( ) ;
            var address = $("#val_nomineeadd").val( ).trim( ) ;
            var mobile = $("#val_mobilenominee").val( ).trim( ) ;
            var nid = $("#val_nidnominee").val( ).trim( ) ;
            var birth =  $("#n_id_type").val( ).trim( ) ;
            var percentage = $("#val_pernominee").val( ).trim( ) ;
            
       
            
            // master details validation 
            
            if(percentage==""){
                $("#val_pernominee").focus();
                $("#erval_pernominee").text("please enter Percentage");
                return false;
                
            }
            else
            {
                $("#erval_pernominee").text("");
            }
            
            if(address == ""){
                $("#val_nomineeadd").focus();
                $("#erval_nomineeadd").text("please enter Address");
                return false;
            }
            else
            {
                $("#erval_nomineeadd").text("");
            }
            if(relation==""){
                $("#val_relationnominee").focus();
                $("#erval_relationnominee").text("please enter Relation");
                return false;
            }
            else
            {
                $("#erval_relationnominee").text("");
            }
            
            if( name ==""){
                $("#val_nominee").focus();
                $("#erval_nominee").text("please enter Relation");
                return false;
            }
            else
            {
                $("#erval_nominee").text("");
            }
            if( mobile ==""){
                $("#val_mobilenominee").focus();
                $("#erval_mobilenominee").text("please enter Mobile Number");
                return false;
            }
            else
            {
                $("#erval_mobilenominee").text("");
            }
            
            if( $("#n_id_type").val( ).trim( ) == "" )
            {
                $( "#n_id_type").focus( ) ;
                $("#ern_id_type").text("please Select One");
                return false ;
            }
            else
            {
                $("#ern_id_type").text("");
            }
            if( nid == "" )
            {
                $( "#val_nidnominee").focus( ) ;
                $("#erval_nidnominee").text("please enter ID No");
                return false ;
            }
            else
            {
                $("#erval_nidnominee").text("");
            }
            
            
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
                  n_percentage: percentage  }, function ( data ){ 
                      if( data == 1 )
                      {
                          alert( "yes!" ) ;
                      }
                      
                  }) ;
        }) ;
        
        
        
        $("#id_type").on( "change" , function( )
        {
            var selector = $("#id_type option:selected").val( ) ;
            
            if( selector == "nid" )
            {
                $("#nid_selector").show( ) ;
                $("#birth_selector").hide( ) ;
            }
            else if( selector == "birth")
            {
                $("#nid_selector").hide( ) ;
                $("#birth_selector").show( ) ;
            }
            else
            {
                $("#nid_selector").hide( ) ;
                $("#birth_selector").hide( ) ;
            }
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
                          title: 'Successfully Recorded!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msgPositive']) ;
                
             }?>
    });
 </script>

