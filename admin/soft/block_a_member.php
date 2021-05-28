<?php include 'include/header.php';?>
<?php $table_heading = "Block Member";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<form action="" id="form-validation" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Search </legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Member ID</label>
                        <div class="col-md-6">
                            <input type="text" id="MEMBER_ID" name="MEMBER_ID" class="form-control" placeholder="Please Enter Member ID">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Mobile No.</label>
                        <div class="col-md-6">
                            <input type="text" id="MOBILE_NO" name="MOBILE_NO" class="form-control" placeholder="Please Enter Mobile Number">
                            
                        </div>
                    </div>


                        <div class="form-group form-actions">
                            <div class="col-lg-offset-8">
                            <button type="button" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
                            <span id = "error" > </span>
                            </div>

                            </div>
                    </fieldset>
                </form>
               

<!-- Search Result -->




<form action="" id="form-validation" method="post" enctype="multipart/form-data" class="form-horizontal" >
        <fieldset class="scheduler-border">
            <legend class="scheduler-border"> Block List </legend>
        
        <div class="table-responsive">
            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        
                        <th class="text-center"> Member ID </th>
                        <th class="text-center"> Mobile/Phone </th>
                        
                        <th class="text-center"> Address </th>
                        <th class="text-center"> Action </th>
                    </tr>
                </thead>
                <tbody id="recordList">
                    <?php
                    $sql = "SELECT mf.`MEMBER_NO`,mf.`MEMBER_ID`,mf.`FULL_NAME`,mf.`MOBILE`,mf.`PERMANENT_VILLAGE`,mf.`PERMANENT_POST`,mf.`PERMANENT_THANA`,mf.`PERMANENT_DISTRICT`,mf.`PERMANENT_POSTCODE` FROM member_profiles AS mf LEFT JOIN members ON mf.`MEMBER_NO`=members.`MEMBER_NO` where mf.IS_BLOCKED=1";
                    $result = mysqli_query($con,$sql);
                    foreach($result as $results){
                    ?>
                       <tr>
                           <td><?=$results['FULL_NAME']?></td>
                           <td><?=$results['MEMBER_ID']?></td>
                           <td><?=$results['MOBILE']?></td>
                           <td><?=$results['PERMANENT_VILLAGE'].",".$results['PERMANENT_POST'].','.$results['PERMANENT_THANA'].','.$results['PERMANENT_DISTRICT']?></td>
                           <td><a href="actions/block_member.php?block_member_no=<?=$results['MEMBER_NO']?>" class="btn btn-primary">Unblock</a></td>
                       </tr>
            <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
        </fieldset>
</form>







 <?php include 'include/footer.php';?>
 <script>
     $(document).ready(function(){
         <?php
          if(isset($_SESSION['msgPositive']) == "success"){?>
 
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Success!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                      
  <?php
  unset( $_SESSION['msgPositive'] ) ;
 }
 ?>
     });
     
     function memberSearch( search, member_id, mobile_no ){
         $.ajax({
             url:"actions/search.php",
             method:"post",
             data: ({"search":search, "member_id":member_id, "mobile_no":mobile_no}),
             dataType:"html",
             success:function(Result){
                 
                 $("#recordList").html(Result);
             }
         });
     }
     
     $(document).ready(function(){
         $("#search_id").on("click",function(){
             var member_id = $("#MEMBER_ID").val();
             var mobile_no = $("#MOBILE_NO").val();
            
             memberSearch("search",member_id,mobile_no);
         });
     });
     
     
 </script>