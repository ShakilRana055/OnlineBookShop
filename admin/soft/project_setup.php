<?php include 'include/header.php';?>
<?php $table_heading = "Project Expnese";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>



<style type="text/css">
    .error {
        color: red;
    }
</style>

<form action="" id="project_form" method="post" enctype="multipart/form-data" class="form-horizontal" name="edit" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Project Setup  </legend>
                       <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input"> Name <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" id="project_name" name="project_name"  class="form-control field_data" placeholder="Please Enter project Name">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input">Location<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" id="location" name="location"  class="form-control field_data" placeholder="Please Enter project Location ">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input">Project Details<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" id="project_detail" name="project_detail"  class="form-control field_data" placeholder="Please Enter project details ">
                            
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input"> Start Date <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="date" id="start_date" name="start_date"  class="form-control field_data" placeholder="">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-lg-4" for="responsible">Responsible Member</label>
                    <div class="col-lg-8">
                    <select id="responsible" name="responsible" class="form-control field_data search" style="width: 100%;">
                    
                    
                    
                    </select>
                    </div>
                    </div>
                    
                      <div class="form-group">
                        <label class="control-label col-lg-4" for="example-text-input">Remarks</label>
                        <div class="col-lg-8">
                            <input type="text" id="remark" name="remark"  class="form-control field_data" placeholder="Write something ">
                            
                        </div>
                    </div>
                    </div>
                    </fieldset>
                
                            <div class="form-group">
                            <div class="col-lg-offset-11">
                            <button type="submit" name="search" class="btn btn-primary" id="search_id" ></i>Save</button>
                            <span id = "error" > </span>
                            </div>

                            </div>
                           
                    
</form>
<form class='cmxform form-horizontal'>
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		
			<div class='form-group'>
				<label for='srcCATEGORY_NAME' class='control-label col-lg-3'>Project Name</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' id="search_procet_name" name='project_name' type='text' is_double = '0' maxlength = '255'/>
				</div>
			</div>
			<div class='form-group '>
			
			<div class='col-lg-offset-7'>
				<button type="button" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
			</div>
		</div>
	</fieldset>
</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>Serial No</th>
         <th>Project Name</th>
         <th>Location</th>
         <th> Project Details </th>
         <th>Start Date</th>
         <th>Responsible Member name</th>
         <th>Remarks</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'>
   
        <?php $ds= "";
             $count = 1 ;
             $query = "SELECT projects.*, member_profiles.MEMBER_NO, member_profiles.FULL_NAME FROM projects LEFT JOIN member_profiles on member_profiles.MEMBER_NO = projects.RESPONSIBLE_MEMBER_NO WHERE projects.IS_DELETED = 0 " ;
             $result = mysqli_query ( $con , $query ) ;
             $i=0;
             foreach( $result as $value )
             {
                 echo "<tr>" ;
                 echo "<td style='display:none'>".$value['MEMBER_NO']."</td>";
                 echo "<td style='display:none'>".$value['PROJECT_NO']."</td>";
                        echo "<td>".$count."</td>" ;
                        echo "<td>".$value['PROJECT_NAME']."</td>" ;
                        echo "<td>".$value['LOCATION']."</td>" ;
                        echo "<td>".$value['DETAILS']."</td>" ;
                        echo "<td>".$value['START_DATE']."</td>" ;
                        echo "<td>".$value['FULL_NAME']."</td>" ;
                        echo "<td>".$value['REMARKS']."</td>" ;
                        ?>
                        <td class="text-center">
                        <div class="btn-group">
                        <a href="project_setup_edit.php?member_no=<?=$value['MEMBER_NO']?>&&project_no=<?=$value['PROJECT_NO']?>" name="edit" data-toggle="tooltip" title="" class="btn btn-xs btn-default editbtn" value="<?=$i?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="actions/project_delete.php?member_no=<?=$value['MEMBER_NO']?>&&project_no=<?=$value['PROJECT_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                        <?php
                        $count ++ ;
                        $i++;
                        
                 echo "</tr>" ;
             }
            
            
        ?>
        </tbody>
</table>


 <?php include 'include/footer.php';?>
 
<script type="text/javascript" src="../js/validation-init.js"></script>
 
 <script>
 
 
 
 
  	function show( id , message )
 	{
 		if( id == 1 )
 		{
 			Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: message ,
                          showConfirmButton: false,
                          timer: 1500
                      })
 		}
 		else
 		{
 			Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: message,
                          showConfirmButton: false,
                          timer: 1500
                      })
 		}
 	}

 
 
    function saveProject( project , name, location , details, start_date , responsible, remark )
    {
        $.ajax({
            url: "actions/ajax.php",
            method:"post",
            data: ({ "project":project , "name":name, "location":location , "details":details, "start_date":start_date ,
                    "responsible": responsible,  "remark": remark }),
            dataType: "html",
            success: function ( Result ) 
            {
                var ans = Result.substr( Result.length - 1 , Result.length  ) ;
                
                if( parseInt ( ans ) == 1 )
                {
                    show( 1 , "Project Created Successfully!");
                    window.location.reload() ;
                }
                else
                {
                    show( 0 , "Error!") ;
                }
            }
        }) ;
    }
    
    function responsibleMembers( responsible )
    {
        $.ajax( {
            
            url: "actions/ajax.php" ,
            method: "post" ,
            data : ({"responsible" : responsible }),
            dataType: "html" ,
            success : function ( Result )
            {
                $("#responsible").html( Result ) ;
            }
            
        }) ;
    }
    
    function projectSearch( project_search, project_name){
  
        $.ajax({
            url: "actions/search.php",
            method:"post",
            data:({"project_search":project_search,"project_name":project_name}),
            dataType:"html",
            success:function(data){
                
                
                    
                    $("#recordList").html(data);
                
            }
        });
    }
     
     $( document ).ready( function ( ){
         
         
         responsibleMembers( "responsible") ;
         
         $("#project_form").submit( function( e ){ 
             e.preventDefault( ) ;
             var name = $("#project_name").val().trim( ) ;
             var location = $("#location").val( ).trim( ) ;
             var details = $("#project_detail").val( ).trim() ;
             var start_date = $("#start_date").val( ).trim() ;
             var responsible = $("#responsible").val( ).trim() ;
             var remark = $("#remark").val( ).trim() ;
             
             if( $("#project_form").valid( ) )
 			{
 				saveProject("project" , name, location , details, start_date , responsible, remark ) ;
 				$("#project_form")[0].reset( ) ;
 			}
 			
             
         });
         
         <?php
          if(isset($_SESSION['msgPositive']) == "success"){?>
 
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Deleted!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                      
  <?php
  unset( $_SESSION['msgPositive'] ) ;
 }
 ?>
         $(document).on("click", "#search_id", function(){
             var project_name = $("#search_procet_name").val();
             projectSearch("project_search",project_name);
             
           
         });
     }) ;
    
 </script>