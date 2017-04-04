$( document ).ready(function() {
    $( "#sale_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

    $('#sales_form').validate({
        rules: {
            sale_date: {
                date: true,
                required: true
            },
            sale_price: {
                minlength: 1,
                maxlength: 10,
                required: true,
                number: true
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