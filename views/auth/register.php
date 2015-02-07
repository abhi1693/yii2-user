<?php
	/** @var $model \abhimanyu\user\models\User */
?>

<div class="container" style="max-width: 300px;margin: 0 auto 20px;text-align: left;">
	<div class="panel panel-default">
		<div class="panel-heading">Sign Up!</div>

		<div class="panel-body">
			<?php $form = \yii\widgets\ActiveForm::begin([
				                                             'id'                   => 'register-form',
				                                             'enableAjaxValidation' => TRUE,
			                                             ]); ?>

			<div class="form-group">
				<?= $form->field($model, 'email')->textInput([
					                                             'class'        => 'form-control',
					                                             'autocomplete' => 'off',
					                                             'autofocus'    => 'on'
				                                             ]) ?>
			</div>

			<div class="form-group">
				<?= $form->field($model, 'username')->textInput([
					                                                'class'        => 'form-control',
					                                                'autocomplete' => 'off',
				                                                ]) ?>
			</div>

			<div class="form-group">
				<?= $form->field($model, 'password')->passwordInput([
					                                                    'class' => 'form-control',
				                                                    ]) ?>
			</div>

			<div class="form-group">
				<?= $form->field($model, 'password_confirm')->passwordInput([
					                                                            'class' => 'form-control',
				                                                            ]) ?>
			</div>

			<hr>
			<div class="row">
				<?= \yii\helpers\Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
				<?= \yii\helpers\Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
			</div>

			<?php $form::end(); ?>
		</div>
	</div>
</div>