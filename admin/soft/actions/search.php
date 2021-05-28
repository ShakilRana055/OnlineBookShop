<?php
if(isset($_POST['search']) && $_POST['search']!= NULL){
    getSearchMember($_POST['member_id'],$_POST['mobile_no']);
}

if(isset($_POST['project_search']) && $_POST['project_search']!= NULL){
    getSearchProject($_POST['project_name']);

   
}

function getSearchMember( $member_id, $mobile_no){
    include ( "../../config/db_connection.php") ;
    $where = "";
    if($member_id!=""){
        $where = "AND MEMBER_ID = '$member_id'" ;
    }
    
    if($mobile_no!=""){
        $where = "AND MOBILE = '$mobile_no'" ;
    }
    
    //$sql = "SELECT mf.`MEMBER_NO`,mf.`MEMBER_ID`,mf.`FULL_NAME`,mf.`MOBILE`,mf.`PERMANENT_VILLAGE`,mf.`PERMANENT_POST`,mf.`PERMANENT_THANA`,mf.`PERMANENT_DISTRICT`,mf.`PERMANENT_POSTCODE` FROM member_profiles AS mf LEFT JOIN members ON mf.`MEMBER_NO`= members.`MEMBER_NO` where 1=1 '$where'";
    
     $sql = "select * from member_profiles where 1=1 $where";
     $result = mysqli_query($con,$sql);
    echo "here" ;
      foreach($result as $results)
      {
                    echo "<tr>";
                    echo "<td>".$results['FULL_NAME']."</td>";
                    echo "<td>".$results['MEMBER_ID']."</td>";
                    echo "<td>".$results['MOBILE']."</td>";
                    echo "<td>".$results['PERMANENT_VILLAGE'].",".$results['PERMANENT_POST'].','.$results['PERMANENT_THANA'].','.$results['PERMANENT_DISTRICT']."</td>";
                    echo "<td> <a href='actions/block_member.php?member_no=".$results['MEMBER_NO']."' class='btn btn-primary'>Block</a>"."</td>";
                    echo "</tr>";
        }
            
}


function getSearchProject($project_name){
    include ( "../../config/db_connection.php") ;
    
    //$where=" AND projects.PROJECT_NAME LIKE '%".$project_name."%'";
    if($project_name!=""){
        $count = 1 ;
             $query = "SELECT * FROM projects INNER JOIN member_profiles ON member_profiles.MEMBER_NO = projects.RESPONSIBLE_MEMBER_NO WHERE member_profiles.IS_DELETED=0 AND member_profiles.IS_BLOCKED=0 AND member_profiles.IS_APPROVED=1 AND projects.IS_DELETED=0 AND projects.PROJECT_NAME='$project_name'" ;
            
             $result = mysqli_query ( $con , $query ) ;
             if($result){
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
             
             }
             
    }
    
}

?>