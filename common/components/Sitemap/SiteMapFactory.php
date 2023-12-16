<?php

namespace common\components\Sitemap;

/**
 * Фабрика sitemap файла.
 * 
 * @property DOMDocument $dom
 * @property DOMElement $root
 * @property string $savePath
 */

class SiteMapFactory
{
    private $dom;
    private $root;
    private $savePath;

    public function __construct(string $savePath)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');

        $root = $dom->createElement('urlset');
        $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $this->dom = $dom;
        $this->root = $root;
        $this->savePath = $savePath;

        $dom->appendChild($root);
    }

    /**
     * Создаёт тег loc
     */
    public function createLoc(string $absoluteUrl): \DOMElement
    {
        $tag = $this->dom->createElement('loc', $absoluteUrl);

        return $tag;
    }

    /**
     * Создаёт тег prioritity
     */
    public function createPriority(string $priority): \DOMElement
    {
        $tag = $this->dom->createElement('priority', $priority);

        return $tag;
    }

    /**
     * Создаёт тег lastmod
     */
    public function createLastmod(string $time): \DOMElement
    {
        $tag = $this->dom->createElement('lastmod', $time);

        return $tag;
    }

    /**
     *  Создаёт тег url 
     */
    public function createUrl(\DOMElement $loc): \DOMElement
    {
        $tag = $this->dom->createElement('url');
        $tag->appendChild($loc);

        return $tag;
    }

    /**
     * Добавляет элемент в древо
     */
    public function append(\DomElement $el)
    {
        $this->root->appendChild($el);
    }

    /**
     * Сохраяет xml
     */
    public function save()
    {
        return $this->dom->save($this->savePath);
    }
}
