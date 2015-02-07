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
				<?= $form->field($model, 'email')->textarea([
					                                            'class'        => 'form-control',
					                                            'autocomplete' => 'off',
					                                            'autofocus'    => 'on'
				                                            ]) ?>
			</div>

			<?php $form::end(); ?>
		</div>
	</div>
</div>