<?php

use kartik\alert\AlertBlock;

/** @var $model \abhimanyu\user\models\User */
/** @var $this \yii\web\View */

$this->title = 'Sign Up - ' . Yii::$app->name;

echo AlertBlock::widget([
	'delay'           => 5000,
	'useSessionFlash' => TRUE
]);
?>

<div class="container" style="max-width: 400px;margin: 0 auto 20px;text-align: left;">
	<div class="panel panel-default">
		<div class="panel-heading"><?= Yii::t('user', 'Sign Up!') ?></div>

		<div class="panel-body">
			<?php $form = \yii\widgets\ActiveForm::begin([
				'id'                   => 'register-form',
				'enableAjaxValidation' => FALSE,
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
				<div class="col-md-4">
					<?= \yii\helpers\Html::submitButton(Yii::t('user', 'Register'), ['class' => 'btn btn-primary']) ?>
				</div>
			</div>

			<?php $form::end(); ?>
		</div>
	</div>
</div>