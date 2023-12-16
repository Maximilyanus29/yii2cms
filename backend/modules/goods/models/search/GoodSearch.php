<?php

namespace backend\modules\goods\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Good;

class GoodSearch extends Good
{
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [['name', 'slug', 'description','price'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Good::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_public' => $this->is_public,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
