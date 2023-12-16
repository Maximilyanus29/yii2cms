<?php

namespace backend\modules\article\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['id', 'article_category_id', 'created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [['name', 'slug', 'text_short', 'text'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'article_category_id' => $this->article_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_public' => $this->is_public,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'text_short', $this->text_short])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
