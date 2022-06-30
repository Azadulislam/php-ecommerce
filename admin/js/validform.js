$(document).ready(function () {
    $('#categoryform').validate({
        rules:{
            catname: {
                required: true,
                remote: {
                    url: "api/checkdata.php",
                    type: "post",
                    // success: function(response) {
                    //     console.log(response);
                    // },
                    // error: function (error){
                    //     console.log(error)
                    // }
                }
            },
            cat_status: {
                required: true,
            },
            catbanner: {
                required: true,
                extension: "jpg|png|jpeg",
            },
        },
        highlight: function(element){
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.form-group').removeClass('no-error');
        },
        unhighlight: function(element){
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').addClass('no-error');
        },
        messages:{
            catname: {
                required: "Name is required",
                remote: "Name already exist"
            },
            cat_status: {
                required: "Select status type",
            },
            catbanner: {
                required: 'Select Benner',
                extension: "Select a valid banner"
            },
        }
    });

    // Sub category validateion
    $('#subcategoryform').validate({
        rules:{
            catname: {
                required: true,
                remote: {
                    url: "api/ch-sub-cat.php"
                }
            },
            cat_status: {
                required: true,
            },
            catbanner: {
                required: true,
                extension: "jpg|png|jpeg",
            },
            cat:{
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
        messages:{
            catname: {
                required: "Name is required",
                remote: "Name already exist"
            },
            cat_status: {
                required: "Select status type",
            },
            catbanner: {
                required: 'Select Benner',
            },
            cat:{
                required: "Category selection required",
            }
        }
    });

    // Edit Category validation
    $('#editcategory').validate({
        rules:{
            catname: {
                required: true,
            },
            cat_status: {
                required: true,
            },
        },
        highlight: function(element){
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.form-group').removeClass('no-error');
        },
        unhighlight: function(element){
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').addClass('no-error');
        },
        messages:{
            catname: {
                required: "Name is required",
            },
            cat_status: {
                required: "Select status type",
            },
        }
    });
    $('#editSubCategory').validate({
        rules:{
            catname: {
                required: true,
            },
            cat_status: {
                required: true,
            },
            cat:{
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
        messages:{
            catname: {
                required: "Name is required",
            },
            cat_status: {
                required: "Select status type",
            },
            cat:{
                required: "Category selection required",
            }
        }
    });


    $('#productForm').validate({
        rules:{
            pname: {
                required: true,
                remote:{
                    url: "api/product.php",
                    type: "post"
                }
            },
            prddesc: {
                required: true,
            },
            brand: {
                required: true,
            },
            quantity: {
                required: true,
                number: true,
            },
            price:{
                required: true,
                number: true,
            },
            status: {
                required: true,
            },
            category: {
                required: true,
            },
            prdimage: {
                required: true,
                extension: "jpg|png|jpeg",
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
            pname: {
                required: "Name is required",
                remote: "Name is alredy Exist"
            },
            prddesc: {
                required: "Description is required",
            },
            quantity: {
                required: "Quantity is required",
                number: "Must input number",
            },
            price:{
                required: "Price is required",
                number: "Price contain Number",
            },
            status: {
                required: "Must select an option",
            },
            category: {
                required: "Must select an option",
            },
            prdimage: {
                required: "Must select One image",
                extension: "Select a valid image with (.jpg .png .jpeg) extension",

            },
        }
    });
});