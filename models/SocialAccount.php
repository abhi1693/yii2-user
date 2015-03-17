<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 12-03-2015
	 * Time: 12:37
	 */

	namespace abhimanyu\user\models;

	use yii\db\ActiveRecord;

	/**
	 * Class SocialAccount
	 *
	 * @package abhimanyu\user\models
	 *
	 * @property integer $id
	 * @property integer $uid
	 * @property string  $provider
	 * @property string  $client_id
	 */
	class SocialAccount extends ActiveRecord
	{

		public static function tableName()
		{
			return '{{%social_account}}';
		}

		public function getUser()
		{
			return $this->hasOne(User::className(), ['id' => 'uid']);
		}

		public function getConnected()
		{
			return $this->uid != NULL;
		}
	}