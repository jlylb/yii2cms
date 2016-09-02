<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/9/2
 * Time: 11:45
 */
namespace common\widgets\KEditor;

use yii;

Trait EditorTrait{

    public static function getUploadPath() {

        $path=Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.'data';

        if (isset(Yii::$app->params->uploadPath)) {
            $path=$path.DIRECTORY_SEPARATOR.Yii::$app->params->uploadPath;
        }
        return $path;
    }

    public static function getUploadUrl() {
        $host=Yii::$app->request->getUserHost();
        $path=$host?"":"http://localhost".Yii::getAlias('@web').'/data';

        if (isset(Yii::$app->params->uploadPath)) {
            $path=$path.Yii::$app->params->uploadPath;
        }
        return $path;
    }

}