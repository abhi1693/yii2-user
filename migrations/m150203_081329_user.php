<?php
	use abhimanyu\user\models\User;
	use yii\db\Migration;
	use yii\db\Schema;

	class m150203_081329_user extends Migration
	{
		public function up()
		{
			$this->createTable(User::tableName(), [
				'id'          => Schema::TYPE_PK,
				'username'   => Schema::TYPE_STRING . ' NOT NULL',
				'email'      => Schema::TYPE_STRING . ' NOT NULL',
				'password'   => Schema::TYPE_STRING . ' NOT NULL',
				'super_admin' => Schema::TYPE_INTEGER,
				'auth_key'    => Schema::TYPE_STRING,
				'status'     => Schema::TYPE_INTEGER . ' NOT NULL',
				'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
				'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
			]);
		}

		public function down()
		{
			$this->dropTable(User::tableName());
		}
	}