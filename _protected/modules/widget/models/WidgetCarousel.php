<?php

namespace widget\models;


use Yii;
use yii\db\ActiveRecord;
use widget\behaviors\CacheInvalidateBehavior;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property integer $id
 * @property string $key
 * @property integer $status
 *
 * @property WidgetCarouselItem[] $items
 */
class WidgetCarousel extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'cacheInvalidate' => [
                'class' => CacheInvalidateBehavior::className(),
                'cacheComponent' => 'cache',
                'keys' => [
                    function ($model) {
                        return [
                            self::className(),
                            $model->key
                        ];
                    }
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'unique'],
            [['status'], 'integer'],
            [['key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'status' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(WidgetCarouselItem::className(), ['carousel_id' => 'id']);
    }
}
