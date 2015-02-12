<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 11-02-2015
	 * Time: 23:11
	 */

	namespace abhimanyu\user\models;

	use yii\base\NotSupportedException;
	use yii\web\IdentityInterface;

	class UserIdentity extends User implements IdentityInterface
	{
		/**
		 * Finds an identity by the given ID.
		 *
		 * @param string|integer $id the ID to be looked for
		 *
		 * @return IdentityInterface the identity object that matches the given ID.
		 * Null should be returned if such an identity cannot be found
		 * or the identity is not in an active state (disabled, deleted, etc.)
		 */
		public static function findIdentity($id)
		{
			return static::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
		}

		/**
		 * Finds an identity by the given token.
		 *
		 * @param mixed $token the token to be looked for
		 * @param mixed $type  the type of the token. The value of this parameter depends on the implementation.
		 *                     For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be
		 *                     `yii\filters\auth\HttpBearerAuth`.
		 *
		 * @return \yii\web\IdentityInterface the identity object that matches the given token.
		 * Null should be returned if such an identity cannot be found
		 * or the identity is not in an active state (disabled, deleted, etc.)
		 * @throws \yii\base\NotSupportedException
		 */
		public static function findIdentityByAccessToken($token, $type = NULL)
		{
			throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
		}

		/**
		 * Finds user by username
		 *
		 * @param string $username
		 *
		 * @return static|null
		 */
		public static function findByUsername($username)
		{
			return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
		}

		/**
		 * Finds user by password reset token
		 *
		 * @param string $token password reset token
		 *
		 * @return static|null
		 */
		public static function findByPasswordResetToken($token)
		{
			if (!static::isPasswordResetTokenValid($token)) {
				return NULL;
			}

			return static::findOne([
				                       'password_reset_token' => $token,
				                       'status'               => self::STATUS_ACTIVE,
			                       ]);
		}

		/**
		 * Find User by activation token
		 *
		 * @param integer $id   User Id
		 * @param string  $code User Activation Token
		 *
		 * @return static
		 */
		public static function findByActivationToken($id, $code)
		{
			return static::findOne([
				                       'id'               => $id,
				                       'activation_token' => $code,
				                       'status'           => self::STATUS_PENDING
			                       ]);
		}

		/**
		 * Returns an ID that can uniquely identify a user identity.
		 *
		 * @return string|integer an ID that uniquely identifies a user identity.
		 */
		public function getId()
		{
			return $this->getPrimaryKey();
		}

		/**
		 * Validates the given auth key.
		 *
		 * This is required if [[User::enableAutoLogin]] is enabled.
		 *
		 * @param string $authKey the given auth key
		 *
		 * @return boolean whether the given auth key is valid.
		 * @see getAuthKey()
		 */
		public function validateAuthKey($authKey)
		{
			return $this->getAuthKey() === $authKey;
		}

		/**
		 * Returns a key that can be used to check the validity of a given identity ID.
		 *
		 * The key should be unique for each individual user, and should be persistent
		 * so that it can be used to check the validity of the user identity.
		 *
		 * The space of such keys should be big enough to defeat potential identity attacks.
		 *
		 * This is required if [[User::enableAutoLogin]] is enabled.
		 *
		 * @return string a key that is used to check the validity of a given identity ID.
		 * @see validateAuthKey()
		 */
		public function getAuthKey()
		{
			return $this->auth_key;
		}
	}