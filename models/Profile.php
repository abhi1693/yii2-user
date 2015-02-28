<?php

	namespace abhimanyu\user\models;

	use yii\db\ActiveRecord;

	/**
	 * This is the model class for table "user_profile".
	 *
	 * @property integer $id
	 * @property integer $uid
	 * @property string  $name_first
	 * @property string  $name_last
	 * @property string  $sex
	 * @property string  $avatar
	 */
	class Profile extends ActiveRecord
	{
		public static function tableName()
		{
			return '{{%user_profile}}';
		}

		public function rules()
		{
			return [
				// uid
				['uid', 'integer'],

				// first name & last name
				[['name_first', 'name_last'], 'string', 'max' => 100],
				[['name_first'], 'required'],
				[['name_last'], 'required'],

				// sex
				['sex', 'integer', 'max' => 1],

				// avatar
				['avatar', 'string', 'max' => 255]
			];
		}

		public function attributeLabels()
		{
			return [
				'uid'        => 'User Id',
				'name_first' => 'First Name',
				'name_last'  => 'Last Name',
				'sex'        => 'Gender',
				'avatar'     => 'Avatar'
			];
		}

		public function getUser()
		{
			return $this->hasOne(User::className(), ['id' => 'uid']);
		}
	}