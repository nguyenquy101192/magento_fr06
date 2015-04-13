var $j = jQuery.noConflict();

jQuery(document).ready(function ($) {
    $(function () {
        var current_caption = 0;
        var list_caption    = $("#caption").children();
        var count           = $('.caption-title').length;

        /*
        *   add for #caption attribute id=item-n
        */
        list_caption.attr("id", function(arr) {
            return "item" + arr;
            });

        /*
        *   function previous click
        */
        $('#prev').click(function () {
            if (current_caption > 0) {
            prev_current = current_caption - 1;
            $('#item' + current_caption).fadeOut();
            $('#item' + prev_current).fadeIn();
            current_caption = current_caption - 1;
            }
        else {
            $('#item' + current_caption).fadeOut();
            current_caption = count - 1;
            $('#item' + current_caption).fadeIn();
            }
        });


        /*
        *   function next click
        */
        $('#next').click(function () {
            if (current_caption < count - 1) {
            next_current = current_caption + 1;
            $('#item' + current_caption).fadeOut();
            $('#item' + next_current).fadeIn();
            current_caption = current_caption + 1;
            }
        else {
            $('#item' + current_caption).fadeOut();
            current_caption = 0;
            $('#item' + current_caption).fadeIn();
            }
        });
    });
});