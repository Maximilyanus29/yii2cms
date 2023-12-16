<?php

namespace common\models;

use paulzi\adjacencyList\AdjacencyListQueryTrait;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    use AdjacencyListQueryTrait;
}
