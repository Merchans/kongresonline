var clickHandler = 'click';

$(document).ready(function() {

    $("body").bind('touchmove', function(event) {
        event.preventDefault();
    });

    if ('ontouchstart' in document.documentElement) {
        clickHandler = "touchstart";
    }

//    $(document).swipe({
//
//        swipe: function(event, direction, distance, duration, fingerCount) {
//
//            if (!$(event.target).hasClass('noSwipe')) {
//
//                if (direction == 'left' && distance > 100) {
//                   document.location = "veeva:gotoSlide(DE_2019_02_BRI_Pflichttext.zip)";
//
//
//                } else if (direction == 'right' && distance > 100) {
//
//                    document.location = "veeva:prevSlide()";
//
//                }
//            }
//            event.stopImmediatePropagation();
//            event.preventDefault();
//        },
//        threshold: 200
//    });


});
