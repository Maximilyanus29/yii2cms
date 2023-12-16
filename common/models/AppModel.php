<?php

namespace common\models;

use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\imagine\Image;
use yii\web\UploadedFile;

abstract class AppModel extends ActiveRecord
{
    const IMG_WIDTH = 1920;
    const IMG_HEIGHT = 1080;
    const IMG_NAME_DEFAULT = 'preview';

    public function uploadImage(UploadedFile $imagesContainer = NULL, string $imageName = self::IMG_NAME_DEFAULT, int $width = self::IMG_WIDTH, int $height = self::IMG_HEIGHT)
    {
        if (!empty($imagesContainer)) {

            $imageName = !empty($imageName) ? $imageName : self::IMG_NAME_DEFAULT;
            $width  = ($width > 0) ? $width : self::IMG_WIDTH;
            $height = !($height > 0) ? $height : self::IMG_HEIGHT;

            $this->removeImage($this->getImageByName($imageName));
            $path = $_SERVER['DOCUMENT_ROOT'] . '/files/images/store/' . $imagesContainer->baseName . '.' . $imagesContainer->extension;
            Image::resize($imagesContainer->tempName, $width, $height, true, false)->save($path);
            $this->attachImage($path, true, $imageName);
            @unlink($path);
        }
    }

    public static function generateSlug($name)
    {
        return Inflector::slug($name);
    }

    public static function getListForSelect($attributeName = "")
    {
        return !empty($attributeName) ? ArrayHelper::map(self::find()->all(), 'id', $attributeName) : [];
    }
}
