<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contamination".
 *
 * @property integer $id
 * @property double $h
 * @property double $d
 * @property double $T
 * @property double $v
 * @property integer $factory_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Contamination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contamination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['h', 'd', 'T', 'v'], 'number'],
            [['factory_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'h' => 'Висота труби',
            'd' => 'Діаметер труби',
            'T' => 'Температура',
            'v' => 'Швидкість виходу викидів',
            'factory_id' => 'Factory ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
}
