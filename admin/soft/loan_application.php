<?php include 'include/header.php';?>
<?php $table_heading = "Loan Application";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<?php 

    // insert data into tables 
    $msg = "" ;
    if( isset( $_POST['save']))
    {
        $cur_date = date( "Y-m-d" ) ;
        $member_no = $_POST['member_no'] ;
        $date = $_POST['APPLY_DATE'] ;
        $loan_amount = $_POST['LOAN_AMOUNT'] ;
        $reference = $_POST['REFERENCE_MEMBER_ID'] ;
        $no_of_installment = $_POST['NO_OF_INSTALLMENT'] ;
        $installment_amount = $_POST['INSTALLMENT_AMOUNT'] ;
        $profile_no = $_POST['profile_no'] ;
        $refer_profile_no = mysqli_fetch_assoc ( mysqli_query( $con , "select `PROFILE_NO` from member_profiles where MEMBER_NO = '$reference'") ) ;
        $prf = $refer_profile_no['PROFILE_NO'] ;
        $loan_period = $_POST['loan_period'] ;
        $store = $_POST['store'] ;
        
        $update_is_pending = "UPDATE member_profiles SET IS_PENDING = 1 WHERE MEMBER_NO = '$member_no'" ;
        mysqli_query( $con, $update_is_pending ) ;
        
        $insert_query = "INSERT INTO loans SET `MEMBER_NO` = '$member_no', `PROFILE_NO` = '$profile_no', `APPLY_DATE` = '$cur_date', `LOAN_AMOUNT` = '$loan_amount', 
         `REFER_MEMBER_NO` = '$reference', `REFER_PROFILE_NO` = '$prf', `NUMBER_OF_INSTALLMENT` = '$no_of_installment', 
         `INSTALLMENT_AMOUNT` = '$store', LOAN_PERIOD = '$loan_period'" ;
    
        $insertion = mysqli_query($con , $insert_query ) ;
        if( $insertion )
        {
            $msg = "success" ;
        }
        else
        {
            $msg = "error" ;
        }
    }
    
    

?>

<?php 
    $get_cash = "SELECT `CASH_CURRENT_BALANCE` FROM acc_cash WHERE CASH_NO = 1 " ;
    $cash = mysqli_fetch_assoc( mysqli_query( $con , $get_cash ) ) ;
?>

<?php
    
    $is_search = "no" ;
    $search_result = "" ;
    $cur = date("d-m-Y") ;
    if( isset( $_POST['search']) ) 
    {
    
        $member_id = $_POST['MEMBER_NO'] ;
        $mobile_number =  $_POST['MOBILE_NO'] ;
        $check_is_taken = "SELECT IS_TAKEN , IS_PENDING FROM member_profiles WHERE MEMBER_ID = '$member_id'" ;
        $check_result = mysqli_fetch_assoc ( mysqli_query( $con , $check_is_taken ) ) ;
        if( $check_result['IS_TAKEN'] == '1' )
        {
            
            $is_search = "is_taken" ;
        }
        else if( $check_result['IS_PENDING'] == '1' )
        {
            $is_search = "is_pending" ;
        }
        else
        {
          
            $query = "" ;
            if( $member_id != "" )
            {
                $query = "SELECT * FROM member_profiles WHERE MEMBER_ID = '$member_id'" ;
            }
            else if( $mobile_number != "" )
            {
                $query = "SELECT * FROM member_profiles WHERE MOBILE = '$mobile_number'" ;
            }
            
            
            $search_result = mysqli_fetch_assoc( mysqli_query( $con , $query ) ) ;
            if( $search_result )
            {
                $is_search = "yes" ;
            }
        }
        
    }

    
?>

    <form action="" id="search" method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" > Search </legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Member ID</label>
                        <div class="col-md-6">
                            <input type="text" id="MEMBER_NO" name="MEMBER_NO" class="form-control" placeholder="Member ID">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-text-input">Mobile No.</label>
                        <div class="col-md-6">
                            <input type="text" id="MOBILE_NO" name="MOBILE_NO" class="form-control" placeholder="Mobile No">
                            
                        </div>
                    </div>

                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="search" class="btn btn-sm btn-primary" id="search_id" ></i>Search</button>
                            
                            </div>

                            </div>
                    </fieldset>
</form>


<input type = "hidden" id = "hidden23" name = "hidden" value = "<?php echo $is_search ; ?>">

<form class='cmxform form-horizontal' id = "submit" method = "post" action = "" enctype = "multipart/form-data" style = "display:none">
    <fieldset class = "scheduler-border">
    <legend class = "scheduler-border"> Loan Information </legend>
    
<!--Start Left side-->
<div class = "col-sm-6">
	<div class='form-group'>
		<label for='MEMBER_ID' class='control-label col-lg-4'>Member ID </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='MEMBER_ID' type='text' value="<?php echo $search_result['MEMBER_ID'];?>" disabled />
		</div>
	</div>
	<input type = "hidden" name = "profile_no" value = "<?php echo $search_result['PROFILE_NO'] ; ?>">
	<input type = "hidden" name = "member_no" value = "<?php echo $search_result['MEMBER_NO'] ; ?>">
	
	<div class='form-group'>
		<label for='APPLY_DATE' class='control-label col-lg-4'>Apply Date </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='APPLY_DATE' type='date'  req='1'  />
		</div>
	</div>
	<div class='form-group'>
		<label for='LOAN_AMOUNT' class='control-label col-lg-4'>Loan Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='LOAN_AMOUNT' id = "LOAN_AMOUNT" type='number' value='' req='1' is_double = '1' />
		</div>
	</div>
	
	
	<div class="form-group">
         <label class="col-md-4 control-label" for="REFERENCE_MEMBER_ID">Reference Member ID</label>
            <div class="col-md-8">
                                
                <select class="form-control search" name="REFERENCE_MEMBER_ID" id="REFERENCE_MEMBER_ID" style = "width:100%;" >
                      <option value = "-1">Please Select One</option>
                      <?php 
                            $another1 = "SELECT MEMBER_NO, FULL_NAME, PROFILE_NO FROM member_profiles" ;
                            $result12 = mysqli_query( $con , $another1 ) ;
                            foreach( $result12 as $value )
                            {
                                echo "<option value = '".$value['MEMBER_NO']."'>".$value['FULL_NAME']."</option>" ;
                            }
                            
                    ?>     
                </select>
        </div>
   </div>
	
</div>
<!--Start Right bar-->
<div class = "col-sm-6">
	<div class='form-group'>
		<label for='BALANCE' class='control-label col-lg-4' style = "color:red;">Balance </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' id = "currernt_balance" name='BALANCE' type='text' disabled style = "color:red" value='<?php echo $cash['CASH_CURRENT_BALANCE']; ?>' />
			<input type = "hidden" value='<?php echo $cash['CASH_CURRENT_BALANCE']; ?>' id = "balance_id">
		</div>
	</div>
	<div class='form-group'>
		<label for='NO_OF_INSTALLMENT' class='control-label col-lg-4'>Number of Installemnt </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='NO_OF_INSTALLMENT' id = "NO_OF_INSTALLMENT" type='number' value='' req='1' is_int = '1' />
		</div>
	</div>
	<div class='form-group'>
		<label for='INSTALLMENT_AMOUNT' class='control-label col-lg-4'>Installment Amount </label>
		<div class='col-lg-8'>
			<input class='form-control field_data' name='INSTALLMENT_AMOUNT' id = "INSTALLMENT_AMOUNT" type='number' value='' disabled req='1' is_double = '1' />
		</div>
	</div>
	<input type = "hidden"  name = "store" id = "store" >
	<div class="form-group">
         <label class="col-md-4 control-label" for="loan_period">Loan Period</label>
            <div class="col-md-8">
                                
                <select class="form-control search" name="loan_period" id="loan_period" style = "width:100%;" >
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
			<input type='submit' name ='save' class='btn btn-primary'   value='Save'/>
		</div>
	</div>
	</fieldset>
</form>



<?php include 'include/footer.php';?>
<script>
    
    $(document).ready( function( ) 
    {
        
        $("#LOAN_AMOUNT").on( "change", function( ){
            
            var amount = $("#LOAN_AMOUNT").val( ) ;
            var number = $("#NO_OF_INSTALLMENT").val( ) ;
            var balance_id = $("#balance_id").val() ;
            
            var final_balance = Number ( balance_id ) - Number( $( this ).val() ) ;
            $( "#currernt_balance").val( final_balance ) ;
            $( number != "" )
            {
                $("#INSTALLMENT_AMOUNT").val( Number ( amount ) / Number ( number ) ) ;
                $("#store").val( Number ( amount ) / Number ( number ) ) ;
            }
            
        }) ;
      
       $("#NO_OF_INSTALLMENT").on( "change", function( ){
            
            var amount = $("#LOAN_AMOUNT").val( ) ;
            var number = $("#NO_OF_INSTALLMENT").val( ) ;
            $( number != "" )
            {
                $("#INSTALLMENT_AMOUNT").val(  Number ( amount ) / Number ( number ) ) ;
                $("#store").val( Number ( amount ) / Number ( number ) ) ;
            }
            
        }) ;
       
      
        var value = $("#hidden23").val( ) ;
        console.log( value )
        if( value == "yes" ) 
        {
            $("#submit").show( ) ;
        }
        else if( value == "is_taken" )
        {
            var show = "Loan is already taken" ;
            Swal.fire( show ) ;
            
        }
        else if( value == "is_pending" )
        {
            var show = "Loan is already Pending" ;
            Swal.fire( show ) ;
        }
    
        
        <?php
        
            if( $msg == "success" ) 
            {
                ?>
                Swal.fire({
                          position: 'top-middle',
                          type: 'success',
                          title: 'Successfully Insterted!',
                          showConfirmButton: false,
                          timer: 1500
                        });
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
                
                <?php
            }
        
        ?>
        
        
    }) ;
    
    
    
</script>


