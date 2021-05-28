<?php include 'include/header.php';?>
<?php $table_heading = "Sale Collection";?>
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
                // echo "<td>".$value['LOAN_AMOUNT']."</td>" ;
                // echo "<td>".$value['NUMBER_OF_INSTALLMENT']."</td>" ;
                // echo "<td>".$value['INSTALLMENT_AMOUNT']."</td>" ;
                // echo "<td></td>" ;
                                    
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
             <th>Day</th>
             <th>Month</th>
             <th>Year</th>
             
             <th>Installment Number</th>
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
                    
                    $sql = "SELECT PROJECT_SCHEDULE_NO, project_sales_schedule.DAY, project_sales_schedule.MONTH , project_sales_schedule.YEAR , 
                    project_sales_schedule.INSTALLMENT_NUMBER, project_sales_schedule.INSTALLMENT_AMOUNT FROM revenue_part_sales 
                    LEFT JOIN project_sales_schedule ON project_sales_schedule.PROJECT_SALE_NO = revenue_part_sales.REVENUE_PART_SALE_NO 
                    WHERE revenue_part_sales.MEMBER_NO = '$member_no' AND project_sales_schedule.IS_PAID = 0 " ;
                    
                    $result = mysqli_query( $con , $sql ) ;
                    
                    $count = 1 ;
                    foreach( $result as $value )
                    {
                        echo "<tr>" ;
                        
                            echo "<td>".$count ."</td>" ; 
                            echo "<td>".$value['DAY']."</td>" ;
                            echo "<td>".getMonth( $value['MONTH'] ) ."</td>" ;
                            echo "<td>".$value['YEAR']."</td>" ;
                            
                            echo "<td>".$value['INSTALLMENT_NUMBER']."</td>" ;
                            echo "<td>".$value['INSTALLMENT_AMOUNT']."</td>" ;
                            $total_amount += $value['INSTALLMENT_AMOUNT'] ;
                           ?>
                           
                           <td>
                                  <input type="checkbox" name="myTextEditBox" class = "sum"  id="<?php echo $count ; ?>" 
                                  DAY = '<?php echo $value['DAY']; ?>' MONTH = '<?php echo $value['MONTH']; ?>' YEAR = '<?php echo $value['YEAR']; ?>'
                                  INSTALLMENT_NUMBER = '<?php echo $value['INSTALLMENT_NUMBER']; ?>' INSTALLMENT_AMOUNT = '<?php echo $value['INSTALLMENT_AMOUNT']; ?>'
                                  PROJECT_SCHEDULE_NO = '<?php echo $value['PROJECT_SCHEDULE_NO']; ?>' style="margin-left:auto; margin-right:auto;"/>
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
                    <th colspan = '4' > Total</th>
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
     
     function confirm_click( )
     {
         Swal.fire({
                  title: 'Do you want to Print?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Print!'
                }).then((result) => {
                  if (result.value) {
                    Swal.fire(
                      'Printed!',
                      'Your file has been Printed.',
                      'success'
                    )
                  }
            }) ;
     }
     
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
     function reload_function()
     {
          window.location.href = "/submit/template/soft/sale_collection.php" ;
     }
     
     function saveData( paid_revenue_sale , project_schedule , paid_amount, member_id, profile_no )
     {
         $.ajax( { 
             
             url : "actions/revenue_part.php",
             method : "post",
             data: ({ "paid_revenue_sale": paid_revenue_sale , "project_schedule": project_schedule.toString() , "paid_amount" : paid_amount, "member_id":member_id, "profile_no":profile_no  }),
             dataTYpe: "html",
             success: function( Result )
             {
                
                 if( Result == 1 )
                 {
                        
                        // show('1') ;
                        // Swal.fire({
                        //   position: 'top-middle',
                        //   type: 'success',
                        //   title: 'Sucessfull!',
                        //   showConfirmButton: true,
                        // });
                        window.location.href = "/submit/template/soft/sale_receive_payment.php" ;
                        // confirm_click() ;
                 }
                 else
                 {
                     show('0') ;
                    setTimeout( reload_function(), 3000 ) ;
                 }
             }
             
         }) ;
     }
     
     
     $( document ).ready( function( ) { 
        
        var day_array = [];
        var month_array = [];
        var year_array = [];
        var installment_number = [];
        var installment_amount = [] ;
        var project_schedule = [] ;
        function claculateAmount(){
            var total_amount = 0;
            day_array = [];
            month_array = [];
            year_array = [];
            installment_number = [];
            installment_amount = [];
            project_schedule = [] ;
            
            $(".sum").each(function()
            {
                if($(this).is(":checked"))
                {
                    var DAY = $(this).attr("DAY");
                    var YEAR = $(this).attr("YEAR");
                    var MONTH = $(this).attr("MONTH");
                    var INSTALLMENT_NUMBER = $(this).attr("INSTALLMENT_NUMBER");
                    var AMOUNT = $(this).attr("INSTALLMENT_AMOUNT");
                    var PROJECT_SCHEDULE_NO = $(this).attr( "PROJECT_SCHEDULE_NO" ) ;
                    total_amount +=Number ( AMOUNT );
                    
                    day_array.push( DAY )
                    month_array.push( MONTH ) ;
                    year_array.push( YEAR ) ;
                    installment_number.push( INSTALLMENT_NUMBER ) ;
                    installment_amount.push( AMOUNT ) ;
                    project_schedule.push( PROJECT_SCHEDULE_NO ) ;
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
            for( var i = 0 ; i < installment_amount.length ; i ++ )
            {
                total_sum += Number ( installment_amount[ i ] );
            }
            
            console.log( total_sum ) ;
            var paid_amount = Number ( $("#paid_amount").val( ) ) ;
            if( paid_amount == total_sum && paid_amount > 0 && total_sum > 0 )
            {
                console.log( "if ") ;
                var member_id = $("#hidden").val( ) ;
                var profile_no = $("#profile_no").val( ) ;
                
                 saveData( "paid_revenue_sale" , project_schedule, paid_amount, member_id, profile_no ) ;
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