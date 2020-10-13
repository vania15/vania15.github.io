$(function() {

    //controls
    var slick = 0;
    if (innerWidth < 480){
        if (!slick) {
            $('.slides').slick({
                arrows:true,
                slidesToShow: 1,
                slidesToScroll: 1,
                swipeToSlide: true,
                infinite: true
            });
            slick = 1;
        }
    }
    $(window).resize(function() {
        if (innerWidth < 480){
            if (!slick) {
                $('.slides').slick({
                    arrows:true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    swipeToSlide: true,
                    infinite: true
                });
                slick = 1;
            }
        }
        else {
            if (slick){
                $('.slides').slick('unslick');
                slick = 0;
            }
        }
    });
});