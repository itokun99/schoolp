(function($) {
    $('button[data-group="btn-link"]').on('click', function() {
        var url = $(this).attr('data-url');
        location.href = url;
    });

    $('button[data-group="btn-open"]').on('click', function() {
        var url = $(this).attr('data-url');
        var title = $(this).attr('data-title');
		
		window.open(url, title);
    });

    $('.link-delete').on('click', function() {
        if (confirm("Are you sure?")) {
            var url = $(this).attr('data-url');
            location.href = url;
        }
    });

    $(document).ready(function () {
        $('.default-msg').delay(3000).fadeOut('slow');
        $('.warning-msg').delay(3000).fadeOut('slow');
        $('.success-msg').delay(3000).fadeOut('slow');

        var lastPath = "";
        var firstPath = window.location.href.split($.baseUrl())[1].split("/")[0];

        if (firstPath == "") {
            $('li[data-id="dashboard"]').attr('class', 'active');
        }

        $('.sidebar-menu li').each(function() {
            var id = $(this).attr('data-id');
            if (id != "" && id == firstPath) {
                if (lastPath != "") {
                    $('li[data-id="' + lastPath + '"]').removeAttr('class');
                }

                $(this).attr('class', 'active');
                lastPath = firstPath;
            }
        });

        $(document).click(function (event) {
            // var _opened = $(".collapse").hasClass("collapse in");
            // if (_opened === true) {
                // $(".collapse").removeClass("in");
            // }
        });

        $('.main-sidebar').height($(document).outerHeight() + 100);

        $.setupNumberInput = function() {
            $('input[data-group="number"]').css('text-align', 'right');

            $('input[data-group="number"]').focusin(function() {
                var readonly = $(this).attr('readonly');
                if ($(this).val() == "0") {
                    $(this).val("");
                }
            });

            $('input[data-group="number"]').focusout(function() {
                if (!$(this).attr('readonly')) {
                    if ($(this).val() == "" || ($(this).val != "" && isNaN($(this).val()))) {
                        $(this).val("0");
                    }
                }
            });
        };

        $.setupNumberInput();
    });
})(jQuery);