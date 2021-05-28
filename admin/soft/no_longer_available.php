<?php include 'include/header.php';?>
    <?php $table_heading = "Student Admission";?>
        <?php include 'include/sidebar.php';?>
            <?php include 'include/body-top.php';?>
                <h2 id="forms-example" class="">Admission Form</h2>

                <form class='cmxform form-horizontal'>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Student Information:</legend>

                        <div class="col-md-6">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Full Name: </label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' type="text" placeholder="Full Name" id="student_name" required="" value='' />
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Home Address: </label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' type="text" placeholder="Your Address" id="student_address" required="" value='' />
                                </div>
                            </div>

                        </div>

                        <!--  <div class="vali-form" id="group_area" style="display:none">
    </div> -->
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Present School:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' type="text" placeholder="Present School" id="student_present_school" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'> Present Class:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Class id" id="student_present_class" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Mobile No:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="01*********" id="student_phone" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Email:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Ex: email@gmail.com" id="student_email" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>

                    </fieldset>

                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>General Information:</legend>

                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Gender/Sex:</label>
                                <div class='col-lg-8'>
                                    <select class='form-control field_data' id="student_gender">
                                        <option value='-1'>--Select--</option>
                                        <?php
                //$sql = "SELECT CLASS_NO, CLASS_NAME,HAS_GROUP FROM adm_class WHERE IS_ACTIVE = 1 ORDER BY ORDER_BY ASC";
                //$query = mysqli_query($con,$sql);
                //while($row = mysqli_fetch_array($query)):
                // echo "<option value='".$row['CLASS_NO']."' HAS_GROUP = '".$row['HAS_GROUP']."'>".$row['CLASS_NAME']."</option>";
                // endwhile;
            ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Date Of Birth:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' type="date" placeholder="Your Birthdate" id="student_birth" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Nationality</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="nationality" id="student_nationality" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Religion:</label>
                                <div class='col-lg-8'>
                                    <select class="form-control field_data" id="religion">
                                        <option>--Select--</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hinduism">Hinduism</option>
                                        <option value="Christianity">Christianity</option>
                                        <option value="Buddhism">Buddhism</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>TC Details</label>
                                <div class='col-lg-8'>
                                    <textarea rows="4" cols="50" id="tcDetails">

                                    </textarea>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Fathers Information:</legend>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Father Name</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' type="text" placeholder="Father Name" id="stu_father_name" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Mobile</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="ex: 01*********" id="stu_father_mobile" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Qualification</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Qualification" id="stu_father_qualification" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Occupation</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Occupation" id="stu_father_occupa" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Designation</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Designation" id="stu_father_deg" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Address</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Address" id="stu_father_address" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Income(P/Y)</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Income" id="stu_father_income" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Email</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Ex: email@gmail.com" id="stu_father_email" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>

                    </fieldset>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Mothers Information:</legend>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Mother Name</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' type="text" placeholder="Mother Name" id="stu_mother_name" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Mobile</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="ex: 01*********" id="stu_mother_mobile" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Qualification</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Qualification" id="stu_mother_qualification" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Occupation</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Occupation" id="stu_mother_occupa" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Designation</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Designation" id="stu_mother_deg" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Address</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Address" id="stu_mother_address" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Income(P/Y)</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Income" id="stu_mother_income" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Email</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Ex: email@gmail.com" id="stu_mother_email" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Guardian/Emergency Contact:</legend>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Name </label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder=" Name" id="stu_guardian_name" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Relation</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="relation" id="stu_guardian_relation" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Mobile No:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="ex: 01*********" id="stu_guardian_mobile" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Email</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Ex: email@gmail.com" id="stu_guardian_email" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Occupation</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Occupation" id="stu_guardian_occupa" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Address</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Address" id="stu_guardian_address" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>

                    </fieldset>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Sibling Information:</legend>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Sibling Name</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Sibling Name" id="stu_sibling_name" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Sibling school Name </label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Sibling school Name" id="stu_sibling_school" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Class</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="class" id="stu_sibling_class" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Session</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Session" id="stu_sibling_session" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>

                    </fieldset>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Medical Information:</legend>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Blood Group:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="ex: A+" id="stu_medical_group" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Medical Issue/Problem(if Any):</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="medical problem details" id="stu_medical_problem" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>

                    </fieldset>
                    <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>(Office Use Only):</legend>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Student Name:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="name" id="office_student_name" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Class</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Student class" id="office_student_class" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Campus</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Student Campus" id="office_student_campus" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Shift</label>
                                <div class='col-lg-8'>
                                    <select class="form-control" id="office_student_shift" required="">
                                        <option>--Select--</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Evening">Evening</option>

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Section</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Section" id="office_student_section" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Group</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Group" id="office_student_group" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Roll No:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="ex: 12435265" id="office_student_roll" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Admission Date</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Admission Date" id="office_student_date" type="date" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Addmission fees</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Addmission fee" id="office_student_admissionFee" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Form fee:</label>
                                <div class='col-lg-8'>
                                    <input class='form-control field_data' placeholder="Fee" id="office_student_formfee" type="text" required="" value='' />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'>Version:</label>
                                <div class='col-lg-8'>
                                    <select class="form-control" id="office_student_version" required="">
                                        <option>--Select--</option>
                                        <option value="Bangla">Bangla</option>
                                        <option value="English">English</option>

                                    </select>
                                </div>

                            </div>
                        </div>

                    </fieldset>
                    
                    <div class="col-md-6 ">
                            <div class='form-group'>
                                <label class='control-label col-lg-4'></label>
                                <div class='col-lg-8'>
                                    
                                    <a href="admissionForm.php" target="_blank" class="btn btn-primary pull-right">Admission Form Download</a>
                                </div>

                            </div>
                        </div>
                    <button type="button" class="btn btn-success pull-right" id="btnSubmit">Submit</button>
                    <a href="index.php?page=" class="btn btn-primary pull-right">Cancel</a>
                    </div>
                    <div class="clearfix"> </div>
                </form>
                <?php include 'include/footer.php';?>
                    <style>
                        .class-section,
                        .class-group {
                            display: none;
                        }
                    </style>

                    <script>
                        $(document).ready(function() {
                            $("#btnSubmit").on("click", function() {
                                var student_name = $("#student_name").val().trim();
                                var student_address = $("#student_address").val().trim();
                                var student_present_school = $("#student_present_school").val().trim();
                                var student_present_class = $("#student_present_class").val().trim();
                                var student_phone = $("#student_phone").val().trim();
                                var student_email = $("#student_email").val().trim();
                                var student_gender = $("#student_gender").val().trim();
                                var student_birth = $("#student_birth").val().trim();
                                var student_nationality = $("#student_nationality").val().trim();
                                var religion = $("#religion").val().trim();
                                var tcDetails = $("#tcDetails").val().trim();
                                var stu_father_name = $("#stu_father_name").val().trim();
                                var stu_father_mobile = $("#stu_father_mobile").val().trim();
                                var stu_father_qualification = $("#stu_father_qualification").val().trim();
                                var stu_father_occupa = $("#stu_father_occupa").val().trim();
                                var stu_father_deg = $("#stu_father_deg").val().trim();
                                var stu_father_address = $("#stu_father_address").val().trim();
                                var stu_father_income = $("#stu_father_income").val().trim();
                                var stu_father_email = $("#stu_father_email").val().trim();
                                var stu_mother_name = $("#stu_mother_name").val().trim();
                                var stu_mother_mobile = $("#stu_mother_mobile").val().trim();
                                var stu_mother_qualification = $("#stu_mother_qualification").val().trim();
                                var stu_mother_occupa = $("#stu_mother_occupa").val().trim();
                                var stu_mother_deg = $("#stu_mother_deg").val().trim();
                                var stu_mother_address = $("#stu_mother_address").val().trim();
                                var stu_mother_income = $("#stu_mother_income").val().trim();
                                var stu_mother_email = $("#stu_mother_email").val().trim();
                                var stu_guardian_name = $("#stu_guardian_name").val().trim();
                                var stu_guardian_relation = $("#stu_guardian_relation").val().trim();
                                var stu_guardian_mobile = $("#stu_guardian_mobile").val().trim();
                                var stu_guardian_email = $("#stu_guardian_email").val().trim();
                                var stu_guardian_occupa = $("#stu_guardian_occupa").val().trim();
                                var stu_guardian_address = $("#stu_guardian_address").val().trim();
                                var stu_sibling_name = $("#stu_sibling_name").val().trim();
                                var stu_sibling_school = $("#stu_sibling_school").val().trim();
                                var stu_sibling_class = $("#stu_sibling_class").val().trim();
                                var stu_sibling_session = $("#stu_sibling_session").val().trim();
                                var stu_medical_group = $("#stu_medical_group").val().trim();
                                var stu_medical_problem = $("#stu_medical_problem").val().trim();
                                var office_student_name = $("#office_student_name").val().trim();
                                var office_student_class = $("#office_student_class").val().trim();
                                var office_student_campus = $("#office_student_campus").val().trim();
                                var office_student_shift = $("#office_student_shift").val().trim();
                                var office_student_section = $("#office_student_section").val().trim();
                                var office_student_group = $("#office_student_group").val().trim();
                                var office_student_roll = $("#office_student_roll").val().trim();
                                var office_student_date = $("#office_student_date").val().trim();
                                var office_student_admissionFee = $("#office_student_admissionFee").val().trim();
                                var office_student_formfee = $("#office_student_formfee").val().trim();
                                var office_student_version = $("#office_student_version").val().trim();

                                $.post("ajax/aca_student_admission.php", {
                                    student_name: student_name,
                                    student_address: student_address,
                                    student_present_school: student_present_school,
                                    student_present_class: student_present_class,
                                    student_phone: student_phone,
                                    student_email: student_email,
                                    student_gender: student_gender,
                                    student_birth: student_birth,
                                    student_nationality: student_nationality,
                                    religion: religion,
                                    tcDetails: tcDetails,
                                    stu_father_name: stu_father_name,
                                    stu_father_mobile: stu_father_mobile,
                                    stu_father_qualification: stu_father_qualification,
                                    stu_father_occupa: stu_father_occupa,
                                    stu_father_deg: stu_father_deg,
                                    stu_father_address: stu_father_address,
                                    stu_father_income: stu_father_income,
                                    stu_father_email: stu_father_email,
                                    stu_mother_name: stu_mother_name,
                                    stu_mother_mobile: stu_mother_mobile,
                                    stu_mother_qualification: stu_mother_qualification,
                                    stu_mother_occupa: stu_mother_occupa,
                                    stu_mother_deg: stu_mother_deg,
                                    stu_mother_address: stu_mother_address,
                                    stu_mother_income: stu_mother_income,
                                    stu_mother_email: stu_mother_email,
                                    stu_guardian_name: stu_guardian_name,
                                    stu_guardian_relation: stu_guardian_relation,
                                    stu_guardian_mobile: stu_guardian_mobile,
                                    stu_guardian_email: stu_guardian_email,
                                    stu_guardian_occupa: stu_guardian_occupa,
                                    stu_guardian_address: stu_guardian_address,
                                    stu_sibling_name: stu_sibling_name,
                                    stu_sibling_school: stu_sibling_school,
                                    stu_sibling_class: stu_sibling_class,
                                    stu_sibling_session: stu_sibling_session,
                                    stu_medical_group: stu_medical_group,
                                    stu_medical_problem: stu_medical_problem,
                                    office_student_name: office_student_name,
                                    office_student_class: office_student_class,
                                    office_student_campus: office_student_campus,
                                    office_student_shift: office_student_shift,
                                    office_student_section: office_student_section,
                                    office_student_group: office_student_group,
                                    office_student_roll: office_student_roll,
                                    office_student_date: office_student_date,
                                    office_student_admissionFee: office_student_admissionFee,
                                    office_student_formfee: office_student_formfee,
                                    office_student_version: office_student_version
                                }, function(data) {
                                    swal("Added Successfully!", "", "success");
                                    window.location.replace("index.php?page=aca_student_admission");
                                });
                                return false;
                            });

                        });
                    </script>