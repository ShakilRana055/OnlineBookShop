<?php include 'include/header.php';?>
<?php $table_heading = "Rent Collection";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<form action="" id="rent_collection" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    
                    
                    <div class="form-group">
                	<label class="col-md-2 control-label" id = "selectOne">Select One</label>
                	<div class="col-md-10">
                		<label class="radio-inline memberchk" for="example-inline-radio1">
                			<input type="radio" id="radio1"  name = "radio" value="member" > Member
                        
                			
                			</label>
                			<label class="radio-inline memberchk" for="example-inline-radio2">
                				<input type="radio" id="radio2"  name = "radio" value="anyone" > Others
                        
                				
                			</label>
                	</div>
                </div>
       
       <div id = "member_selector" style = "display:none">
                    <div class="form-group" id = "member_name"  >
                    <label class="col-md-3 control-label" for="member_info"> Renter Name <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select id="member_info" name="member_info" class="form-control search" style = "width:100%;">
                        <option value = '-1'>Please select one</option>
                        <?php
                            
                            $sql = "SELECT PROFILE_NO, FULL_NAME, MEMBER_ID FROM member_profiles" ;
                            $result = mysqli_query( $con , $sql ) ;
                            foreach( $result as $value )
                            {
                                echo "<option value = '".$value['PROFILE_NO']."'>".$value['FULL_NAME']."(".$value['MEMBER_ID'].")</option>" ;
                            }
                        ?>
                     </select>
                </div>
                 </div>
                <input type = "hidden" id = "profile_hidden" value =''>
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
               <tbody id='member_table'>
                
                </tbody> 
        </table>
    </div>

    
    <div id = "others_selector" style = "display:none">
        
         <div class="form-group" id = ""  >
                    <label class="col-md-3 control-label" for="renter_name"> Renter Name <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select id="renter_name" name="renter_name" class="form-control search" style = "width:100%;">
                        <option value = '-1'>Please select one</option>
                        <?php
                            
                           $sql = "SELECT `REVENUE_PART_RENT_NO`, `NAME`, `PHONE` FROM revenue_part_rents" ;
                           $result = mysqli_query( $con , $sql ) ;
                           foreach( $result as $value )
                           {
                               echo "<option value = '".$value['REVENUE_PART_RENT_NO']."'>".$value['NAME']."( ".$value['PHONE'].")</option>" ;
                           }
                        ?>
                     </select>
                </div>
                 </div>
                 <input type = "hidden" id = "other_hidden">
              <table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
        
                     <th>Mobile Number</th>
                     <th>Address</th>
                     
                  </tr>
               </thead>
               <tbody id='others_table'>
                </tbody> 
            </table>   
        
    </div>

<fieldset class = "scheduler-border" id = "dues_list" style = "display:none;"> 
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
       <tbody id='dues_list_body'>
                
            </tbody>
            
    </table>

        <input type="hidden" name="hidden" id = "amount_hidden" value="">
        <div class = "col-sm-6">
            
            <div class="form-group">
                        <label class="col-md-4 control-label" for="example-text-input"> <strong>Advance Amount </strong> </label>
                        <div class="col-md-8">
                            <input type="text" id="advance_amount" name="advance_amount" disabled class="form-control" placeholder="">
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label" for="deduction_amount"> <strong>Deduction Amount </strong> </label>
                        <div class="col-md-8">
                            <input type="text" id="deduction_amount" name="deduction_amount" class="form-control" placeholder="">
                        </div>
            </div>
            <label class="col-md-8 control-label" for="example-text-input"> <strong>Deduct From Advance </strong> </label>
            <div class="col-md-1">
                    <input type="checkbox" name="myTextEditBox" checked id = "pay_it">
            </div>
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
</div>
 </form>





 <?php include 'include/footer.php';?>
 
 
 <script>

    function deduction_method( ) 
    {
        var amount = Number ( $("#amount_hidden").val() ) ; 

        var check = $("#pay_it").prop('checked');
        var deduction_amount = Number ( $("#deduction_amount").val() ) ;

        if( check )
        {
            if( deduction_amount > amount )
             {
                alert( "Current Advance Advance Amount Exceeded" ) ;
                deduction_amount = $("#deduction_amount").val("") ;
                $("#deduction_amount").focus() ;
            }
            else
            {
                $("#advance_amount").val( amount - deduction_amount ) ;
            }
        }
        else
        {
            $("#advance_amount").val( amount ) ;
        }
    }
     
     function radio( )
    {
        
        if( $('input[name=radio]:checked', '#rent_collection' ).val( )  == "anyone")
        {
           
            $("#others_selector").show( ) ;
            $("#member_selector").hide( ) ;
            
        }
        else
        {
            
            $("#member_selector").show( ) ;
            $("#others_selector").hide( ) ;
        }
    }
     
     
    function getInformation( information , profile_no )
    {
        $.ajax( { 
            
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"information":information , "profile_no":profile_no } ),
            dataType: "html",
            success: function( Result )
            {
                $("#member_table").html( Result ) ;
            }
            
        }) ;
    }
     
     
     function getRevenue( revenue_info , revenue_no   )
     {
         $.ajax( { 
            
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"revenue_info":revenue_info , "revenue_no":revenue_no } ),
            dataType: "html",
            success: function( Result )
            {
                $("#others_table").html( Result ) ;
            }
            
        }) ;
     }
     
     function getAllDuesProfile( profile_dues , profile_no )
     {
         $.ajax( { 
             
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"profile_dues":profile_dues , "profile_no":profile_no } ),
            dataType: "html",
            success: function( Result )
            {
                $("#dues_list_body").html( Result ) ;
            }
             
         }) ;
     }
    
     function getRevenueDue( revenue_dues , revenue_no )
     {
        $.ajax({ 
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"revenue_dues":revenue_dues , "revenue_no":revenue_no } ),
            dataType: "html",
            success: function( Result )
            {
                 // console.log(Result) ;
                $("#dues_list_body").html( Result ) ;
            }
        }) ;
     }

     function collect_rent( collect_all , revenue_no, deduction_amount, paid ) 
     {
        $.ajax({ 
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"collect_all":collect_all , "revenue_no":revenue_no.toString(), "deduction_amount":deduction_amount , "paid":paid } ),
            dataType: "html",
            success: function( Result )
            {
                console.log( Result) ;
                if( Result == 1 )
                {
                    Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Receive Successfully!',
                          showConfirmButton: false,
                          timer: 1500 
                          
                        });
                }
                else
                {
                    Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'error!',
                          showConfirmButton: false,
                          timer: 1500
                          
                        });
                }
            }
        }) ;
     }

     function getRevenueHandover(handoverAmount ,revenue_no  )
     {
        $.ajax({ 
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"handoverAmount":handoverAmount , "revenue_no":revenue_no } ),
            dataType: "html",
            success: function( Result )
            {
                $("#amount_hidden").val(Result) ;
               $("#advance_amount").val(Result) ;
            }
        }) ;
     }

     function  getProfileHandover( profile_hand , profile_no  ) 
     {
        $.ajax({ 
            url:"actions/rent_collection.php",
            method:"post",
            data: ({"profile_hand":profile_hand , "profile_no":profile_no } ),
            dataType: "html",
            success: function( Result )
            {
                $("#amount_hidden").val(Result) ;
               $("#advance_amount").val(Result) ;
            }
        }) ;
     }

     $(document).ready( function( ) { 
         
         var revenue_no = [] ;
         var summation = [] ;

         function calculate_total(  )
         {
            var total_amount = 0 ;
            revenue_no = [] ;
            summation = [] ;
            $(".sum").each( function ( ) { 

                if($(this).is(":checked"))
                {
                    var no = $(this).attr("REVENUE_PART_SCEHDULE_NO") ;
                    revenue_no.push( no );
                    var amount = $(this).attr("INSTALLMENT_AMOUNT");
                    summation.push(amount) ;
                    total_amount += Number ( amount );
                    
                }


            }) ;
            $("#total").text( total_amount );
             console.log(revenue_no);
             console.log(summation) ;
         }

         calculate_total() ;
         
         $(document).on( "change" , ".sum", function ( ) { 
            calculate_total() ;
         }) ;
        
         $('input[type="radio"]').on( "click change" , function( e ) { 
             
            radio() ;
             
         }) ;
         
         $("#member_info").on( "change" , function( ) { 
                var profile_no = $(this).val( ) ;
                console.log(profile_no);
                $("#profile_hidden").val( profile_no ) ;
                getInformation( "information" , profile_no ) ;
                $("#dues_list").show() ;
                getAllDuesProfile( "profile_dues" , profile_no ) ;
                getProfileHandover( "profile_hand" , profile_no  ) ;

         }) ;
         
         $("#renter_name").on( "change" , function( ) { 
             var revenue_no1 = $(this).val( ) ;
             $("#other_hidden").val( revenue_no1 ) ;
             getRevenue( "revenue_info" , revenue_no1 ) ;
             $("#dues_list").show() ;
             getRevenueDue( "revenue_dues" , revenue_no1 ) ;
             getRevenueHandover( "handoverAmount" ,revenue_no1 ) ;
         }) ;
         

         
         if( $("#profile_hidden").val( ) == "" && $("#other_hidden").val( ) == "" )
         {
             $("#dues_list").hide( ) ;
         }

         $("#save_btn").on( "click" , function( ) 
         { 
            var paid = Number ( $("#paid_amount").val() ) ;
            var deduction_amount = Number( $("#deduction_amount").val() ) ;

            var total_sum = 0 ;
            calculate_total() ;
            for( var  i = 0 ; i < summation.length ; i++ )
            {
                total_sum += Number( summation[ i ] ) ;
            }
            console.log( paid ) ;
            console.log( total_sum ) ;
            if( paid == total_sum && paid > 0 && total_sum > 0 )
            {
                collect_rent( "collect_all" , revenue_no , deduction_amount, paid ) ;

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

         $("#pay_it").click( function( ) { 
            
                deduction_method() ;
            }) ;
         $("#deduction_amount" ).on ( "change" , function() { 
                deduction_method() ;
         }) ; 
          deduction_method() ;
     }) ;
     
     
 </script>