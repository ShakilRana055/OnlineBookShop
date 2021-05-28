<?php include 'include/header.php';?>
<?php $table_heading = "Member Profile";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<!DOCTYPE html>
<head>
  <style>
.form-group input {
  border-bottom:2px dotted gray;
  background:white;
  border-top:none;
  border-left:none;
  border-right:none;
  width:100%;
 
}

</style>
</head>

<?php if(isset($_GET['profile_no']))
                                      {
?>
 
 
<?php

 $frofile_no=$_GET['profile_no'];
 $sql="SELECT * FROM member_profiles WHERE PROFILE_NO='$frofile_no'";

$paic=mysqli_fetch_array(mysqli_query($con,$sql));
$member_no =  $paic['MEMBER_NO'];

$sql2 = "SELECT * FROM `nominees` LEFT JOIN members ON nominees.MEMBER_NO=members.MEMBER_NO WHERE nominees.MEMBER_NO='$member_no'";
$nominee_row = mysqli_fetch_array(mysqli_query($con,$sql2));
?> 
<div class="row"> 
        <div class="col-md-3">
        
       <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/logobdn.png'" altr="no image" style= "height:100px; "/>
        </div>    
        <div class="col-md-6">  
            <div class="" name= "head" style=" margin:0 auto;">
                   <h6 class="text-center">ইনিল হুকমু ইল্লালিল্লাহ  </h6>
                    <h2 class="text-center">আনসারুল মুসলিমীন বহুমূখী সমবায় সমীতি </h1>
                    <h6 class="text-center"> বর্তমান ঠিকানাঃ বায়তুল মামুর  জামে মসজিদ  </h6>
                    <h6 class="text-center">  দক্ষিন বিশিল , মিরপুর-১,ঢাকা-১২১৬ </h6>
                    
           </div>
        </div>
        
        <div class="col-md-3"> 
        <img src="actions/image/<?=$paic['IMG_URL']?>" onerror="this.src='image/freelancer.jpg'" altr="no image" style= "height:220px; width:210px;"/>
        </div>
        
</div> 
  
 <h3 class="text-auto">রেজিঃ নং-    <?=$paic['MEMBER_NO']?>  </h3>
   <form id="form-validation" style="padding:20px;" action="actions/test.php" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"> <strong> সদস্য ফরম </strong> </legend>
                 
                    <div class="col-sm-12">
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">নাম :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" value="<?=$paic['FULL_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname"> পিতা/স্বামীর নাম : <span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$paic['FATHER_HUSBAND_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">
                               
                            <label class="col-md-2 control-label" for="val_fullname">বর্তমান ঠিকানা-</label>
                            
                            <div class="form-group col-md-10">
                             <div class="form-group">
                             <label class="col-md-2 control-label" for="val_fullname">বাড়ী নং- <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_HOUSE_NO']?>"style="color:black" >

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">রোড নং-<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_LANE_NO']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">ব্লক নং-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_BLOCK']?> "style="color:black">

                            </div>
                            </div>
                            
                            
                    <div class="form-group">
                                
                            <label class="col-md-2 control-label" for="val_fullname">সেকসন -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_SECTION']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname"> কলোনী -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_COLONY']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">থানা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_THANA']?> "style="color:black">

                            </div>
                   
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="val_fullname">জেলা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_DISTRICT']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">পোষ্ট কোড- -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRESENT_POSTCODE']?> "style="color:black">

                            </div>
                 
                      </div>    
                        
                        </div>
                           
             </div>
             
              <div class="form-group">
                               
                            <label class="col-md-2 control-label" for="val_fullname">স্থায়ী ঠিকানা-  </label>
                            
                            <div class="form-group col-md-10">
                             <div class="form-group">
                             <label class="col-md-2 control-label" for="val_fullname">বাড়ী নং- <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_VILLAGE']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">রোড নং-<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_ROAD']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">ব্লক নং-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_BLOCK']?> "style="color:black">

                            </div>
                            </div>
                            
                            
                    <div class="form-group">
                                
                            <label class="col-md-2 control-label" for="val_fullname">সেকসন -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_SECTION']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname"> কলোনী -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_COLONY']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">থানা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_THANA']?> "style="color:black">

                            </div>
                   
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="val_fullname">জেলা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_DISTRICT']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">পোষ্ট কোড- -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PERMANENT_POSTCODE']?> "style="color:black">

                            </div>
                 
                      </div>    
                        
                        </div>
                           
             </div>
                        
                       
                        
                <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">পেশা :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PROFESSION']?> "style="color:black">

                            </div>
                 </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">শিক্ষাগত যোগ্যতা :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$paic['EDUCATION_QUALIFICATION']?> "style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">কারিগরী যোগ্যতা থাকলে :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['PRACTICAL_QUALIFICATION']?> "style="color:black">

                            </div>
                        </div>
  
                             <label class="col-md-2 control-label" for="val_fullname">  অপ্রাপ্ত বয়ষ্কের/মহিলাদের ক্ষেত্রে-       </label>
                            
                        <div class="form-group col-md-12">
                             <label class="col-md-2 control-label" for="val_fullname">অভিভাবকের নাম:<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['GUARDIAN_NAME']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">সম্পর্ক :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?=$paic['GUARDIAN_RELATION']?> "style="color:black">

                            </div>
                            
                            
                        </div>
                            
                            
                            
                             <label class="col-md-2 control-label" for="val_fullname">সদস্য মৃত্যুর ক্ষেত্রে - </label>
                            
                        <div class="form-group col-md-12">
                             <label class="col-md-2 control-label" for="val_fullname">(নমিনির নাম):<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  placeholder="" value="<?php echo $nominee_row['NOMINEE_NAME']?>"style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">সম্পর্ক :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"  value="<?php echo $nominee_row['NOMINEE_RELATION']?>" style="color:black">

                            </div>
                            
                            
                        </div>
             
                    </div>
                    
                    <div class="col-md-12" style="padding:40px;">
                         <p>
                            আল্লাহ তা'লাকে সাক্ষি রাখিয়া বলিতেছি যে,আনসারুল মুসলিমিন বহুমূখী সমবায় সমীতি একটি ইসলামিক আইনে খাটি আদর্শে পরিচালিত পারস্পারিক সহযোগিতার
                            মাধ্যমে দ্বীনি সেবামূলক সমিতি।আমি আনসারুল মুসলিমিন বহুমূখী সমবায় সমীতির গঠনতন্ত্র জানিয়া বুঝিয়া সব-ইচ্ছায় স্বজ্ঞানে উহা মানিয়া চলার অঙ্গীকার করতঃ
                            উক্ত সমিতির সদস্যভূক্ত হয়ার জন্যে আবেদন করিতেছি।
                        </p>
                            
                        
                    </div>
                    
                    
                    <div class="col-md-12" style="padding:40px;">
                        
                        <div class="col-md-4">
                            <label> সনাক্তকারী সদস্যের স্বাক্ষর </label>
                            
                              <img src="actions/image/<?=$paic['IDENTIFIER_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:80px;"/>
    
                        </div>
                        
                        <div class="col-md-4" style="margin-top:80px;">
                            
                      <label> সমিতির সদস্যভূক্ত করা হইল।</label>
                       
                            <div class="col-md-6">
                                <label>সভাপতি</label>
                            
                              <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:90px;"/>
     
                            </div>
                            <div class="col-md-6">
                                <label> সেক্রেটারী </label>
                            
                                <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:90px;"/>
                            </div>
                            
                            
                        </div>
                        
                        <div class="col-md-4">
                            
                            <label> আবেদনকারীর স্বাক্ষর</label>
                            
                           <img src="actions/image/<?=$paic['SIGNATURE_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:80px;"/>
                            
                            
                        </div>
                        
                        
                        
                    </div>
            

      </fieldset>
      <!--<div class="row">-->
      <!--    <div class="col-md-5" ></div>-->
      <!--    <div class="col-md-2">-->
      <!--    <button onclick="myFunction()" class="btn btn-primary">Print</button>-->
      <!--</div>-->
      <!--<div class="col-md-5" ></div>-->
      <!--</div>-->
     
 </form>
                                                                               
                                   
 <?php
       }
 ?>
                                                                                         <!--Update-->
                                                                                         <!--Update-->
                                                                                         <!--Update-->
                                                                                         <!--Update-->
     
<?php if(isset($_POST['update']))
{
?> 
      <?php 
      
      //info
       $member_no=$_POST['member_no'];
       $sql="SELECT * FROM member_profiles WHERE MEMBER_NO='$member_no' AND IS_DELETED = 0 ";
       $paic = mysqli_num_rows(mysqli_query($con,$sql));
       
        $val_image=time().$_FILES["profileImage"]["name"];
     
        $val_fullname = $_POST['name'];
        $val_FHname = $_POST['f_name'];
        $val_education = $_POST['quilification'];
        $val_educationex = $_POST['ex_quilification'];
        $val_guardian = $_POST['g_name'];
        $val_guardian_rel = $_POST['g_rel'];
        $val_nominee = $_POST['n_name'];
        $val_nominee_rel = $_POST['n_rel'];
        $val_occupation = $_POST['profession'];
       // permanent Information
        $val_houseNo = $_POST['p_h_nob'];
        $val_road= $_POST['p_r_nob'];    
        $val_block= $_POST['p_b_nob'];
        $val_section = $_POST['p_s_nob'];     
        $val_colony = $_POST['p_k_nob'];
        $val_thana = $_POST['p_t_nob'];
        $val_district = $_POST['p_d_nob'];
        $val_postcode = $_POST['p_p_nob'];
        
        // present information
        $val_houseNoPresent = $_POST['p_h_no'];
        $val_roadPresent = $_POST['p_r_no'];    
        $val_blockPresent = $_POST['p_b_no'];
        $val_sectionPresent = $_POST['p_s_no'];     
        $val_colonyPresent = $_POST['p_k_no'];
        $val_thanaPresent = $_POST['p_t_no'];
        $val_districtPresent = $_POST['p_d_no'];
        $val_postcodePresent = $_POST['p_p_no'];
        $sql = "" ;
        
        $identifier_signature = $_FILES['identity_signature']['name'] ;
        
        $applier_signature = $_FILES['applier_signature']['name'] ;
        
              if($_FILES["profileImage"]["name"] == "")
                {
                   $sql = "UPDATE member_profiles SET FULL_NAME='$val_fullname',FATHER_HUSBAND_NAME='$val_FHname',PRESENT_HOUSE_NO='$val_houseNoPresent',PRESENT_LANE_NO='$val_roadPresent',PRESENT_BLOCK='$val_blockPresent',PRESENT_SECTION='$val_sectionPresent',PRESENT_COLONY='$val_colonyPresent',PRESENT_THANA='$val_thanaPresent',PRESENT_DISTRICT='$val_districtPresent',PRESENT_POSTCODE='$val_postcodePresent',
                    PERMANENT_VILLAGE='$val_houseNo',PERMANENT_ROAD='$val_road',PERMANENT_SECTION='$val_section',PERMANENT_BLOCK='$val_block',PERMANENT_COLONY='$val_colony',PERMANENT_THANA='$val_thana',PERMANENT_DISTRICT='$val_district',PERMANENT_POSTCODE='$val_postcode',
                    PROFESSION='$val_occupation',EDUCATION_QUALIFICATION='$val_education',PRACTICAL_QUALIFICATION='$val_educationex',
                    GUARDIAN_NAME='$val_guardian',GUARDIAN_RELATION='$val_guardian_rel'"; 
                    
                    
                }
                else
                {
                     $sql = "UPDATE member_profiles SET FULL_NAME='$val_fullname',FATHER_HUSBAND_NAME='$val_FHname',PRESENT_HOUSE_NO='$val_houseNoPresent',PRESENT_LANE_NO='$val_roadPresent',PRESENT_BLOCK='$val_blockPresent',PRESENT_SECTION='$val_sectionPresent',PRESENT_COLONY='$val_colonyPresent',PRESENT_THANA='$val_thanaPresent',PRESENT_DISTRICT='$val_districtPresent',PRESENT_POSTCODE='$val_postcodePresent',
                    PERMANENT_VILLAGE='$val_houseNo',PERMANENT_ROAD='$val_road',PERMANENT_SECTION='$val_section',PERMANENT_BLOCK='$val_block',PERMANENT_COLONY='$val_colony',PERMANENT_THANA='$val_thana',PERMANENT_DISTRICT='$val_district',PERMANENT_POSTCODE='$val_postcode',
                    PROFESSION='$val_occupation',EDUCATION_QUALIFICATION='$val_education',PRACTICAL_QUALIFICATION='$val_educationex',
                    GUARDIAN_NAME='$val_guardian',GUARDIAN_RELATION='$val_guardian_rel',IMG_URL='$val_image'"; 
                                       
                       move_uploaded_file($_FILES["profileImage"]["tmp_name"],"actions/image/" .$val_image );
                    
                }
                
                if( $identifier_signature != "" )
                {
                   $identifier_signature1 = "identifier".time().$identifier_signature ;
                    move_uploaded_file( $_FILES["identity_signature"]["tmp_name"], "actions/image/".$identifier_signature1 ) ;
                    $sql .= ", IDENTIFIER_URL = '$identifier_signature1'";
                }
                
                if( $applier_signature != "" )
                {
                    $applier_signature1 = "applier".time( ).$applier_signature ;
                    move_uploaded_file( $_FILES["applier_signature"]["tmp_name"], "actions/image/" .$applier_signature1 ) ;
                    $sql .= ", SIGNATURE_URL = '$applier_signature1'";
                }
             
             $sql .= "WHERE MEMBER_NO = '$member_no'";
             
             $res = mysqli_query($con,$sql);
             if($res)
             {
                 echo "<p style='color:green;font-size:30px;'>Successfully Updated</p>";
                 
             }

?>


<?php
}
?>
 
 
 
 
                          
                          
                          
                          
                                                                               <!--edit--><!--edit--><!--edit-->
                                                                               <!--edit--><!--edit--><!--edit-->
                                                                               <!--edit--><!--edit--><!--edit-->
                                                                               <!--edit--><!--edit--><!--edit-->
                                                                               <!--edit--><!--edit--><!--edit-->
<?php if(isset($_GET['edit']))
{
?>

 
<?php

$member_no=$_GET['edit'];
$sql="SELECT * FROM members LEFT JOIN member_profiles ON members.MEMBER_NO=member_profiles.MEMBER_NO WHERE member_profiles.MEMBER_NO='$member_no'";

$paic=mysqli_fetch_array(mysqli_query($con,$sql));
$sql2 = "SELECT * FROM `nominees` LEFT JOIN members ON nominees.MEMBER_NO=members.MEMBER_NO WHERE nominees.MEMBER_NO='$member_no'";
$nominee_row = mysqli_fetch_array(mysqli_query($con,$sql2));
?> 

   <form  style="padding:20px;" action="" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"> <strong> সদস্য ফরম </strong> </legend>
                 
                 <div class="row"> 
        <div class="col-md-3">
       <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/logobdn.png'" altr="no image" style= "height:100px; width:100px;"/>
       
        </div>    
        <div class="col-md-6">  
            <div class="" name= "head" style=" margin:0 auto;">
                    <h6 class="text-center">ইনিল হুকমু ইল্লালিল্লাহ  </h6>
                    <h2 class="text-center">আনসারুল মুসলিমীন বহুমূখী সমবায় সমীতি </h1>
                    <h6 class="text-center"> বর্তমান ঠিকানাঃ বায়তুল মামুর  জামে মসজিদ  </h6>
                    <h6 class="text-center">  দক্ষিন বিশিল , মিরপুর-১,ঢাকা-১২১৬ </h6>
                    
           </div>
        </div>
        
        <div class="col-md-3"> 
        
         <img src="actions/image/<?=$paic['IMG_URL']?>" onerror="this.src='image/freelancer.jpg'" altr="no image" style= "height:220px; width:210px;"/>
         <input  id="" name="profileImage" type="file"  />
        
        </div>
        
</div> 
  
  <h3 class="text-auto">রেজিঃ নং-    <?=$paic['MEMBER_NO']?>  </h3>
                 
                    
                    <input type ="hidden" name = "member_no" value = "<?php echo $member_no ; ?>">
                    <div class="col-sm-12">
                        
                        <div class="form-group">
                    
                            <label class="col-md-2 control-label" for="val_fullname">নাম :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text"  id="val_fullname" name="name" value="<?=$paic['FULL_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname"> পিতা/স্বামীর নাম : <span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text"  id="val_fullname" name="f_name"   value="<?=$paic['FATHER_HUSBAND_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">
                               
                            <label class="col-md-2 control-label" for="val_fullname">বর্তমান ঠিকানা-</label>
                            
                            <div class="form-group col-md-10">
                             <div class="form-group">
                             <label class="col-md-2 control-label" for="val_fullname">বাড়ী নং- <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_h_no"  value="<?=$paic['PRESENT_HOUSE_NO']?>"style="color:black" >

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">রোড নং-<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_r_no"  value="<?=$paic['PRESENT_LANE_NO']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">ব্লক নং-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_b_no"  value="<?=$paic['PRESENT_BLOCK']?> "style="color:black">

                            </div>
                            </div>
                            
                            
                    <div class="form-group">
                                
                            <label class="col-md-2 control-label" for="val_fullname">সেকসন -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_s_no"  value="<?=$paic['PRESENT_SECTION']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname"> কলোনী -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" id="val_fullname" name="p_k_no"  value="<?=$paic['PRESENT_COLONY']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">থানা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_t_no"  value="<?=$paic['PRESENT_THANA']?> "style="color:black">

                            </div>
                   
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="val_fullname">জেলা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_d_no"  value="<?=$paic['PRESENT_DISTRICT']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">পোষ্ট কোড- -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_p_no"  value="<?=$paic['PRESENT_POSTCODE']?> "style="color:black">

                            </div>
                 
                      </div>    
                        
                        </div>
                           
             </div>
             
              <div class="form-group">
                               
                            <label class="col-md-2 control-label" for="val_fullname">স্থায়ী ঠিকানা-  </label>
                            
                            <div class="form-group col-md-10">
                             <div class="form-group">
                             <label class="col-md-2 control-label" for="val_fullname">বাড়ী নং- <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_h_nob"  value="<?=$paic['PERMANENT_VILLAGE']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">রোড নং-<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_r_nob"  value="<?=$paic['PERMANENT_ROAD']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">ব্লক নং-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_b_nob"  value="<?=$paic['PERMANENT_BLOCK']?> "style="color:black">

                            </div>
                            </div>
                            
                            
                    <div class="form-group">
                                
                            <label class="col-md-2 control-label" for="val_fullname">সেকসন -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_s_nob"  value="<?=$paic['PERMANENT_SECTION']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname"> কলোনী -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" id="val_fullname" name="p_k_nob"  value="<?=$paic['PERMANENT_COLONY']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">থানা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_t_nob"  value="<?=$paic['PERMANENT_THANA']?> "style="color:black">

                            </div>
                   
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="val_fullname">জেলা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_d_nob"  value="<?=$paic['PERMANENT_DISTRICT']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">পোষ্ট কোড- -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="p_p_nob"  value="<?=$paic['PERMANENT_POSTCODE']?> "style="color:black">

                            </div>
                 
                      </div>    
                        
                        </div>
                           
             </div>
                        
                       
                        
                <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">পেশা :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text"  id="val_fullname" name="profession"  value="<?=$paic['PROFESSION']?> "style="color:black">

                            </div>
                 </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">শিক্ষাগত যোগ্যতা :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" id="val_fullname" name="quilification"   value="<?=$paic['EDUCATION_QUALIFICATION']?> "style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">কারিগরী যোগ্যতা থাকলে :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text"  id="val_fullname" name="ex_quilification"  value="<?=$paic['PRACTICAL_QUALIFICATION']?> "style="color:black">

                            </div>
                        </div>
  
                             <label class="col-md-2 control-label" for="val_fullname">  অপ্রাপ্ত বয়ষ্কের/মহিলাদের ক্ষেত্রে-       </label>
                            
                        <div class="form-group col-md-12">
                             <label class="col-md-2 control-label" for="val_fullname">অভিভাবকের নাম:<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="g_name"  value="<?=$paic['GUARDIAN_NAME']?> "style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">সম্পর্ক :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="g_rel"  value="<?=$paic['GUARDIAN_RELATION']?> "style="color:black">

                            </div>
                            
                            
                        </div>
                            
                             <label class="col-md-2 control-label" for="val_fullname">সদস্য মৃত্যুর ক্ষেত্রে - </label>
                            
                        <div class="form-group col-md-12">
                             <label class="col-md-2 control-label" for="val_fullname">(নমিনির নাম):<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="n_name"  placeholder="Membull Name" value="<?php echo $nominee_row['NOMINEE_NAME']?>" style="color:black">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">সম্পর্ক :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text"  id="val_fullname" name="n_rel"  value="<?php echo $nominee_row['NOMINEE_RELATION']?>" style="color:black">

                            </div>
                            
                            
                        </div>
                        
                    <!--signatures update option-->
                    <div class="col-md-12" style="padding:40px;">
                        
                        <div class="col-md-4">
                            <label> সনাক্তকারী সদস্যের স্বাক্ষর </label>
                            
                              <img src="actions/image/<?=$paic['IDENTIFIER_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:80px;"/>
                                <input  id="" name="identity_signature" type="file"  />
                        </div>
                        
                        <div class="col-md-4" style="margin-top:80px;">
                            
                      <label> সমিতির সদস্যভূক্ত করা হইল।</label>
                       
                            <div class="col-md-6">
                                <label>সভাপতি</label>
                            
                              <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:90px;"/>
                                <!--<input  id="" name="chairman_signature" type="file"  />-->
                            </div>
                            <div class="col-md-6">
                                <label> সেক্রেটারী </label>
                            
                                <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:90px;"/>
                           <!--<input  id="" name="secretary_signature" type="file"  />-->
                            </div>
                            
                            
                        </div>
                        
                        <div class="col-md-4">
                            
                            <label> আবেদনকারীর স্বাক্ষর</label>
                            
                           <img src="actions/image/<?=$paic['SIGNATURE_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:80px;"/>
                            <input  id="" name="applier_signature" type="file"  />
                            
                        </div>
                        
                        
                        
                    </div>
                        
                    
                    <!--End of the signature updated Option-->
                        
                        
             
                    </div>
                    <div class="row">
                       <div class="col-md-5">
                           
                       </div>
                        <div class="col-md-2">
           
                           <input type="submit" class="btn btn-primary" name="update" value="Update"  style="background:#256d29;"/>
                
                         </div>
                       <div class="col-md-5">
                           
                       </div>
                   </div>

        </div>
        
      </fieldset>
                   
 </form>



<?php 
    }
?>

 <?php include 'include/footer.php';?>
 <script>
   function myFunction() {
  window.print();
}
 </script>