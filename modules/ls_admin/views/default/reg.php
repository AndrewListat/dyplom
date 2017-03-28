<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/template_admin/assets/css/main.css');
?>

<div class="login-body">
    <article class="container-login center-block">
        <?php if ($masseg){?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <strong>Error!</strong> <?php
                foreach ($masseg as $masseg1) {

                    echo $masseg1['0'].'</br>';
                }
                ?>
            </div>
        <?php }?>
        <section>
            <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                <div id="login-access" class="tab-pane fade active in">
                    <h2><i class="glyphicon glyphicon-log-in"></i> Sign Up</h2>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-horizontal'],
                    ]) ?>
                    <div class="form-group ">
                        <label for="login" class="sr-only">Логін</label>
                        <input type="text" class="form-control" name="username" id="login_value"
                               placeholder="Імя" tabindex="1" value="" required/>
                    </div>
                    <div class="form-group ">
                        <label for="login" class="sr-only">Логін</label>
                        <input type="text" class="form-control" name="lastname" id="last_value"
                               placeholder="Прізвище" tabindex="1" value="" required/>
                    </div>
                    <div class="form-group ">
                        <label for="login" class="sr-only">Email</label>
                        <input type="email" class="form-control" name="email" id="login_value"
                               placeholder="Email" tabindex="1" value="" required/>
                    </div>
                    <div class="form-group ">
                        <label for="password" class="sr-only">Пароль</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Пароль" value="" tabindex="2" required />
                    </div>
                    <br/>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-lg btn-primary">Реєстрація</button>
                        <a href="signin" class="btn btn-lg btn-primary">Вхід</a>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </section>

    </article>
</div>

