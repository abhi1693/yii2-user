<?php

	namespace abhimanyu\user;

	use abhimanyu\user\models\User;
	use Yii;
	use yii\base\Module;
	use yii\db\Exception;
	use yii\web\Application;

	class UserModule extends Module
	{
		const VERSION = '0.0.1';

		public function init()
		{
			$this->setAliases(['@user' => __DIR__]);
			parent::init();
		}

		/**
		 * We just check whether module is installed and user is logged in.
		 *
		 * @return bool
		 */
		public static function hasUser()
		{
			if (!Yii::$app instanceof Application)
				return FALSE;

			if (!Yii::$app->db->getTableSchema(User::tableName()))
				return FALSE;

			try {
				$identityClass = Yii::$app->user->identityClass;
			} catch (Exception $e) {
				$identityClass = FALSE;
			}

			if (!$identityClass)
				return FALSE;

			return !Yii::$app->user->isGuest;
		}
	}