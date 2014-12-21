(function ($) {
    $.fn.autoSubmit = function (options) {
        return $.each (this, function () {
            var input = $(this);
            var column = input.attr('name');

            var form = input.parents('form');
            var method = form.attr('method');
            var action = form.attr('action');

        })
    }
}
) (jQuery);