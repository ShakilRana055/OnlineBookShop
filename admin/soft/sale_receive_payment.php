<?php include 'include/header.php';?>
<?php $table_heading = "Payment Form";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
 
  
<?php
  $cur = date( "d-m-Y" ) ;
  $printed_month = "" ;
  $address = "" ;
  $profile_no = $_SESSION['profile_no'] ;
  unset( $_SESSION['profile_no'] ) ;
  $member_info = "SELECT `FULL_NAME`,`MEMBER_ID`,`PRESENT_HOUSE_NO`, `PRESENT_LANE_NO`, `PRESENT_ROAD_NO`, 
  `PRESENT_AVENUE`, `PRESENT_BLOCK`, `PRESENT_SECTION`, `PRESENT_COLONY`, `PRESENT_THANA`, `PRESENT_DISTRICT`, 
  `PRESENT_POST_OFFICE` FROM member_profiles WHERE PROFILE_NO = '$profile_no' " ;
  $member_information = mysqli_fetch_assoc( mysqli_query( $con , $member_info ) ) ;
  
  $address = $member_information['PRESENT_HOUSE_NO'].", ".$member_information['PRESENT_ROAD_NO'].", ".$member_information['PRESENT_THANA'].", ".$member_information['PRESENT_DISTRICT'];
  
  
  $schedule_no = $_SESSION['project_schedule'] ;
//   echo $schedule_no ;
  $project_shcedule = explode ( "," , $_SESSION['project_schedule']) ;
  unset( $_SESSION['project_schedule'] ) ;
  $id = $project_shcedule[0] ;
  
  $final_voucher = "SELECT `INSTALLMENT_AMOUNT` FROM `project_sales_schedule` WHERE `PROJECT_SCHEDULE_NO` in ( $schedule_no )" ;
//   echo $final_voucher ;
  $final_voucher_result = mysqli_query( $con , $final_voucher ) ;
  
  
  if(count( $project_shcedule ) < 2 )
  {
      $PROJECT_SCHEDULE_NO  = $project_shcedule[0] ;
      $query = "SELECT `MONTH`,`YEAR` FROM project_sales_schedule WHERE PROJECT_SCHEDULE_NO = '$PROJECT_SCHEDULE_NO'" ;
      $ans = mysqli_fetch_assoc ( mysqli_query( $con , $query ) ) ;
      $printed_month = getMonth ( $ans['MONTH'] )."-".$ans['YEAR'] ;
  }
  else if( count( $project_shcedule ) >= 2 )
  {
      $first = $project_shcedule[0] ;
      $last = $project_shcedule[count( $project_shcedule ) - 1 ] ;
      $query = "SELECT `MONTH`,`YEAR` FROM project_sales_schedule WHERE PROJECT_SCHEDULE_NO = '$first'" ;
      $ans = mysqli_fetch_assoc ( mysqli_query( $con , $query ) ) ;
      $printed_month = getMonth ( $ans['MONTH'] )."-".$ans['YEAR'] ;
      
      $query = "SELECT `MONTH`,`YEAR` FROM project_sales_schedule WHERE PROJECT_SCHEDULE_NO = '$last'" ;
      $ans = mysqli_fetch_assoc ( mysqli_query( $con , $query ) ) ;
      $printed_month .= " to ".getMonth ( $ans['MONTH'] )."-".$ans['YEAR'] ;
  }
  
  $get_tittle_name = "SELECT project_revenue.TITLE_NAME FROM project_sales_schedule LEFT JOIN revenue_part_sales ON 
  revenue_part_sales.REVENUE_PART_SALE_NO = project_sales_schedule.PROJECT_SALE_NO LEFT JOIN project_revenue ON 
  project_revenue.PROJECT_NO = revenue_part_sales.PROJECT_NO WHERE project_sales_schedule.PROFILE_NO = '$profile_no' AND 
  project_sales_schedule.PROJECT_SCHEDULE_NO = '$id' " ;
//   echo $get_tittle_name ;
  $get_name = mysqli_fetch_assoc( mysqli_query( $con , $get_tittle_name ) ) ;
  
?>


<?php 
    
    function is_fraction( $string )
    {
      
      for( $i = 0 ; $i <  strlen( $string ); $i ++ )
      {
        
        if( $string[$i] == '.' )
        {
          
          return true ;
        }
      }
      return false ;
    }

    function getFraction( $string )
    {
      
        $is_fraction = is_fraction( $string ) ;
        
      
        $integer = "" ;
        $fraction = "" ;
        $checker = false ;
        if( is_fraction( $string ) == true )
        {
          
          for( $i = 0 ; $i < strlen ( $string ) ; $i ++ )
          {

            if( $string[$i] != '.' && $checker == false )
              $integer .= $string[$i] ;
            else if(  $string[$i] == '.' )
            {
              $checker = true ;
            }
            else
            {
              $fraction .= $string[ $i ] ;
            }

             
          }
          // echo $integer. " ".$fraction."<br/>" ;
          return [$integer, $fraction];
        }
        else
        {
          return [$string , 00 ] ;
        }
      
    }

?> 

<?php

    function getMonth ( $id )
      {
          $all12 = "JANUARY,FEBRUARY , MARCH ,APRIL, MAY ,JUNE, JULY, AUGUST, SEPTEMBER, OCTOBER, NOVEMBER, DECEMBER";
           $month = explode( "," , $all12 ) ;
          for( $i = 0 ; $i < count( $month ) ; $i ++ )
          {
            if( $i + 1 == $id )
              {
                return $month[$i] ;
              }
          }
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

  <h4 class="text-auto">রসিদ নং -     </h4>
   <form id="form-validation" style="padding:20px;" action="actions/test.php" method="post" class="form-horizontal form-bordered" novalidate="novalidate" name="form-validation" enctype="multipart/form-data">
                    
        
                    
                    <div class="col-sm-6">
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname">নাম :<span class="text-danger"></span> </label>
                            <div class="col-md-8">
                                    <input type="text" disabled id="val_fullname" name="val_fullname" value="<?=$member_information['FULL_NAME']?>" style="color:black">

                            </div>
                        </div>
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="val_fullname"> সদস্য নং  : <span class="text-danger"></span> </label>
                            <div class="col-md-8">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$member_information['MEMBER_ID']?>" style="color:black">

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
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?php echo $printed_month ;?>" style="color:black">

                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <div class="col-sm-12">
                              
                              <div class = "form-group">
                            <label class="col-md-2 control-label" for="val_fullname">বর্তমান ঠিকানা-</label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$address?>" style="color:black">

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
             
             $count = 1 ;
             $total = 0 ;
             foreach( $final_voucher_result as $value )
             {
                 echo "<tr>" ;
                 echo "<td>".$count ++ . "</td>" ;
                 echo "<td>".$get_name['TITLE_NAME']."</td>" ;
                 $amount = $value['INSTALLMENT_AMOUNT'] ;
                 $total += $amount ;
                 $explode = explode( "." , strval( $amount ) ) ;
                 if( count ( $explode ) == 2 )
                 {
                     echo "<td>".$explode[0]."</td>" ;
                     echo "<td>".$explode[1]."</td>" ;
                 }
                 else
                 {
                     echo "<td>".$explode[0]."</td>" ;
                     echo "<td>"."00"."</td>" ;
                 }
                 echo "<tr>" ;

             }
             $taka = explode( ".", strval( $total ) ) ;
                
                
        ?>
		    
		    
		
	</tbody>
	<?php if( count( $taka ) == 1 ) { ?>
	<tfoot>
	    <tr >
	        <td class = "weight" colspan = '1'></td>
	        <td class = "weight" style = 'text-align: right;'> মোট =  </td>
	        <td class = "weight" style='text-align:right'> <?php echo $total  ; ?> </td>
	        <td class = "weight"style='text-align:right' > <?php echo "00" ?> </td>
	    </tr>
	</tfoot>
	<?php } else { ?>
	<tfoot>
	    <tr >
	        <td class = "weight" colspan = '1'></td>
	        <td class = "weight" style = 'text-align: right;'> মোট =  </td>
	        <td class = "weight" style='text-align:right'> <?php echo $taka[0]  ; ?> </td>
	        <td class = "weight"style='text-align:right' > <?php echo $taka[1]  ; ?> </td>
	    </tr>
	</tfoot>
	<?php }?>
	
</table>



 </form>

 <?php include 'include/footer.php';?>
 
 <script>
 document.body.onload=function(){document.body.offsetHeight;window.print()};
 </script>