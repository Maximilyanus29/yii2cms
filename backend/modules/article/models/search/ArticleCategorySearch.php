<?php

namespace backend\modules\article\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleCategory;

class ArticleCategorySearch extends ArticleCategory
{

    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [['name', 'slug', 'description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ArticleCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_public' => $this->is_public,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
