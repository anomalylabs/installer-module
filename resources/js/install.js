var process = function () {

    var step = $('body').find('[data-step]').first();
    var progress = $('#progress');

    progress.find('.label').text(step.data('label') + '...');

    $.ajax({
        url: step.data('action'),
        success: function () {

            step.remove();

            if ($('body').find('[data-step]').length) {

                progress.progress('increment', progress.data('precision'));

                process();
            } else {

                progress.progress({
                    percent: 100
                }).find('.label').text('Ready.');

                setTimeout(function () {
                    progress.fadeOut(200);
                    $('#button').removeClass('hidden').addClass('animated-slow fadeInUpBig');
                }, 1000);
            }
        },
        error: function () {
            progress.addClass('error').find('.label').text('Error');
        }
    });
};

$(document).ready(function () {
    process();
});
