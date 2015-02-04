<?php

	namespace abhimanyu\user\models;

	use Yii;
	use yii\behaviors\TimestampBehavior;
	use yii\db\ActiveRecord;
	use yii\web\IdentityInterface;

	/**
	 * This is the model class for table "user".
	 *
	 * The followings are the available columns in table 'user':
	 *
	 * @property integer      $id
	 * @property string       $username
	 * @property string       $password
	 * @property string       $email
	 * @property integer      $super_admin
	 * @property integer      $status
	 * @property mixed        $auth_key
	 * @property string       $created_at
	 * @property string       $updated_at
	 *
	 * @author  Abhimanyu Saharan <abhimanyu@teamvulcans.com>
	 */
	class User extends ActiveRecord implements IdentityInterface
	{
		/**
		 * User Status Flags
		 */
		const STATUS_DISABLED = 0;
		const STATUS_ENABLED = 1;
		const STATUS_NEED_APPROVAL = 2;
		const STATUS_DELETED = 3;
		public $loginUrl = ['/user/auth/login'];

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
			return static::findOne($id);
		}

		/**
		 * Finds an identity by the given token.
		 *
		 * @param mixed $token the token to be looked for
		 * @param mixed $type  the type of the token. The value of this parameter depends on the implementation.
		 *                     For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
		 *
		 * @return IdentityInterface the identity object that matches the given token.
		 * Null should be returned if such an identity cannot be found
		 * or the identity is not in an active state (disabled, deleted, etc.)
		 */
		public static function findIdentityByAccessToken($token, $type = NULL)
		{
			static::findOne(compact('auth_key'));
		}

		/**
		 * Finds user by username
		 *
		 * @param  string $username
		 *
		 * @return static|null
		 */
		public static function findByUsername($username)
		{
			return static::findOne(['username' => $username, 'status' => self::STATUS_ENABLED]);
		}

		public static function tableName()
		{
			return '{{%user}}';
		}

		public function getStatusName()
		{
			return self::statusList()[$this->status];
		}

		/**
		 * gets all available user status list
		 *
		 * @return array statuses
		 */
		public static function statusList()
		{
			return [
				self::STATUS_DISABLED      => 'Blocked',
				self::STATUS_ENABLED       => 'Active',
				self::STATUS_NEED_APPROVAL => 'Pending',
				self::STATUS_DELETED       => 'Deleted'
			];
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
			return $this->auth_key == $authKey;
		}

		/**
		 * Validates password
		 *
		 * @param  string $password password to validate
		 *
		 * @return boolean if password provided is valid for current user
		 */
		public function validatePassword($password)
		{
			return $this->password == Yii::$app->security->validatePassword($password, $this->generatePassword($password));
		}

		/**
		 * Generates password hash from password and sets it to the model
		 *
		 * @param string $password original password.
		 *
		 * @return string hashed password.
		 */
		public function generatePassword($password)
		{
			return Yii::$app->security->generatePasswordHash($password);
		}

		/**
		 * Generates "remember me" authentication key
		 */
		public function generateAuthKey()
		{
			return $this->auth_key = md5(Yii::$app->security->generateRandomKey());
		}

		public function getIsSuperAdmin()
		{
			return Yii::$app->user->identity->super_admin == 1;
		}

		public function getUsername()
		{
			return Yii::$app->user->identity->username;
		}

		/**
		 * @inheritdoc
		 */
		public function behaviors()
		{
			return [
				'timestamp' => [
					'class'      => TimestampBehavior::className(),
					'attributes' => [
						self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
						self::EVENT_BEFORE_UPDATE => ['updated_at'],
					],
				],
			];
		}

		public function scenarios()
		{
			return [
				'register' => ['username', 'email', 'password'],
				'create'   => ['username', 'email', 'password']
			];
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				// username
				['username', 'required', 'on' => ['register', 'create']],
				['username', 'match', 'pattern' => '/^[a-zA-Z0-9]\w+$/'],
				['username', 'string', 'min' => 3, 'max' => 25],
				['username', 'unique'],
				['username', 'trim'],

				// email
				['email', 'required', 'on' => ['register', 'create']],
				['email', 'email'],
				['email', 'string', 'max' => 255],
				['email', 'unique'],
				['email', 'trim'],

				//password
				['password', 'required', 'on' => ['register']],
				['password', 'string', 'min' => 6, 'on' => ['register', 'create']],
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'email'       => 'Email',
				'username'    => 'Username',
				'auth_key'    => 'Auth key',
				'password'    => 'Password',
				'status'      => 'Status',
				'super_admin' => 'Super Admin',
				'created_at'  => 'Created At',
				'updated_at'  => 'Updated At'
			];
		}
	}