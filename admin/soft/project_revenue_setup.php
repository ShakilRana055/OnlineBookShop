<?php include 'include/header.php';?>
<?php $table_heading = "Project Revenue Set Up";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<?php
if(isset($_GET['edit'])){
    $revenue_no = $_GET['edit'];
    $query = "SELECT * FROM project_revenue LEFT JOIN projects ON projects.PROJECT_NO = project_revenue.PROJECT_NO where project_revenue.PROJECT_REVENUE_NO='$revenue_no'";
    $result = mysqli_query( $con , $query ) ;
    $row = mysqli_fetch_assoc($result);
}


?>
<?php
    function convert( $type )
    {
        if( $type == "rent" )
            return "Rent" ;
        else if( $type == "sale")
            return "Allotment" ;
        else if( $type == "member" )
            return "Member" ;
        else if( $type == "else" )
            return "Someone Else";
    }
?>
<style type="text/css">
    .error {
        color: red;
    }
</style>


  <form action="" id="revenue_setup_form" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Project Revenue Setup  </legend>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="project_name"> Project Name<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="project_name" name="project_name" class="form-control search" style = "width:100%;">
                        <option value="<?=@$row['PROJECT_NO']?>"><?=@$row['PROJECT_NAME']?></option>
                    
                    </select>
                    </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="radio"> Select One <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="radio" name="radio" class="form-control search" style = "width:100%;">
                        <option value = "<?php echo $row['FOR_WHOM'];?>"> <?php echo convert ( $row['FOR_WHOM'] );?> </option>
                         <option value="member">Member</option>
                         <option value="else">Someone Else</option>
                        
                    </select>
                    </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="revenue_type">Revenue Type <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="revenue_type" name="revenue_type" class="form-control search" style = "width:100%;">
                        <option value="<?=@$row['REVENUE_TYPE']?>"> <?php echo convert( $row['REVENUE_TYPE'] ); ?></option>
                        
                        <option value="">Please select</option>
                        <option value="rent">Rent</option>
                        <option value="sale">Allotment</option>
        
                    </select>
                    </div>
                    </div>
                    
                    <!-- if Rent then !-->
        <div class="form-group" id = "rent_selector" style = "display:none;">
                        <fieldset clss = "scheduler-border">
                        <legend clss = "scheduler-border" > Rent Information </legend>
                        <div class="form-group" >
                        <label class="col-md-3 control-label" for="rent_period"> Rent Period <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <select id="rent_period" name="rent_period" class="form-control search" style="width: 100%;">
                                <option value="">Please select</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                                <option value="3month">3 month</option>
                                <option value="6month">6 month</option>
                            </select>
                        </div>
                        </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Part of project<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="part_project" name="part_project" value="<?=@$row['PART_OF_PROJECT']?>"  class="form-control" placeholder="Part of Project ">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="district"> District <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="district" name="district" class="form-control search" style = "width:100%">
                                <option value="">Please select</option>
                        			<?php
                        			        $all64 = "Bagerhat,Bandarban,Barguna,Barisal,Bhola,Bogra,Brahmanbaria,Chandpur,Chittagong,Chuadanga,Comilla,Coxs Bazar,
                        			        Dhaka,Dinajpur,Faridpur,Feni,Gaibandha,Gazipur,Gopalganj,Habiganj,Jaipurhat,Jamalpur,Jessore,Jhalakati,Jhenaidah,
                        			        Khagrachari,Khulna,Kishoreganj,Kurigram,Kushtia,Lakshmipur,Lalmonirhat,Madaripur,Magura,Manikganj,Meherpur,Moulvibazar,
                        			        Munshiganj,Mymensingh,Naogaon,Narail,Narayanganj,Narsingdi,Natore,Nawabganj,Netrakona,Nilphamari,Noakhali,Pabna,
                        			        Panchagarh,Parbattya Chattagram,Patuakhali,Pirojpur,Rajbari,Rajshahi,Rangpur,Satkhira,Shariatpur,Sherpur,Sirajganj,
                        			        Sunamganj,Sylhet,Tangail,Thakurgaon" ;
                        			        
                        			        $district = explode( ",", $all64 ) ;
                        			        for( $i = 0 ; $i < count( $district ) ; $i ++ )
                        			        {
                        			            echo "<option value = '".$district[$i]."'>".$district[$i]."</option>" ;
                        			        }
                        			?>
                        			
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Location <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="location" name="location" value="<?=@$row['LOCATION']?>" class="form-control" placeholder="Please Enter location">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="title_name" name="title_name" value="<?=@$row['TITLE_NAME']?>" class="form-control" placeholder="Please Enter Title Name">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">SL No <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="sl_no" name="sl_no" value="<?=@$row['SL_NO']?>" class="form-control" placeholder="Please Enter serial no">
                            
                        </div>
                    </div>
                        
                        </fieldset>
                    </div>
                    <!-- if Sale then !-->
        
        <div id = "sale_selector" style = "display: none;">
                <fieldset class= "scheduler-border">
                        <legend class = "scheduler-border">Allotment Information</legend>
                    
                
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Part of project<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="sale_part_project" name="part_project" value="<?=@$row['PART_OF_PROJECT']?>"  class="form-control" placeholder="Part of Project ">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="district"> District <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="sale_district" name="district" class="form-control search" style = "width:100%">
                                <option value="">Please select</option>
                              <?php
                                      $all64 = "Bagerhat,Bandarban,Barguna,Barisal,Bhola,Bogra,Brahmanbaria,Chandpur,Chittagong,Chuadanga,Comilla,Coxs Bazar,
                                      Dhaka,Dinajpur,Faridpur,Feni,Gaibandha,Gazipur,Gopalganj,Habiganj,Jaipurhat,Jamalpur,Jessore,Jhalakati,Jhenaidah,
                                      Khagrachari,Khulna,Kishoreganj,Kurigram,Kushtia,Lakshmipur,Lalmonirhat,Madaripur,Magura,Manikganj,Meherpur,Moulvibazar,
                                      Munshiganj,Mymensingh,Naogaon,Narail,Narayanganj,Narsingdi,Natore,Nawabganj,Netrakona,Nilphamari,Noakhali,Pabna,
                                      Panchagarh,Parbattya Chattagram,Patuakhali,Pirojpur,Rajbari,Rajshahi,Rangpur,Satkhira,Shariatpur,Sherpur,Sirajganj,
                                      Sunamganj,Sylhet,Tangail,Thakurgaon" ;
                                      
                                      $district = explode( ",", $all64 ) ;
                                      for( $i = 0 ; $i < count( $district ) ; $i ++ )
                                      {
                                          echo "<option value = '".$district[$i]."'>".$district[$i]."</option>" ;
                                      }
                              ?>
                              
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Location <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="sale_location" name="location" value="<?=@$row['LOCATION']?>" class="form-control" placeholder="Please Enter location">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="sale_title_name" name="title_name" value="<?=@$row['TITLE_NAME']?>" class="form-control" placeholder="Please Enter Title Name">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">SL No <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="sale_sl_no" name="sl_no" value="<?=@$row['SL_NO']?>" class="form-control" placeholder="Please Enter serial no">
                            
                        </div>
                    </div>
                    </fieldset>
                  </div>
                        
                    
                    <div class="form-group form-actions">
                            <div class="col-lg-offset-8">
                            <button type="button" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Submit</button>
                            
                            </div>

                      </div>
</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>Serial No</th>
         <th>Project Name</th>
        
         <th> For Whom </th>
         <th>Revenue Type</th>
         <th> Rent Period </th>
         <th>Part Of Project</th>
         <th>District</th>
         <th>Location</th>
         <th>SL No</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'>
            <?php 
                    $count = 1 ;
                    $query = "SELECT * FROM project_revenue LEFT JOIN projects ON projects.PROJECT_NO = project_revenue.PROJECT_NO WHERE project_revenue.IS_DELETED = '0' " ;
                    $result = mysqli_query( $con , $query ) ;
                    foreach( $result as $value )
                    {
                        echo "<tr>" ;
                        echo "<td>".$count."</td>" ;
                        echo "<td>".$value['PROJECT_NAME']."</td>" ;
                        
                        echo "<td>".$value['FOR_WHOM']."</td>" ;
                        if( $value['REVENUE_TYPE'] == "rent" )
                        {
                            echo "<td>"."Rent"."</td>" ;
                        }
                        else
                        {
                            echo "<td>"."Allotment"."</td>" ;
                        }
                        
                        echo "<td>".$value['RENT_PERIOD']."</td>" ;
                        echo "<td>".$value['PART_OF_PROJECT']."</td>" ;
                        echo "<td>".$value['DISTRICT']."</td>" ;
                        echo "<td>".$value['LOCATION']."</td>" ;
                        echo "<td>".$value['SL_NO']."</td>" ;
                        ?>
                        <td class="text-center">
                        <div class="btn-group">
                        <a href="project_revenue_setup.php?edit=<?=$value['PROJECT_REVENUE_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="actions/revenue_setup_delete.php?delete=<?=$value['PROJECT_REVENUE_NO']?>" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                        <?php
                        $count ++ ;
                        
                 echo "</tr>" ;
                    }
            ?>
        </tbody>
</table>


 <?php include 'include/footer.php';?>
 <!-- <script type="text/javascript" src="../js/validation-init.js"></script> -->
 
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
     
     
     function getProjectName( wise )
     {
         $.ajax( {
             
             url: "actions/ajax.php" ,
             method: "post",
             data: ({ "wise": wise }),
             dataType: "html",
             success : function ( Result )
             {
                // console.log( Result ) ;
                 $("#project_name").html( Result ) ;
             }
             
         } ) ;
     }
     
     function saveRevenueSetup( revenue_setup , project_no,type, radio, revenue_type ,rent_period,part_project,district,location, sl_no , title_name )
     {
         $.ajax( {
             
             url: "actions/ajax.php" ,
             method: "post",
             data: ({ "revenue_setup":revenue_setup , "project_no":project_no, "type": type, "radio": radio, "revenue_type":revenue_type ,
                    "rent_period":rent_period, "part_project": part_project, "district": district, "location": location, "sl_no": sl_no , "title_name":title_name }),
             dataType: "html",
             success : function ( Result )
             {
                 console.log( Result) ;
                 if( Result == 1 )
                 {
                     
                     show( 1 , "Created Successfully!" ) ;
                 }
                 else
                 {
                     show( 0 , "Error!") ;
                 }
             }
             
         } ) ;
     }
      function getHeadName(headName,project_no){
          $.ajax({
              url:"actions/ajax.php",
              method:"post",
              data:({"headName":headName,"project_no":project_no}),
              dataType:"html",
              success:function(Result){
                  $("#type").html(Result);
              }
          });
      }
     
     $( document ).ready( function( ) {
        
         getProjectName( "wise" ) ;
         $("#project_name").on("change",function(){
             var project_no = $("#project_name option:selected").val();
            //  getHeadName("headName",project_no);
         });
         
         
         
         
         $("#revenue_type").on( "change", function( ) { 
             
             var selector = $("#revenue_type option:selected").val( ) ;
             if( selector == "rent" )
             {
                 $("#rent_selector").show( ) ;
                 $("#sale_selector").hide( ) ;
             }
             else
             {
                 $("#sale_selector").show( ) ;
                 $("#rent_selector").hide( ) ;
                 
             }
             
         }) ;
         
         $("#search_id").click( function() {
             var project_no ; 
             var type ;
             var radio ;
             var revenue_type  ;
             var rent_period ;
             var part_project  ;
             var district  ;
             var location ;
             var sl_no  ;
             var title_name  ;

             var selector = $("#revenue_type option:selected").val( ) ;
             if( selector == "rent" )
             {
                project_no = $("#project_name").val( ).trim( ) ;
                type = "" ;
                radio = $("#radio").val( ).trim( ) ;
                revenue_type = $("#revenue_type").val( ).trim( ) ;
                rent_period = $("#rent_period").val( ).trim( ) ;
                part_project = $("#part_project").val( ).trim( ) ;
                district = $("#district").val( ).trim( ) ;
                location = $("#location").val( ).trim( ) ;
                sl_no = $("#sl_no").val( ).trim( ) ;
                title_name = $("#title_name").val().trim() ;
             }
             else if( selector == "sale") 
             {
                console.log( "else ");
                project_no = $("#project_name").val( ).trim( ) ;
                type = "" ;
                radio = $("#radio").val( ).trim( ) ;
                revenue_type = $("#revenue_type").val( ).trim( ) ;
                rent_period = "" ;
                part_project = $("#sale_part_project").val( ).trim( ) ;
                district = $("#sale_district").val( ).trim( ) ;
                location = $("#sale_location").val( ).trim( ) ;
                sl_no = $("#sale_sl_no").val( ).trim( ) ;
                title_name = $("#sale_title_name").val().trim() ;
             }




              console.log( $("#rent_period").val() ) ;
              console.log( $("#sale_part_project").val() ) ;
              console.log( $("#sale_district").val() ) ;
              console.log( $("#sale_location").val() ) ;
              console.log( $("#sale_sl_no").val() ) ; 
              console.log( $("#sale_title_name").val() ) ; 

 			     saveRevenueSetup( "revenue_setup" , project_no,type, radio, revenue_type ,rent_period,part_project,district,location, sl_no, title_name  ) ;
               $("#revenue_setup_form")[0].reset( ) ;

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
         
         
     }) ;
     
 </script>