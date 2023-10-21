<?php

namespace app\models;

use app\helpers\AppleHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%apples}}".
 *
 * @property int $id
 * @property int $color_id
 * @property int $created_at
 * @property int|null $fallen_at
 * @property int $status
 * @property int|null $eaten
 * @property int|null $deleted_at
 *
 * @property Color $color
 */
class Apple extends \yii\db\ActiveRecord
{
    const ON_THE_TREE_STATUS = 0;
    const FALLEN_STATUS = 1;
    const SPOILED = 2;

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = time();
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apples}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_id'], 'required'],
            [['color_id', 'status'], 'integer'],
            [['created_at', 'fallen_at', 'deleted_at'], 'safe'],
            [['eaten'], 'number', 'min' => 0, 'max' => 100],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::class, 'targetAttribute' => ['color_id' => 'color_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color_id' => 'Color ID',
            'created_at' => 'Created At',
            'fallen_at' => 'Fallen At',
            'status' => 'Status',
            'eaten' => 'Eaten',
            'condition' => 'Condition',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::class, ['color_id' => 'color_id']);
    }

    /**
     * @return bool
     */
    public function createApple()
    {
        $colorId = AppleHelper::getRandomExistingColor();
        if($colorId) {
            $this->color_id = $colorId ;
            return true;
        }
        return false;

    }
}
