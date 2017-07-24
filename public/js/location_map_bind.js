/**
 * Created by akram on 11/23/2016.
 */
$('input[type=radio][name=area_id]').change(function() {
    $area = $(this);
    var position = new google.maps.LatLng($area.data('lat'),$area.data('lng'));
    maps[0].map.panTo(position);
});