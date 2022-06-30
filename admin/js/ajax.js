$(document).ready(function () {

    function resultAlert(message,status) { 
        if(status ==1){
            $('.err').slideUp(500);
            $('.suc>.mess').text(message);
            $('.suc').slideDown();
            setTimeout(function(){ $('.suc').slideUp(500);}, 3000);
        }else if(status == 0){
            $('.suc').slideUp(500);
            $('.err>.mess').text(message);
            $('.err').slideDown();
            setTimeout(function(){ $('.err').slideUp(500);}, 3000);
        }
     }

    $('a.editbtn').click(function (e) {

        var id = $(this).data('id');

        var url = $(this).data('url');

        var jsobj = {id:id};

        var fields = JSON.stringify(jsobj);

        $.ajax({

            type: "POST",

            url: url+"/admin/api/category.php",

            data: fields,

            processData: false,

            contentType: false,

            success: function (response) {

                $('#edtcatname').val(response.name);

                $('.id').val(response.id)

            },

            error: function(error){

                console.log(error);

            }

        });

    });



    $('[data-get="subcategory"]').change(function (e) { 

        e.preventDefault();

        const target = $(this).data('target');

        var id     = $(this).children(":selected").val();

        var data   = {catid:id};

        var jsobj  = JSON.stringify(data);

        $(target).html('<option value="">--Select sub category--</option>');

        $.ajax({

            type: "POST",

            url : "api/category.php",

            data: jsobj,

            cache: false,

            processData: false,

            success: function (response) {

                $.each(response, function (k, v) {

                    $(target).append("<option value='"+v.id+"'>"+v.name+"</option>");

                });

            },

            error: function(error){

                console.log(error);

            }

        })

    });


    $('[data-get="brand"]').change(function (e) { 

        e.preventDefault();
        const target = $(this).data('target');

        var id     = $(this).children(":selected").val();
        var cat    = $('[data-get="subcategory"]').children(":selected").val();
        var data   = {subcatid:id,catid:cat};

        var jsobj  = JSON.stringify(data);

        $(target).html('<option value="">--Select Brand--</option>');

        $.ajax({

            type: "POST",

            url : "api/brand.php",

            data: jsobj,

            cache: false,

            processData: false,

            success: function (response) {

                $.each(response, function (k, v) {

                    $(target).append("<option value='"+v.id+"'>"+v.name+"</option>");

                });

            },

            error: function(error){

                console.log(error);

            }

        })

    });



    $('.not_working_alert').click(function (e) { 

        e.preventDefault();

        $('.err-mess').text("Demo purpous it will not work!");

        $('.err').slideDown(500);

        setTimeout(function(){ $('.err').slideUp(500);}, 3000);

    });

    $('.err').click(function () {
        $('.err').slideUp(500);
    })

    $('a.update').click(function (e) {
        e.preventDefault();
        var tag    = $(this);
        var id     = $(this).data('id');
        var sts    = $(this).data('status');
        var target = $(this).data('target');
        var url    = $("#url").val();
        var jsobj  = {id:id,action:target,status:sts};
        var fields = JSON.stringify(jsobj);
        $.ajax({
            type: "POST",
            url: url+"/admin/api/status.php",
            data: fields,
            contentType: false,
            cache: false,
            success: function (response) {
                resultAlert(response.mess,response.status);
                if(response.status == 1){
                    location.reload();
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});