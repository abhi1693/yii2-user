<?php

	namespace abhimanyu\user;

	use Yii;
	use yii\base\Module;
	use yii\i18n\PhpMessageSource;

	class UserModule extends Module
	{
		const VERSION = '0.0.3-dev';

		public function init()
		{
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