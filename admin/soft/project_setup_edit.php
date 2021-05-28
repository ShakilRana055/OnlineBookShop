<?php include 'include/header.php';?>
<?php $table_heading = "Project Expnese";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$member_no = $_GET['member_no'];
$project_no = $_GET['project_no'];

$query = "SELECT * FROM projects INNER JOIN member_profiles ON member_profiles.MEMBER_NO = projects.RESPONSIBLE_MEMBER_NO where projects.PROJECT_NO='$project_no' AND projects.RESPONSIBLE_MEMBER_NO='$member_no'" ;
$result = mysqli_query ( $con , $query ) ;
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $project_name = $_POST['project_name'];
    $location = $_POST['location'];
    $project_detail = $_POST['project_detail'];
    $start_date = $_POST['start_date'];
    $responsible = $_POST['responsible'];
    $remark = $_POST['remark'];
    $sql = "update projects set PROJECT_NAME='$project_name',LOCATION='$location',RESPONSIBLE_MEMBER_NO='$responsible' ,DETAILS='$project_detail',START_DATE='$start_date',REMARKS='$remark' where PROJECT_NO='$project_no' AND RESPONSIBLE_MEMBER_NO='$member_no'";
    if(mysqli_query($con,$sql)){
    echo "<meta http-equiv='refresh' content='0;url=project_setup.php'>";
    }
}


?>
<style type="text/css">
    .error {
        color: red;
    }
</style>

<form action="" id="project_form" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Project Setup  </legend>
                        <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input"> Name <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" id="project_name" name="project_name" value="<?=$row['PROJECT_NAME']?>" class="form-control field_data" placeholder="Please Enter project Name">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input">Location<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" id="location" name="location" value="<?=$row['LOCATION']?>" class="form-control field_data" placeholder="Please Enter project Location ">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input">Project Details<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" id="project_detail" name="project_detail" value="<?=$row['DETAILS']?>" class="form-control field_data" placeholder="Please Enter project details ">
                            
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input"> Start Date <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="date" id="start_date" name="start_date" value="<?=$row['START_DATE']?>" class="form-control field_data" placeholder="">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-lg-4" for="responsible"> Responsible Member</label>
                    <div class="col-lg-8">
                    <select id="responsible" name="responsible" class="Search form-control field_data">
                        <option value="<?=$row['RESPONSIBLE_MEMBER_NO']?>"><?=$row['FULL_NAME']."(".$row['MEMBER_NO'].")"?></option>
                        <option value="-1">-Select-</option>
                        <?php
                        
                        $query = "select MEMBER_NO, FULL_NAME from member_profiles " ;
	                	$result = mysqli_query ( $con , $query ) ;
	                	
	                	foreach($result as $results){?>
                        
                    <option value="<?=$results['MEMBER_NO']?>"><?=$results['FULL_NAME']."(".$results['MEMBER_NO'].")"?></option>
                    
                    <?php
	                	}
	                	?>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input">Remarks</label>
                        <div class="col-lg-8">
                            <input type="text" id="remark" name="remark" value="<?=$row['REMARKS']?>" class="form-control field_data" placeholder="Write something ">
                            
                        </div>
                    </div>
                    </div>
                    </fieldset>
                        <div class="form-group">
                            <div class="col-lg-offset-11">
                            <input type="submit" name="update" class="btn btn-primary" value="Update">
                            <span id = "error" > </span>
                            </div>

                            </div>
                    
</form>
 <?php include 'include/footer.php';?>
 