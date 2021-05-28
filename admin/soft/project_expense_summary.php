<?php include 'include/header.php';?>
<?php $table_heading = "Project Expense Summary";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php
    $is_search = "no" ;
    $search_result = "" ;
    $distinct_result = "" ;
    $expense_head = "" ;
    $execute_it = "" ;
    if( isset($_POST['search']) )
    {
        $is_search = "yes" ;
        $from_date = $_POST['FROM_DATE'] ;
        $to_date = $_POST['TO_DATE'] ;
        $expense_head_no = $_POST['hidden'] ;
        $expense_head = $expense_head_no ;
        $concate = "" ;
        
        $distinct = "SELECT DISTINCT PROJECT_EXPENSE_HEAD_NO FROM project_expenses" ;
        $distinct_result = mysqli_query( $con , $distinct ) ;
                    
       $execute_it .= "SELECT `TRN_DATE`, `REMARKS`, SUM(EXPENSE_AMOUNT) as AMOUNT, project_expense_heads.PROJECT_EXPENSE_HEAD_NAME FROM project_expenses 
	                LEFT JOIN project_expense_heads ON project_expense_heads.PROJECT_EXPENSE_HEAD_NO = project_expenses.PROJECT_EXPENSE_HEAD_NO 
	                WHERE project_expenses.IS_DELETED = '0' " ;
        
        if( $from_date != "" &&  $to_date != "" ) 
        {
            $concate .= " AND TRN_DATE BETWEEN '$from_date' AND '$to_date' " ;
        }
        else if( $from_date != "" )
        {
            $concate .= " AND TRN_DATE >= '$from_date'" ;
        }
        else if( $to_date != "" )
        {
            $concate .= " AND TRN_DATE <= '$to_date'" ;
        }
        
    
        $execute_it .= $concate ;
        
        // echo $query ; 
    }

?>




<form class='cmxform form-horizontal' action = "" method = "post" enctype = "multipart/form-data">
	<fieldset class='scheduler-border'>
		<legend class='scheduler-border'>Search</legend>
		<div class='form-group '>
			<div class='form-group'>
				<label for='srcFORM_DATE' class='control-label col-lg-3'>From Date</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='FROM_DATE' type='date' is_double = '0' />
				</div>
			</div>
			
			
			
			<div class='form-group'>
				<label for='srcTO_DATE' class='control-label col-lg-3'>To Date</label>
				<div class='col-lg-5'>
					<input class='form-control src_data' name='TO_DATE' type='date' is_double = '0' />
				</div>
			</div>
			
			<div class="form-group">
                            <label class="control-label col-lg-3" for="expense_head">Expense Head Name</label>
                            <div class="col-lg-5">
                                
                            <select class="form-control search" name="expense_head" id="expense_head" multiple style='width:100%'>
                            
                            <?php 
                                    $query32 = "SELECT `PROJECT_EXPENSE_HEAD_NO`, `PROJECT_EXPENSE_HEAD_NAME` FROM project_expense_heads" ;
                                    $result1 = mysqli_query( $con , $query32 ) ;
                                    foreach( $result1 as $value )
                                    {
                                        echo "<option value = '".$value['PROJECT_EXPENSE_HEAD_NO']."'>".$value['PROJECT_EXPENSE_HEAD_NAME']."</option>" ;
                                    }
                                ?>
                                
                              </select>
                                
                                
                            </div>
            </div>
                        
              <input type = "hidden" name = "hidden" id = "hidden" >
			<label for='location' class='control-label col-lg-3'></label>
			<div class=' col-lg-5'>
				<input type='submit' table_name = 'summary_summarys' name = "search" class='btn btn-primary pull-right'  value='Search' />
			</div>

		</div>
		
		
	</fieldset>
</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Date</th>
			<th>Expense Head Name</th>
			<th>Amount</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody id='recordList'>
	    
	    <?php
	        $count = 1 ;
	        if( $is_search == "no" ) 
	        {
	            $query = "SELECT DISTINCT PROJECT_EXPENSE_HEAD_NO FROM project_expenses" ;
	            $result = mysqli_query( $con , $query ) ;
	            foreach( $result as $value )
	            {
	                $id = $value['PROJECT_EXPENSE_HEAD_NO'] ;
	                $final_query = "SELECT `TRN_DATE`, `REMARKS`, SUM(EXPENSE_AMOUNT) as AMOUNT, project_expense_heads.PROJECT_EXPENSE_HEAD_NAME FROM project_expenses 
	                LEFT JOIN project_expense_heads ON project_expense_heads.PROJECT_EXPENSE_HEAD_NO = project_expenses.PROJECT_EXPENSE_HEAD_NO WHERE 
	                project_expenses.PROJECT_EXPENSE_HEAD_NO = '$id' " ;
	                
	                $final_result = mysqli_query( $con , $final_query ) ;
	                
	                foreach( $final_result as $keys )
	                {
	                    echo "<tr>" ;
    	            
    	                echo "<td>".$count ++ ."</td>" ;
    	                echo "<td>". $keys['TRN_DATE'] ."</td>" ;
    	                echo "<td>".$keys['PROJECT_EXPENSE_HEAD_NAME']."</td>" ;
    	                echo "<td>".$keys['AMOUNT']."</td>" ;
    	                echo "<td>".$keys['REMARKS']."</td>" ;
    	            
    	                echo "</tr>" ;
	                }
	                
	            }
	        }
	        else
	        {
	            $is_search = "yes" ;
	            if( $expense_head == "" )
	            {
	                
	                foreach( $distinct_result as $k ){
	                    
	                    $temp = $execute_it ;
	                    $temp .= " AND project_expenses.PROJECT_EXPENSE_HEAD_NO = '".$k['PROJECT_EXPENSE_HEAD_NO']."' " ;
	                    $ans = mysqli_query( $con ,  $temp ) ;
	                    //echo $temp ;
	                    foreach( $ans as $keys )
	                    {
	                        echo "<tr>" ;
    	            
        	                echo "<td>".$count ++ ."</td>" ;
        	                echo "<td>". $keys['TRN_DATE'] ."</td>" ;
        	                echo "<td>".$keys['PROJECT_EXPENSE_HEAD_NAME']."</td>" ;
        	                echo "<td>".$keys['AMOUNT']."</td>" ;
        	                echo "<td>".$keys['REMARKS']."</td>" ;
        	            
        	                echo "</tr>" ;
	                    }
	                }
	            }
	            else
	            {
	                for( $i = 0 ; $i < count ( $expense_head ) ; $i ++ )
	                {
	                    $id = $expense_head[$i] ;
	                    $temp = $execute_it ;
	                    $temp .= " AND project_expenses.PROJECT_EXPENSE_HEAD_NO = '$id' " ;
	                    $final_result = mysqli_query( $con , $temp ) ;
	                    foreach( $final_result as $value )
	                    {
	                        echo "<tr>" ;
    	            
        	                echo "<td>".$count ++ ."</td>" ;
        	                echo "<td>". $value['TRN_DATE'] ."</td>" ;
        	                echo "<td>".$value['PROJECT_EXPENSE_HEAD_NAME']."</td>" ;
        	                echo "<td>".$value['AMOUNT']."</td>" ;
        	                echo "<td>".$value['REMARKS']."</td>" ;
        	            
        	                echo "</tr>" ;
	                    }
	                    
	                }
	            }
	        }
	    
	    
	    ?>
	    
	    
	</tbody>
</table>



 <?php include 'include/footer.php';?>
 
 
  <script>
     
     $( document ).ready( function( ) {
         
         $("#expense_head").on( "change" , function( ) {
             
             $("#hidden").val( $("#expense_head").val() ) ;
             console.log( $("#hidden").val() ) ;
             
         }) ;
         
     }) ;
     
     
 </script>
 