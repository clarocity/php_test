$(document).ready(function () {

    $('#add-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $('index.php').attr('action'),
            data: $(this).serialize()
        })
        .done(function( data ) {
            $('.message--form').html(data);
        });
    });

    $('#add-button').click(function (event) {
        event.preventDefault();
        $('#add-form').toggle();
    });

    $('.close').click(function (event) {
        event.preventDefault();
        $('#add-form').toggle();
    });


});