<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Folder;

/**
 * FolderSearch represents the model behind the search form of `app\models\Folder`.
 */
class FolderSearch extends Folder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fold_id', 'fold_user_id'], 'integer'],
            [['fold_name', 'fold_image', 'fold_desc'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Folder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fold_id' => $this->fold_id,
            'fold_user_id' => $this->fold_user_id,
        ]);

        $query->andFilterWhere(['like', 'fold_name', $this->fold_name])
            ->andFilterWhere(['like', 'fold_image', $this->fold_image])
            ->andFilterWhere(['like', 'fold_desc', $this->fold_desc]);

        return $dataProvider;
    }
}
