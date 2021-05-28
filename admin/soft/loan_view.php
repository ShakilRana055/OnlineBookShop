<?php include 'include/header.php';?>
<?php $table_heading = "Loan Application";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php 
    
    $view = "" ;
    $refer_name = "" ;
    $loan_no = $_GET['loan_no'] ;
    if( isset( $_GET['loan_no'] ) )
    {
        
        $sql = "SELECT * FROM `loans` LEFT JOIN member_profiles ON member_profiles.PROFILE_NO = loans.PROFILE_NO WHERE LOAN_NO = '$loan_no'" ;
        $view = mysqli_fetch_assoc( mysqli_query( $con , $sql ) ) ;
        
        $query = "SELECT FULL_NAME FROM member_profiles WHERE PROFILE_NO = '".$view['REFER_PROFILE_NO']."' " ;
        $refer_name = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
        
    }

?>


<?php
    $msg = "" ;
    if( isset( $_POST['update'] ) ) 
    {
        $LOAN_AMOUNT = $_POST['LOAN_AMOUNT'] ;
        $NO_OF_INSTALLMENT = $_POST['NO_OF_INSTALLMENT'] ;
        $INSTALLMENT_AMOUNT = $_POST['install'];
        $LOAN_NO = $_POST['hidden'] ;
        $final = $_POST['final_test'] ;
        
        $sql = "UPDATE loans SET `LOAN_AMOUNT` = '$LOAN_AMOUNT', `NUMBER_OF_INSTALLMENT` = '$NO_OF_INSTALLMENT', `INSTALLMENT_AMOUNT` = '$final'
        WHERE LOAN_NO = '$LOAN_NO'" ;
        
        
        $result = mysqli_query( $con , $sql ) ;
        if( $result )
        {
            $msg = "success" ;
        }
        else
        {
            $msg = "error" ;
        }
    }


?>




<form class='cmxform form-horizontal' id = "submit" method = "post" action = "" enctype = "multipart/form-data" >
    <fieldset class = "scheduler-border">
    <legend class = "scheduler-border"> Loan Information </legend>
    <input type = "hidden" name = "hidden" value = "<?php echo $view['LOAN_NO'];?>">
<!--Start Left side-->
<div class = "col-sm-6">
	<div class='form-group'>
		<label for='MEMBER_ID' class='control-label col-lg-4'>Member Name </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='MEMBER_ID' type='text' value="<?php echo $view['FULL_NAME'];?>" disabled />
		</div>
	</div>

	<div class='form-group'>
		<label for='APPLY_DATE' class='control-label col-lg-4'>Apply Date </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='APPLY_DATE' type='text' value="<?php echo $view['APPLY_DATE'];?>" disabled req='1'  />
		</div>
	</div>
	<div class='form-group'>
		<label for='LOAN_AMOUNT' class='control-label col-lg-4'>Loan Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='LOAN_AMOUNT' id = "LOAN_AMOUNT" type='text' value='<?php echo $view['LOAN_AMOUNT'];?>' req='1' is_double = '1' />
		</div>
	</div>
	
	<div class='form-group'>
		<label for='LOAN_AMOUNT' class='control-label col-lg-4'>Reference Member Name </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='REFERENCE_MEMBER_ID' type='text' value='<?php echo $refer_name['FULL_NAME'];?>' disabled req='1' is_double = '1' />
		</div>
	</div>
	<input type = "hidden" name = "final_test" id = "final_test">
	

</div>
<!--Start Right bar-->
<div class = "col-sm-6">
	<div class='form-group'>
		<label for='BALANCE' class='control-label col-lg-4'>Balance </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='BALANCE' type='text' disabled value='' />
		</div>
	</div>
	<div class='form-group'>
		<label for='NO_OF_INSTALLMENT' class='control-label col-lg-4'>Number of Installemnt </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='NO_OF_INSTALLMENT' id = "NO_OF_INSTALLMENT" type='text' value='<?php echo $view['NUMBER_OF_INSTALLMENT'];?>' req='1' is_int = '1' />
		</div>
	</div>
	<div class='form-group'>
		<label for='INSTALLMENT_AMOUNT' class='control-label col-lg-4'>Installment Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='install' id = "INSTALLMENT_AMOUNT"   type='number'  req='1' is_double = '1' disabled />
		</div>
	</div>
	
	<div class="form-group">
         <label class="col-md-4 control-label" for="loan_period">Loan Period</label>
            <div class="col-md-8">
                                
                <select class="form-control search" name="loan_period" id="loan_period" style = "width:100%;" >
                    
                    <?php 
                        function Convert( $type )
                        {
                            $store = array( "monthly"=> "Monthly", "weekly" => "Weekly", "yearly" => "Yearly", "15_days" => "15 Days",
                            "3_month" => "3 month", "6_month" => "6 month"  ) ;
                            
                            foreach( $store as $key => $value )
                            {
                                echo $value ;
                                if( $key == $type )
                                {
                                    return $value ;
                                }
                            }
                        }
                        
                        echo "<option value = '".$view['LOAN_PERIOD']."'>".Convert( $view['LOAN_PERIOD'] )."</option>" ;
                        
                    ?>
                    
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
	<div class='form-group'>
		<div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
			<input type='submit' name ='update' class='btn btn-primary'   value='Update'/>
			<button type = "button" class = "btn btn-primary" onclick="window.location.href='/submit/template/soft/loan_approval.php'" > Back </button>
		</div>
		
	</div>
	</fieldset>
</form>



<?php include 'include/footer.php';?>
<script>
    
    $( document ).ready( function ( ) {
        
       
        
        var amount1 = $("#LOAN_AMOUNT").val( ) ;
        var no1 = $("#NO_OF_INSTALLMENT").val( ) ;
        
        $( "#INSTALLMENT_AMOUNT" ).val( Number ( amount1  ) / Number ( no1 ) ) ;
        $( "#final_test" ).val( Number ( amount1  ) / Number ( no1 ) ) ;
        
        $("#LOAN_AMOUNT").on( "change" , function( ) 
        {
            var amount = $("#LOAN_AMOUNT").val( ) ;
            var no = $("#NO_OF_INSTALLMENT").val( ) ;
            if( no != "" ) 
            {
                $( "#INSTALLMENT_AMOUNT" ).val(  Number ( amount  ) / Number ( no ) ) ;
                $( "#final_test" ).val( Number ( amount  ) / Number ( no ) ) ;
            }
            
        }) ;
        
        $("#NO_OF_INSTALLMENT").on( "change" , function( ) 
        {
            var amount = $("#LOAN_AMOUNT").val( ) ;
            var no = $("#NO_OF_INSTALLMENT").val( ) ;
            if( amount != "" ) 
            {
                $( "#INSTALLMENT_AMOUNT" ).val( Number ( amount  ) / Number ( no ) ) ;
                $( "#final_test" ).val( Number ( amount  ) / Number ( no ) ) ;
            }
            
        }) ;
        
        <?php
            if( $msg == "success")
            {
                ?>
                
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Updated!',
                          showConfirmButton: false,
                          timer: 1000
                        });
                  window.location.href='/submit/template/soft/loan_approval.php' ;
                <?php
            }
            else if( $msg == "error" )
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'error',
                          title: 'Error!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                 window.location.href='/submit/template/soft/loan_approval.php' ;
                <?php
            }
        
        ?>
        
    }) ;
    
</script>


