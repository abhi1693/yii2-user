<?php
	/* @var $model \abhimanyu\user\models\AccountLoginForm */
?>
<div class="container" style="text-align: center">
	<div class="panel panel-default" id="login-form" style="max-width: 300px;margin: 0 auto 20px;text-align: left">
		<div class="panel-heading"><strong>Please</strong> Sign In!</div>
		<div class="panel-body">
			<?php $form = \yii\widgets\ActiveForm::begin([
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
					<?= \yii\helpers\Html::submitButton('Sign In', ['class' => 'btn btn-large btn-primary']) ?>
				</div>

				<div class="col-md-8 text-right">
					<small>
						<?= \yii\helpers\Html::a('Forgot your password?', Yii::$app->urlManager->createUrl('//user/auth/recoverPassword')) ?>
					</small>
				</div>
			</div>

			<?php $form::end(); ?>
		</div>
	</div>
</div>