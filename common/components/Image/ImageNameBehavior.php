<?php

namespace common\components\Image;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use Yii;

class ImageNameBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveImageName',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveImageName',
        ];
    }

    public function saveImageName()
    {
        $res = false;

        if (Yii::$app->request->isPost && ($this->owner instanceof ActiveRecord)) {
            $res = $this->saveImageNamesForPost(Yii::$app->request->post());
        }

        return $res;
    }

    protected function saveImageNamesForPost($post)
    {
        if (!empty($post) && isset($post['ImageNames'])) {
            foreach ($post['ImageNames'] as $image_id => $image_text) {
                Image::updateAll(['text' => trim($image_text)], ['id' => (int)$image_id]);
            }
        }
        return true;
    }
}
