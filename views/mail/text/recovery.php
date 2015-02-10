<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 10-02-2015
	 * Time: 15:45
	 */

	use yii\helpers\Html;

	/** @var $user \abhimanyu\user\models\User */
?>
Hello,

You have recently requested to reset your password. In order to complete your request, we need you to verify that
you initiated this request. Please click the link below to complete your password reset.

<?= Html::a('Change Password', ['//user/recovery/reset', 'id' => $user->id, 'code' => $user->password_reset_token]) ?>

P.S. If you did not request to reset your password, please disregard this message. Your account is safe.
