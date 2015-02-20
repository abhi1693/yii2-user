<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 14:12
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\UserSearch;
	use yii\filters\AccessControl;
	use yii\web\Controller;

	class AdminController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'actions' => ['index'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				],
			];
		}

		public function actionIndex()
		{
			$searchModel  = new UserSearch();
			$dataProvider = $searchModel->search($_GET);

			return $this->render('index', [
				'dataProvider' => $dataProvider,
			]);
		}
	}