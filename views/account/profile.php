<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 01-03-2015
	 * Time: 22:10
	 */

	use kartik\alert\AlertBlock;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/** @var $this \yii\web\View */
	/** @var $profile \abhimanyu\user\models\Profile */

	$this->title = Yii::t('user', 'Profile Settings - ' . Yii::$app->name);
?>

<div class="row">
	<div class="col-md-3">
		<?= $this->render('_sidebar') ?>
	</div>

	<div class="col-md-9">

		<?= AlertBlock::widget([
			                       'useSessionFlash' => TRUE,
			                       'delay'           => 5000
		                       ]) ?>

		<div class="panel panel-default">
			<div class="panel-heading"><?= Yii::t('user', Html::encode($this->title)) ?></div>
			<div class="panel-body">
				<?php $form = ActiveForm::begin([
					                                'enableAjaxValidation' => FALSE
				                                ]); ?>

				<div class="form-group">
					<?= $form->field($profile, 'name_first')->textInput([
						                                                    'class'        => 'form-control',
						                                                    'autocomplete' => 'off',
						                                                    'autofocus'    => TRUE
					                                                    ]) ?>
				</div>

				<div class="form-group">
					<?= $form->field($profile, 'name_last')->textInput([
						                                                   'class'        => 'form-control',
						                                                   'autocomplete' => 'off'
					                                                   ]) ?>
				</div>

				<hr>

				<div class="form-group">
					<?= $form->field($profile, 'sex')->dropDownList([
						                                                0 => Yii::t('user', 'Male'),
						                                                1 => Yii::t('user', 'Female')
					                                                ],
					                                                [
						                                                'class'   => 'form-control',
						                                                'options' =>
							                                                [
								                                                'sex' =>
									                                                [
										                                                'selected ' => TRUE
									                                                ]
							                                                ]
					                                                ]) ?>
				</div>

				<hr>

				<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>

				<?php $form::end(); ?>
			</div>
		</div>
	</div>
</div>
