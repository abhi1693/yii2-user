<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 12-03-2015
 * Time: 09:56
 */

use kartik\alert\AlertBlock;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this \yii\web\View */
/** @var $model \abhimanyu\user\models\SettingsForm */

$this->title = 'User Module Settings - ' . Yii::$app->name;
?>

<?= AlertBlock::widget([
	'useSessionFlash' => TRUE,
	'delay'           => 5000
]) ?>

<div class="panel panel-default">
	<div class="panel-heading"><?= Html::encode($this->title) ?></div>

	<div class="panel-body">
		<?php $form = ActiveForm::begin(); ?>

		<div class="form-group">
			<div class="checkbox">
				<?= $form->field($model, 'canRegister')
					->checkbox([
						'options' => [
							'class' => 'form-control',
						],
					]) ?>
			</div>
		</div>

		<div class="form-group">
			<div class="checkbox">
				<?= $form->field($model, 'canRecoverPassword')
					->checkbox([
						'options' => [
							'class' => 'form-control',
						],
					]) ?>
			</div>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'rememberMeDuration')->textInput([
				'options' => [
					'autocomplete' => 'off',
					'class'        => 'form-control'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'loginType')->dropDownList(
				[
					0 => 'Email and Username',
					1 => 'Email',
					2 => 'Username'
				]
			) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php $form::end(); ?>
	</div>
</div>