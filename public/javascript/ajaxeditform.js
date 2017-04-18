$(document).ready(function () {
    $('#edit-form').toggle(false);
    $('.message--delete').toggle(false);
    $('#edit-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
                type: 'POST',
                url: $('property.php').attr('action'),
                data: $(this).serialize()
            })
            .done(function (data) {
                $('.message--form').html(data);
            })

    });

    $('#edit-button').click(function (event) {
        event.preventDefault();
        $('#edit-form').toggle();
    });

    $('#delete-button').click(function (event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete from the database?')) {
            $.ajax({
                type: 'DELETE',
                url: $('property.php').attr('action')
            })
            .done(function (data) {
                $('.message--delete').html(data);
                $('.message--delete').toggle(true);
            })
        }
    });

    $('.close').click(function (event) {
        event.preventDefault();
        $('#edit-form').toggle();
    });


});