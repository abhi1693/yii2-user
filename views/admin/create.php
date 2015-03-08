<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 25-02-2015
	 * Time: 23:25
	 */

	use kartik\alert\AlertBlock;
	use yii\widgets\ActiveForm;

	/** @var $this \yii\web\View */
	/** @var $model \abhimanyu\user\models\User */

	$this->title = Yii::t('user', 'Create User - ' . Yii::$app->name);

	echo AlertBlock::widget([
		                        'delay'           => 5000,
		                        'useSessionFlash' => TRUE
	                        ]);
?>

<div class="panel panel-default">
	<div class="panel-heading"><?= Yii::t('user', 'Create New User') ?></div>

	<div class="panel-body">
		<?php
			$form = ActiveForm::begin([
				                          'enableAjaxValidation' => FALSE,
			                          ]);
		?>

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
			<div class="checkbox">
				<?= $form->field($model, 'super_admin')->checkbox() ?>
			</div>
		</div>

		<div class="form-group">
			<?= \yii\helpers\Html::submitButton(Yii::t('user', Yii::t('user', 'Create User')), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php $form::end(); ?>
	</div>
</div>