<?php

	namespace abhimanyu\user\models;

	use Yii;
	use yii\base\Model;

	/**
	 * LoginForm is the model behind the login form.
	 */
	class LoginForm extends Model
	{
		public $username;
		public $password;
		public $rememberMe = FALSE;
		private $_user = FALSE;

		/**
		 * @return array the validation rules.
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

		public function attributeLabels()
		{
			return [
				'username'   => 'Username',
				'password'   => 'Password',
				'rememberMe' => 'Remember me?',
			];
		}

		/**
		 * Validates the password.
		 * This method serves as the inline validation for password.
		 */
		public function validatePassword()
		{
			if (!$this->hasErrors()) {
				$user = $this->getUser();
				if (!$user || !$user->validatePassword($this->password)) {
					$this->addError('password', 'Incorrect username or password.');
				}
			}
		}

		/**
		 * Logs in a user using the provided username and password.
		 *
		 * @param bool $validate
		 *
		 * @return boolean whether the user is logged in successfully
		 */
		public function login($validate = TRUE)
		{
			if (!$validate || $this->validate()) {
				return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
			} else {
				return FALSE;
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
				$this->_user = User::findByUsername($this->username);
			}

			return $this->_user;
		}
	}