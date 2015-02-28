<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 27-02-2015
	 * Time: 22:55
	 */

	use abhimanyu\user\models\Profile;
	use yii\db\Migration;
	use yii\db\mysql\Schema;

	class m150227_225450_add_avatar extends Migration
	{
		public function up()
		{
			$this->addColumn(Profile::tableName(), 'avatar', Schema::TYPE_STRING . '(255) DEFAULT
			"vendor/abhi1693/yii2-user/uploads/default_user.jpg"');
		}

		public function down()
		{
			$this->dropColumn(Profile::tableName(), 'avatar');
		}
	}