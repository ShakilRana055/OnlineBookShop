<?php include 'include/header.php';?>
<?php $table_heading = "Office Expense Summary";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>



<?php
    
    $is_search = "no" ;
    $search_result = "" ;
    $expense_head = "" ;
    $execute_it = "" ;
    if( isset( $_POST['search'] ) ) 
    {
        $is_search = "yes" ;
        $from_date = $_POST['FROM_DATE'] ;
        $to_date = $_POST['TO_DATE'] ;
        $expense_head_no = explode( "," , $_POST['hidden'] );
        $expense_head = $expense_head_no ;
        $concate = "" ;
        $find_distinct = "SELECT DISTINCT EXPENSE_HEAD_NO FROM acc_expenses" ;
        $distinct_result = mysqli_query ( $con , $find_distinct ) ;
        $execute_it = "SELECT `TRN_DATE`, `TRN_REMARKS`,sum(TRN_AMOUNT) as AMOUNT, acc_expense_heads.HEAD_NAME FROM acc_expenses LEFT JOIN acc_expense_heads 
	                ON acc_expense_heads.EXPENSE_HEAD_NO = acc_expenses.EXPENSE_HEAD_NO WHERE acc_expenses.IS_DELETED = '0'" ;
        if( $from_date != "" && $to_date != "" ) 
        {
            $concate .= "AND TRN_DATE BETWEEN '$from_date' AND '$to_date'" ;
        }
        else if( $from_date != "" )
        {
             $concate .= "AND TRN_DATE >= '$from_date' " ;
        }
        else if( $to_date != "" )
        {
            $concate .= "AND TRN_DATE <= '$to_date' " ;
        }
        $execute_it .= $concate ;
        
    }

?>





<form class='cmxform form-horizontal' method = "post" action = "" encType = "multipart/form-data">
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
                                    $query = "SELECT HEAD_NAME, EXPENSE_HEAD_NO FROM acc_expense_heads" ;
                                    $result = mysqli_query( $con , $query ) ;
                                    foreach( $result as $value )
                                    {
                                        echo "<option value = '".$value['EXPENSE_HEAD_NO']."'>".$value['HEAD_NAME']."</option>";
                                    }
                                ?>
                                
                              </select>
                                
                                
                            </div>
                        </div>
                    <input type = "hidden" name = "hidden" id = "hidden">
			<label for='location' class='control-label col-lg-3'></label>
			<div class=' col-lg-5'>
				<input type='submit' table_name = 'summary_summarys' class='btn btn-primary pull-right' name = "search" id='Search' value='Search' />
			</div>

		</div>
		
		
	</fieldset>
</form>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
	<thead>
		<tr>
			<th>#</th>
			<th>Date</th>
			<th>Amount</th>
			<th>Expense Head</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody id='recordList'>
	    
	    <?php 
	        $count = 1 ;
	        echo $is_search ;
	        if( $is_search == "no" )
	        {
	            $query1 = "SELECT DISTINCT EXPENSE_HEAD_NO FROM acc_expenses" ;
	            $result1 = mysqli_query( $con , $query1 ) ;
	            
	            foreach( $result1 as $value )
	            {
	                echo $value['EXPENSE_HEAD_NO'];
	                
	                $query2 = "SELECT `TRN_DATE`, `TRN_REMARKS`,sum(TRN_AMOUNT) as AMOUNT, acc_expense_heads.HEAD_NAME FROM acc_expenses LEFT JOIN acc_expense_heads 
	                ON acc_expense_heads.EXPENSE_HEAD_NO = acc_expenses.EXPENSE_HEAD_NO WHERE acc_expenses.EXPENSE_HEAD_NO = '".$value['EXPENSE_HEAD_NO']."' " ;
	                
	                $result2 = mysqli_query( $con , $query2 ) ;
	                
	                foreach( $result2 as $keys )
	                {
    	                echo "<tr>" ;
        	            
        	                echo "<td>".$count ++ ."</td>" ;
        	                echo "<td>". $keys['TRN_DATE'] ."</td>" ;
        	                echo "<td>".$keys['HEAD_NAME']."</td>" ;
        	                echo "<td>".$keys['AMOUNT']."</td>" ;
        	                echo "<td>".$keys['TRN_REMARKS']."</td>" ;
        	            
        	            echo "</tr>" ;
	                }
	            }
	        }
	        else
	        {
	            
	            if( $expense_head == "")
	            {
	                
	                foreach( $distinct_result as $value )
	                {
	                    $temp = $execute_it ;
	                    $temp .= "AND acc_expenses.EXPENSE_HEAD_NO = '".$value['EXPENSE_HEAD_NO']."'" ;
	                    //echo $temp ;
	                    $result1 = mysqli_query( $con , $temp ) ;
	                    foreach( $result1 as $keys )
	                    {
	                        echo "<tr>" ;
        	                echo "<td>".$count ++ ."</td>" ;
        	                echo "<td>". $keys['TRN_DATE'] ."</td>" ;
        	                echo "<td>".$keys['HEAD_NAME']."</td>" ;
        	                echo "<td>".$keys['AMOUNT']."</td>" ;
        	                echo "<td>".$keys['TRN_REMARKS']."</td>" ;
        	                echo "</tr>" ;
	                        
	                    }
	                }
	            }
	            else
	            {

	                
	                for( $i = 0 ; $i < count( $expense_head ) ; $i ++ )
	                {
	                    $temp = $execute_it ;
	                    $temp .= "AND acc_expenses.EXPENSE_HEAD_NO = '".$expense_head[$i]."'" ;
	                    
	                    $result1 = mysqli_query( $con , $temp ) ;
	                    foreach( $result1 as $keys )
	                    {
	                        echo "<tr>" ;
        	                echo "<td>".$count ++ ."</td>" ;
        	                echo "<td>". $keys['TRN_DATE'] ."</td>" ;
        	                echo "<td>".$keys['HEAD_NAME']."</td>" ;
        	                echo "<td>".$keys['AMOUNT']."</td>" ;
        	                echo "<td>".$keys['TRN_REMARKS']."</td>" ;
        	                echo "</tr>" ;
	                        
	                    }
	                }
	            }
	            
	            $is_search = "no" ;
	        }
	    
	    ?>
	    
	    
	</tbody>
</table>


 <?php include 'include/footer.php';?>
 
 <script>
     
     $(document).ready( function( ) {
         
         $("#expense_head").on( "change" , function( ) {
             
             var value = $("#expense_head").val( ) ;
            //  console.log( value )
             $("#hidden").val( value ) ;
             console.log( $("#hidden").val(  ) ) ;
         }) ;
         
     }) ;
     
 </script>