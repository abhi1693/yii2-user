<?php

	namespace abhimanyu\user\models;

	use Yii;
	use yii\data\ActiveDataProvider;

	/**
	 * @property mixed username
	 */
	class UserSearch extends User
	{
		public function rules()
		{
			return [
				[['id', 'email', 'password', 'username'], 'safe'],
				[['status', 'created_at', 'updated_at', 'super_admin'], 'integer'],
			];
		}

		public function search($params)
		{
			$query        = User::find();
			$dataProvider = new ActiveDataProvider([
				                                       'query' => $query,
			                                       ]);
			if (!($this->load($params) && $this->validate())) {
				return $dataProvider;
			}
			$query->andFilterWhere([
				                       'status'     => $this->status,
				                       'created_at' => $this->created_at,
				                       'updated_at' => $this->updated_at,
			                       ]);
			$query->andFilterWhere(['like', 'id', $this->id])
				->andFilterWhere(['like', 'email', $this->email])
				->andFilterWhere(['like', 'password', $this->password])
				->andFilterWhere(['like', 'username', $this->username]);

			return $dataProvider;
		}
	}