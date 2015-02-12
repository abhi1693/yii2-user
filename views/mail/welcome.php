<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 10-02-2015
	 * Time: 18:31
	 */

	use yii\helpers\Html;

	/** @var $user \abhimanyu\user\models\User */
?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	Hello,<br/>
	Click on the following link to activate your account:<br/>
	<?= Html::a('Activate Account', ['//user/registration/confirm', 'id' => $user->id, 'code' => $user->activation_token],
	            ['class' => 'btn btn-lg btn-success']) ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	Your account on <?= Yii::$app->name ?> has been successfully created. You can use your username address to log in.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	Email Id: <?= $user->email ?><br>
	Username: <?= $user->username ?><br>
	Password: <?= $user->password ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	P.S. If you received this email by mistake, simply delete it.
</p>