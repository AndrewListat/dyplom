<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "factory".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $address
 * @property string $coordinate_x
 * @property string $coordinate_y
 * @property integer $created_at
 * @property integer $updated_at
 */
class Factory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'coordinate_x', 'coordinate_y'], 'string', 'max' => 255],
            ['coordinate_x', 'required', 'message' => 'Поставте маркер на карті'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва підприемства',
            'user_id' => 'User ID',
            'address' => 'Адреса',
            'coordinate_x' => 'Coordinate X',
            'coordinate_y' => 'Coordinate Y',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата редагування',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public function getCont()
    {
        return $this->hasOne(Contamination::className(), ['factory_id' => 'id']);
    }


}
