$(document).ready(function () {
    $.validator.addMethod('strongPass',function(value){
        return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(value);
    },"Insert atlest one uppercase, lowercase and a number");
    $("#register_form").validate({
        rules:{
            fname: {
                required: true,
                nowhitespace: true,
            },
            lname: {
                required: true,
                nowhitespace: true,
            },
            email:{
                required: true,
                email: true,
                remote: {
                    url: "api/checkmail.php",
                    type: "post"
                }
            },
            phone:{
                required: true,
                minlength: 11,
            },
            pass: {
                required: true,
                strongPass: true,
                minlength: 8,
            },
            con_pass: {
                required: true,
                equalTo: "#pass",
            },
            add1: {
                required: true,
            },
            add2: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            cntry: {
                required: true,
            },
            zcode: {
                required: true,
            },
            agree: {
                required: true,
            }
        },
        highlight: function(element){
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.form-group').removeClass('no-error');
        },
        unhighlight: function(element){
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').addClass('no-error');
        },
        messages: {
            fname: {
                required: "First name fild is required",
                nowhitespace: "No white space Allowed",
            },
            lname: {
                required: "Last name fild is required",
                nowhitespace: "No white space Allowed",
            },
            email:{
                required: "Email must be include",
                remote: "This email alredy exist"
            },
            phone:{
                required: "Phone number is required",
            },
            pass: {
                required: "Password must be include",
                minlength: "Enter atlest 8 character"
            },
            con_pass: {
                required: 'confirm Password must be include',
                equalTo: "Inter same value as password"
            },
            add1: {
                required: "Address fild is required",
            },
            add2: {
                required: "Address fild is required",
            },
            city: {
                required: "City must be included",
            },
            state: {
                required: "State must be included",
            },
            cntry: {
                required: "Country fild is required",
            },
            zcode: {
                required: "Zip code must be included",
            },
            agree: {
                required: "Must agree with tarms and condition",
            }
        }
    });
    $("#vendoreReg").validate({
        rules:{
            fname: {
                required: true,
                nowhitespace: true,
            },
            lname: {
                required: true,
                nowhitespace: true,
            },
            email:{
                required: true,
                email: true,
                remote: {
                    url: "api/checkmail.php",
                    type: "post"
                }
            },
            pass: {
                required: true,
                strongPass: true,
                minlength: 8,
            },
            con_pass: {
                required: true,
                equalTo: "#pass",
            },
            add1: {
                required: true,
            },
            add2: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            cntry: {
                required: true,
            },
            zcode: {
                required: true,
            },
            agree: {
                required: true,
            },
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.form-group').removeClass('no-error');
        },
        unhighlight: function(element){
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').addClass('no-error');
        },
        messages: {
            fname: {
                required: "First name fild is required",
                nowhitespace: "No white space Allowed",
            },
            lname: {
                required: "Last name fild is required",
                nowhitespace: "No white space Allowed",
            },
            email:{
                required: "Email must be include",
                remote: "Email alredy Exist",
            },
            pass: {
                required: "Password must be include",
                minlength: "Enter atlest 8 character"
            },
            con_pass: {
                required: 'confirm Password must be include',
                equalTo: "Inter same value as password"
            },
            add1: {
                required: "Address fild is required",
            },
            add2: {
                required: "Address fild is required",
            },
            city: {
                required: "City must be included",
            },
            state: {
                required: "State must be included",
            },
            cntry: {
                required: "Country fild is required",
            },
            zcode: {
                required: "Zip code must be included",
            },
            agree: {
                required: "Must agree with tarms and condition",
            }
        }
    });

    $("#contatcFrom").validate({
        rules:{
            con_name:{
                required: true,
            },
            con_email:{
                required: true,
                email: true,
            },
            message:{
                required: true,
            }
        },
        highlight: function(element){
            $(element).addClass('has-error');
            $(element).removeClass('no-error');
        },
        unhighlight: function(element){
            $(element).removeClass('has-error');
            $(element).addClass('no-error');
        },
        messages: {
            con_name: {
                required: "Name fild is required",
            },
            con_email:{
                required: "Email must be filed out",
                email: "Email is not valid",
            },
            message:{
                required: "Must write something",
            }
            
        }
    });
});