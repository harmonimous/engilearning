function resizeJquerySteps() {
     $('.wizard .content').animate({
        height: $('.body.current').outerHeight()
    }, 'slow');
}

$(window).resize($.debounce(250, resizeJquerySteps));