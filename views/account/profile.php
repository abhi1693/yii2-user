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

	$this->title = 'Profile Settings - ' . Yii::$app->name;
?>

<div class="row">
	<div class="col-md-3">
		<?= $this->render('_sidebar') ?>
	</div>

	<div class="col-md-9">

		<?= AlertBlock::widget([
			                       'useSession' => TRUE,
			                       'delay'      => 5000
		                       ]) ?>

		<div class="panel panel-default">
			<div class="panel-heading"><?= Html::encode($this->title) ?></div>
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
						                                                0 => 'Male',
						                                                1 => 'Female'
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

				<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

				<?php $form::end(); ?>
			</div>
		</div>
	</div>
</div>
