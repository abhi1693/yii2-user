<?php

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\AccountLoginForm;
	use abhimanyu\user\models\AccountRecoverPasswordForm;
	use Yii;
	use yii\base\Model;
	use yii\filters\AccessControl;
	use yii\filters\VerbFilter;
	use yii\web\Controller;
	use yii\web\Response;
	use yii\widgets\ActiveForm;

	class AuthController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'allow'   => TRUE,
							'actions' => ['login', 'register', 'recover-password'],
							'roles'   => ['?']
						],
						[
							'allow'   => TRUE,
							'actions' => ['logout'],
							'roles'   => ['@']
						]
					]
				],
				'verbs'  => [
					'class'   => VerbFilter::className(),
					'actions' => [
						'logout' => ['post']
					]
				]
			];
		}

		/**
		 * Displays the login page.
		 *
		 * @return string|\yii\web\Response
		 */
		public function actionLogin()
		{
			// If the user is logged in, redirect to dashboard
			if (!Yii::$app->user->isGuest)
				return $this->redirect(Yii::$app->user->returnUrl);

			$model = new AccountLoginForm();

			/** Performs ajax validation if enabled */
			//$this->performAjaxValidation($model);

			if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->login())
				return $this->redirect(Yii::$app->user->returnUrl);

			return $this->render('login', ['model' => $model, 'canRegister' => Yii::$app->config->get('user.enableRegistration')]);
		}

		/**
		 * Sends password recovery mail to the user
		 *
		 * @return string
		 */
		public function actionRecoverPassword()
		{
			$model = new AccountRecoverPasswordForm();

			/** Performs ajax validation if enabled */
			$this->performAjaxValidation($model);

			if ($model->load(Yii::$app->request->post())) {
				if ($model->validate()) {
					$model->recoverPassword();
				}
			}

			return $this->render('recoverPassword', ['model' => $model]);
		}

		/**
		 * Performs AJAX validation.
		 *
		 * @param array|Model $models
		 *
		 * @throws \yii\base\ExitException
		 */
		protected function performAjaxValidation($models)
		{
			if (Yii::$app->request->isAjax) {
				if (is_array($models)) {
					$result = [];

					foreach ($models as $model) {
						if ($model->load(Yii::$app->request->post())) {
							Yii::$app->response->format = Response::FORMAT_JSON;
							$result                     = array_merge($result, ActiveForm::validate($model));
						}
					}

					echo json_encode($result);
					Yii::$app->end();
				}
			} else {
				if ($models->load(Yii::$app->request->post())) {
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(ActiveForm::validate($models));
					Yii::$app->end();
				}
			}
		}

		/**
		 * Logs the user out and then redirects to the homepage.
		 *
		 * @return \yii\web\Response
		 */
		public function actionLogout()
		{
			Yii::$app->user->logout();

			return $this->goHome();
		}
	}