$(function () {
    $('select[name="country_code"]').on('change', function () {
        generateCities();
    });


    function generateCities() {
        var citySelector = $('#city_id');
        citySelector.html('<option value="">SELECT</option>');
        Boilerplate.cities.forEach(function (city) {
            if( city.country_code == $('#country_code').val() ) {
                citySelector.append('<option value="' + city.id + '">' + city.name + '</option>');
            }
        });
        $('.selectpicker').selectpicker('refresh');

    }

    $('select[name="city_id"]').on('change', function () {
        generateAreas();
    });


    function generateAreas() {
        var areaSelector = $('#area_id');
        areaSelector.html('<option value="">SELECT</option>');
        Boilerplate.areas.forEach(function (area) {
            if( area.city_id == $('#city_id').val() ) {
                areaSelector.append('<option value="' + area.id + '">' + area.name + '</option>');
            }
        });
        $('.selectpicker').selectpicker('refresh');

    }

});
