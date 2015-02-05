<?php
	/** @var $model \abhimanyu\user\models\AccountRecoverPasswordForm */

	foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
		echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
	}
?>
<div class="container" style="text-align: center">
	<div class="row">
		<div id="password-recovery-form" class="panel panel-default"
		     style="max-width: 300px;margin: 0 auto 20px;text-align: left;">
			<div class="panel-heading">Password Recovery</div>

			<div class="panel-body">
				<?php $form = \yii\widgets\ActiveForm::begin([
					                                             'id'                   => 'recover-password-form',
					                                             'enableAjaxValidation' => TRUE
				                                             ]); ?>
				<p>Just enter your e-mail address. We´ll send you a new one!</p>

				<div class="form-group">
					<?= $form->field($model, 'email')->textInput([
						                                             'class'        => 'form-control',
						                                             'autocomplete' => 'off',
						                                             'autofocus'    => 'on'
					                                             ]) ?>

					<!-- todo add captcha -->
					<hr>
					<?= \yii\helpers\Html::submitButton('Get new Password', ['class' => 'btn btn-primary']) ?><?= \yii\helpers\Html::a('Back', Yii::$app->urlManager->createUrl('//')) ?>
				</div>

				<?php $form::end(); ?>
			</div>
		</div>
	</div>
</div>