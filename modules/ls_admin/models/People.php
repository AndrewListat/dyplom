<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "people".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $user_id
 * @property string $sex
 * @property string $age
 * @property string $coordinate_y
 * @property string $coordinate_x
 * @property integer $created_at
 * @property integer $updated_at
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'age'], 'integer'],
            [['name', 'address', 'sex', 'coordinate_y','coordinate_x'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'П.І.П',
            'address' => 'Адреса',
            'user_id' => 'User ID',
            'sex' => 'Стать',
            'age' => 'Вік',
            'coordinate_y' => 'Coordinate Y',
            'coordinate_x' => 'Coordinate X',
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

}
