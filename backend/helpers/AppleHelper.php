<?php
namespace  app\helpers;

use app\models\Color;

class AppleHelper
{
    public static function getRandomExistingColor()
    {
        $colorIds = Color::find()->select('color_id')->column();
        if (!empty($colorIds)) {
            return $colorIds[rand(0, (count($colorIds) - 1))];
        }
        return false;
    }
}