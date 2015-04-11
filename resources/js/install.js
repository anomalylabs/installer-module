var install = function () {

    var step = $('body').find('[data-step]').first();
    var progress = $('.progress-bar');

    $('#label').text(step.data('step') + '...');

    $.ajax({
        url: step.data('action'),
        success: function () {

            step.remove();

            if ($('body').find('[data-step]').length) {

                progress.width(step.data('progress') + '%');

                install();
            } else {

                progress.width('100%');

                $('#label').text('Ready.');

                setTimeout(function () {
                    $('#finished').removeClass('hidden');
                }, 1000);
            }
        },
        error: function () {
            progress.addClass('error').find('.label').text('Error');
        }
    });
};

$(document).ready(function () {
    install();
});
