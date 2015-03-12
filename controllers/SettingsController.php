<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 12-03-2015
	 * Time: 09:53
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\SettingsForm;
	use yii\filters\AccessControl;
	use yii\web\Controller;

	class SettingsController extends Controller
	{

		/**
		 * @inheritdoc
		 */
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'allow'   => TRUE,
							'actions' => ['index'],
							'roles'   => ['@'],
						]
					]
				],
			];
		}

		public function actionIndex()
		{
			$model = new SettingsForm();

			return $this->render('index', ['model' => $model]);
		}
	}