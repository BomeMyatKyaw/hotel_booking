$(document).ready(function(){


    // Start Back to Top

    $('.btn-backtotops').hide();
    $(window).scroll(function(){
        var getscrolltops = $(this).scrollTop();
        console.log(getscrolltops);

        if(getscrolltops >= 370){
            $('.btn-backtotops').fadeIn(1000);
        }else{
            $('.btn-backtotops').fadeOut(1000);
        }

    });

    // End Back to Top

    // Start Nav Bar
        $(window).scroll(function(){


            let position = $(this).scrollTop();
            // console.log(position);

            if (position >= 200){
                $('.navbar').addClass('navmenus')
            }else{
                $('.navbar').removeClass('navmenus');
            }

        });


        $('.navbuttons').click(function(){
            $(this).toggleClass('crossxs');
        });

    // End Nav Bar

    // Start Property Section

    $('.propertylists').click(function(){

        // $(this).addClass('activeitems');
        $(this).addClass('activeitems').siblings().removeClass('activeitems');

        let filtervalue = $(this).attr('data-filter');
            filtervalue = $(this).data('filter');

        console.log(filtervalue);

        if(filtervalue === 'all'){
            $('.filters').show('slide',500);
        }else{
            $('.filters').hide();

            $('.filter').not('.'+filtervalue).hide('slide',500);
            $('.filter').filter('.'+filtervalue).show('slide',500);

        }
        
    });

    // End Property Section

    // Start Adv Section

    $(window).scroll(function(){
        
        var getscrolltt = $(this).scrollTop();
        console.log(getscrolltt);
        if(getscrolltt >= 900){
            $('.advimages').addClass('fromlefts');
            $('.advtexts').addClass('fromrights');
        }else{
            $('.advimages').removeClass('fromlefts');
            $('.advtexts').removeClass('fromrights');
        }

    });

    // End Adv Section

    // Start Footer Section

    const getyear= $('#getyear');
    const getfullyear = new Date().getFullYear();
    getyear.text(getfullyear);

    // End Footer Section

});