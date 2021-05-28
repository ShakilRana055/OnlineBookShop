
<?php include 'include/header.php';?>
<?php $table_heading = "Rent Collection List";?>
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
       
       <div id="member_information" style="display: none;">
       		<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		<div class='form-group '>
			<div class='form-group'>
				<label for='srcMEMBER_ID' class='control-label col-lg-3'>Member ID</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='MEMBER_ID' id="member_member_id" type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group'>
				<label for='srcFROM_DATE' class='control-label col-lg-3'>From Date</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' id="member_from_date" name='FROM_DATE' type='date' is_double = '0' />
				</div>
			</div>
			<div class='form-group'>
				<label for='srcTO_DATE' class='control-label col-lg-3'>To Date</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' id="member_to_date" name='TO_DATE' type='date' is_double = '0' />
				</div>
			</div>
			<label for='location' class='control-label col-lg-3'></label>
			<div class=' col-lg-5'>
				<input type='button' name="search" id="member_search" class='btn btn-primary pull-right'  value='Search' />
			</div>
		</div>
	</fieldset>
       </div>

       <div id="other_information" style="display: none;">
					
			<fieldset class='scheduler-border'>
				<legend class='scheduler-border'>Search</legend>
				<div class='form-group '>
					<div class='form-group'>
						<label for='srcMOBILE_NUMBER' class='control-label col-lg-3'>Mobile Number</label>
						<div class='col-lg-5'>
							<input class='form-control src_data' id="other_mobile" name='MOBILE_NUMBER' type='text' is_double = '0' maxlength = '255'/>
						</div>
					</div>
					<div class='form-group'>
						<label for='srcFROM_DATE' class='control-label col-lg-3'>From Date</label>
						<div class='col-lg-5'>
							<input class='form-control src_data' id="other_from_date" name='FROM_DATE' type='date' is_double = '0' />
						</div>
					</div>
					<div class='form-group'>
						<label for='srcTO_DATE' class='control-label col-lg-3'>To Date</label>
						<div class='col-lg-5'>
							<input class='form-control src_data' id="other_to_date" name='TO_DATE' type='date' is_double = '0' />
						</div>
					</div>
					<label for='location' class='control-label col-lg-3'></label>
					<div class=' col-lg-5'>
						<input type='button' table_name = 'nothing_notiings' class='btn btn-primary pull-right' id='other_search' value='Search' />
					</div>
				</div>
			</fieldset>

       </div>

 </form>
<div id = "hide_for_member" style="display: none;">
 <table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
       <thead>
          <tr>
             <th>#</th>
             <th>Name</th>
             <th>Member ID</th>
             <th>Paid Date</th>
             <th>Schedule Date</th>
             <th>Installment Number</th>
             <th>Amount</th>
             <th>Action</th>
             
          </tr>
       </thead>
       <tbody id='for_member_list'>
                
            </tbody>
            
    </table>
</div>

<div id = "hide_for_other" style="display: none;">
 <table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
       <thead>
          <tr>
             <th>#</th>
             <th>Name</th>
             <th>Mobile Number</th>
             <th>Paid Date</th>
             <th>Schedule Date</th>
             <th>Installment Number</th>
             <th>Amount</th>
             <th>Action</th>
             
          </tr>
       </thead>
       <tbody id='for_other_list'>
                
            </tbody>
            
    </table>
</div>

 <?php include 'include/footer.php';?>
 
 <script type="text/javascript">
 	
 	function get_all_member( all_member )
 	{
 		$.ajax( { 

 			url: "actions/rent_collection_list.php",
 			method:"post",
 			data: ({ "all_member": all_member }),
 			dataType: "html",
 			success: function( Result )
 			{
 				$("#for_member_list").html(Result) ;
 			}

 		}) ;
 	}

 	function get_all_other( all_other )
 	{
 		$.ajax( { 

 			url: "actions/rent_collection_list.php",
 			method:"post",
 			data: ({ "all_other": all_other }),
 			dataType: "html",
 			success: function( Result )
 			{
 				$("#for_other_list").html(Result) ;
 			}

 		}) ;
 	}

 	function GetMemberInformation( member_search, member_member_id, member_from_date, member_to_date  ) 
 	{
 		$.ajax( { 

 			url: "actions/rent_collection_list.php",
 			method:"post",
 			data: ({ "member_search": member_search , "member_member_id": member_member_id, "member_from_date":member_from_date, "member_to_date":member_to_date }),
 			dataType: "html",
 			success: function( Result )
 			{
 				$("#for_member_list").html(Result) ;
 			}

 		}) ;
 	}


 	function GetOtherInformation( other_search , other_mobile, other_from_date, other_to_date ) 
 	{
 		$.ajax( { 

 			url: "actions/rent_collection_list.php",
 			method:"post",
 			data: ({ "other_search": other_search , "other_mobile": other_mobile, "other_from_date":other_from_date, "other_to_date":other_to_date }),
 			dataType: "html",
 			success: function( Result )
 			{
 				$("#for_other_list").html(Result) ;
 			}

 		}) ;
 	}


 	 function radio( )
    {
        
        if( $('input[name=radio]:checked', '#rent_collection' ).val( )  == "anyone")
        {
           
            $("#other_information").show( ) ;
            $("#hide_for_other").show() ;
            $("#member_information").hide( ) ;
            $("#hide_for_member").hide() ;
            get_all_other( "all_other" ) ;
            
        }
        else
        {
            $("#hide_for_member").show() ;

            $("#member_information").show( ) ;
            $("#other_information").hide( ) ;
            $("#hide_for_other").hide( ) ;
            get_all_member("all_member") ;
        }
    }

 	$(document).ready( function( ) { 

 		$('input[type="radio"]').on( "click change" , function( e ) { 
             
            radio() ;
             
         }) ;

 		$("#member_search").on( "click" , function ( ) { 
 			
 			var member_member_id = $("#member_member_id").val() ; 
 			var member_from_date = $("#member_from_date").val() ;
 			var member_to_date = $("#member_to_date").val() ; 

 			GetMemberInformation( "member_search", member_member_id, member_from_date, member_to_date  ) ;

 		}) ;

 		$("#other_search").on( "click" , function() { 

 			var other_mobile = $("#other_mobile").val() ;
 			var other_from_date = $("#other_from_date").val() ;
 			var other_to_date = $("#other_to_date").val() ;

 			GetOtherInformation( "other_search" , other_mobile, other_from_date, other_to_date ) ;

 		}) ;

 	}) ;

 </script>
