<?php
namespace  app\helpers;

use app\models\Apple;
use app\models\Color;
use yii\base\Request;
use yii\helpers\ArrayHelper;

class AppleHelper
{
    /**
     * @return false|mixed
     */
    public static function getRandomExistingColor()
    {
        $colorIds = Color::find()->select('color_id')->column();
        if (!empty($colorIds)) {
            return $colorIds[rand(0, (count($colorIds) - 1))];
        }
        return false;
    }

    /**
     * @param array<int, int> $idEatenArray
     * @return string
     */
    public static function makeSqlForGroupAppleUpdate(array $idEatenArray)
    {
        $whenThenPart = '';
        foreach ($idEatenArray as $key => $value) {
            if ($value > 0) {
                $whenThenPart .= ' WHEN id=' . (int)$key . ' THEN ' . (int)$value;
            }
        }
        $sql = 'UPDATE `apples` SET eaten=(CASE'. $whenThenPart . ' END) WHERE id IN ( ' . implode(',', array_keys($idEatenArray)) . ' )';
        return $sql;
    }

    /**
     * @return void
     */
    public static function deleteFullyEatenApples()
    {
        Apple::updateAll(['deleted_at' => time()], ['and' , ['eaten'=> 100], ['deleted_at' => null]]);
    }

    /**
     * @param array $appleArray
     * @return void
     */
    public static function changeStatusToFallen(array $appleArray)
    {
        $applesArray = ArrayHelper::getValue($appleArray, "eaten");

        if($applesArray) {
            $onlyOnTheTreeArray = array_filter($applesArray, fn($eaten) => $eaten === '');


            Apple::updateAll(
                ['status' => Apple::FALLEN_STATUS, 'fallen_at' => time()],
                ['and' , [ 'in', 'id' , array_keys($onlyOnTheTreeArray)], ['!=', 'status', Apple::FALLEN_STATUS]]);
        }
    }
}