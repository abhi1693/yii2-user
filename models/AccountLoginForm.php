<?php

	namespace abhimanyu\user\models;

	use Yii;
	use yii\base\Model;

	/**
	 * LoginForm is the model behind the login form.
	 *
	 * todo fix ajax validation
	 */
	class AccountLoginForm extends Model
	{
		public $username;
		public $password;
		public $rememberMe = FALSE;

		protected $identity;

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
				if (!$this->identity || !Yii::$app->getSecurity()->validatePassword($this->password, $this->identity->password)) {
					$this->addError('password', 'Incorrect username or password.');
				}
			}
		}

		/**
		 * Logs in a user using the provided username and password.
		 *
		 * @return boolean whether the user is logged in successfully
		 */
		public function login()
		{
			if ($this->validate()) {
				return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
			} else {
				return FALSE;
			}
		}

		public function getUser()
		{
			if ($this->identity === FALSE) {
				$this->identity = User::findByUsername($this->username);
			}

			return $this->identity;
		}
	}