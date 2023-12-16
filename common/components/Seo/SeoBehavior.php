<?php

namespace common\components\Seo;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use Yii;

class SeoBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveSeo',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveSeo',
        ];
    }

    public function getSeo()
    {
        $owner = $this->owner;

        if ($owner instanceof ActiveRecord) {
            $seo = $this->findModelSeo();
        } else if ($owner instanceof \yii\base\Controller) {
            $seo = $this->findIndexPageSeo();
        }
        if (is_null($seo)) {
            $seo = new Seo();
        }

        return $seo;
    }

    public function saveSeo()
    {
        $res = false;

        if (Yii::$app->request->isPost && ($this->owner instanceof ActiveRecord)) {
            $res = $this->saveSeoModel(Yii::$app->request->post());
        }

        return $res;
    }

    public function saveSeoIndexPage()
    {
        $res = false;

        if (Yii::$app->request->isPost) {
            $res = $this->saveSeoIndexPageModel(Yii::$app->request->post());
        }

        return $res;
    }

    protected function saveSeoIndexPageModel()
    {
        $owner = $this->owner;
        $seo = $this->findIndexPageSeo();

        if (is_null($seo)) {
            $seo = new Seo();
        }

        try {

            $seo->load(Yii::$app->request->post());
            $seo->entity_name = $this->getShortClassName($owner);
            $seo->entity_id = 0;

            return $seo->save();
        } catch (\Exception $ex) {

            $results[] = [
                [
                    'text' => '<b>Ошибка: ' . $ex->getMessage() . (YII_DEBUG ? '</b><br>' .
                        'Информация для отладки: ' . $ex->getTraceAsString() : ''), 'type' => 'error'
                ]
            ];
        }
    }

    protected function saveSeoModel($post)
    {
        $owner = $this->owner;
        $seo = $this->findModelSeo();

        if (is_null($seo)) {
            $seo = new Seo();
        }

        try {
            $seo->load($post);

            if ($seo->isNewRecord) {
                $seo->entity_name = $this->getShortClassName($owner);
                $seo->entity_id = $owner->primaryKey;
            }
        } catch (\Exception $ex) {

            $results[] = [
                [
                    'text' => '<b>Ошибка: ' . $ex->getMessage() . (YII_DEBUG ? '</b><br>' .
                        'Информация для отладки: ' . $ex->getTraceAsString() : ''), 'type' => 'error'
                ]
            ];

            return $results;
        }


        return $seo->save();
    }

    protected function getShortClassName($object)
    {
        $fullName = get_class($object);
        $pattern = "/\w+$/";
        preg_match($pattern, $fullName, $matches);

        return $matches[0];
    }

    protected function findIndexPageSeo()
    {
        return $this->findSeo(0, $this->getShortClassName($this->owner));
    }

    protected function findModelSeo()
    {
        return $this->findSeo($this->owner->primaryKey, $this->getShortClassName($this->owner));
    }

    protected function findSeo($entityId, $entityName)
    {
        return Seo::findOne([
            'entity_id' => $entityId,
            'entity_name' => $entityName
        ]);
    }
}
