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

		$config = Configuration::get();

		if ($model->load(Yii::$app->request->post())) {
			Yii::$app->config->set(Enum::USER_REGISTRATION, $model->canRegister);
			Yii::$app->config->set(Enum::USER_FORGOT_PASSWORD, $model->canRecoverPassword);
			Yii::$app->config->set(Enum::GOOGLE_CLIENT_ID, $model->googleClientId);
			Yii::$app->config->set(Enum::GOOGLE_CLIENT_SECRET, $model->googleClientSecret);

			if (!empty($model->googleClientId) && !empty($model->googleClientSecret)) {
				Yii::$app->config->set(Enum::GOOGLE_AUTH, GoogleOAuth::className());
				Yii::$app->config->set(Enum::GOOGLE_CLIENT_ID, $model->googleClientId);
				Yii::$app->config->set(Enum::GOOGLE_CLIENT_SECRET, $model->googleClientSecret);

				$config['components']['authClientCollection']['class'] = Collection::className();
				$config['components']['authClientCollection']['clients']['google']['class'] = GoogleOAuth::className();
				$config['components']['authClientCollection']['clients']['google']['clientId'] = $model->googleClientId;
				$config['components']['authClientCollection']['clients']['google']['clientSecret'] = $model->googleClientSecret;
			} else {
				$config['components']['authClientCollection'] = NULL;
			}


			Configuration::set($config);

			Yii::$app->getSession()->setFlash('success', 'User module settings saved successfully');
		}

		return $this->render('index', ['model' => $model]);
	}
}