<?php

namespace abhimanyu\user\models;

use abhimanyu\user\UserModule;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 */
class AccountLoginForm extends Model
{
	public  $username;
	public  $password;
	public  $rememberMe = TRUE;
	private $_user      = FALSE;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array  $params    the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			}
		}
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === FALSE) {
			if (UserModule::$loginType == User::LOGIN_TYPE_EMAIL) {
				$this->_user = UserIdentity::findByEmail($this->username);
			} elseif (UserModule::$loginType == User::LOGIN_TYPE_USERNAME) {
				$this->_user = UserIdentity::findByUsername($this->username);
			} elseif (UserModule::$loginType == User::LOGIN_TYPE_BOTH) {
				$this->_user = UserIdentity::findByUsernameOrEmail($this->username);
			}
		}

		return $this->_user;
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		return $this->validate() ? Yii::$app->user->login($this->getUser(), $this->rememberMe ? UserModule::$rememberMeDuration : 0) : FALSE;
	}
}