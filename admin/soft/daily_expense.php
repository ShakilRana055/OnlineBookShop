<?php include 'include/header.php';?>
<?php $table_heading = "Daily Expnese";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<style type="text/css">
    .error {
        color: red;
    }
</style>



<form action="" id="daily_expense" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Office Expense  </legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="date">Date <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="date" id="date" name="date" class="form-control" placeholder="">
                            
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="expense_head">Expense Head <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                    <select id="expense_head" name="expense_head" class="form-control">
                    <?php
                        $query = "SELECT * FROM acc_expense_heads" ;
                        $result = mysqli_query ( $con , $query ) ;
                        echo "<option value = ''>Please Select One</option>";
                        foreach ( $result as $value )
                        {
                            echo "<option value = '".$value['EXPENSE_HEAD_NO']."'>".$value['HEAD_NAME']."</option>";
                        }
                    ?>
                    </select>
                    </div>
                    </div>
                
                <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Amount<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount ">
                            
                        </div>
                    </div>
                    
                
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Remarks</label>
                        <div class="col-md-6">
                            <input type="text" id="remark" name="remark" class="form-control" placeholder="Write something ">
                            
                        </div>
                    </div>
                    
                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Submit</button>
                            <span id = "error" > </span>
                            </div>

                            </div>
                    </fieldset>
</form>

<!--<form action="" id="form-validation" method="post" enctype="multipart/form-data" class="form-horizontal" >-->
<!--                    <fieldset class="scheduler-border">-->
<!--                        <legend class="scheduler-border" > Search </legend>-->
<!--                    <div class="form-group">-->
<!--                        <label class="col-md-3 control-label" for="example-text-input">Start Date</label>-->
<!--                        <div class="col-md-6">-->
<!--                            <input type="date" id="start_date" name="start_date" class="form-control" placeholder="">-->
                            
<!--                        </div>-->
<!--                    </div>-->
                    
<!--                    <div class="form-group">-->
<!--                        <label class="col-md-3 control-label" for="example-text-input">End Date</label>-->
<!--                        <div class="col-md-6">-->
<!--                            <input type="date" id="end_date" name="end_date" class="form-control" placeholder="">-->
                            
<!--                        </div>-->
<!--                    </div>-->


<!--                        <div class="form-group form-actions">-->
<!--                            <div class="col-md-9 col-md-offset-3">-->
<!--                            <button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>-->
<!--                            <span id = "error" > </span>-->
<!--                            </div>-->

<!--                            </div>-->
<!--                    </fieldset>-->
<!--                </form>-->
<!--               </div>-->
               
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th>Serial No</th>
         <th>Date</th>
         <th>Amount</th>
         <th> Expense Head </th>
         <th>Remark</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'>
       
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
    function saveDailyExpense( dailyExpense , date , amount , expense_head , remark )  
    {
        $.ajax( {
            
            url: "actions/save_again.php",
            method: "post",
            data : ({ "dailyExpense": dailyExpense ,"date": date ,"amount": amount , "expense_no":expense_head ,"remark": remark}),
            dataType: "html",
            success: function ( Result )
            {
                console.log( Result ) ;
                if( Result == 1 )
                {
                    show( 1 , "Created Successfully!") ;
                }
                else
                {
                    show( 0 , "Error!") ;
                }
            }
            
        } ) ;
    }
        
    function getTableData ( data )
    {
        $.ajax( {
            
            url : "actions/save_again.php" ,
            method: "post",
            data: ({ "table": data }),
            dataType: "html" ,
            success : function ( Result )
            {
                //console.log( Result ) ;
                $("#recordList").html( Result ) ;
            }
            
        } ) ;
    }
        
     $(document).ready( function( ){ 
         
         $("#daily_expense").submit( function( e ) {
             
             e.preventDefault( ) ;
             var date = $("#date").val( ) ;
             var amount = $("#amount").val( ).trim( ) ;
             var expense_head = $("#expense_head").val( ) ;
             var remark = $("#remark").val( ).trim( ) ;
            
             if( $("#daily_expense").valid( ) )
 			{
 				 saveDailyExpense( "dailyExpense" , date , amount , expense_head , remark ) ;
 				$("#daily_expense")[0].reset( ) ;
 				getTableData( "tableData" ) ;
 			}
             
         }) ;
         
        // console.log( "document function ") ;
         getTableData( "tableData" ) ;
         
     }) ;
 </script>
 
 