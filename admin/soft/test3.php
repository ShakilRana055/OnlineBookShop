<?php include 'include/header.php';?>
<?php $table_heading = "Upazila Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<form class='cmxform form-horizontal'>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-3'>Address </label>
      <div class='col-lg-5'><input class='form-control field_data' name='ADDRESS' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='EMAIL' class='control-label col-lg-3'>Email </label>
      <div class='col-lg-5'><input class='form-control field_data' name='EMAIL' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'><input type='button' class='btn btn-primary' table_name='Gen_Registers' id='btnAdd' value='Save'/></div>
   </div>
</form>
<form class='cmxform form-horizontal'>
   <fieldset class='scheduler-border'>
      <legend class='scheduler-border'>Search</legend>
      <div class='form-group '>
         <div class='form-group'>
            <label for='srcADDRESS' class='control-label col-lg-3'>Address</label>
            <div class='col-lg-5'><input class='form-control src_data' name='ADDRESS' type='text' is_double = '0' maxlength = '255'/></div>
         </div>
         <div class='form-group'>
            <label for='srcEMAIL' class='control-label col-lg-3'>Email</label>
            <div class='col-lg-5'><input class='form-control src_data' name='EMAIL' type='text' is_double = '0' maxlength = '255'/></div>
         </div>
         <label for='location' class='control-label col-lg-3'></label>
         <div class=' col-lg-5'><input type='button' table_name = 'Gen_Registers' class='btn btn-primary pull-right' id='btnSearch' value='Search' /></div>
      </div>
   </fieldset>
</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>#</th>
         <th>Address</th>
         <th>Email</th>
         
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'></tbody>
</table>
<?php include 'include/footer.php';?>
