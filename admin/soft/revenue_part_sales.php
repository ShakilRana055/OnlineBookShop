<?php include 'include/header.php';?>
<?php $table_heading = "Revenue Part Sales";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php
    $getvalue = "" ;
    if(isset( $_GET['delete_it'] ) ) 
    {
        $id =  $_GET['delete_it'] ;
        $query = "DELETE FROM `revenue_part_sales` WHERE `REVENUE_PART_SALE_NO` = '$id'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            header( "location: revenue_part_sales.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            header( "location: revenue_part_sales.php" ) ;
        }
    }
    
    if( isset( $_GET['update_it'] ) )
    {
        $id = $_GET['update_it'] ;
        $query = "SELECT * FROM revenue_part_sales LEFT JOIN projects ON revenue_part_sales.PROJECT_NO = projects.PROJECT_NO WHERE REVENUE_PART_SALE_NO = '$id' " ;
        $getvalue = mysqli_fetch_assoc ( mysqli_query( $con , $query ) );
    }

?>

<?php

    $is_search = false ;
    $get_search_result = "" ;
    if( isset( $_POST['search'] ) ) 
    {
        $project_name = $_POST['project_name'] ;
        $mobile = $_POST['mobile'] ;
        $query = "SELECT `NAME`,REVENUE_PART_SALE_NO, `ADVANCE_AMOUNT`, `PHONE`, `EMAIL`, `ID_NUMBER`, `EMERGENCY_CONTACT_NUMBER`, 
            `PERMANENT_ADDRESS`, `SALE_AMOUNT`, `HANDOVER_AMOUNT`, `SALE_DATE`, projects.PROJECT_NAME FROM revenue_part_sales LEFT JOIN projects ON projects.PROJECT_NO = revenue_part_sales.PROJECT_NO" ;
    
        if( $project_name != "" ) 
        {
            $query .= " WHERE projects.PROJECT_NAME LIKE '%".$project_name."%'" ;
        }
        if( $mobile != "" )
        {
            $query .= " WHERE revenue_part_sales.PHONE = '$mobile'" ;
        }
        $is_search = true ;
        $get_search_result = mysqli_query ( $con , $query ) ;
    }

?>


 <form class='cmxform form-horizontal' id = "revenue_part_sales" method = "post" action = "actions/revenue_part.php" enctype = "multipart/form-data" >
     <fieldset class = "scheduler-border">
         <legend class = "scheduler-border"> Revenue Part Sales Information</legend>
         <input type = "hidden" name = "id" value = "<?php echo $getvalue['REVENUE_PART_SALE_NO']; ?>">
    <div class = "col-sm-6">  
    
    <div class="form-group">
                    <label class="col-md-4 control-label" for="project"> Project Name <span class="text-danger">*</span></label>
                <div class="col-md-8">
                    <select id="project_name" name="project" class="form-control search" style = "width:100%">
                        <!--<option value = "<?php echo $getvalue['PROJECT_NO'];?>"><?php echo $getvalue['PROJECT_NAME'];?></option>-->
                        
                        <?php
                            if( $getvalue['PROJECT_NO'] != "" )
                            {
                                echo "<option PROJECT_REVENUE_NO = '".$getvalue['PROJECT_REVENUE_NO']."' value = '".$getvalue['PROJECT_NO']."'>".$getvalue['PROJECT_NAME']."</option>" ;
                            }
                            echo "<option>Please select one</option>" ;
                            $query = "SELECT * FROM `project_revenue` LEFT JOIN projects ON projects.PROJECT_NO = project_revenue.PROJECT_NO WHERE `REVENUE_TYPE`= 'sale'" ;
                            $result = mysqli_query( $con , $query ) ;
                            foreach( $result as $value )
                            {
                                echo "<option PROJECT_REVENUE_NO = '".$value['PROJECT_REVENUE_NO']."' value = '".$value['PROJECT_NO']."'>".$value['PROJECT_NAME']."</option>" ;
                            }
                            
                        ?>
                     </select>
                </div>
     </div>
    
    	<div class="form-group" id = "radio_show" style="display: none;">
        <label class="col-md-4 control-label" id = "selectOne">Select One</label>
        <div class="col-md-8">
        <label class="radio-inline" for="example-inline-radio1">
        <input type="radio" id="radio1"  name = "radio" value="member" checked> Member
        </label>
        <label class="radio-inline" for="example-inline-radio2">
        <input type="radio" id="radio2"  name = "radio" value="anyone"> Anyone Else
        </label>
    
        </div>
        </div>
    
    <div class="form-group" id = "member_name" style = "display:none;"  >
                    <label class="col-md-4 control-label" for="member_info"> Member Name <span class="text-danger">*</span></label>
                <div class="col-md-8">
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
    
	<div class='form-group'>
		<label for='NAME' class='control-label col-lg-4 '>Name </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "NAME" name='NAME' type='text' value = "<?php echo $getvalue['NAME'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<div class='form-group'>
		<label for='MOBILE' class='control-label col-lg-4'>Mobile </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "MOBILE" name='MOBILE' type='text' value = "<?php echo $getvalue['PHONE'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<div class='form-group'>
		<label for='E-MAIL' class='control-label col-lg-4'>E-mail 
			
		</label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "E_MAIL" name='E_MAIL' type='text' value = "<?php echo $getvalue['EMAIL'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<div class='form-group'>
		<label for='ID_NUMBER' class='control-label col-lg-4'>ID Number </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "ID_NUMBER" name='ID_NUMBER' type='text' value = "<?php echo $getvalue['ID_NUMBER'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
		</div>
		
		
		<div class='form-group'>
		<label for='EMERGENCY_CONTACT_NO' class='control-label col-lg-4'>Emergency Contact No </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "EMERGENCY_CONTACT_NO" name='EMERGENCY_CONTACT_NO' type='text' value = "<?php echo $getvalue['EMERGENCY_CONTACT_NUMBER'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	

	
	<div class='form-group'>
		<label for='PERMANENT_ADDRESS' class='control-label col-lg-4'>Permanent Address 
			
		</label>
		<div class='col-lg-8'>
			<textarea class='form-control field_data' id = "PERMANENT_ADDRESS" name='PERMANENT_ADDRESS' type='text'  req='0' is_double = '0' maxlength = '255'> <?php echo $getvalue['PERMANENT_ADDRESS'];?> </textarea>
		</div>
	</div>
		<div class='form-group'>
		<label for='DEAL_DATE' class='control-label col-lg-4'>Deal Date </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "DEAL_DATE" name='DEAL_DATE' type='date' value = "<?php echo $getvalue['SALE_DATE'];?>" req='1' is_double = '0' />
		</div>
	</div>
	
	
	
	</div>
		<!-- Right Side start here-->
	


    <div class = "col-sm-6">
	<div class='form-group'>
		<label for='SALES_AMOUNT' class='control-label col-lg-4'>Sales Amount 
			
		</label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "SALES_AMOUNT" name='SALES_AMOUNT' type='number' value = "<?php echo $getvalue['SALE_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>

    	<div class='form-group'>
		<label for='HAND_OVER_AMOUNT' class='control-label col-lg-4'>Hand over Amount 
			
		</label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "HAND_OVER_AMOUNT" name='HAND_OVER_AMOUNT' type='number' value = "<?php echo $getvalue['HANDOVER_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>

    		<div class='form-group'>
		<label for='DUE_AMOUNT' class='control-label col-lg-4'>Due Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "DUE_AMOUNT" disabled name='DUE_AMOUNT' type='number' value = "<?php echo $getvalue['ADVANCE_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	   
	   <div class='form-group'>
		<label for='ADDITIONAL_CHARGE' class='control-label col-lg-4'>Additional Charge </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "ADDITIONAL_CHARGE" name='ADDITIONAL_CHARGE' type='number' value = "<?php echo $getvalue['ADVANCE_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<div class='form-group'>
		<label for='OUTSTANDING_AMOUNT' class='control-label col-lg-4'>Outstanding Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' disabled id = "OUTSTANDING_AMOUNT" name='OUTSTANDING_AMOUNT' type='number' value = "<?php echo $getvalue['ADVANCE_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
		<div class='form-group'>
		<label for='INSTALLMENT_NUMBER' class='control-label col-lg-4'> Installment Number </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "INSTALLMENT_NUMBER" name='INSTALLMENT_NUMBER' type='number' value = "<?php echo $getvalue['ADVANCE_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<div class='form-group'>
		<label for='INSTALLMENT_AMOUNT' class='control-label col-lg-4'> Installment Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "INSTALLMENT_AMOUNT" name='INSTALLMENT_AMOUNT' type='number' disabled value = "<?php echo $getvalue['ADVANCE_AMOUNT'];?>" req='0' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	
		

    <div class="form-group">
         <label class="col-md-4 control-label" for="loan_period"> Sales Period </label>
            <div class="col-md-8">
                                
                <select class="form-control search" name="SALES_PERIOD" id="SALES_PERIOD" style = "width:100%;" >
                        <option value = "monthly">Monthly</option>
                        <option value = "weekly">Weekly</option>
                        <option value = "yearly">Yearly</option>
                        <option value = "15_days">15 Days</option>
                        <option value = "3_month">3 Month</option>
                        <option value = "6_month">6 Month</option>
                </select>
        </div>
   </div>

	

	
	</div>
	
	<!-- End Right Side-->
	
	<?php
	        if( $_GET['update_it'] )
	        { ?>
	            <div class='form-group'>
            		<div class='col-lg-offset-10'>
            		    <button type='submit' class='btn btn-primary' name = "update" >Update</button>
            			<!--<input type='submit' class='btn btn-primary' table_name='Name_Nos' name = "revenue_part" id='btnAdd' value='Save'/>-->
            		</div>
            	</div>
        <?php
	        }else { ?>
	        
	        	<div class='form-group'>
            		<div class='col-lg-offset-10'>
            		    <button type='submit' class='btn btn-primary' name = "revenue_part" >Save</button>
            			<!--<input type='submit' class='btn btn-primary' table_name='Name_Nos' name = "revenue_part" id='btnAdd' value='Save'/>-->
            		</div>
            	</div>
	        <?php
	            
	        }
	?>
	</div>

	</fieldset>
</form>
<form class='cmxform form-horizontal' action = "" method = "post" enctype = "multipart/form-data" >
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		
			<div class='form-group'>
				<label for='srcCATEGORY_NAME' class='control-label col-lg-3'>Project Name</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' id="search_procet_name" name='project_name' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group'>
				<label for='srcCATEGORY_NAME' class='control-label col-lg-3'>Mobile No</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' id="search_mobile_no" name='mobile' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group '>
			
			<div class='col-lg-offset-7'>
				<button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
			</div>
		</div>
	</fieldset>
</form>

<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>SL No.</th>
         <th>Project Name</th>
         <th>Name</th>
         <th>Mobile</th>
         <th>Email</th>
         <th>ID Number</th>
         <th>Emergency Number</th>
         <th>HandOver Amount</th>
         <th>Advance Amount</th>
         <th>Sales Amount</th>
         <th>Deal Date</th>
         
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'>
       
       <?php
       if( $is_search == true )
       {
           $count = 1 ;
           foreach( $get_search_result as $value )
           {
               echo "<tr>" ;
                    echo "<td>".$count ++ ."</td>" ;
                    echo "<td>".$value['PROJECT_NAME']."</td>" ;
                    echo "<td>".$value['NAME']."</td>" ;
                    echo "<td>".$value['PHONE']."</td>" ;
                    echo "<td>".$value['EMAIL']."</td>" ;
                    echo "<td>".$value['ID_NUMBER']."</td>" ;
                    echo "<td>".$value['EMERGENCY_CONTACT_NUMBER']."</td>" ;
                    echo "<td>".$value['HANDOVER_AMOUNT']."</td>" ;
                    echo "<td>".$value['ADVANCE_AMOUNT']."</td>" ;
                    echo "<td>".$value['SALE_AMOUNT']."</td>" ;
                    echo "<td>".$value['SALE_DATE']."</td>" ;
                ?>
                
                <td class="text-center">
                        <div class="btn-group">
                        <a href="revenue_part_sales.php?update_it=<?=$value['REVENUE_PART_SALE_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="revenue_part_sales.php?delete_it=<?=$value['REVENUE_PART_SALE_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" onclick="return confirm('Are you Sure Want to Delete?');" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                
                <?php
                echo "</tr>" ;
           }
           $is_search = false ;
       }
       else
       {
            $query = "SELECT `NAME`,REVENUE_PART_SALE_NO, `ADVANCE_AMOUNT`, `PHONE`, `EMAIL`, `ID_NUMBER`, `EMERGENCY_CONTACT_NUMBER`, 
            `PERMANENT_ADDRESS`, `SALE_AMOUNT`, `HANDOVER_AMOUNT`, `SALE_DATE`, projects.PROJECT_NAME FROM revenue_part_sales LEFT JOIN projects ON projects.PROJECT_NO = revenue_part_sales.PROJECT_NO  " ;
            $count = 1 ;
            $result = mysqli_query( $con , $query ) ;
            foreach( $result as $value )
            {
                echo "<tr>" ;
                    echo "<td>".$count ++ ."</td>" ;
                    echo "<td>".$value['PROJECT_NAME']."</td>" ;
                    echo "<td>".$value['NAME']."</td>" ;
                    echo "<td>".$value['PHONE']."</td>" ;
                    echo "<td>".$value['EMAIL']."</td>" ;
                    echo "<td>".$value['ID_NUMBER']."</td>" ;
                    echo "<td>".$value['EMERGENCY_CONTACT_NUMBER']."</td>" ;
                    echo "<td>".$value['HANDOVER_AMOUNT']."</td>" ;
                    echo "<td>".$value['ADVANCE_AMOUNT']."</td>" ;
                    echo "<td>".$value['SALE_AMOUNT']."</td>" ;
                    echo "<td>".$value['SALE_DATE']."</td>" ;
                ?>
                
                <td class="text-center">
                        <div class="btn-group">
                        <a href="revenue_part_sales.php?update_it=<?=$value['REVENUE_PART_SALE_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="revenue_part_sales.php?delete_it=<?=$value['REVENUE_PART_SALE_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" onclick="return confirm('Are you Sure Want to Delete?');" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                
                <?php
                echo "</tr>" ;
            }
       }
       
       ?>
       
   </tbody>
</table>




 <?php include 'include/footer.php';?>
 
 
 <script>
    
    function handmade_disabled( )
    {
        $( "#NAME").prop("disabled", true ) ;
        $( "#MOBILE").prop("disabled", true ) ;
        $( "#ID_NUMBER").prop("disabled", true ) ;
        $( "#PERMANENT_ADDRESS").prop("disabled", true ) ;
    }
    
    function clear( )
    {
        $( "#NAME").prop("disabled", false ) ;
        $( "#MOBILE").prop("disabled", false ) ;
        $( "#ID_NUMBER").prop("disabled", false ) ;
        $( "#PERMANENT_ADDRESS").prop("disabled", false ) ;
         $( "#NAME").val( "" ) ;
                
        $( "#MOBILE").val( "" ) ;
        $( "#ID_NUMBER").val( "" ) ;
        $( "#PERMANENT_ADDRESS").text( "" ) ;
    }
    
    function getForWhom( forwhom , PROJECT_REVENUE_NO )
     {
         $.ajax( { 
             
             url: "actions/ajax.php",
             method: "post",
             data: ({ "forwhom":forwhom , "PROJECT_REVENUE_NO":PROJECT_REVENUE_NO }),
             dataType: "html",
             success: function(Result, xhr) {
                console.log( Result ) ;
            if( Result == "member" )
            {
                $("#radio_show").show() ;
                $("#radio1").prop("checked", true);
                $("#radio1").trigger("change");
                
            }
            else
            {
                $("#radio_show").hide() ;
                $("#radio2").prop("checked", true);
                $("#radio2").trigger("change");
            }
                 
             }
         }) ;
     }
    
    function getInformation( profile_no )
    {
        
         $.ajax({
            url: "actions/ajax.php",
            method: "post",
            data: ({
                "profile_noaction": profile_no,
                
            }),
            dataType: "html",
            success: function(Result, xhr) {
               console.log( Result ) ;
                var all_information = JSON.parse( Result ) ;
                console.log( all_information ) ;
                $( "#NAME").val( all_information[0].FULL_NAME ) ;
                $( "#MOBILE").val( all_information[0].MOBILE ) ;
                $( "#ID_NUMBER").val( all_information[0].NID ) ;

                var address = all_information[ 0 ].PRESENT_HOUSE_NO + " , "+ all_information[ 0 ].PRESENT_ROAD_NO + " , "+ all_information[ 0 ].PRESENT_AVENUE + " , "+ all_information[ 0 ].PRESENT_BLOCK + " , "
                                + all_information[ 0 ].PRESENT_SECTION + " , "+ all_information[ 0 ].PRESENT_COLONY + " , "+ all_information[ 0 ].PRESENT_THANA + " , "+ all_information[ 0 ].PRESENT_DISTRICT + " , "
                                + all_information[ 0 ].PRESENT_POSTCODE + " , "+ all_information[ 0 ].PRESENT_POST_OFFICE ;
                
                $( "#PERMANENT_ADDRESS").text( address ) ;
                handmade_disabled() ;
            },
            error: function(xhr, thrownError, ajaxOptions) {}
        });
        
        
    }
    
    function radio( )
    {
        if( $('input[name=radio]:checked', '#revenue_part_sales' ).val( )  == "anyone")
        {
            clear() ;
            $("#member_name").hide( ) ;
        }
        else
        {
            clear() ;
            $("#member_name").show( ) ;
        }
    }
    
    function due_amount( )
    {
        var sale_amount = Number ( $("#SALES_AMOUNT").val() ) ;
        var handover = Number ( $("#HAND_OVER_AMOUNT").val() ) ;
        var final = sale_amount - handover ;
        $("#DUE_AMOUNT").val( final ) ;
        $("#OUTSTANDING_AMOUNT").val( final ) ;
        
    }
    
    function outstading_amount( )
    {
        var due = Number ( $("#DUE_AMOUNT").val( )  ) ;
        var additional = Number ( $("#ADDITIONAL_CHARGE").val( ) ) ;
        $("#OUTSTANDING_AMOUNT").val( due + additional ) ;
    }
    
    function clear_all_Calculation( )
    {
        $("#HAND_OVER_AMOUNT").val("") ;
        $("#DUE_AMOUNT").val("") ;
        $("#ADDITIONAL_CHARGE").val("") ;
        $("#OUTSTANDING_AMOUNT").val("") ;
        
    }
    
    
    // ready function ////
    
    
     $(document).ready( function( )
     {
         $("#revenue_part_sales").on("submit", function()
         {
             
             $(".field_data").removeAttr("disabled");
             
         })
         
         $("#HAND_OVER_AMOUNT").on("change" , function( ) { 
             
             due_amount() ;
             
         }) ;
         
         due_amount() ;
         outstading_amount() ;
         clear_all_Calculation() ;
         
        
        
        $("#SALES_AMOUNT").on ( "change", function( ) { 
            clear_all_Calculation( ) ;
             var value = $("#SALES_AMOUNT").val() ;
            $("#DUE_AMOUNT").val(value) ;
            $("#OUTSTANDING_AMOUNT").val(value) ;
            
        }) ;
         
         $("#INSTALLMENT_NUMBER").on ( "change", function( ) { 
            
            var value = $("#OUTSTANDING_AMOUNT").val() ;
            var no = Number (  $("#INSTALLMENT_NUMBER").val() ) ;
            if( no <= 0 )
            {
                Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error Installment Number',
                          showConfirmButton: true,
                          
                        });
            }
            else
            {
                $("#INSTALLMENT_AMOUNT").val( value / no ) ;
            }

        }) ;
         
         $("#ADDITIONAL_CHARGE").on( "change" , function( ) { 
             outstading_amount() ;
         }) ;
         
         $("#project_name").on( "change" , function( ) { 
             
             var value = $("#project_name option:selected").attr( 'PROJECT_REVENUE_NO' ) ;
             
             getForWhom( "forwhom" , value ) ;
         }) ;
         
         
         $('input[type="radio"]').on( " click change" , function( e ) { 
             
            radio() ;
             
         }) ;
         
         // radio() ;
         
         $("#member_info").on( "change" , function( ) { 
             
              getInformation( $(this).val() ) ;
              console.log($(this).val() );
             
         }) ;
         
         
            <?php
                if( isset( $_SESSION['msgPositive'] ) == "success")
                {
                    ?>
                       
                    //   swal("Success!", "Data Save Successfully", "success");     
                    Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successful',
                          showConfirmButton: false,
                          timer: 1500
                        });

                            
                    <?php
                    unset( $_SESSION['msgPositive'] ) ;
                }
                else if(isset( $_SESSION['msgPositive'] )== "error" )
                {
                    ?>
                        Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php
                    unset( $_SESSION['msgPositive'] ) ;
                    
                }
            
            
            ?>
         
     }) ;
 </script>
 
 