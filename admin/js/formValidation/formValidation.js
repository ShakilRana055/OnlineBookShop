
function invalid(id)
{
  document.getElementById(id).class=document.getElementById(id).class+" invalid"
}
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='form-validation']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      val_fullname:{ required: true },
      val_FHname:{ required: true },
      val_occupation:{ required: true },
      val_education:{ required: true },
      val_guardian:{ required: true },
      val_memberno:{ required: true },
      val_mothername:{ required: true },
      val_age:{ required: true },
      val_relationguardian:{ required: true },

      val_villagePermanent:{ required: true },
      val_thanaPermanent:{ required: true },
      val_zillaPermanent:{ required: true },
      val_houseNoPresent:{ required: true },
      val_districtPresent:{ required: true },
      val_thanaPresent:{ required: true },
      val_postPresent:{ required: true },
      
      val_postPermanent:{ required: true },
      member_id:{ required: true } ,
      apply_date:{ required: true } ,
      loan_amount:{ required: true } ,
      refer_member_id:{ required: true } ,
      nid:{ required: true },
      mobile:{ required: true },
      reason:{ required: true },
      pre_member:{ required: true },

     //, $("#val_fullname").addClass("invalid")
    },
    // Specify validation error messages
    messages: {
      val_fullname:"Please enter full name",
      val_FHname:"Please enter Father/Husband name",
      val_occupation: "Please enter your occupation",
      val_education:"Please enter education qualification",
      val_guardian:"Please enter guardian Name",
      val_memberno: "Please Enter Member no",
      val_mothername: "please enter mother name",
      val_age:"please enter your age",
      val_relationguardian:"Relationship with Guardian",

      val_villagePermanent: "Enter Permanent Village name",
      val_thanaPermanent: "Enter permanent Thana Name",
      val_zillaPermanent:"Enter Permanent District Name",
      val_houseNoPresent:"Enter House No.",
      val_districtPresent: "Enter District Name",
      val_thanaPresent:"Enter Thana Name",
      val_postPresent:"Enter PostOffice",
      
      val_postPermanent:"Enter post PostOffice",  
      member_id : "Please Enter Member ID", 
      apply_date: "Please Enter Date",
      loan_amount: "Please Enter loan amount",  
      refer_member_id: "Please Enter Reference member ID", 
      nid: "Please Enter NID Number",
      mobile: "Please enter mobile number" ,
      reason: "Please Enter transfer Reason",
      pre_member: "Please enter Member ID",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});