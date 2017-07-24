/**
 * Created by akram on 9/29/2016.
 *
 * todo
 * -CHANGE HIDDEN INPUT VAULUES ACCORDING TO CLICK EVENT
 * -make three labels with values to inform the user about his selection
 * -hover event is only for changing map values
 *
 */
$(document).ready(function () {
    $(".dropdown").on("hide.bs.dropdown", function (evt) {
        evt.stopPropagation();
        return false;
    });
    $(".dropdown").on("show.bs.dropdown", function () {
        $(".btn").html(' <span class="caret caret-up"></span> الموقع ');
    });

    $.each($('.area-list').children('a').not('.divider'), function (i, v) {

        $(this).on('click', function (evt) {
            var $area = $('#area_id');
            window['info_area_' + $area.val()] && (function () {
                window['info_area_' + $area.val()].close();
                //$('#city_id').val("");
                //$('#district_id').val("");
            })();
            maps[0].map.setCenter(window['infoMarker_area_' + $(this).attr('data-id')].position);
            window['info_area_' + $(this).attr('data-id')].open(maps[0].map, window['infoMarker_area_' + $(this).attr('data-id')]);
            $area.val($(this).attr('data-id'));
        });
        $(this).on('mouseout', function (evt) {

        });
    });

    $.each($('.city-list').children('a').not('.divider'), function (i, v) {
        $(this).on('click', function (evt) {
            var $city = $('#city_id');

            window['info_city_' + $city.val()] && (function () {
                window['info_city_' + $city.val()].close();
               // $('#district_id').val("");
            })();
            maps[0].map.setCenter(window['infoMarker_city_' + $(this).attr('data-id')].position);
            window['info_city_' + $(this).attr('data-id')].open(maps[0].map, window['infoMarker_city_' + $(this).attr('data-id')]);
            $city.val($(this).attr('data-id'));

        });
        $(this).on('mouseout', function (evt) {

        });
    });

    $.each($('.district-list').children('a').not('.divider'), function (i, v) {
        $(this).on('click', function (evt) {
            var $district = $('#district_id');

            window['info_district_' + $district.val()] && window['info_district_' + $district.val()].close();
            maps[0].map.setCenter(window['infoMarker_district_' + $(this).attr('data-id')].position);
            window['info_district_' + $(this).attr('data-id')].open(maps[0].map, window['infoMarker_district_' + $(this).attr('data-id')]);
            $district.val($(this).attr('data-id'));

        });
        $(this).on('mouseout', function (evt) {
            //         window['info_district_' + $(this).attr('data-id')].close();
        });
        $(this).on('click', function (evt) {
            $district.val($(this).attr('data-id'));
            //         window['info_district_' + $(this).attr('data-id')].close();
        });


    });
});