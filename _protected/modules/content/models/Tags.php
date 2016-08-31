<?php

namespace content\models;

use Yii;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $frequency
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增编号'),
            'name' => Yii::t('app', '标签名'),
            'frequency' => Yii::t('app', '文章统计数量'),
        ];
    }

    /**
     * @inheritdoc
     * @return TagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsQuery(get_called_class());
    }
}
