<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Factory */

$this->title = $model->name;
?>
<div class="factory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити підприемство?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="box box-success">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Зона викидів </a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Опис</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Мониторинг викидів</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">

                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            'address',
                            'cont.h',
                            'cont.d',
                            'cont.T',
                            'cont.v',
                            'created_at:date',
                            'updated_at:date',
                        ],
                    ]) ?>

                </div>
                <div role="tabpanel" class="tab-pane" id="messages">...</div>
            </div>

        </div>
    </div>


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




            // Add the circle for this city to the map.

            $.post('/api/radius_vykydiv?id='+id, function (data) {
                if (data) {
                    console.log(data)
                    var cityCircle = new google.maps.Circle({
                        strokeWeight: 0,
                        fillColor: '#FF0000',
                        fillOpacity: 0.15,
                        map: map,
                        center: {lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lng)},
                        radius: data[0].radius
                    });
                    var cityCircle = new google.maps.Circle({
                        strokeWeight: 0,
                        fillColor: '#FF0000',
                        fillOpacity: 0.15,
                        map: map,
                        center: {lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lng)},
                        radius: data[0].radius_max
                    });
                    var marker = new google.maps.Marker({
                        position: {lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lng)},
                        map: map,
                        title: data[0].title
                    });
                }
            });
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeaq3M7TgfGIj6FLt9cGYKjMwi2tjWlN4&callback=initMap"></script>
