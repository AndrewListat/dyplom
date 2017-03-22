<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 19.03.2017
 * Time: 18:49
 */

namespace app\controllers;

use Yii;
use app\modules\ls_admin\models\Contamination;
use app\modules\ls_admin\models\Factory;
use yii\web\Controller;

class ApiController extends Controller
{
    public $F = 1;
    public $M = 100;

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionRadius_vykydiv_all(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $rezult = [];
        $factorys = Factory::find()->where(['user_id'=>Yii::$app->user->id])->all();
        if ($factorys){
            foreach($factorys as $factory){
                $cont = Contamination::find()->where(['factory_id'=>$factory->id])->orderBy(['id'=>SORT_DESC])->one();

                $f= 1000*(($cont->v*$cont->v*$cont->d)/($cont->h*$cont->h*$cont->T));

                $v1 = 1.3*(($cont->d*$cont->v)/$cont->h);

                $corinj = ($v1*$cont->T)/$cont->h;

                $V_m = 0.65 * pow($corinj, 1/3);

                $d=1;

                $n = 1;

                if ($V_m < 5 ){
                    $d = 2.48*(1+0.28*pow($f,1/3));
                    $n = 4.4*$V_m;
                } elseif (($V_m < 2) && ($V_m > 0.5)) {
                    $d = 4.95*$V_m*(1+0.28*pow($f,1/3));
                    $n = 0.532*$V_m*$V_m - 2.13*$V_m + 3.13;
                } elseif ($V_m > 2){
                    $d = 3*pow($V_m,2)*(1+0.28*pow($f,1/3));
                    $n = 1;
                }

                $x = ((5-$this->F)/4)*$d*$cont->h;

                if ($f<100){
                    $m = 1/(0.65 + 0.1*pow($f ,1/2)+0.34*pow($f,1/3));
                } else {
                    $m = 1.47/pow($f,1/3);
                }


                $c = (180*1*$this->F*$this->M*$m*$n)/($cont->h*$cont->h*pow($v1*$cont->h,1/3));

                $rezult[]=['radius'=>$x, 'radius_max'=>$c,'title'=>'Назва: '.$factory->name.'; Радіус викидів: ' . $x, 'lat'=>$factory->coordinate_x, 'lng'=>$factory->coordinate_y];
            }
            return $rezult;
        } else
            return false;
    }

    public function actionRadius_vykydiv($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $rezult = [];
        $factory = Factory::findOne($id);
        if ($factory){
            $cont = Contamination::find()->where(['factory_id'=>$id])->orderBy(['id'=>SORT_DESC])->one();

            $f= 1000*(($cont->v*$cont->v*$cont->d)/($cont->h*$cont->h*$cont->T));

            $v1 = 1.3*(($cont->d*$cont->v)/$cont->h);

            $corinj = ($v1*$cont->T)/$cont->h;

            $V_m = 0.65 * pow($corinj, 1/3);

            $d=1;

            $n = 1;

            if ($V_m < 5 ){
                $d = 2.48*(1+0.28*pow($f,1/3));
                $n = 4.4*$V_m;
            } elseif (($V_m < 2) && ($V_m > 0.5)) {
                $d = 4.95*$V_m*(1+0.28*pow($f,1/3));
                $n = 0.532*$V_m*$V_m - 2.13*$V_m + 3.13;
            } elseif ($V_m > 2){
                $d = 3*pow($V_m,2)*(1+0.28*pow($f,1/3));
                $n = 1;
            }

            $x = ((5-$this->F)/4)*$d*$cont->h;

            if ($f<100){
                $m = 1/(0.65 + 0.1*pow($f ,1/2)+0.34*pow($f,1/3));
            } else {
                $m = 1.47/pow($f,1/3);
            }


            $c = (180*1*$this->F*$this->M*$m*$n)/($cont->h*$cont->h*pow($v1*$cont->h,1/3));

            $rezult=[['radius'=>$x, 'radius_max'=>$c,'title'=>'Назва: '.$factory->name.'; Радіус викидів: ' . $x, 'lat'=>$factory->coordinate_x, 'lng'=>$factory->coordinate_y]];

            return $rezult;
        } else
            return false;
    }

}