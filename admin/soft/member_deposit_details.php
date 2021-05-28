<?php include 'include/header.php';?>
<?php $table_heading = "Deposit";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

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
                            <div class="col-lg-offset-8">
                            <button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
                            <span id = "error" > </span>
                            </div>

                            </div>
                </fieldset>
                
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>#</th>
         <th>Name</th>
         <th>Member ID</th>
         <th>Mobile Number</th>
         <th>Address</th>
         
      </tr>
   </thead>
   <tbody id='recordList123'>
<?php
                            
    $member_identity = "" ;
    $member_no = "" ;
    $profile_no = "" ;
                            
    if( isset( $_POST['search'] ) ) 
    {
        $mobile = $_POST['MOBILE_NO'] ;
        $memberid = $_POST['MEMBER_NO'] ;
        $query = "" ;
        if( $mobile != "" )
        {
            $query = "SELECT * FROM member_profiles WHERE MOBILE =  '$mobile'" ;
        }
        else
        {
            $query = "SELECT * FROM member_profiles WHERE MEMBER_ID = '$memberid'" ;
        }
        $result = mysqli_query( $con , $query ) ;
        $value = mysqli_fetch_assoc( $result ) ;
        
            echo "<tr>" ;
                $member_identity = $value['MEMBER_ID'] ;
                $profile_no = $value['PROFILE_NO'] ;
                $member_no = $value['MEMBER_NO'] ; 
                echo "<td>1</td>" ;
                echo "<td>".$value['FULL_NAME']."</td>" ;
                echo "<td>".$value['MEMBER_ID']."</td>" ;
                echo "<td>".$value['MOBILE']."</td>" ;
                echo "<td>".$value['PRESENT_HOUSE_NO'].", ".$value['PRESENT_THANA'].", ".$value['PRESENT_DISTRICT']."</td>" ;
                
                                    
            echo "</tr>" ;
    }


?>
       </tbody> 
</table>

<input type = "hidden" name = "member_id" id = "hidden" value = "<?php echo $member_no ; ?>">
<input type = "hidden" name = "profile_no" id = "profile_no" value = "<?php echo $profile_no ; ?>">
<div id = "showme" style = "display: none;" >
<fieldset class = "scheduler-border"> 
    <legend class = "scheduler-border" >Dues</legend>
    <table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
       <thead>
          <tr>
             <th>#</th>
             <th>Year</th>
             <th>Month</th>
             <th>Account Head</th>
             <th>Amount</th>
             <th> Action </th>
             
          </tr>
       </thead>
       <tbody id='recordList'>
                <?php 
                    $total_amount = 0 ;  
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
                    
                    function getHeadName ( $id )
                    {
                        if( $id == '-1' )
                        {
                            return "Loan" ;
                        }
                        include ( '../config/db_connection.php') ;
                        $query = "SELECT DEPOSITE_HEAD_NAME FROM deposite_heads WHERE DEPOSITE_HEAD_NO = '$id'" ;
                        $ans = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
                        return $ans['DEPOSITE_HEAD_NAME'] ;
                    }
                    
                    $sql = "SELECT deposite_heads.DEPOSITE_HEAD_NAME,deposite_heads.DEPOSITE_HEAD_CODE,T3.* FROM (SELECT T2.* 
                    FROM (SELECT DEPOSITE_HEAD_NO, DEPOSIT_AMOUNT AMT, YEAR, MONTH FROM member_deposit_details LEFT JOIN 
                    member_depsoit_masters ON member_depsoit_masters.DEPOSIT_MASTER_NO = member_deposit_details.DEPOSIT_MASTER_NO 
                    WHERE MEMBER_NO = '$member_identity')T1 RIGHT JOIN (SELECT DEPOSIT_HEAD_NO DEPOSITE_HEAD_NO, DEPOSIT_AMOUNT AMT, CALENDAR_YEAR YEAR, CALENDAR_MONTH 
                    MONTH FROM depsoit_scams WHERE MEMBER_NO = '$member_identity' OR MEMBER_NO = -1)T2 ON T1.DEPOSITE_HEAD_NO = T2.DEPOSITE_HEAD_NO 
                    AND T1.YEAR = T2.YEAR AND T1.MONTH = T2.MONTH WHERE T1.DEPOSITE_HEAD_NO IS NULL UNION (SELECT '-1' DEPOSITE_HEAD_NO,INSTALLMENT_AMOUNT AMT, 
                    SCHEDULE_YEAR YEAR, SCHEDULE_MONTH MONTH FROM loan_schedule WHERE MEMBER_NO = '$member_identity' AND IS_PAID = 0))T3 LEFT 
                    JOIN deposite_heads ON deposite_heads.DEPOSITE_HEAD_NO = T3.DEPOSITE_HEAD_NO ORDER BY YEAR,MONTH ASC " ;
                    
                    $result = mysqli_query( $con , $sql ) ;
                    
                    $count = 1 ;
                    foreach( $result as $value )
                    {
                        echo "<tr>" ;
                        
                            echo "<td>".$count ."</td>" ; 
                            echo "<td>".$value['YEAR']."</td>" ;
                            echo "<td>".getMonth( $value['MONTH'] ) ."</td>" ;
                            echo "<td>".$value['DEPOSITE_HEAD_NAME']." (".$value['DEPOSITE_HEAD_CODE'].")</td>" ;
                            echo "<td>".$value['AMT']."</td>" ;
                            $total_amount += $value['AMT'] ;
                           ?>
                           
                           <td>
                                  <input type="checkbox" name="myTextEditBox" class = "sum" id="<?php echo $count ; ?>" checked 
                                  style="margin-left:auto; margin-right:auto;" DEPOSITE_HEAD_NO = '<?php echo $value['DEPOSITE_HEAD_NO']; ?>' 
                                  YEAR = '<?php echo $value['YEAR']; ?>' MONTH = '<?php echo $value['MONTH'] ; ?>' AMT = '<?php echo $value['AMT']; ?>'/>
                             </td>
                           
                           <?php
                        echo "</tr>" ;
                        $count ++ ;
                    }
                    
                
                ?>
            </tbody>
            <tfooter id='tfoot_id'>
                <tr>
                    <td>  </td>
                    <th colspan = '3' > Total</th>
                    <th id = "total" > <?php echo $total_amount ; ?></th> 
                    
                    <td>  </td>
                    
                </tr>
            </tfooter>
    </table>


        <div class = "col-sm-6">
            
        </div>
        <div class = "col-sm-6">
            <div class="form-group">
                        <label class="col-md-4 control-label" for="example-text-input"> <strong>Receive Amount </strong> </label>
                        <div class="col-md-8">
                            <input type="text" id="paid_amount" name="paid" class="form-control" placeholder="">
                        </div>
            </div>
            <div class="form-group form-actions" id = "show_save" >
                    <div class="col-lg-offset-8">
                    <button type="button" name="save" class="btn btn-sm btn-primary" id="save_btn" ></i>Receive</button>
                            
            </div>
    </div>
    </fieldset>
</form>
                
                

 <?php include 'include/footer.php';?>
 
 <script>
     
     function show( id )
     {
         if( id == '1' )
         {
             Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Sucessfull!',
                          showConfirmButton: false,
                          timer: 1500
                        });
         }
         else
         {
             Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });
             
         }
     }
     
     function saveData( saveAll, DEPOSITE_HEAD_NO_ARRAY, YEAR_ARRAY, MONTH_ARRAY, AMT_ARRAY, member_id , profile_no , paid_amount )
     {
         $.ajax( { 
             
             url : "actions/save_deposit.php",
             method : "post",
             data: ({ "saveAll": saveAll , "DEPOSITE_HEAD_NO_ARRAY": DEPOSITE_HEAD_NO_ARRAY.toString(), "YEAR_ARRAY": YEAR_ARRAY.toString(), "MONTH_ARRAY": MONTH_ARRAY.toString() , 
             "AMT_ARRAY": AMT_ARRAY.toString(), "member_id": member_id, "profile_no": profile_no , "paid_amount": paid_amount }),
             dataTYpe: "html",
             success: function( Result )
             {
                 console.log( Result ) ;
                 if( Result == 1 )
                 {
                    
                        setTimeout(show( '1' ), 2000);
                        window.location.href = "/submit/template/soft/deposit_receive_voucher.php" ;
                 }
                 else
                 {
                     setTimeout(show( 0 ), 1500);
                     window.location.href = "/submit/template/soft/member_deposit_details.php" ;
                 }
             }
             
         }) ;
     }
     
     
     $( document ).ready( function( ) { 
        
        var DEPOSITE_HEAD_NO_ARRAY = [];
        var YEAR_ARRAY = [];
        var MONTH_ARRAY = [];
        var AMT_ARRAY = [];
        function claculateAmount(){
            var total_amount = 0;
            DEPOSITE_HEAD_NO_ARRAY = [];
            YEAR_ARRAY = [];
            MONTH_ARRAY = [];
            AMT_ARRAY = [];
            $(".sum").each(function()
            {
                if($(this).is(":checked"))
                {
                    var DEPOSITE_HEAD_NO = $(this).attr("DEPOSITE_HEAD_NO");
                    var YEAR = $(this).attr("YEAR");
                    var MONTH = $(this).attr("MONTH");
                    var AMT = $(this).attr("AMT");
                    total_amount +=Number ( AMT);
                    DEPOSITE_HEAD_NO_ARRAY.push( DEPOSITE_HEAD_NO );
                    YEAR_ARRAY.push( YEAR );
                    MONTH_ARRAY.push( MONTH );
                    AMT_ARRAY.push( AMT ) ;
                }
            });
            $("#total").text(total_amount);
        } 
         
        $(".sum").on("change",function(){
            claculateAmount(); 
        });
         
        
        var identity = $("#hidden").val(  ) ;
        
        
        
        if( identity != "" )
        {
            $("#showme").show( ) ;
            var value = "fitst" + $('tfooter td#total').val();
            console.log( value ) ;
        }
        else
        {
            $("#showme").hide( ) ;
        }
        
        claculateAmount( ) ;
        
        $("#save_btn").on( "click", function( ) 
        {
            console.log( "click") ;
            var total_sum = 0 ;
            claculateAmount( ) ;
            for( var i = 0 ; i < AMT_ARRAY.length ; i ++ )
            {
                total_sum += Number ( AMT_ARRAY[ i ] ) ;
            }
            
            console.log( total_sum ) ;
            var paid_amount = Number ( $("#paid_amount").val( ) ) ;
            console.log( paid_amount ) ;
            if( paid_amount == total_sum && paid_amount > 0 && total_sum > 0 )
            {
                console.log( "if ") ;
                var member_id = $("#hidden").val( ) ;
                var profile_no = $("#profile_no").val( ) ;
                saveData( "saveAll", DEPOSITE_HEAD_NO_ARRAY, YEAR_ARRAY, MONTH_ARRAY, AMT_ARRAY, member_id , profile_no , paid_amount ) ;
            }
            else
            {
                if( paid_amount == 0 && total_sum == 0 )
                {
                    Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Receive Amount is Zero',
                          showConfirmButton: true,
                          
                        });
                }
                else
                {
                    Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: "Total and Receive Amount aren't same",
                          showConfirmButton: true,
                          
                        });
                    $("#paid_amount").val( "" ) ;
                }
                
            }
            
        }) ;
        
        
        
         
     }) ;
     
 </script>