<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 12-03-2015
 * Time: 09:53
 */

namespace abhimanyu\user\controllers;

use abhimanyu\installer\helpers\Configuration;
use abhimanyu\installer\helpers\enums\Configuration as Enum;
use abhimanyu\user\models\SettingsForm;
use Yii;
use yii\authclient\clients\Facebook;
use yii\authclient\clients\GoogleOAuth;
use yii\authclient\Collection;
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
		$model->canRegister = Yii::$app->config->get(Enum::USER_REGISTRATION);
		$model->canRecoverPassword = Yii::$app->config->get(Enum::USER_FORGOT_PASSWORD);

		$model->googleClientId = Yii::$app->config->get(Enum::GOOGLE_CLIENT_ID);
		$model->googleClientSecret = Yii::$app->config->get(Enum::GOOGLE_CLIENT_SECRET);

		$model->facebookClientId = Yii::$app->config->get(Enum::FACEBOOK_CLIENT_ID);
		$model->facebookClientSecret = Yii::$app->config->get(Enum::FACEBOOK_CLIENT_SECRET);

		$config = Configuration::get();

		if ($model->load(Yii::$app->request->post())) {
			Yii::$app->config->set(Enum::USER_REGISTRATION, $model->canRegister);
			Yii::$app->config->set(Enum::USER_FORGOT_PASSWORD, $model->canRecoverPassword);
			Yii::$app->config->set(Enum::GOOGLE_CLIENT_ID, $model->googleClientId);
			Yii::$app->config->set(Enum::GOOGLE_CLIENT_SECRET, $model->googleClientSecret);
			Yii::$app->config->set(Enum::FACEBOOK_CLIENT_ID, $model->facebookClientId);
			Yii::$app->config->set(Enum::FACEBOOK_CLIENT_SECRET, $model->facebookClientSecret);

			$config['components']['authClientCollection']['class'] = Collection::className();

			if (!empty($model->googleClientId) && !empty($model->googleClientSecret)) {
				Yii::$app->config->set(Enum::GOOGLE_AUTH, GoogleOAuth::className());
				Yii::$app->config->set(Enum::GOOGLE_CLIENT_ID, $model->googleClientId);
				Yii::$app->config->set(Enum::GOOGLE_CLIENT_SECRET, $model->googleClientSecret);

				$config['components']['authClientCollection']['clients']['google']['class'] = GoogleOAuth::className();
				$config['components']['authClientCollection']['clients']['google']['clientId'] = $model->googleClientId;
				$config['components']['authClientCollection']['clients']['google']['clientSecret'] = $model->googleClientSecret;
			} else {
				$config['components']['authClientCollection']['clients']['google'] = NULL;
			}

			if (!empty($model->facebookClientId) && !empty($model->facebookClientSecret)) {
				Yii::$app->config->set(Enum::FACEBOOK_AUTH, Facebook::className());
				Yii::$app->config->set(Enum::FACEBOOK_CLIENT_ID, $model->facebookClientId);
				Yii::$app->config->set(Enum::FACEBOOK_CLIENT_SECRET, $model->facebookClientSecret);

				$config['components']['authClientCollection']['clients']['facebook']['class'] = Facebook::className();
				$config['components']['authClientCollection']['clients']['facebook']['clientId'] = $model->facebookClientId;
				$config['components']['authClientCollection']['clients']['facebook']['clientSecret'] = $model->facebookClientSecret;
			} else {
				$config['components']['authClientCollection']['clients']['facebook'] = NULL;
			}


			Configuration::set($config);

			Yii::$app->getSession()->setFlash('success', 'User module settings saved successfully');
		}

		return $this->render('index', ['model' => $model]);
	}
}