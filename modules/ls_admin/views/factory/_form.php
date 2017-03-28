<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Factory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($contamination, 'h'); ?>
    <?= $form->field($contamination, 'd'); ?>
    <?= $form->field($contamination, 'T'); ?>
    <?= $form->field($contamination, 'v'); ?>
    <?= $form->field($contamination, 'C'); ?>

    <?= $form->field($model, 'coordinate_x')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'coordinate_y')->hiddenInput()->label(false) ?>

    <?php
    echo \kartik\date\DatePicker::widget([
        'name'  => 'from_date',
        'value' => date('d.m.Y'),
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]);
    ?>


    <?= $form->field($model, 'address')->textInput(['style'=>"width: 80%; margin-top: 7px",'maxlength' => true, 'id'=>"pac-input", "placeholder"=>"Адреса підприемства"])->label(false) ?>
    <div class="box">
<!--        <input id="pac-input" class="controls" type="text" placeholder="Search Box">-->
        <div id="map" style="width: 100%; height: 500px"></div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавити' : 'Обновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!--
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxITw-3tjkxe83DdkWe6NfhUnYpGDegx4&libraries=places&callback=initMap" async defer></script>-->

<?php
    echo $model->isNewRecord ?  "<script> var isCreate = true; var lat=49.3580116; var lng=23.512319299999945; </script>" : "<script> var isCreate = false; var lat=".$model->coordinate_x."; var lng=".$model->coordinate_y."; </script>"
?>

<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    function initAutocomplete() {
        var markers = [];

        if(isCreate){
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat, lng: lng},
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        } else {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat, lng: lng},
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var markerT = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map
//                title: 'Hello World!'
            });
            markers.push(markerT);
        }

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var click_marker = null;
        google.maps.event.addListener(map, 'click', function(event) {
//            click_marker.setMap(null);
            if (click_marker)
                click_marker.setMap(null);
            console.log('click_marker',click_marker)
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            console.log('location', location)
            $("#factory-coordinate_x").val(location.lat());
            $("#factory-coordinate_y").val(location.lng());
            click_marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers=[];
            markers.push(click_marker);
        }

        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

//            $("#factory-coordinate_x").val(places[0].geometry.location.lat());
//            $("#factory-coordinate_y").val(places[0].geometry.location.lng());

            markerT = null;
            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        // [END region_getplaces]
    }


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeaq3M7TgfGIj6FLt9cGYKjMwi2tjWlN4&libraries=places&callback=initAutocomplete"
        async defer></script>