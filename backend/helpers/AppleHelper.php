<?php
namespace  app\helpers;

use app\models\Color;

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
            $whenThenPart .= ' WHEN id=' . (int)$key . ' THEN ' . (int)$value;
        }
        $sql = 'UPDATE `apples` SET eaten=(CASE'. $whenThenPart . ' END) WHERE id IN ( ' . implode(',', array_keys($idEatenArray)) . ' )';
        return $sql;
    }
}