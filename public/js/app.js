$(function () {
    App.init();
});

App = {
    // Config
    config: {
        doNotHideControlsFor: '.download, .destroy, .restore, .controls',
        status: 1,
        getCsrfToken: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        }
    },
    // Methods
    init: function () {
        App.photo.init();
        App.controls.init();
        App.events();
    },
    events: function () {
        $('.filter').on('click', function () {
            if ($(this).hasClass('btn-primary')) {
                $('.filter')
                    .removeClass('btn-primary')
                    .addClass('btn-primary');
                $(this).removeClass('btn-primary');
                App.config.status = $(this).data('status');
                App.photo[$(this).data('action')]();
            }
        });

        $('body').on('click', function (e) {
            if (!$(e.target).is(App.config.doNotHideControlsFor)) {
                App.controls.hide();
                App.photo.element = $(e.target).parents('.image');
                if (App.photo.element.length) {
                    App.photo.element.addClass('highlight');
                    App.controls.prepare();
                }
            }
        });
    },
    photo: {
        element: null,
        container: null,
        init: function () {
            this.container = $('.photos-row').eq(0);
            this.show();
        },
        show: function () {
            this.action("/show/" + App.config.status);
        },
        add: function () {
            this.action("/edit/", function () {
                $('#photo-form').find('.form-loading').hide().end().on('submit', function (e) {
                    e.preventDefault();
                    $(this).find('.form-loading').show().end().find('.form-inputs').hide();
                    var formData = new FormData(this);

                    $.ajax({
                        url: '/store',
                        type: 'post',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: App.config.getCsrfToken,
                        error: function(status, error) {
                            alert('Whoops! An error occured. And we are fixing it! Please, try again later.');
                            App.photo.afterAdd();
                        },
                        success: function (response) {
                            if (response.result != 'OK') {
                                alert('Whoops! An error occured. And we are fixing it! Please, try again later.');
                            }
                            App.photo.afterAdd();
                        }
                    });
                });
            });
        },
        afterAdd: function() {
            $('.filter-row')
                .find('.add')
                .addClass('btn-primary')
                .end()
                .find('.filter-group .filter:eq(0)')
                .removeClass('btn-primary');
            App.photo.show();
        },
        action: function (url, callback) {
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                beforeSend: App.config.getCsrfToken,
                success: function (data) {
                    if (data.result === 'OK') {
                        App.photo.container.html(data.content);
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                }
            });
        }
    },
    controls: {
        element: null,
        init: function () {
            this.element = $('.footer .container').eq(0);
        },
        prepare: function () {
            if (App.photo.element.data('id')) {
                $.ajax({
                    url: "/controls/" + App.photo.element.data('id'),
                    method: "GET",
                    dataType: "json",
                    beforeSend: App.config.getCsrfToken,
                    success: function (data) {
                        if (data.result === 'OK') {
                            App.controls.element.html(data.content).show();
                            $('#controls-form').off('submit').on('submit', function () {
                                $.ajax({
                                    url: $(this).attr('action'),
                                    method: $(this).attr('method'),
                                    dataType: "json",
                                    beforeSend: App.config.getCsrfToken,
                                    success: function (data) {
                                        if (data.result === 'OK') {
                                            App.controls.hide();
                                            App.photo.show();
                                        }
                                    }
                                });
                                return false;
                            });
                        }
                    }
                });
            }
        },
        show: function () {
            this.element.show();
            this.element
                .find('a.download')
                .attr(
                    'href',
                    'storage/photo/' + image.data('image')
                );
        },
        hide: function () {
            this.element.hide();
            $('.highlight').removeClass('highlight');
        }
    }
};