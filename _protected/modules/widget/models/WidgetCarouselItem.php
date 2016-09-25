<?php

namespace widget\models;

use widget\behaviors\CacheInvalidateBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "widget_carousel_item".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $base_url
 * @property string $path
 * @property string $type
 * @property string $image
 * @property string $imageUrl
 * @property string $url
 * @property string $caption
 * @property integer $status
 * @property integer $order
 *
 * @property WidgetCarousel $carousel
 */
class WidgetCarouselItem extends ActiveRecord
{

    /**
     * @var array|null
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel_item}}';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $key = array_search('carousel_id', $scenarios[self::SCENARIO_DEFAULT], true);
        $scenarios[self::SCENARIO_DEFAULT][$key] = '!carousel_id';
        return $scenarios;
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type'
            ],
            'cacheInvalidate' => [
                'class' => CacheInvalidateBehavior::className(),
                'cacheComponent' => 'cache',
                'keys' => [
                    function ($model) {
                        return [
                            WidgetCarousel::className(),
                            $model->carousel->key
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
            [['carousel_id'], 'required'],
            [['carousel_id', 'status', 'order'], 'integer'],
            [['url', 'caption', 'base_url', 'path'], 'string', 'max' => 1024],
            [['type'], 'string', 'max' => 255],
            ['image', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'carousel_id' => Yii::t('app', 'Carousel ID'),
            'image' => Yii::t('app', 'Image'),
            'base_url' => Yii::t('app', 'Base URL'),
            'path' => Yii::t('app', 'Path'),
            'type' => Yii::t('app', 'File Type'),
            'url' => Yii::t('app', 'Url'),
            'caption' => Yii::t('app', 'Caption'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(WidgetCarousel::className(), ['id' => 'carousel_id']);
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return rtrim($this->base_url, '/') . '/' . ltrim($this->path, '/');
    }
}
