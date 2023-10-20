<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%colors}}".
 *
 * @property int $color_id
 * @property string|null $name
 *
 * @property Apple[] $apples
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%colors}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'color_id' => 'Color ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Apple]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApples()
    {
        return $this->hasMany(Apple::class, ['color_id' => 'color_id']);
    }
}
