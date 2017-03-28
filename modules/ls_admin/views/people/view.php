<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\People */

$this->title = $model->name;

?>
<div class="people-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'address',
            'sex',
            'age'
        ],
    ]) ?>
<div id="map" style="width: 100%; height: 500px;"></div>

</div>
<?php
echo "<script> var lat=".$model->coordinate_x."; var lng=".$model->coordinate_y."; var id=".$model->id."; </script>"
?>

<script>

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: {lat: lat, lng: lng},
        });

                        var marker = new google.maps.Marker({
                            position: {lat: lat, lng: lng},
                            map: map
                        });


            // Add the circle for this city to the map.

            $.get('/api/radius_vykydiv_all', function (data) {

                if (data) {
                    console.log('data',data);
                    data.map(function(item){
                        console.log('item',item);
                        var cityCircle = new google.maps.Circle({
                            strokeWeight: 0,
                            fillColor: item[0].color,
                            fillOpacity: 0.15,
                            map: map,
                            center: {lat: parseFloat(item[0].lat), lng: parseFloat(item[0].lng)},
                            radius: item[0].radius
                        });
                        var cityCircle = new google.maps.Circle({
                            strokeWeight: 0,
                            fillColor: item[0].color,
                            fillOpacity: 0.15,
                            map: map,
                            center: {lat: parseFloat(item[0].lat), lng: parseFloat(item[0].lng)},
                            radius: item[0].radius_max
                        });
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(item[0].lat), lng: parseFloat(item[0].lng)},
                            map: map,
                            title: item[0].title
                        });
                        var infowindow = new google.maps.InfoWindow({
                            content: item[0].title
                        });
                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                    })
                
                }
            });
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeaq3M7TgfGIj6FLt9cGYKjMwi2tjWlN4&callback=initMap"></script>
