<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 27-02-2015
	 * Time: 10:37
	 */

	use kartik\alert\AlertBlock;
	use yii\widgets\ActiveForm;

	/** @var $this \yii\web\View */
	/** @var $user \abhimanyu\user\models\User */
	/** @var $profile \abhimanyu\user\models\Profile */

	$this->title = Yii::t('user', 'Update User - ' . Yii::$app->name);

	echo AlertBlock::widget([
		                        'delay'           => 5000,
		                        'useSessionFlash' => TRUE
	                        ]);
?>

<div class="panel panel-default">
	<div class="panel-heading"><?= Yii::t('user', 'Update User') ?></div>

	<div class="panel-body">
		<?php
			$form = ActiveForm::begin([
				                          'enableAjaxValidation' => FALSE,
			                          ]);
		?>

		<div class="form-group">
			<?= $form->field($user, 'email')->textInput([
				                                            'class'        => 'form-control',
				                                            'autocomplete' => 'off',
				                                            'autofocus'    => 'on'
			                                            ]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($user, 'username')->textInput([
				                                               'class'        => 'form-control',
				                                               'autocomplete' => 'off',
			                                               ]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($user, 'password')->passwordInput([
				                                                   'class' => 'form-control',
			                                                   ])->hint(Yii::t('user', 'Enter new password here otherwise leave
			                                                    it blank')) ?>
		</div>

		<div class="form-group">
			<div class="checkbox">
				<?= $form->field($user, 'super_admin')->checkbox() ?>
			</div>
		</div>

		<hr>

		<div class="form-group">
			<?= $form->field($profile, 'name_first')->textInput([
				                                                    'class'        => 'form-control',
				                                                    'autocomplete' => 'off',
			                                                    ]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($profile, 'name_last')->textInput([
				                                                   'class'        => 'form-control',
				                                                   'autocomplete' => 'off',
			                                                   ]) ?>
		</div>

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

		<div class="form-group">
			<?= \yii\helpers\Html::submitButton(Yii::t('user', 'Update User'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php $form::end(); ?>
	</div>
</div>