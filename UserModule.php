<?php

namespace abhimanyu\user;

use abhimanyu\installer\helpers\enums\Configuration as Enum;
use Yii;
use yii\base\Module;
use yii\i18n\PhpMessageSource;

class UserModule extends Module
{
	/**
	 * Module Version
	 */
	const VERSION = '0.0.4-dev';

	/**
	 * @var bool Checks whether the user can register
	 */
	public static $canRegister = 0;

	/**
	 * @var bool Checks whether the user can recover password
	 */
	public static $canRecoverPassword = 0;

	/**
	 * @var int Stores remember me duration in seconds
	 */
	public static $rememberMeDuration = 0;

	public function init()
	{
		UserModule::$canRegister = Yii::$app->config->get(Enum::USER_REGISTRATION);
		UserModule::$canRecoverPassword = Yii::$app->config->get(Enum::USER_FORGOT_PASSWORD);
		UserModule::$rememberMeDuration = Yii::$app->config->get(Enum::REMEMBER_ME_DURATION);

		$this->setAliases(['@user' => __DIR__]);
		parent::init();
		$this->registerTranslations();
	}

	public function registerTranslations()
	{
		Yii::$app->i18n->translations['user*'] = [
			'class'    => PhpMessageSource::className(),
			'basePath' => __DIR__ . '/messages',
		];
	}
}