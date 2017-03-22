<?php

namespace app\modules\ls_admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\ls_admin\controllers';


    public function init()
    {
        parent::init();

        $this->setLayoutPath('@app/modules/ls_admin/views/layouts');
        // custom initialization code goes here
    }
}
