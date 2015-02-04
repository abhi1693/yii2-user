<?php

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\LoginForm;
	use Yii;
	use yii\web\Controller;
	use yii\web\Response;
	use yii\widgets\ActiveForm;

	class AuthController extends Controller
	{
		public function actionLogin()
		{
			// If the user is logged in, redirect to dashboard
			if (!Yii::$app->user->isGuest)
				return $this->redirect(Yii::$app->user->returnUrl);

			// todo show register form link if enabled

			$model = new LoginForm();

			if ($model->load(Yii::$app->request->post())) {
				if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
					Yii::$app->response->format = Response::FORMAT_JSON;

					return ActiveForm::validate($model);
				}

				if ($model->validate() && $model->login()) {
					return $this->redirect(Yii::$app->user->returnUrl);
				}
			}

			return $this->render('login', ['model' => $model]);
		}
	}