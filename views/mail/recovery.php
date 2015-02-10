<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 09-02-2015
	 * Time: 19:04
	 */

	use yii\helpers\Html;

	/** @var $user \abhimanyu\user\models\User */
?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	Hello,
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	You have recently requested to reset your password. In order to complete your request, we need you to verify that
	you initiated this request. Please click the link below to complete your password reset.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	<?= Html::a('Change Password', ['//user/recovery/reset', 'id' => $user->id, 'code' => $user->password_reset_token],
	            ['class' => 'btn btn-lg	btn-primary']) ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	P.S. If you did not request to reset your password, please disregard this message. Your account is safe
	.
</p>
