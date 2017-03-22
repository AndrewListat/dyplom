<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $desc
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_key
 * @property integer $created_at
 * @property integer $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc', 'seo_desc'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'url', 'seo_title', 'seo_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название страницы',
            'url' => 'url',
            'desc' => 'Cодержание',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Desc',
            'seo_key' => 'Seo Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'slug' => [
                'class' => 'app\commands\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'url',
                'translit' => true
            ]
        ];
    }
}
