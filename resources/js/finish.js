var install = function () {

    var step = $('body').find('[data-step]').first();
    var progress = $('.progress');
    var label = $('#label');

    label.text(step.data('step'));

    $.ajax({
        url: step.data('action'),
        success: function () {

            step.remove();

            if ($('body').find('[data-step]').length) {

                progress.attr('value', step.data('progress'));

                install();
            } else {

                progress.attr('value', '100');
                progress.addClass('progress-success');

                label.text('Ready.');

                setTimeout(function () {
                    $('.finished').removeClass('hidden');
                }, 1000);
            }
        },
        error: function () {
            progress.addClass('progress-danger');
            label.addClass('text-danger').text('There was an error. Please check your error logs.');
        }
    });
};

$(document).ready(function () {
    install();
});
