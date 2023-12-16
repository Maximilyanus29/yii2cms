<?php

namespace backend\modules\page\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Page;

class PageSearch extends Page
{
    public function rules()
    {
        return [
            [['is_public', 'is_delete'], 'integer'],
            [['name', 'slug', 'text', 'text_short'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Page::find()->where(['is_delete' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'is_public' => $this->is_public,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'text_short', $this->text_short]);

        return $dataProvider;
    }
}
