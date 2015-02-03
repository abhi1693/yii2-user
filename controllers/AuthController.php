<?php

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\LoginForm;
	use yii\web\Controller;

	class AuthController extends Controller
	{
		public function actionLogin()
		{
			$model = new LoginForm();

			return $this->render('login', ['model' => $model]);
		}
	}