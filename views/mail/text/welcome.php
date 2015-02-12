<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 10-02-2015
	 * Time: 18:40
	 */

	use yii\helpers\Html;

	/** @var $user \abhimanyu\user\models\User */
?>
Hello,<br/>
Click on the following link to activate your account:<br/>
<?= Html::a('Activate Account', ['//user/registration/confirm', 'id' => $user->id, 'code' => $user->activation_token],
            ['class' => 'btn btn-lg btn-success']) ?>
Your account on <?= Yii::$app->name ?> has been successfully created. You can use your email address to log in.<br/>

Email Id: <?= $user->email ?><br>
Username: <?= $user->username ?><br>
Password: <?= $user->password ?><br/>

P.S. If you received this email by mistake, simply delete it.