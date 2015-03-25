<?php

namespace abhimanyu\user\controllers;

use abhimanyu\user\models\AccountLoginForm;
use abhimanyu\user\models\SocialAccount;
use abhimanyu\user\UserModule;
use Yii;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

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
						'actions' => ['login', 'auth'],
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

	public function actions()
	{
		return [
			'auth' => [
				'class'           => AuthAction::className(),
				'successCallback' => [$this, 'authenticate'],
			]
		];
	}

	public function authenticate(ClientInterface $client)
	{
		$attributes = $client->getUserAttributes();
		$provider = $client->getId();
		$clientId = $attributes['id'];

		$model = SocialAccount::find()->where(['provider' => $provider, 'client_id' => $clientId])->one();

		if ($model === NULL) {
			$model->save(FALSE);
		}

		if (NULL === ($user = $model->getUser())) {
			$this->action->successUrl = Url::to(['/user/registration/connect', 'account_id' => $model->id]);
		} else {
			Yii::$app->user->login($user, UserModule::$rememberMeDuration);
		}
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

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->login())
			return $this->redirect(Yii::$app->user->returnUrl);

		return $this->render('login', [
			'model'              => $model,
			'canRegister'        => UserModule::$canRegister,
			'canRecoverPassword' => UserModule::$canRecoverPassword
		]);
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