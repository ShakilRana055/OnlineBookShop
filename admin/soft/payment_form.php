<?php include 'include/header.php';?>
<?php $table_heading = "Payment Form";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php 
    
    $cur = date( "m-d-Y" ) ;
    $present = "" ;
    $all_data = "" ;
    if( isset( $_GET['profile_no'] ) ) 
    {
        $profile_no = $_GET['profile_no'] ;
        $sql = "SELECT * FROM `member_profiles` WHERE PROFILE_NO = '$profile_no'" ;
        $all_data = mysqli_fetch_assoc( mysqli_query( $con , $sql )) ;

        $present = $all_data['PRESENT_HOUSE_NO'].",".$all_data['PRESENT_LANE_NO'].",".$all_data['PRESENT_ROAD_NO'].",".$all_data['PRESENT_AVENUE'].","
        .$all_data['PRESENT_BLOCK'].",".$all_data['PRESENT_SECTION'].",".$all_data['PRESENT_COLONY'].",".$all_data['PRESENT_THANA'].","
        .$all_data['PRESENT_DISTRICT'].",".$all_data['PRESENT_POSTCODE'].",".$all_data['PRESENT_POST_OFFICE'] ;
    }
?>

 <style>
    .form-group input {
      border-bottom:2px dotted gray;
      background:white;
      border-top:none;
      border-left:none;
      border-right:none;
      width:100%;
     
    }
    
    .weight 
    {
        font-weight: 900;
        text-align: center;
        background-color: #d1aaa2;
        
    }
    
    .hand_made {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 20px;
      margin: 4px 2px;
      border-radius: 8px;
    }

</style>

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
        
        
      
</div> 
<div class = "col-md-12">
    <div class="col-md-5">
        
    </div> 
    <div class="col-md-3">
        
        
        <h4 class = "hand_made"> প্রকল্প রসিদ  </h4>
    </div>
            

<div class="col-md-4">
        
    </div>
</div>

  <h4 class="text-auto">রসিদ নং -    <?=$paic['MEMBER_NO']?> </h4>
   <form id="form-validation" style="padding:20px;" action="actions/test.php" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data">
                    
        
                    
                    <div class="col-sm-6">
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname">নাম :<span class="text-danger"></span> </label>
                            <div class="col-md-8">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" value="<?=$all_data['FULL_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname"> সদস্য নং  : <span class="text-danger"></span> </label>
                            <div class="col-md-8">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$all_data['`MEMBER_ID`']?>" style="color:black">

                            </div>
                        </div>
                        
                        
                           
                        
                    </div>
                    
                    <div class = "col-sm-6">
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname"> তারিখ : <span class="text-danger"></span> </label>
                            <div class="col-md-8">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$cur?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname"> কিস্তি / মাস  : <span class="text-danger"></span> </label>
                            <div class="col-md-8">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$paic['FATHER_HUSBAND_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <div class="col-sm-12">
                              
                              <div class = "form-group">
                            <label class="col-md-2 control-label" for="val_fullname">বর্তমান ঠিকানা-</label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$present?>" style="color:black">

                            </div>
                            </div>
                    </div>
                    
                    
                    
<table class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
	<thead>
		<tr>
			<th class = "weight">ক্রমিক নং </th>
			<th  class = "weight" >বিবরণ </th>
			<th class = "weight"> টাকা </th>
			<th class = "weight">পয়সা </th>
		</tr>
	</thead>
	<tbody id="recordList">
		
		<?php 
		    
		    function convert( $n )
		    {
		        $bengali = array( '1' => "১", '2' => "২", '3' =>"৩", '4' =>"৪", '5' =>"৫", '6' =>"৬", '7' =>"৭", '8' => "৮",'9' =>"৯", '10' =>"১০", '11' =>"১১", '12'  =>"১২" );
		        foreach( $bengali as $key => $value )
		        {
		            if( $key == $n )
		            {
		                return $value ;
		            }
		        }
		    }
		    
		    $sql = "SELECT * FROM `voucher_entities` " ;
		    $result = mysqli_query( $con , $sql ) ;
		    foreach( $result as $value )
		    {
		        echo "<tr>" ;
		        echo "<td style = 'text-align: center;'>". convert ( $value['VOUCHER_ENTITY_NO'] ) ."</td>" ;
		        echo "<td style = 'text-align: center;'>".$value['VOUCHER_ENTITY_NAME']."</td>" ;
		        echo "<td>".""."</td>" ;
		        echo "<td>".""."</td>" ;
		        echo "<tr>" ;
		    }
		    
		?>
		
	</tbody>
	
	<tfoot>
	    <tr >
	        <td class = "weight" colspan = '1'></td>
	        <td class = "weight" style = 'text-align: right;'> মোট =  </td>
	        <td class = "weight" ></td>
	        <td class = "weight" ></td>
	    </tr>
	</tfoot>
	
</table>



 </form>







 <?php include 'include/footer.php';?>