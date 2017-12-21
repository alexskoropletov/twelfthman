$(function() {
    var controls = $('.footer .container').eq(0);
    $('body').on('click', function(e) {
        var image = $(e.target).parents('.image');
        controls.hide();
        $('.highlight').removeClass('highlight');
        if (image.length) {
            controls.show();
            image.addClass('highlight');

        }
    });
});