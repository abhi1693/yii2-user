<?php

	namespace abhimanyu\user\controllers;

	use yii\web\Controller;

	class AuthController extends Controller
	{
		public function actionLogin()
		{
			return $this->render('login');
		}
	}