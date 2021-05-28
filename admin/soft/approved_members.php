<?php include 'include/header.php';?>
<?php $table_heading = " Approved Members ";?>
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
        
        <div class="table-responsive">
            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        
                        <th class="text-center"> Name </th>
                        <th class="text-center"> Member ID </th>
                        <th class="text-center"> Mobile/Phone </th>
                        <th class="text-center"> Opening Balance </th>
                        <th class="text-center"> Address </th>
                        <th class="text-center"> Action </th>
                    </tr>
                </thead>
                <tbody>
                   <!-- something to do here !-->

                        <?php
                            if( isset( $_POST['search'] ) ) 
                            {
                                $mobile = $_POST['MOBILE_NO'] ;
                                $memberid = $_POST['MEMBER_NO'] ;
                                $query = "" ;
                                if( $mobile != "" )
                                {
                                    $query = "SELECT `PROFILE_NO`, PRESENT_HOUSE_NO,`MEMBER_ID`, `FULL_NAME`, `PRESENT_THANA`, `PRESENT_DISTRICT`, `MOBILE` FROM member_profiles WHERE MOBILE = '$mobile' AND IS_APPROVED = '1' AND IS_BLOCKED = '0' AND IS_DELETED = '0'" ;
                                }
                                else if( $memberid != "" )
                                {
                                    $query = "SELECT `PROFILE_NO`,PRESENT_HOUSE_NO , `MEMBER_ID`, `FULL_NAME`, `PRESENT_THANA`, `PRESENT_DISTRICT`, `MOBILE` FROM member_profiles WHERE MEMBER_ID = '$memberid' AND IS_APPROVED = '1' AND IS_BLOCKED = '0' AND IS_DELETED = '0' " ;
                                }
                                
                                $result = mysqli_query( $con , $query ) ;
                                
                                foreach( $result as $value )
                                {
                                    echo "<tr>" ;
                                        
                                        echo "<td>".$value['FULL_NAME']."</td>" ;
                                        echo "<td>".$value['MEMBER_ID']."</td>" ;
                                        echo "<td>".$value['MOBILE']."</td>" ;
                                        echo "<td>".""."</td>" ;
                                        echo "<td>".$value['PRESENT_HOUSE_NO'].", ".$value['PRESENT_THANA'].", ".$value['PRESENT_DISTRICT']."</td>" ;
                                    ?>
                                    
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="member_profile.php?profile_no=<?=$value['PROFILE_NO']?>" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-eye"></i></i></a>
                                            <a href="member_profile.php?edit=<?=$value['MEMBER_ID']?>" data-toggle="tooltip" title="Edit" class="btn btn-info" data-original-title="Edit"><i class="fa fa-pencil"></i></i></a>
                                            <a onclick="return confirm('Are you Sure Want to Delete?');" href="actions/delete.php?delete=<?=$value['PROFILE_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                    
                                    <?php
                                    echo "</tr>" ;
                                }
                            }
                        
                        
                        
                        ?>
                        

                </tbody>
            </table>
        </div>
        
</form>





<div id="page-content">

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Member List</strong></h2>
        </div>
       

        <div class="table-responsive">
            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Sl No</th>
                        <!--<th class="text-center">Member No</th>-->
                        <!--<th class="text-center"><i class="gi gi-user"></i></th>-->
                        <th class="text-center">Name</th>
                        <th class="text-center">Member ID</th>
                        <th class="text-center">Mobile No.</th>
                        <th class="text-center">Opening Balance</th>
                        <th class="text-center">Adress</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- retriving data from database !-->

                    <?php 
                        
                        $query = "select * from member_profiles where IS_APPROVED = 1 AND IS_BLOCKED = '0' AND IS_DELETED = '0'" ;
                        $result = mysqli_query( $con , $query ) ;
                        //echo "<tr><td>".mysqli_num_rows($result)."</td></tr>";    

                        $count = 1 ;
                        foreach ($result as $value)
                        {
                            echo "<tr>";

                                echo "<td>".$count ++ ."</td>";
                                // echo "<td>".$value['MEMBER_NO']."</td>";
                                // echo "<td>".""."</td>";
                                echo "<td>".$value['FULL_NAME']."</td>";
                                echo "<td>".$value['MEMBER_ID']."</td>";
                                echo "<td>".$value['MOBILE']."</td>";
                                echo "<td>".""."</td>";
                                echo "<td>".$value['PERMANENT_THANA'].", ".$value['PERMANENT_DISTRICT']."</td>";
                            ?>
                            
                            <td class="text-center">
                                    <div class="btn-group">
                                        <a href="member_profile.php?profile_no=<?=$value['PROFILE_NO']?>" target="_blank" data-toggle="tooltip" title="View" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-eye"></i></i></a>
                                        <a href="member_profile.php?edit=<?=$value['MEMBER_ID']?>" target="_blank" data-toggle="tooltip" title="Edit" class="btn btn-info" data-original-title="Edit"><i class="fa fa-pencil"></i></i></a>
                                        <a onclick="return confirm('Are you Sure Want to Delete?');" href="actions/delete.php?delete=<?=$value['PROFILE_NO']?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                    </div>
                            </td>
                            
                            <?php
                            echo "</tr>";
                        }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Content -->
</div>
         





 <?php include 'include/footer.php';?>
 
 
 <script>
     
     $( document ).ready( function( )
     {
         
         <?php
        if( isset($_SESSION['msgPositive']) == "success" ) 
                    {?>
                        
                        Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Deleted!',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msgPositive']) ;
            }
            else if( isset($_SESSION['msgPositive']) == "error" ) { ?>

                 Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error',
                          showConfirmButton: false,
                          timer: 1500
                        });

                    <?php 
                    unset( $_SESSION['msgPositive']) ;
                
             }?>
         
     }) ;
     
     
 </script>
