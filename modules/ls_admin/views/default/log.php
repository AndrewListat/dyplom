<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->registerCssFile('/template_admin/assets/css/main');
?>
<div style="width: 100%">
    <div class="login-body">
        <article class="container-login center-block">
            <?php if ($masseg){?>
                <div class="alert alert-danger alert-dismissible" role="alert">
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
                        <h2><i class="glyphicon glyphicon-log-in"></i> Вхід</h2>
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                        ]) ?>
                        <div class="form-group ">
                            <label for="login" class="sr-only">Логін</label>
                            <input type="email" class="form-control" name="email" id="email_value"
                                   placeholder="Email" tabindex="1" value="" required/>
                        </div>
                        <div class="form-group ">
                            <label for="password" class="sr-only">Пароль</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Пароль" value="" tabindex="2" required />
                        </div>
                        <div class="checkbox">
                            <label class="control-label" for="remember_me">
                                <input type="checkbox" name="rememberMe" id="remember_me" class="" value="1" tabindex="3"/> Запамятати
                            </label>
                        </div>
                        <br/>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-lg btn-primary">Вхід</button>
                            <a href="signup" class="btn btn-lg btn-primary">Реєстрація</a>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </section>

        </article>
    </div>
</div>


