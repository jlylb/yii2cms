<?php

namespace backend\modules\survey\models;

use Yii;

/**
 * This is the model class for table "soptions_item".
 *
 * @property string $id
 * @property string $title
 * @property integer $option_id
 * @property integer $num
 */
class SoptionsItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soptions_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['option_id', 'num'], 'integer'],
            [['title'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '选项标题',
            'option_id' => 'Option ID',
            'num' => 'Num',
        ];
    }

    /**
     * @inheritdoc
     * @return SoptionsItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SoptionsItemQuery(get_called_class());
    }
}
