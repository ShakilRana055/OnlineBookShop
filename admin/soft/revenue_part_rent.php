<?php include 'include/header.php';?>
<?php $table_heading = "Revenue Part Rent";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php
    $checker = "" ;
    $get_value = "" ;
    if( isset($_GET['delete_it'] ) )
    {
        $id = $_GET['delete_it'] ;
        $query = "DELETE FROM revenue_part_rents WHERE REVENUE_PART_RENT_NO = '$id'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            header( "location: revenue_part_rent.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            header( "location: revenue_part_rent.php" ) ;
        }
    }
    
    if( isset ( $_GET['update_it'] ) ) 
    {
        $id = $_GET['update_it'] ;
        $query = "SELECT * FROM revenue_part_rents LEFT JOIN projects ON projects.PROJECT_NO = revenue_part_rents.PROJECT_NO WHERE REVENUE_PART_RENT_NO = '$id' " ;
        $get_value = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
    }

?>

<?php

    $is_search = false ;
    $get_search_result = "" ;
    if( isset( $_POST['search'] ) ) 
    {
        $project_name = $_POST['project_name'] ;
        $mobile = $_POST['mobile'] ;
        $sql = "SELECT * FROM revenue_part_rents LEFT JOIN projects ON projects.PROJECT_NO = revenue_part_rents.PROJECT_NO" ;
        if( $project_name != "" )
        {
            $sql .= " WHERE projects.PROJECT_NAME LIKE '%".$project_name."%'" ;
        }
        if( $mobile != "" )
        {
            $sql .= " WHERE revenue_part_rents.PHONE = '$mobile'" ;
        }
        
        $get_search_result = mysqli_query( $con , $sql ) ;
        
        $is_search = true ;
    }

?>

<form class='cmxform form-horizontal' action = "actions/revenue_rent.php" id = "revenue_part_rent" method = "post" enctype = "multipart/form-data">
    <fieldset class = "scheduler-border">
        <legend class = "scheduler-border" > Revenue Part Rent information </legend>
        
    <!-- Strt left side -->
    <div class = "col-sm-6">
    <input type = "hidden" name = "id" value = "<?php echo $get_value['REVENUE_PART_RENT_NO'] ; ?>">
    <div class="form-group">
                    <label class="col-md-3 control-label" for="project"> Project Name <span class="text-danger">*</span></label>
                <div class="col-md-8">
                    <select id="project_name" name="project" class="form-control search" style = "width:100%;">
                        
                        
                        <?php
                            if( $get_value['PROJECT_NAME'] != "" )
                            {
                                echo "<option value = '".$get_value['PROJECT_NO']."'>".$get_value['PROJECT_NAME']."</option>" ;
                            }
                            echo "<option value='-1'>Please select one</option>" ;
                            $query = "SELECT * FROM `project_revenue` LEFT JOIN projects ON projects.PROJECT_NO = project_revenue.PROJECT_NO WHERE `REVENUE_TYPE`= 'rent'" ;
                            $result = mysqli_query( $con , $query ) ;
                            $checker = mysqli_fetch_assoc( $result ) ;
                            foreach( $result as $value )
                            {
                                echo "<option PROJECT_REVENUE_NO = '".$value['PROJECT_REVENUE_NO']."' value = '".$value['PROJECT_NO']."'>".$value['PROJECT_NAME']."</option>" ;
                            }
                            
                        ?>
                     </select>
                </div>
     </div>
     <input type = "hidden" id = "value_set" name = "value_set">
     
     <div class="form-group" id = "show_raidio_button" style="display: none;">
        <label class="col-md-3 control-label" id = "selectOne">Select One</label>
        <div class="col-md-8">
        <label class="radio-inline memberchk" for="example-inline-radio1">
        <input type="radio" id="radio1"  name = "radio" value="member" > Member
        </label>
        <label class="radio-inline memberchk" for="example-inline-radio2">
        <input type="radio" id="radio2"  name = "radio" value="anyone" > Anyone Else
        </label>
    
        </div>
        </div>
        
        <div class="form-group" id = "member_name" style = "display:none;"  >
                    <label class="col-md-3 control-label" for="member_info"> Member Name <span class="text-danger">*</span></label>
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
     <input type="hidden" id = "profile_no" name="profile_no">

	<div class='form-group'>
		<label for='NAME' class='control-label col-lg-3'>Renter Name </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "NAME" name='NAME' type='text' value="<?php echo $get_value['NAME'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<div class='form-group'>
		<label for='PHONE' class='control-label col-lg-3'> Phone/ Mobile </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='PHONE' id = "MOBILE" type='text' value="<?php echo $get_value['PHONE'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>


	<div class='form-group'>
		<label for='EMAIL' class='control-label col-lg-3'>Email </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='EMAIL' type='text' value="<?php 
			echo $get_value['EMAIL'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<div class='form-group'>
		<label for='emergency ' class='control-label col-lg-3'>Emergency Cotact Number </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='emergency' type='text' value="<?php echo $get_value['EMERGENCY_CONTACT_NUMBER'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<div class='form-group'>
		<label for='permanent' class='control-label col-lg-3'>Permanent Address</label>
		<div class='col-lg-8'>
			<textarea class='form-control field_data' id = "PERMANENT_ADDRESS" name='permanent' type='text' value="" req='1' is_double = '0' maxlength = '255'><?=$get_value['PERMANENT_ADDRESS']?></textarea>
		</div>
	</div>
	
	<div class='form-group'>
		<label for='ADVANCE_AMOUNT' class='control-label col-lg-3'>NID Number </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='id_number' id = "ID_NUMBER" type='text' value="<?php echo $get_value['ID_NUMBER'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<!--End left Side here-->
	</div>
	
	<!--Start Right bar -->
	<div class = "col-sm-6">
	    
	<div class='form-group'>
		<label for='RENT_AMOUNT' class='control-label col-lg-3'>Rent Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "rent_amount" name='RENT_AMOUNT' type='number' value="<?php echo $get_value['RENT_AMOUNT'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	<div class='form-group'>
		<label for='handover_amount' class='control-label col-lg-3'>Handover Amount</label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "handover_amount" name='handover_amount' type='number' value="<?php echo $get_value['HANDOVER_AMOUNT'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
	<div class='form-group'>
		<label for='ADVANCE_AMOUNT' class='control-label col-lg-3'>Due Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "due_amount" disabled name='ADVANCE_AMOUNT' type='number' value="<?php echo $get_value['ADVANCE_AMOUNT'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
		<div class='form-group' >
		<label for='NUMBER_OF_INSTALLMENT' class='control-label col-lg-3'>Number of Installment </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "NUMBER_OF_INSTALLMENT" name='NUMBER_OF_INSTALLMENT' type='number' value="<?php echo $get_value['NO_OF_INSTALLMENT'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	
		<div class='form-group'>
		<label for='INSTALLMENT_AMOUNT' class='control-label col-lg-3'>Installment Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' disabled id = "INSTALLMENT_AMOUNT" name='INSTALLMENT_AMOUNT' type='number' value="<?php echo $get_value['INSTALLMENT_AMOUNT'];?>" req='1' is_double = '0' maxlength = '255'/>
		</div>
	</div>
	

	
	<div class='form-group'>
		<label for='START_DATE' class='control-label col-lg-3'>Start Date </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='START_DATE' type='date' value="<?php echo $get_value['DEAL_DATE'];?>" req='1' is_double = '0' />
		</div>
	</div>
	
	

	
	<div class="form-group">
         <label class="col-md-3 control-label" for="loan_period"> Rent Period </label>
            <div class="col-md-8">
                                
                <select class="form-control search" name="RENT_PERIOD" id="RENT_PERIOD" style = "width:100%;" >
                        <option value = "monthly">Monthly</option>
                        <option value = "weekly">Weekly</option>
                        <option value = "yearly">Yearly</option>
                        <option value = "15_days">15 Days</option>
                        <option value = "3_month">3 Month</option>
                        <option value = "6_month">6 Month</option>
                </select>
        </div>
   </div>
	
	<!--End Right Sidebar -->
	<?php 
	    if( isset($_GET['update_it']) )
	    {
	        ?>
	        <div class='form-group'>
    		    <div class='col-lg-offset-10'>
    			<input type='submit' class='btn btn-primary' name = "update_final" value='Update'/>
		    </div>
	    </div>
	<?php
	    }else
	    {
	        ?>
	<div class='form-group'>
		<div class='col-lg-offset-10'>
			<input type='submit' class='btn btn-primary' id = "save_it" name = "revenue_rent" value='Save'/>
		</div>
	</div>
	<?php }?>
	</div>
	</fieldset>
</form>

<form class='cmxform form-horizontal' action = "" method = "post" enctype = "multipart/form-data">
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
			<th>#</th>
			<th>Project Name</th>
			<th>Renter Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Rent Amount</th>
			<th>Start Date</th>
			<th>Advance Amount</th>
			<th>Installment Amount</th>
			<th>Number of Installment</th>
			
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
	                
	                    echo "<td>".$count ++."</td>" ;
	                    echo "<td>".$value['PROJECT_NAME']."</td>" ;
	                    echo "<td>".$value['NAME']."</td>" ;
	                    echo "<td>".$value['PHONE']."</td>" ;
	                    echo "<td>".$value['EMAIL']."</td>" ;
	                    echo "<td>".$value['RENT_AMOUNT']."</td>" ;
	                    echo "<td>".$value['DEAL_DATE']."</td>" ;
	                    echo "<td>".$value['ADVANCE_AMOUNT']."</td>" ;
	                    echo "<td>".$value['INSTALLMENT_AMOUNT']."</td>" ;
	                    echo "<td>".$value['NO_OF_INSTALLMENT']."</td>" ;
	                    
	           ?>
	                    <td class="text-center">
                        <div class="btn-group">
                        <a href="revenue_part_rent.php?update_it=<?=$value['REVENUE_PART_RENT_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="revenue_part_rent.php?delete_it=<?=$value['REVENUE_PART_RENT_NO']?>" data-toggle="tooltip" onclick="return confirm('Are you Sure Want to Delete?');" title="" class="btn btn-xs btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
	            <?php
	                    
	                echo "</tr>" ;
	                
	            }
	            $is_search = false ;
	           }
	           else
	           {
	        
    	            $query = "SELECT * FROM revenue_part_rents LEFT JOIN projects ON projects.PROJECT_NO = revenue_part_rents.PROJECT_NO " ;
    	            $result = mysqli_query( $con , $query ) ;
    	            $count = 1;
    	            foreach( $result as $value )
    	            {
    	                echo "<tr>" ;
    	                
    	                    echo "<td>".$count ++."</td>" ;
    	                    echo "<td>".$value['PROJECT_NAME']."</td>" ;
    	                    echo "<td>".$value['NAME']."</td>" ;
    	                    echo "<td>".$value['PHONE']."</td>" ;
    	                    echo "<td>".$value['EMAIL']."</td>" ;
    	                    echo "<td>".$value['RENT_AMOUNT']."</td>" ;
    	                    echo "<td>".$value['DEAL_DATE']."</td>" ;
    	                    echo "<td>".$value['ADVANCE_AMOUNT']."</td>" ;
    	                    echo "<td>".$value['INSTALLMENT_AMOUNT']."</td>" ;
    	                    echo "<td>".$value['NO_OF_INSTALLMENT']."</td>" ;
    	                    
    	                    
    	                    ?>
    	                    <td class="text-center">
                            <div class="btn-group">
                            <a href="revenue_part_rent.php?update_it=<?=$value['REVENUE_PART_RENT_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="revenue_part_rent.php?delete_it=<?=$value['REVENUE_PART_RENT_NO']?>" data-toggle="tooltip" onclick="return confirm('Are you Sure Want to Delete?');" title="" class="btn btn-xs btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
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
 var hidden="";
    
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
                 
            if( Result == "member" )
            {

            	$("#show_raidio_button").show() ;
                $("#radio1").prop("checked", true);
                $("#radio1").trigger("change");
                $("#member_name").show( ) ;
                
            }
            else
            {
            	 $("#member_name").hide( ) ;
            	$("#show_raidio_button").hide() ;
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
               
                var all_information = JSON.parse( Result ) ;
                
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
        
        if( $('input[name=radio]:checked', '#revenue_part_rent' ).val( )  == "anyone")
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
    
    function clear_calculation( )
    {
        $("#due_amount").val("") ;
        $("#handover_amount").val("") ;
        $("#NUMBER_OF_INSTALLMENT").val("") ;
        $("#INSTALLMENT_AMOUNT").val("") ;
    }
     
     
     $( document ).ready( function ( ) 
     {
         
         // $(".field_data").removeAttr("disabled") ;

         $("#revenue_part_rent").submit( function( ) { 
         		$(".field_data").removeAttr("disabled") ;
         }) ;
         
         $("#project_name").on( "change", function( ) { 
             
             var value = $("#project_name option:selected").attr( 'PROJECT_REVENUE_NO' ) ;
             
             getForWhom( "forwhom" , value ) ;
              
         }) ;
        
        
        // calculation //
        
        $("#rent_amount").on ("change", function ( ) 
        {
            clear_calculation() ;
             var rent_amount = Number(  $("#rent_amount").val() ) ;
            $("#due_amount").val( rent_amount ) ;
        
            
        }) ;
        
        // $("#handover_amount").on("change" , function( ) { 
            
        //     var rent_amount = Number(  $("#rent_amount").val() ) ;
        //     var handover = Number ( $(this).val( ) ) ;
        //     $("#due_amount").val( rent_amount - handover ) ;
            
        // }) ;
        
        
        $("#NUMBER_OF_INSTALLMENT").on("change" , function( ) { 
            var rent_amount = Number(  $("#rent_amount").val() ) ;
            var handover = Number ( $("#handover_amount").val() ) ;
            
            var number = Number ( $("#NUMBER_OF_INSTALLMENT").val() );
            // var due = rent_amount - handover ;
            
            $("#INSTALLMENT_AMOUNT").val( rent_amount / number ) ;
            
        }) ;
        
        
        
        
        
        // end calculation //
        

         $('input[type="radio"]').on( "click change" , function( e ) { 
             
            radio() ;
             
         }) ;
         
         // radio( ) ;
         
         $("#member_info").on( "change" , function( ) { 

         	 $("#profile_no").val( $(this).val() ) ;
         	 console.log( $("#profile_no").val( ) ) ;
              getInformation( $(this).val() ) ;
         }) ;
         

         
         
         
         <?php
                if( isset( $_SESSION['msgPositive'] )== "success")
                {
                    ?>
                       
                    //   swal("Success!", "Data Save Successfully", "success");     
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
         
         
         
         // Showing Installment Number
        //  $("#INSTALLMENT_AMOUNT").on ( "change", function( ) {
             
        //      var value = $("#INSTALLMENT_AMOUNT").val( ).trim( ) ;
             
        //      if( value != "") 
        //      {
        //          console.log( value ) ;
        //           $("#NUMBER_OF_INSTALLMENT").show( ) ;
        //      }
        //      else
        //      {
        //          console.log("else") ;
        //          $("#NUMBER_OF_INSTALLMENT").hide( ) ;
        //      }
             
        //  }) ;// End Number of Installment Showing
         
         
     }) ;
     
 </script>
 
 