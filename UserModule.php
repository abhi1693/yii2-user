<?php

	namespace abhimanyu\user;

	use Yii;
	use yii\base\Module;

	class UserModule extends Module
	{
		const VERSION = '0.0.2';

		public function init()
		{
			$this->setAliases(['@user' => __DIR__]);
			parent::init();
		}
	}