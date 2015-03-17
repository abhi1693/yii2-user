<?php
	use abhimanyu\user\models\Profile;
	use abhimanyu\user\models\User;
	use yii\db\Migration;
	use yii\db\Schema;

	class m150203_081329_user extends Migration
	{
		public function up()
		{
			$this->createTable(User::tableName(), [
				'id'                   => Schema::TYPE_PK,
				'username'             => Schema::TYPE_STRING . ' NOT NULL',
				'email'                => Schema::TYPE_STRING . ' NOT NULL',
				'password_hash'        => Schema::TYPE_STRING . ' NOT NULL',
				'super_admin'          => Schema::TYPE_INTEGER,
				'status'               => Schema::TYPE_INTEGER . ' NOT NULL',
				'auth_key'             => Schema::TYPE_STRING,
				'activation_token'     => Schema::TYPE_STRING . '(24) DEFAULT NULL',
				'password_reset_token' => Schema::TYPE_STRING . ' DEFAULT NULL',
				'created_at'           => Schema::TYPE_DATETIME . ' NOT NULL',
				'updated_at'           => Schema::TYPE_DATETIME . ' NOT NULL',
			]);

			$this->createTable(Profile::tableName(), [
				'id'         => Schema::TYPE_PK,
				'uid' => Schema::TYPE_INTEGER . ' NOT NULL UNIQUE',
				'name_first' => Schema::TYPE_STRING . ' NOT NULL',
				'name_last'  => Schema::TYPE_STRING,
				'sex' => Schema::TYPE_INTEGER
			]);

			$this->createIndex('uid_index', Profile::tableName(), 'uid', TRUE);
			$this->addForeignKey('profile_uid_user_id', Profile::tableName(), 'uid', User::tableName(), 'id', 'CASCADE', 'CASCADE');
		}

		public function down()
		{
			$this->dropTable(Profile::tableName());
			$this->dropTable(User::tableName());
		}
	}