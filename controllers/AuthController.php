<?php

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\AccountLoginForm;
	use abhimanyu\user\models\AccountRecoverPasswordForm;
	use abhimanyu\user\models\User;
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

			$model = new AccountLoginForm();

			if ($model->load(Yii::$app->request->post())) {
				if ($model->validate() && $model->login()) {
					return $this->redirect(Yii::$app->user->returnUrl);
				}
			}

			return $this->render('login', ['model' => $model, 'canRegister' => Yii::$app->config->get('user.registration')]);
		}

		public function actionRegister()
		{
			$model           = new User();
			$model->scenario = 'register';

			if ($model->load(Yii::$app->request->post())) {
				if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
					Yii::$app->response->format = Response::FORMAT_JSON;

					return ActiveForm::validate($model);
				}

				if ($model->validate() && $model->register(FALSE, User::STATUS_PENDING)) {
					Yii::$app->session->setFlash('success', 'You\'ve successfully been registered. Check your mail to activate your account');

					return $this->redirect(Yii::$app->urlManager->createUrl('//user/auth/login'));
				}
			}

			return $this->render('register', ['model' => $model]);
		}

		public function actionRecoverPassword()
		{
			$model = new AccountRecoverPasswordForm();

			if ($model->load(Yii::$app->request->post())) {
				if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
					Yii::$app->response->format = Response::FORMAT_JSON;

					return ActiveForm::validate($model);
				}

				if ($model->validate()) {
					$model->recoverPassword();
				}
			}

			return $this->render('recoverPassword', ['model' => $model]);
		}
	}