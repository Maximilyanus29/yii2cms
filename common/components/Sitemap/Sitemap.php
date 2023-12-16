<?php

namespace common\components\Sitemap;

use Yii;
use yii\base\Component;
use common\models\Page;

class Sitemap extends Component
{
    private $factory;

    public function init()
    {
        $this->factory = new SiteMapFactory(Yii::getAlias('@app/../sitemap.xml'));
    }

    /**
     * Создаёт абсолютный url к сущности в БД
     */
    protected function createUrlToEntity(\yii\db\ActiveRecord $record, $route, $timeFlag = false, $priority = null)
    {
        $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl($route);

        $timeUpd =  $timeFlag ? date(\DateTime::W3C, $record->updated_at) : null;
        $item = $this->generateItem($url, $priority, $timeUpd);

        return $item;
    }

    /**
     * Создаёт url страницы 
     */
    protected function createUrlTo($route, $priority = null)
    {
        $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl($route);
        $item = $this->generateItem($url, $priority, null);

        return $item;
    }

    /**
     * Создаёт xml тег
     * 
     * @return DOM
     */
    protected function generateItem($absoluteUrl, $priority = null, $time = null)
    {
        $loc = $this->factory->createLoc($absoluteUrl);
        $url = $this->factory->createUrl($loc);

        if (!is_null($priority)) {
            $url->appendChild($this->factory->createPriority($priority));
        }
        if (!is_null($time)) {
            $url->appendChild($this->factory->createLastmod($time));
        }

        return $url;
    }

    /**
     * Sitemap-генератор
     */
    public function generate()
    {
        ini_set("memory_limit", "1G");

        $main_page_route = ['site/index'];
        $indexUrl = $this->createUrlTo($main_page_route, '1.0');
        $this->factory->append($indexUrl);

        $pages = Page::findWhereFront()->all();
        foreach ($pages as $page) {
            $urlPage = $this->createUrlToEntity($page, $page->link, true, 0.9);
            $this->factory->append($urlPage);
        }
        
        $this->factory->save();
    }
}
