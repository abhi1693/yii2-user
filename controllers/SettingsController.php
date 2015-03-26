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
use yii\authclient\clients\GitHub;
use yii\authclient\clients\GoogleOAuth;
use yii\authclient\clients\LinkedIn;
use yii\authclient\clients\Live;
use yii\authclient\clients\Twitter;
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
						'actions' => ['index', 'auth-client'],
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
		$model->rememberMeDuration = Yii::$app->config->get(Enum::REMEMBER_ME_DURATION);
		$model->loginType = Yii::$app->config->get(Enum::USER_LOGIN_TYPE);

		if ($model->load(Yii::$app->request->post())) {
			Yii::$app->config->set(Enum::USER_REGISTRATION, $model->canRegister);
			Yii::$app->config->set(Enum::USER_FORGOT_PASSWORD, $model->canRecoverPassword);
			Yii::$app->config->set(Enum::REMEMBER_ME_DURATION, $model->rememberMeDuration);
			Yii::$app->config->set(Enum::USER_LOGIN_TYPE, $model->loginType);

			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User module settings saved successfully'));
		}

		return $this->render('index', ['model' => $model]);
	}

	public function actionAuthClient()
	{
		$model = new SettingsForm();
		$model->googleClientId = Yii::$app->config->get(Enum::GOOGLE_CLIENT_ID);
		$model->googleClientSecret = Yii::$app->config->get(Enum::GOOGLE_CLIENT_SECRET);

		$model->facebookClientId = Yii::$app->config->get(Enum::FACEBOOK_CLIENT_ID);
		$model->facebookClientSecret = Yii::$app->config->get(Enum::FACEBOOK_CLIENT_SECRET);

		$model->linkedInClientId = Yii::$app->config->get(Enum::LINKED_IN_CLIENT_ID);
		$model->linkedInClientSecret = Yii::$app->config->get(Enum::LINKED_IN_CLIENT_SECRET);

		$model->githubClientId = Yii::$app->config->get(Enum::GITHUB_CLIENT_ID);
		$model->githubClientSecret = Yii::$app->config->get(Enum::GITHUB_CLIENT_SECRET);

		$model->liveClientId = Yii::$app->config->get(Enum::LIVE_CLIENT_ID);
		$model->liveClientSecret = Yii::$app->config->get(Enum::LIVE_CLIENT_SECRET);

		$model->twitterConsumerKey = Yii::$app->config->get(Enum::TWITTER_CONSUMER_KEY);
		$model->twitterConsumerSecret = Yii::$app->config->get(Enum::TWITTER_CONSUMER_SECRET);

		$config = Configuration::get();

		if ($model->load(Yii::$app->request->post())) {
			Yii::$app->config->set(Enum::GOOGLE_CLIENT_ID, $model->googleClientId);
			Yii::$app->config->set(Enum::GOOGLE_CLIENT_SECRET, $model->googleClientSecret);

			Yii::$app->config->set(Enum::FACEBOOK_CLIENT_ID, $model->facebookClientId);
			Yii::$app->config->set(Enum::FACEBOOK_CLIENT_SECRET, $model->facebookClientSecret);

			Yii::$app->config->set(Enum::LINKED_IN_CLIENT_ID, $model->linkedInClientId);
			Yii::$app->config->set(Enum::LINKED_IN_CLIENT_SECRET, $model->linkedInClientSecret);

			Yii::$app->config->set(Enum::GITHUB_CLIENT_ID, $model->githubClientId);
			Yii::$app->config->set(Enum::GITHUB_CLIENT_SECRET, $model->githubClientSecret);

			Yii::$app->config->set(Enum::LIVE_CLIENT_ID, $model->liveClientId);
			Yii::$app->config->set(Enum::LIVE_CLIENT_SECRET, $model->liveClientSecret);

			Yii::$app->config->set(Enum::TWITTER_CONSUMER_KEY, $model->twitterConsumerKey);
			Yii::$app->config->set(Enum::TWITTER_CONSUMER_SECRET, $model->twitterConsumerSecret);

			$config['components']['authClientCollection']['class'] = Collection::className();

			if (!empty($model->googleClientId) && !empty($model->googleClientSecret)) {
				Yii::$app->config->set(Enum::GOOGLE_AUTH, GoogleOAuth::className());
				Yii::$app->config->set(Enum::GOOGLE_CLIENT_ID, $model->googleClientId);
				Yii::$app->config->set(Enum::GOOGLE_CLIENT_SECRET, $model->googleClientSecret);

				$config['components']['authClientCollection']['clients']['google']['class'] = GoogleOAuth::className();
				$config['components']['authClientCollection']['clients']['google']['clientId'] = $model->googleClientId;
				$config['components']['authClientCollection']['clients']['google']['clientSecret'] = $model->googleClientSecret;
			} else {
				Yii::$app->config->set(Enum::GOOGLE_AUTH, NULL);
				unset($config['components']['authClientCollection']['clients']['google']);
			}

			if (!empty($model->facebookClientId) && !empty($model->facebookClientSecret)) {
				Yii::$app->config->set(Enum::FACEBOOK_AUTH, Facebook::className());
				Yii::$app->config->set(Enum::FACEBOOK_CLIENT_ID, $model->facebookClientId);
				Yii::$app->config->set(Enum::FACEBOOK_CLIENT_SECRET, $model->facebookClientSecret);

				$config['components']['authClientCollection']['clients']['facebook']['class'] = Facebook::className();
				$config['components']['authClientCollection']['clients']['facebook']['clientId'] = $model->facebookClientId;
				$config['components']['authClientCollection']['clients']['facebook']['clientSecret'] = $model->facebookClientSecret;
			} else {
				Yii::$app->config->set(Enum::FACEBOOK_AUTH, NULL);
				unset($config['components']['authClientCollection']['clients']['facebook']);
			}

			if (!empty($model->linkedInClientId) && !empty($model->linkedInClientSecret)) {
				Yii::$app->config->set(Enum::LINKED_IN_AUTH, LinkedIn::className());
				Yii::$app->config->set(Enum::LINKED_IN_CLIENT_ID, $model->linkedInClientId);
				Yii::$app->config->set(Enum::LINKED_IN_CLIENT_SECRET, $model->linkedInClientSecret);

				$config['components']['authClientCollection']['clients']['linkedin']['class'] = LinkedIn::className();
				$config['components']['authClientCollection']['clients']['linkedin']['clientId'] = $model->linkedInClientId;
				$config['components']['authClientCollection']['clients']['linkedin']['clientSecret'] = $model->linkedInClientSecret;
			} else {
				Yii::$app->config->set(Enum::LINKED_IN_AUTH, NULL);
				unset($config['components']['authClientCollection']['clients']['linkedin']);
			}

			if (!empty($model->githubClientId) && !empty($model->githubClientSecret)) {
				Yii::$app->config->set(Enum::GITHUB_AUTH, GitHub::className());
				Yii::$app->config->set(Enum::GITHUB_CLIENT_ID, $model->githubClientId);
				Yii::$app->config->set(Enum::GITHUB_CLIENT_SECRET, $model->githubClientSecret);

				$config['components']['authClientCollection']['clients']['github']['class'] = GitHub::className();
				$config['components']['authClientCollection']['clients']['github']['clientId'] = $model->githubClientId;
				$config['components']['authClientCollection']['clients']['github']['clientSecret'] = $model->githubClientSecret;
			} else {
				Yii::$app->config->set(Enum::GITHUB_AUTH, NULL);
				unset($config['components']['authClientCollection']['clients']['github']);
			}


			if (!empty($model->liveClientId) && !empty($model->liveClientSecret)) {
				Yii::$app->config->set(Enum::LIVE_AUTH, Live::className());
				Yii::$app->config->set(Enum::LIVE_CLIENT_ID, $model->liveClientId);
				Yii::$app->config->set(Enum::LIVE_CLIENT_SECRET, $model->liveClientSecret);

				$config['components']['authClientCollection']['clients']['live']['class'] = Live::className();
				$config['components']['authClientCollection']['clients']['live']['clientId'] = $model->liveClientId;
				$config['components']['authClientCollection']['clients']['live']['clientSecret'] = $model->liveClientSecret;
			} else {
				Yii::$app->config->set(Enum::LIVE_AUTH, NULL);
				unset($config['components']['authClientCollection']['clients']['live']);
			}

			if (!empty($model->twitterConsumerKey) && !empty($model->twitterConsumerSecret)) {
				Yii::$app->config->set(Enum::TWITTER_AUTH, Twitter::className());
				Yii::$app->config->set(Enum::TWITTER_CONSUMER_KEY, $model->twitterConsumerKey);
				Yii::$app->config->set(Enum::TWITTER_CONSUMER_SECRET, $model->twitterConsumerSecret);

				$config['components']['authClientCollection']['clients']['twitter']['class'] = Twitter::className();
				$config['components']['authClientCollection']['clients']['twitter']['consumerKey'] = $model->twitterConsumerKey;
				$config['components']['authClientCollection']['clients']['twitter']['consumerSecret'] = $model->twitterConsumerSecret;
			} else {
				Yii::$app->config->set(Enum::TWITTER_AUTH, NULL);
				unset($config['components']['authClientCollection']['clients']['twitter']);
			}

			Configuration::set($config);

			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User module settings saved successfully'));
		}

		return $this->render('authClient', ['model' => $model]);
	}
}