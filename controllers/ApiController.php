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
                $cont = Contamination::find()->where(['factory_id'=>$factory->id])->orderBy(['created_at'=>SORT_DESC])->one();

                $f= 1000*(($cont->v*$cont->v*$cont->d)/($cont->h*$cont->h*$cont->T));

                $v1 = 1.3*(($cont->d*$cont->v)/$cont->h);

                $corinj = ($v1*$cont->T)/$cont->h;

                $V_m = 0.65 * pow($corinj, 1/3);

                $d=1;

                $n = 1;

                if ($f< 100){
                    if ($V_m <= 0.5 ){
                        $d = 2.48*(1+0.28*pow($f,1/3));
                    } elseif (($V_m < 2) && ($V_m > 0.5)) {
                        $d = 4.95*$V_m*(1+0.28*pow($f,1/3));
                    } elseif ($V_m > 2){
                        $d = 3*pow($V_m,2)*(1+0.28*pow($f,1/3));
                    }
                }else{
                    if ($V_m <= 0.5 ){
                        $d = 5.7;
                    } elseif (($V_m < 2) && ($V_m > 0.5)) {
                        $d = 11.4*$V_m;
                    } elseif ($V_m >= 2){
                        $d = 16*pow($V_m,1/2);
                    }
                }


                if ($V_m < 0.5 ){
                    $n = 4.4*$V_m;
                } elseif (($V_m < 2) && ($V_m > 0.5)) {
                    $n = 0.532*$V_m*$V_m - 2.13*$V_m + 3.13;
                } elseif ($V_m > 2){
                    $n = 1;
                }


                $x = ((5-$this->F)/4)*$d*$cont->h;

                if ($f<100){
                    $m = 1/(0.65 + 0.1*pow($f ,1/2)+0.34*pow($f,1/3));
                } else {
                    $m = 1.47/pow($f,1/3);
                }


                $c = (180*1*$this->F*$this->M*$m*$n)/($cont->h*$cont->h*pow($v1*$cont->h,1/3));


                $color ='';
                if ($cont->C >= 100){
                    $color = 'red';
                } elseif (($cont->h>50)&&($cont->h < 100)){
                    $color = 'yellow';
                } elseif ($cont->C <= 50){
                    $color = 'green';
                }

                $rezult[]=[['radius'=>round($x, 2), 'radius_max'=>round($c, 2),'title'=>'Назва підприємства: '.$factory->name.';<br> Радіус викидів: ' . round($x, 2).'м','color'=>$color, 'lat'=>$factory->coordinate_x, 'lng'=>$factory->coordinate_y]];
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
            $cont = Contamination::find()->where(['factory_id'=>$id])->orderBy(['created_at'=>SORT_DESC])->one();

            $f= 1000*(($cont->v*$cont->v*$cont->d)/($cont->h*$cont->h*$cont->T));

            $v1 = 1.3*(($cont->d*$cont->v)/$cont->h);

            $corinj = ($v1*$cont->T)/$cont->h;

            $V_m = 0.65 * pow($corinj, 1/3);

            $d=1;

            $n = 1;

            if ($f< 100){
                if ($V_m <= 0.5 ){
                    $d = 2.48*(1+0.28*pow($f,1/3));
                } elseif (($V_m < 2) && ($V_m > 0.5)) {
                    $d = 4.95*$V_m*(1+0.28*pow($f,1/3));
                } elseif ($V_m > 2){
                    $d = 3*pow($V_m,2)*(1+0.28*pow($f,1/3));
                }
            }else{
                if ($V_m <= 0.5 ){
                    $d = 5.7;
                } elseif (($V_m < 2) && ($V_m > 0.5)) {
                    $d = 11.4*$V_m;
                } elseif ($V_m >= 2){
                    $d = 16*pow($V_m,1/2);
                }
            }


            if ($V_m < 0.5 ){
                $n = 4.4*$V_m;
            } elseif (($V_m < 2) && ($V_m > 0.5)) {
                $n = 0.532*$V_m*$V_m - 2.13*$V_m + 3.13;
            } elseif ($V_m > 2){
                $n = 1;
            }

            $x = ((5-$this->F)/4)*$d*$cont->h;

            if ($f<100){
                $m = 1/(0.65 + 0.1*pow($f ,1/2)+0.34*pow($f,1/3));
            } else {
                $m = 1.47/pow($f,1/3);
            }


            $c = (180*1*$this->F*$this->M*$m*$n)/($cont->h*$cont->h*pow($v1*$cont->h,1/3));

            $color ='';
            if ($cont->C >= 100){
                $color = 'red';
            } elseif (($cont->h>50)&&($cont->h < 100)){
                $color = 'yellow';
            } elseif ($cont->C <= 50){
                $color = 'green';
            }

            $rezult=[['radius'=>round($x, 2), 'radius_max'=>round($c, 2),'title'=>'Назва підприємства: '.$factory->name.';<br/> Радіус викидів: ' . round($x, 2).'м','color'=>$color, 'lat'=>$factory->coordinate_x, 'lng'=>$factory->coordinate_y]];

            return $rezult;
        } else
            return false;
    }

    public function actionHrafik_vykydiv($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $rezult = [];

        $mis = strtotime('January');

        $mas_m = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July ',
            'August',
            'September',
            'October' ,
            'November' ,
            'December',
        ];

        $mas_t = [];

        foreach ($mas_m as $m){
            $mas_t[]= strtotime($m);
        }

        $k = 0;
        foreach ($mas_t as $item){
            if ($k > 0){
                $rezult[]=$this->getR($id,$mas_t[$k-1],$item);
            } else {
                $rezult[]=$this->getR($id,0,$item);
            }
            $k++;
        }


        return $rezult;
    }

    function getR($id, $date_from, $date_to){

        $conts = Contamination::find()
            ->where(['factory_id'=>$id])
            ->andWhere(['<','created_at', $date_to])
            ->andWhere(['>','created_at', $date_from])
            ->all();

        if ($conts){

            $d_x=0;
            $k=0;
            foreach ($conts as $cont) {
                $k++;
                $f = 1000 * (($cont->v * $cont->v * $cont->d) / ($cont->h * $cont->h * $cont->T));

                $v1 = 1.3 * (($cont->d * $cont->v) / $cont->h);

                $corinj = ($v1 * $cont->T) / $cont->h;

                $V_m = 0.65 * pow($corinj, 1 / 3);

                $d = 1;

                $n = 1;

                if ($f < 100) {
                    if ($V_m <= 0.5) {
                        $d = 2.48 * (1 + 0.28 * pow($f, 1 / 3));
                    } elseif (($V_m < 2) && ($V_m > 0.5)) {
                        $d = 4.95 * $V_m * (1 + 0.28 * pow($f, 1 / 3));
                    } elseif ($V_m > 2) {
                        $d = 3 * pow($V_m, 2) * (1 + 0.28 * pow($f, 1 / 3));
                    }
                } else {
                    if ($V_m <= 0.5) {
                        $d = 5.7;
                    } elseif (($V_m < 2) && ($V_m > 0.5)) {
                        $d = 11.4 * $V_m;
                    } elseif ($V_m >= 2) {
                        $d = 16 * pow($V_m, 1 / 2);
                    }
                }


                if ($V_m < 0.5) {
                    $n = 4.4 * $V_m;
                } elseif (($V_m < 2) && ($V_m > 0.5)) {
                    $n = 0.532 * $V_m * $V_m - 2.13 * $V_m + 3.13;
                } elseif ($V_m > 2) {
                    $n = 1;
                }

                $x = ((5 - $this->F) / 4) * $d * $cont->h;

                if ($f < 100) {
                    $m = 1 / (0.65 + 0.1 * pow($f, 1 / 2) + 0.34 * pow($f, 1 / 3));
                } else {
                    $m = 1.47 / pow($f, 1 / 3);
                }


                $c = (180 * 1 * $this->F * $this->M * $m * $n) / ($cont->h * $cont->h * pow($v1 * $cont->h, 1 / 3));

                $color = '';
                if ($cont->C >= 100) {
                    $color = 'red';
                } elseif (($cont->h > 50) && ($cont->h < 100)) {
                    $color = 'yellow';
                } elseif ($cont->C <= 50) {
                    $color = 'green';
                }
                $d_x+=$x;
            }
            return round($d_x/$k);

        } else {
            return null;
        }

    }

}