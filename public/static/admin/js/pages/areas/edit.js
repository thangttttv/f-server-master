$(function () {
    $('select[name="country_code"]').on('change', function () {
        generateCities();
    });


    function generateCities() {
        var citySelector = $('#city_id');
        citySelector.html('<option value="">--</option>');
        Boilerplate.cities.forEach(function (city) {
            if( city.country_code == $('#country_code').val() ) {
                citySelector.append('<option value="' + city.id + '">' + city.name + '</option>');
            }
        });
        $('.selectpicker').selectpicker('refresh');

    }

});
