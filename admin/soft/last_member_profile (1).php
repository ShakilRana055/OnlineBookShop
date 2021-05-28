<?php include 'include/header.php';?>
<?php $table_heading = "Member Profile";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php

$sql="SELECT * FROM members LEFT JOIN member_profiles ON members.MEMBER_NO=member_profiles.MEMBER_NO WHERE member_profiles.MEMBER_NO=1";

$paic=mysqli_fetch_array(mysqli_query($con,$sql));

?> 
<div class="col-md-12"> 
        <div class="col-md-2">
        
       <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/logobdn.png'" altr="no image" style= "height:100px; width:100px;"/>
        </div>    
        <div class="col-md-7">  
            <div class="" name= "head" style="width:800px; margin:0 auto;">
                    <h6 class="text-center">ইনিল হুকুম ইল্লালিল্লাহ</h6>
                    <h2 class="text-center">আনসারুল মুসলিমিন বহুমূখী সমবায় সমীতি </h1>
                    <h6 class="text-center"> বর্তমান ঠিকানাঃ বায়তুল মামুর  জামে মসজিদ  </h6>
                    <h6 class="text-center">  দক্ষিন বিশিল , মিরপুর-১,ঢাকা-১২১৬ </h6>
                    
           </div>
        </div>
        
        <div class="col-md-2"> 
        <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/freelancer.jpg'" altr="no image" style= "height:220px; width:210px;"/>
        </div>
        
</div> 
  
 <h6 class="text-auto">রেজিঃ নং-   </h6>
   <form id="form-validation" style="padding:20px;" action="actions/test.php" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"> <strong> সদস্য ফরম </strong> </legend>
                 
                    <div class="col-sm-12">
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">নাম :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" placeholder="Member Full Name" value="<?=$paic['FULL_NAME']?> ">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname"> পিতা/স্বামীর নাম : <span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content"  value="<?=$paic['FATHER_HUSBAND_NAME']?> ">

                            </div>
                        </div>
                        
                        <div class="form-group">
                               
                            <label class="col-md-2 control-label" for="val_fullname">বর্তমান ঠিকানা-</label>
                            
                            <div class="form-group col-md-10">
                             <div class="form-group">
                             <label class="col-md-2 control-label" for="val_fullname">বাড়ী নং- <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_HOUSE_NO']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">রোড নং-<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_LANE_NO']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">ব্লক নং-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_BLOCK']?> ">

                            </div>
                            </div>
                            
                            
                    <div class="form-group">
                                
                            <label class="col-md-2 control-label" for="val_fullname">সেকসন -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_SECTION']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname"> কলোনী -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_COLONY']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">থানা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_THANA']?> ">

                            </div>
                   
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="val_fullname">জেলা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_DISTRICT']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">পোষ্ট কোড- -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRESENT_POSTCODE']?> ">

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
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_VILLAGE']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">রোড নং-<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_ROAD']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">ব্লক নং-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_BLOCK']?> ">

                            </div>
                            </div>
                            
                            
                    <div class="form-group">
                                
                            <label class="col-md-2 control-label" for="val_fullname">সেকসন -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_SECTION']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname"> কলোনী -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_COLONY']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">থানা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_THANA']?> ">

                            </div>
                   
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" for="val_fullname">জেলা-  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_DISTRICT']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">পোষ্ট কোড- -  <span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PERMANENT_POSTCODE']?> ">

                            </div>
                 
                      </div>    
                        
                        </div>
                           
             </div>
                        
                       
                        
                <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">পেশা :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PROFESSION']?> ">

                            </div>
                 </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">শিক্ষাগত যোগ্যতা :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content"  value="<?=$paic['EDUCATION_QUALIFICATION']?> ">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-2 control-label" for="val_fullname">কারিগরী যোগ্যতা থাকলে :<span class="text-danger"></span> </label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['PRACTICAL_QUALIFICATION']?> ">

                            </div>
                        </div>
  
                             <label class="col-md-2 control-label" for="val_fullname">  অপ্রাপ্ত বয়ষ্কের/মহিলাদের ক্ষেত্রে-       </label>
                            
                        <div class="form-group col-md-12">
                             <label class="col-md-2 control-label" for="val_fullname">আভিবাবকের নাম :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['FATHER_HUSBAND_NAME']?> ">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">সম্পর্ক :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="<?=$paic['GUARDIAN_RELATION']?> ">

                            </div>
                            
                            
                        </div>
                            
                             <label class="col-md-2 control-label" for="val_fullname">সদস্য মৃত্যুর ক্ষেত্রে - </label>
                            
                        <div class="form-group col-md-12">
                             <label class="col-md-2 control-label" for="val_fullname">(নমিনির নাম):<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" placeholder="Membull Name" value="Help Me">

                            </div>
                            <label class="col-md-2 control-label" for="val_fullname">সম্পর্ক :<span class="text-danger"></span> </label>
                            <div class="col-md-2">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" class="form-control ui-wizard-content" value="I am busy">

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
                            
                              <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:80px;"/>
    
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
                            
                           <img src="image/<?=$paic['IMG_URL']?>" onerror="this.src='image/jbs.jpg'" altr="no image" style= "height:50px; width:80px;"/>
                            
                            
                        </div>
                        
                        
                        
                    </div>
            

      </fieldset>
 </form>




 <?php include 'include/footer.php';?>