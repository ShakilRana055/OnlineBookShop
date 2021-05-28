var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();
        
        $("#prpject_wise_expense").validate( {
            rules:
            {
                project_name: { required: true },
                expense_head: { required: true },
                expense_code: { required: true },
            },
            messages:
            {
                project_name: "Please select one Project",
                expense_head : "Please enter Expense head",
                expense_code:"Please enter expense code",
            }
        }) ;
        
        $( "#daily_expense").validate( {
           rules:
           {
               date:{ required: true },
               amount:{ required: true },
               expense_head:{ required: true },
           },
           messages:
           {
               date: "Please pick a date",
               amount: "Please enter amount",
               expense_head: "Please select one",
           }
        });
        
        $("#revenue_setup").validate( {
            
            rules:
            {
                project_name: { required: true },
                type:{ required: true },
               // radio:{ required: true },
                revenue_type:{ required: true },
                rent_period:{ required: true },
                part_project:{ required: true },
                district:{ required: true },
                location:{ required: true },
                sl_no:{ required: true },
            },
            messages:
            {
                project_name: "Please enter project name",
                type: "Please select one",
               // radio: "Please select one",
                revenue_type : "Please select one",
                rent_period: "Please select one",
                part_project: "Plese enter part of project",
                district: "Please select one",
                location: "Please enter location",
                sl_no : "Please enter serial no",
            }
            
        });
        
        $("#project_expense").validate( { 
            
            rules:
            {
                date:  { required: true },
                amount: { required: true },
                project: { required: true },
                expense_head:{ required: true },
            },
            messages:
            {
                date: "Please Enter date",
                amount: "Please Enter amount",
                project: "Please Select project Name",
                expense_head: "Please Select Expense Head Name",
            }
            
        });
        
        
        $( "#project_form" ).validate( {
            
            rules:
            {
                project_name: { required: true },
                location:{ required: true },
                project_detail:{ required: true },
                start_date:{ required: true },
                responsible: { required: true },
            },
            messages:
            {
                project_name: "Please enter project name",
                location: "Please Enter location",
                project_detail: "Write Something about Project",
                start_date: "Please enter start date",
                responsible: "Please Choose resposnsible member name",
            }
            
        }) ;
        
        $("#installment_form").validate( {
            rules:
            {
                installment : { required:true },
                installment_amount: { required: true },
                total_paid:{ required: true },
            },
            messages:
            {
                installment: "Please Enter number of installment",
                installment_amount: "Please enter Installment Amount",
                total_paid: "Total Paid",
            }
        } );
        
        $("#saved_it").validate({
                rules:
                {
                    member_id:{ required: true } ,
                      apply_date:{ required: true } ,
                      loan_amount:{ required: true } ,
                      refer_member_id:{ required: true } ,
                },
                messages: 
                {
                      apply_date: "Please Enter Date",
                      loan_amount: "Please Enter loan amount",  
                      refer_member_id: "Please Enter Reference member ID", 
                      member_id: "Please Enter member ID ",
                }
        });

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();