$(document).ready(function () {
    $('span.q_plus').click(function (e) { 
        e.preventDefault();
        var qty = $(this).data('target');
        var price = $(this).data('price');
        var dis = $(this).data('discount');
        var proid = $(this).data('id');
        var qtyval = $(qty).val();
        var max = $(qty).attr('max');
        if(max == 0){
            alert("Product is not avilable");
        }else if(max == qtyval){
            alert(max+" Product is avilable");
        }else{
            $.post("cart.php", { plus: qtyval, pid: proid ,price:price,discount:dis})
            .done(function( data ) {
                console.log(data);
                //$("#maindiv").load("templates/_cl.php");
                location.reload();
            });
        }

    });

    $('.q_minus').click(function (e) { 
        e.preventDefault();
        var qty = $(this).data('target');
        var dis = $(this).data('discount');
        var proid = $(this).data('id');
        var qtyval = $(qty).val();
        var price = $(this).data('price');
        if(qtyval > 1){
            $.post("cart.php", { min: qtyval, pid: proid,price:price,discount:dis})
            .done(function( data ) {
                console.log(data);
                //$("#maindiv").load("templates/_cl.php");
                location.reload();
            });
        }else{
            alert("Product can't be less than 1");
        }

    });



    
    // $("[data-get='sub_category']").change(function (e) { 
    //     //e.preventDefault();
    //     var target = $(this).data('target');
    //     $('#subcat').html('<option value="">Sufaafad category</option>');
    //     var id     = $(this).children(":selected").val();
    //     var data   = {catid:id};
    //     var jsobj  = JSON.stringify(data);

    //     $.ajax({
    //         type: "POST",
    //         url : "api/getcategory.php",
    //         data: jsobj,
    //         cache: false,
    //         processData: false,
    //         success: function (response) {
    //             $.each(response, function (k, v) { 
    //                 $(target).append("<option value='"+v.id+"'>"+v.name+"</option>");
    //             });
    //         },
    //         error: function(error){
    //             console.log(error);
    //         }
    //     })
    // });
    
    

    // side maenu script
    var catid = null;
    $('.sidmenu_link').click(function (e) {
        e.preventDefault();
        var id = $(this).data('target');
        $(".submenu:not("+id+")").hide(500).parent().removeClass('actv');
        $(this).parent().toggleClass('actv');
        $(id).toggle(500);
        catid    = $(this).data('category');
        $(".sidemenu_subcategory").prop('checked', false);
        $(document.querySelectorAll('.check'+catid)).prop('checked', true)
        sendDtata();
    });
    
    $(".sidemenu_subcategory").click(function (e) { 
        sendDtata();
    });

    $('[name="srctext"]').keyup(function (e) { 
        e.preventDefault();
        sendDtata();
    });
    $('[name="brandby"]').change(function (e) { 
        e.preventDefault();
        sendDtata();
    });
    $('[name="vendoresrc"]').change(function (e) { 
        e.preventDefault();
        sendDtata();
    });
    $('[name="orderby"]').change(function (e) { 
        e.preventDefault();
        sendDtata();
    });
    
    $('#searchtopfrom').submit(function (e) { 
        e.preventDefault();
        sendDtata();
    });

    $('.sidebar_ttl').click(function (e) { 
        e.preventDefault();
        location.reload();
    });

    var min = null;
    var max = null;

    //slider range category
    $("#slider-range").slider({
       range: true,
       min: 0,
       max: 10000,
       step: 10,
       values: [0, 4800000],
       slide: function (event, ui) {
           $("#amount_mn").val(ui.values[0]);
           $("#amount_mx").val(ui.values[1]);
        },
        stop: function(event,ui){
            min = $("#amount_mn").val();
            if(min==0){
                min = 1;
            }
            max = $("#amount_mx").val();
            console.log(min);
            console.log(max);
           fileter();
       }
    });
    $("#amount_mn").val($("#slider-range").slider("values", 0));
    $("#amount_mx").val($("#slider-range").slider("values", 1));
    
   //slider range category
    var slider2 = $("#slider-range2");
    slider2.slider({
        range: true,
        min: 0,
        max: 10000,
        step: 5,
        values: [0, 10000],
        slide: function (event, ui) {
            $("#amount_min").val(ui.values[0]);
            $("#amount_max").val(ui.values[1]);
        },
        stop: function (event, ui) {
            min = $("#amount_min").val();
            if(min==0){
                min = 1;
            }
            max = $("#amount_max").val();
            sendDtata();
        }
    });
    $("#amount_min").val(slider2.slider("values", 0));
    $("#amount_max").val(slider2.slider("values", 1));
    
    function sendDtata() {
        var key      = $('[name="srctext"]').val();
        var vendorid = $('[name="vendoresrc"]').val();
        var brand_d  = $('[name="brandby"]').val();
        var porder   = $('[name="orderby"]').val();
        var action   = "fetch_data";
        sub = dataArray('.sidemenu_subcategory');
        var data   = {action:action,cid:catid,scid:sub,min:min,max:max,price:porder,brand:brand_d,vendor:vendorid,serach:key};
        $.ajax({
            type: "POST",
            url : "api/search.php?sing",
            data:  data,
            success: function (response) {
                $('.product_content').html(response);
            },
            error: function(error){
                console.log(error);
            }
        })
    }

     // slider range

    function dataArray(class_name) { 
        var array = [];
        $(class_name+':checked').each( function(){
            array.push($(this).val());
        })
        return array;
    }


    // Fetch sub category
    $('[data-get="sub_category"]').change(function (e) {
        const target = $(this).data('target');
        var id     = $(this).children(":selected").val();
        var data   = {catid:id};
        var jsobj  = JSON.stringify(data);
        $(target).html('<option value="">Sub category</option>');
        $.ajax({
            type: "POST",
            url : "api/getcategory.php",
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

    $('#select_category').change(function (e) { 
        e.preventDefault();
        fileter();
    });
    $('#subCat').change(function (e) { 
        e.preventDefault();
        fileter();
    });
    $('.src-imp-text').blur(function (e) { 
        e.preventDefault();
        fileter();
    });
    $('#seletbrnd').change(function (e) { 
        e.preventDefault();
        fileter();
    });
    $('#searchSidbar').submit(function (e) { 
        e.preventDefault();
        fileter();
    });

    function fileter() {
        var category    = $('#select_category').val();
        var subCategory = $('#subCat').val();
        var dif         = $('#subCat').data("dif");
        var barnd       = $('#seletbrnd').val();
        var key         = $('.src-imp-text').val();
        var action      = "filter";
        var vendorid    = 0;
        var porder      = 0;
        var page        = "api/search.php";
        var data        = {action:action,cid:category,scid:subCategory,min:min,max:max,price:porder,brand:barnd,vendor:vendorid,serach:key};
        $.ajax({
            type: "POST",
            url : page,
            data:  data,
            success: function (response) {
                $('.page_product').html(response);
            },
            error: function(error){
                console.log(error);
            }
        })
    }


    
});