<?php

namespace upload\models;

use Yii;

/**
 * This is the model class for table "{{%attachment}}".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $entity_model
 * @property string $path
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $order
 * @property integer $created_at
 */
class Attachment extends \yii\db\ActiveRecord
{
        public function behaviors() {
        return [
            'timeAttr'=>[
               'class' => 'yii\behaviors\TimestampBehavior',
               'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'created_at',
               ]
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_model', 'path', 'base_url'], 'required'],
            [['entity_id', 'size', 'order', 'created_at'], 'integer'],
            [['entity_model', 'path', 'type', 'name','base_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'entity_model' => Yii::t('app', 'Entity Model'),
            'path' => Yii::t('app', 'Path'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'name' => Yii::t('app', 'Name'),
            'order' => Yii::t('app', 'Order'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return AttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttachmentQuery(get_called_class());
    }
}
