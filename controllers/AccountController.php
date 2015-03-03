<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 01-03-2015
	 * Time: 22:08
	 */

	namespace abhimanyu\user\controllers;

	use yii\filters\AccessControl;
	use yii\web\Controller;

	class AccountController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'actions' => ['profile'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				]
			];
		}

		public function actionProfile()
		{
			return $this->render('profile');
		}
	}