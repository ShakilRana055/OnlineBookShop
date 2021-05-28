<?php include 'include/header.php';?>
<?php $table_heading = "Payment Form";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
 
  
<?php
  $cur = date("Y-m-d") ;
  $month = explode("-", $cur ) ;
  $member_information = "" ;
  $present_address = "" ;
  if( isset($_GET['member_no']) && isset( $_GET['paid_date']) ) 
  {
    // echo "tor maire bap" ;
      $member_no = $_GET['member_no'] ;
      $paid_date = $_GET['paid_date'] ;

      $sql = "SELECT FULL_NAME, `MEMBER_ID`, `PRESENT_HOUSE_NO`,`PRESENT_LANE_NO`, `PRESENT_ROAD_NO`, `PRESENT_THANA`, `PRESENT_DISTRICT` FROM member_profiles WHERE MEMBER_NO = '$member_no'" ;
      $member_information = mysqli_fetch_assoc( mysqli_query( $con, $sql )) ;
      $present_address = $member_information['PRESENT_HOUSE_NO'].", ".$member_information['PRESENT_LANE_NO'].", ".$member_information['PRESENT_ROAD_NO'].", ".$member_information['PRESENT_THANA'].", ".$member_information['PRESENT_DISTRICT'] ;
  }
  
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
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?php echo getMonth( $month[1] ) ;?>" style="color:black">

                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <div class="col-sm-12">
                              
                              <div class = "form-group">
                            <label class="col-md-2 control-label" for="val_fullname">বর্তমান ঠিকানা-</label>
                            <div class="col-md-10">
                                    <input type="text" disabled id="val_fullname" name="val_fullname"   value="<?=$present_address?>" style="color:black">

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

      $member_no = $_GET['member_no'] ;
      $paid_date = $_GET['paid_date'] ;

      $sql = "SELECT *  FROM project_sales_schedule WHERE MEMBER_NO = '$member_no' AND PAID_DATE = '$paid_date'" ;
      $result = mysqli_query( $con , $sql ) ;
      $count = 1 ;
      $total1 = 0 ;
      $total2 = 0 ;
      $total = 0 ;
      foreach ($result as $value) {
        echo "<tr>";

          echo "<td>".$count ++ ."</td>" ;
          echo "<td>Allotment Collection</td>";
          

          
          //$value46547645 = getFraction( strval( $value['INSTALLMENT_AMOUNT'] ) )  ;
          $total1 += intval(getFraction( strval( $value['INSTALLMENT_AMOUNT'] ) )[0]) ;
          $total2 += intval(getFraction( strval( $value['INSTALLMENT_AMOUNT'] ) )[1]) ;
          
          echo "<td style='text-align:right'>".getFraction( strval( $value['INSTALLMENT_AMOUNT'] ) )[0]."</td>" ;
          echo "<td style='text-align:right'>".getFraction( strval( $value['INSTALLMENT_AMOUNT'] ))[1] ."</td>";
        echo "</tr>";
        $total +=floatval($value['INSTALLMENT_AMOUNT'] ) ;
      }
    ?>
		    
		    
		
	</tbody>
	
	<tfoot>
	    <tr >
	        <td class = "weight" colspan = '1'></td>
	        <td class = "weight" style = 'text-align: right;'> মোট =  </td>
	        <td class = "weight" style='text-align:right'> <?php echo ( intval(getFraction( strval( $total ) )[0]) )  ; ?> </td>
	        <td class = "weight"style='text-align:right' > <?php echo ( intval(getFraction( strval( $total ) )[1]) )  ; ?> </td>
	    </tr>
	</tfoot>
	
</table>



 </form>

 <?php include 'include/footer.php';?>