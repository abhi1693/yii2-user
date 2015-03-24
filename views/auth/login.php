<?php

use kartik\alert\AlertBlock;
use yii\authclient\widgets\AuthChoice;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \abhimanyu\user\models\AccountLoginForm */
/* @var $canRegister bool */
/* @var $canRecoverPassword bool */
/* @var $this \yii\web\View */

$this->title = 'Sign In - ' . Yii::$app->name;

echo AlertBlock::widget([
	'delay'           => 5000,
	'useSessionFlash' => TRUE
]);
?>

<div class="container" style="text-align: center">
	<div class="panel panel-default" id="login-form" style="max-width: 300px;margin: 0 auto 20px;text-align: left">
		<div class="panel-heading"><strong>Please</strong> Sign In!</div>
		<div class="panel-body">
			<?php $form = ActiveForm::begin([
				'id'                   => 'login-form',
				'enableAjaxValidation' => FALSE
			]); ?>

			<div class="form-group">
				<?= $form->field($model, 'username')->textInput(['class' => 'form-control']) ?>
			</div>
			<div class="form-group">
				<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>
			</div>
			<div class="checkbox">
				<?= $form->field($model, 'rememberMe')->checkbox() ?>
			</div>
			<hr>

			<div class="row">
				<div class="col-md-4">
					<?= Html::submitButton('Sign In', ['class' => 'btn btn-large btn-primary']) ?>
				</div>

				<?php
				if ($canRecoverPassword == 1) {
					?>
					<div class="col-md-8 text-right">
						<small>
							<?= Html::a('Forgot your password?',
								Yii::$app->urlManager->createUrl('//user/recovery/recover-password')
							) ?>
						</small>
					</div>
				<?php
				}
				?>
			</div>

			<?php
			if ($canRegister == 1) {
				?>
				<hr>
				<?= Html::a('Don\'t have an account?',
					Yii::$app->urlManager->createUrl('//user/registration/register')) ?>
			<?php
			}
			?>

			<hr/>

			<?= AuthChoice::widget(['baseAuthUrl' => ['/user/auth/authenticate']]) ?>

			<?php $form::end(); ?>
		</div>
	</div>
</div>