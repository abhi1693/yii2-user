<?php
	use abhimanyu\user\models\User;
	use yii\db\Migration;
	use yii\db\Schema;

	class m140417_081329_user extends Migration
	{
		public function up()
		{
			$this->createTable(User::tableName(), [
				'id'          => Schema::TYPE_PK,
				'username'    => Schema::TYPE_STRING,
				'email'       => Schema::TYPE_STRING,
				'password'    => Schema::TYPE_STRING,
				'super_admin' => Schema::TYPE_INTEGER,
				'auth_key'    => Schema::TYPE_STRING,
				'status'      => Schema::TYPE_INTEGER,
				'created_at'  => Schema::TYPE_DATETIME,
				'updated_at'  => Schema::TYPE_DATETIME,
			]);
		}

		public function down()
		{
			$this->dropTable(User::tableName());
		}
	}