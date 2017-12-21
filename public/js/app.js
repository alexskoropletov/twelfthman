$(function() {
    var controls = $('.footer .container').eq(0);

    $('.filter').on('click', function() {
        if ($(this).hasClass('btn-primary')) {
            $('.filter')
                .removeClass('btn-primary')
                .addClass('btn-primary');
            $(this).removeClass('btn-primary');
            $('.image').hide();
            $('.image.status' + $(this).data('status')).show();
        }
    });

    $('body').on('click', function(e) {
        if (!$(e.target).hasClass('download') && !$(e.target).hasClass('delete')) {
            var image = $(e.target).parents('.image');
            controls.hide();
            $('.highlight').removeClass('highlight');
            if (image.length) {
                controls.show();
                image.addClass('highlight');
                // action buttons
                // TODO: delete button
                controls
                    .find('a.download')
                    .attr(
                        'href',
                        'storage/photo/' + image.data('image')
                    );
            }
        }
    });
});