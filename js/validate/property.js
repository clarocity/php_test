$( document ).ready(function() {
    $('form').validate({
        rules: {
            address: {
                minlength: 10,
                maxlength: 50,
                required: true
            },
            city: {
                minlength: 5,
                maxlength: 15,
                required: true
            },
            state: {
                SelectName: { valueNotEquals: "Select Sate" },
                required: true
            },
            zip: {
                minlength: 5,
                maxlength: 5,
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
    });
});