<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\File;

/**
 * FileSearch represents the model behind the search form of `app\models\File`.
 */
class FileSearch extends File
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'file_user_id', 'file_fold_id', 'file_isDeleted', 'file_isPersonal'], 'integer'],
            [['file_dir', 'file_name', 'file_ext', 'file_color', 'file_comment', 'file_dateloaded'], 'safe'],
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
        $query = File::find()->where(['file_isDeleted' => 0]);
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
            'file_id' => $this->file_id,
            'file_dateloaded' => $this->file_dateloaded,
            'file_user_id' => $this->file_user_id,
            'file_fold_id' => $this->file_fold_id,
            'file_isDeleted' => $this->file_isDeleted,
            'file_isPersonal' => $this->file_isPersonal,
        ]);

        $query->andFilterWhere(['like', 'file_dir', $this->file_dir])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_ext', $this->file_ext])
            ->andFilterWhere(['like', 'file_color', $this->file_color])
            ->andFilterWhere(['like', 'file_comment', $this->file_comment]);

        return $dataProvider;
    }
}
