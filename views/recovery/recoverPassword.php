<?php

use kartik\alert\AlertBlock;

/** @var $model \abhimanyu\user\models\AccountRecoverPasswordForm */
/** @var $this \yii\web\View */

$this->title = 'Password Recovery - ' . Yii::$app->name;

echo AlertBlock::widget([
	'delay'           => 5000,
	'useSessionFlash' => TRUE
]);
?>

<div class="container" style="text-align: center">
	<div class="row">
		<div id="password-recovery-form" class="panel panel-default"
		     style="max-width: 300px;margin: 0 auto 20px;text-align: left;">
			<div class="panel-heading"><?= Yii::t('user', 'Password Recovery') ?></div>

			<div class="panel-body">
				<?php $form = \yii\widgets\ActiveForm::begin([
					'id'                   => 'recover-password-form',
					'enableAjaxValidation' => FALSE
				]); ?>
				<p><?= Yii::t('user', 'Just enter your e-mail address. We´ll send you a new one!') ?></p>

				<div class="form-group">
					<?= $form->field($model, 'email')->textInput([
						'class'        => 'form-control',
						'autocomplete' => 'off',
						'autofocus'    => 'on'
					]) ?>

					<!-- todo add captcha -->
					<hr>
					<?= \yii\helpers\Html::submitButton(Yii::t('user', 'Get new Password'), ['class' => 'btn btn-primary']) ?><?= \yii\helpers\Html::a(Yii::t('user', 'Back'), Yii::$app->urlManager->createUrl('//'), ['class' => 'pull-right']) ?>
				</div>

				<?php $form::end(); ?>
			</div>
		</div>
	</div>
</div>