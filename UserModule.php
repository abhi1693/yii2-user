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
		const VERSION = '0.0.3-dev';

		/**
		 * @var bool Checks whether the user can register
		 */
		public static $canRegister = 0;

		public function init()
		{
			UserModule::$canRegister = Yii::$app->config->get(Enum::USER_REGISTRATION);

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