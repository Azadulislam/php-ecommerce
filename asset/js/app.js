$(document).ready(function () {

    $('[data-toggle="menu"]').click( function (e) { 
        e.preventDefault();
        var id = $(this).attr('href');
        if(id == '#' || id == '' || id == 'javascirpt:'){
            return;
        }else{
            $(id).toggle('500');
        }
    });
    
    $('[data-toggle="tooltip"]').tooltip();

    var owlone = $('.owl_one');
    var nxtbtn = $('#nxt_one');
    var prvbtn = $('#prv_one');
    initowl(owlone,nxtbtn,prvbtn);

    function initowl(target,next,prev){
        target.owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            slideSpeed : 2000,
            lazyLoad: true,
        })
        next.click(function (e) {
            e.preventDefault();
            owlone.trigger('next.owl.carousel');
        })
    
        prev.click(function (e) {
            e.preventDefault();
            owlone.trigger('prev.owl.carousel', [300]);
        })
    }

    





    //==============Owl two=========

    var owltow  = $('.owl_tow');
    var nextbtn = $('button.nxt-tow');
    var prevbtn = $('button.prv-tow');
    owlInit(owltow,nextbtn,prevbtn);
    
    
    //==============Owl three=========
    
    var owltow  = $('.owl_three');
    var nextbtn = $('button.nxt-three');
    var prevbtn = $('button.prv-three');
    owlInit(owltow,nextbtn,prevbtn);


    //==============Owl four=========

    var owltow  = $('.owl_four');
    var nextbtn = $('button.nxt-four');
    var prevbtn = $('button.prv-four');
    owlInit(owltow,nextbtn,prevbtn);

    //==============Owl five=========

    var owltow  = $('.owl_five');
    var nextbtn = $('button.nxt-five');
    var prevbtn = $('button.prv-five');
    owlInit(owltow,nextbtn,prevbtn);


    


    function owlInit(target,next,prev) { 
        target.owlCarousel({
            items: 5,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            dots: false,
            nav: false,
            lazyLoad: true,
            responsive:{
                300:{
                    items:2,
                },
                600:{
                    items:2,
                },
                800:{
                    items:3,
                },
                1000:{
                    items:4,
                },
                1180:{
                    items:5,
                    nav:true,
                }
            }
        });
    
        next.click(function (e) {
            e.preventDefault();
            target.trigger('next.owl.carousel');
        })
        prev.click(function (e) {
            e.preventDefault();
            target.trigger('prev.owl.carousel', [300]);
        })
    }








    //==============Owl seven=========

    var owl_svn = $('.owl_svn');




    owl_svn.owlCarousel({

        items: 4,

        loop: true,

        margin: 10,

        autoplay: true,

        autoplayTimeout: 5000,

        autoplayHoverPause: true,

        dots: false,

        responsive:{

            300:{

                items:2,

            },

            600:{

                items:2,

            },

            800:{

                items:3,

            },

            1000:{

                items:4,

            },

            1180:{

                items:4,

                nav:true,

            }

        }

    });

    $('.nxt_svn').click(function (e) {

        e.preventDefault();

        owl_svn.trigger('next.owl.carousel');

    })

    $('.prv_svn').click(function (e) {

        e.preventDefault();

        owl_svn.trigger('prev.owl.carousel', [300]);

    })



    //==============Owl six=========

    var owltow  = $('.owl_six');
    var nextbtn = $('.nxt_six');
    var prevbtn = $('.prv_six');
    owlInitEight(owltow,nextbtn,prevbtn);

    //==============Owl eight=========

    var owl_eight = $('.owl_eight');
    var nextbtn   = $('.nxt_eight');
    var prevbtn   = $('.prv_eight');

    owlInitEight(owl_eight,nextbtn,prevbtn);

    function owlInitEight(target,next,prev){
        target.owlCarousel({
            items: 8,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            dots: false,
            lazyLoad: true,
            nav: false,
            responsive:{
                300:{
                    items:3,
                },
                600:{
                    items:4,
                },
                800:{
                    items:4,
                },
                1000:{
                    items:6,
                },
                1180:{
                    items:8,
                    nav:true,
                }
            }
        });

        next.click(function (e) {
            e.preventDefault();
            target.trigger('next.owl.carousel');
        })

        prev.click(function (e) {
            e.preventDefault();
            target.trigger('prev.owl.carousel', [300]);
        })
    }




    $(window).scroll(function () {

        if ($(this).scrollTop() > 5) {
            $("#backToTop").css({ bottom: '15px' });
        } else {
            $("#backToTop").css({ bottom: '-100px' });
        }

    });



    $("#backToTop").click(function () {

        $("html, body").animate({ scrollTop: 0 }, 1000);

    });

    //================Select picker============

    $('#selectcat').selectpicker();

    $('#subcat').selectpicker();

    $('#selectbrnd').selectpicker();

    $('#order').selectpicker();



    



   

    



    



    

    

    $(".womenfashion-content .nav-item:first-child .nav-link").addClass('active');

    

    var fmsl = $("[name='type']");

    var selavlo = $("#tone").children(":selected").val();

    var selavlt = $("#ttwo").children(":selected").val();

    changlink(selavlo);

    changlink(selavlt);

    $("[name='type']").change(function (e) { 

        var type = $(this).children(":selected").val();

        changlink(type);

    })



    function changlink(type) {

        if(type == 'vendor'){

            fmsl.parent().parent().attr('action','all_vendors.php');

            $("[name='category']").css('display','none');

            $("[name='search']").css('width','74.3%');

        }else{

            fmsl.parent().parent().attr('action','search.php');

            $("[name='category']").css('display','inline-block');

            $("[name='search']").css('width','48.6%');

        }

    }



})

