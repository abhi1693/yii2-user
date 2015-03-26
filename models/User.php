<?php

namespace abhimanyu\user\models;

use RuntimeException;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * User model
 *
 * @property integer $id
 * @property string  $username
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property string  $auth_key
 * @property string  $activation_token
 * @property integer $super_admin
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string  $password write-only password
 */
class User extends ActiveRecord
{
	/** User Status - Blocked/Inactive */
	const STATUS_BLOCKED = 0;
	/** User Status - Active */
	const STATUS_ACTIVE = 1;
	/** User Status - Activation Pending */
	const STATUS_PENDING = 2;

	/** Login Type - Email and Username */
	const  LOGIN_TYPE_BOTH = 0;
	/** Login Type - Email Only */
	const  LOGIN_TYPE_EMAIL = 1;
	/** Login Type - Username Only */
	const  LOGIN_TYPE_USERNAME = 2;

	/** @var string Plain password. Used for model validation. */
	public $password;
	/** @var string Plain password. Used for model validation. */
	public $password_confirm;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user}}';
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 *
	 * @return boolean
	 */
	public static function isPasswordResetTokenValid($token)
	{
		if (empty($token)) {
			return FALSE;
		}
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = (int)end($parts);

		return $timestamp + $expire >= time();
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
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				],
				'value'      => new Expression('NOW()')
			],
		];
	}

	public function scenarios()
	{
		return [
			'register' => ['username', 'email', 'password', 'password_confirm'],
			'recover'  => ['email'],
			'reset'    => ['password', 'password_confirm'],
			'create'   => ['username', 'email', 'password'],
			'update'   => ['username', 'email', 'password'],
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
			['username', 'match', 'pattern' => '/^[a-zA-Z0-9_]\w+$/'],
			['username', 'string', 'min' => 3, 'max' => 25],
			['username', 'unique'],
			['username', 'trim'],

			// email
			['email', 'required', 'on' => ['register', 'create']],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['email', 'unique'],
			['email', 'trim'],

			// password
			['password', 'required', 'on' => ['register', 'reset', 'create']],
			['password', 'string', 'min' => 6, 'on' => ['register', 'reset', 'create', 'update']],

			// password confirm
			['password_confirm', 'required', 'on' => ['register', 'reset']],
			['password_confirm', 'compare', 'compareAttribute' => 'password'],
		];
	}

	public function attributeLabels()
	{
		return [
			'username'         => 'Username',
			'password_hash'    => 'Password',
			'password_confirm' => 'Confirm Password',
			'email'            => 'Email'
		];
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 *
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	public function beforeSave($insert)
	{
		if ($insert) {
			$this->generateAuthKey();
			$this->generateActivationToken();
		}

		if ($this->password)
			$this->setPassword($this->password);

		return parent::beforeSave($insert);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates account activation token
	 */
	public function generateActivationToken()
	{
		$this->activation_token = Yii::$app->security->generateRandomString(24);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	public function afterSave($insert, $changedAttributes)
	{
		if ($insert) {
			$profile = Yii::createObject([
				'class' => Profile::className(),
				'uid'   => $this->id
			]);
			$profile->save(FALSE);
		}

		parent::afterSave($insert, $changedAttributes);
	}

	/**
	 * Gets user profile
	 *
	 * @return Profile
	 */
	public function getProfile()
	{
		return $this->hasOne(Profile::className(), ['uid' => 'id']);
	}

	/**
	 * This method is used to register new user account.
	 *
	 * @param bool $isSuperAdmin
	 * @param int  $status
	 *
	 * @return bool
	 */
	public function register($isSuperAdmin = FALSE, $status = 1)
	{
		if ($this->getIsNewRecord() == FALSE) {
			throw new RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
		}

		// Set to 1 if isSuperAdmin is true else set to 0
		$this->super_admin = $isSuperAdmin ? 1 : 0;

		// Set status
		$this->status = $status;

		// Save user data to the database
		if ($this->save()) {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * @return bool Whether the user is an admin or not.
	 */
	public function getIsAdmin()
	{
		return $this->super_admin == 1;
	}

	public function create($isSuperAdmin = FALSE)
	{
		if ($this->getIsNewRecord() == FALSE) {
			throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
		}

		// Set to 1 if isSuperAdmin is true else set to 0
		$this->super_admin = $isSuperAdmin ? 1 : 0;

		// Set status
		$this->status = User::STATUS_PENDING;

		// Save user data to the database
		if ($this->save()) {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Returns user's status
	 *
	 * @return null|string
	 */
	public function getIsStatus()
	{
		switch ($this->status) {
			case User::STATUS_PENDING:
				return '<div class="text-center"><span class="text-primary">Pending</span></div>';
			case User::STATUS_ACTIVE:
				return '<div class="text-center"><span class="text-success">Active</span></div>';
			case User::STATUS_BLOCKED:
				return '<div class="text-center"><span class="text-danger">Blocked</span></div>';
		}

		return NULL;
	}

	/**
	 * Returns TRUE if user is confirmed else FALSE
	 *
	 * @return bool
	 */
	public function getIsConfirmed()
	{
		return $this->status != User::STATUS_PENDING;
	}

	/**
	 * Returns TRUE if user is blocked else FALSE
	 *
	 * @return bool
	 */
	public function getIsBlocked()
	{
		return $this->status == User::STATUS_BLOCKED;
	}

	/**
	 * Confirms user and sets status to ACTIVE
	 */
	public function confirm()
	{
		$this->status = User::STATUS_ACTIVE;
		if ($this->save(FALSE))
			return TRUE;

		return FALSE;
	}

	/**
	 * Blocks the user and sets the status to BLOCKED
	 */
	public function block()
	{
		$this->status = User::STATUS_BLOCKED;

		if ($this->save(FALSE))
			return TRUE;

		return FALSE;
	}

	/**
	 * Unblocks the user and sets the status to ACTIVE
	 */
	public function unblock()
	{
		$this->status = User::STATUS_ACTIVE;

		if ($this->save(FALSE))
			return TRUE;

		return FALSE;
	}
}