<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 12-03-2015
	 * Time: 12:36
	 */

	use abhimanyu\user\models\SocialAccount;
	use abhimanyu\user\models\User;
	use yii\db\Migration;
	use yii\db\Schema;

	class m150312_123650_add_social_account_table extends Migration
	{

		public function up()
		{
			$this->createTable(SocialAccount::tableName(), [
				'id'        => Schema::TYPE_PK,
				'uid'       => Schema::TYPE_INTEGER . ' NOT NULL UNIQUE',
				'provider'  => Schema::TYPE_STRING . ' NOT NULL',
				'client_id' => Schema::TYPE_STRING . ' NOT NULL',
			]);

			$this->createIndex('account_unique', SocialAccount::tableName(), ['provider', 'client_id'], TRUE);
			$this->addForeignKey('fk_user_account', SocialAccount::tableName(), 'uid', User::tableName(), 'id', 'CASCADE', 'RESTRICT');
		}

		public function down()
		{
			$this->dropTable(SocialAccount::tableName());
		}
	}