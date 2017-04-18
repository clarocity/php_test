$(document).ready(function () {

    var urlParams = new URLSearchParams(window.location.search);

    $('#search-input').val(urlParams.get('searchInput'));

    switch(urlParams.get('priceRange')) {
        case 'inexpensive':
            $('#btn--inexpensive').addClass('active');
            break;
        case 'moderate':
            $('#btn--moderate').addClass('active');
            break;
        case 'pricey':
            $('#btn--pricey').addClass('active');
    }

    if (!!urlParams.get('year')){
        $('#btn--year').addClass('active');
    }

});