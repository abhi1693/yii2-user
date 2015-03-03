<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 03-03-2015
	 * Time: 10:19
	 */

	use kartik\alert\AlertBlock;
	use kartik\file\FileInput;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\widgets\ActiveForm;

	/** @var $this \yii\web\View */
	/** @var $profile \abhimanyu\user\models\Profile */

	$this->title = 'Upload Avatar - ' . Yii::$app->name;
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
			<div class="panel-heading"><?= Html::encode($this->title) ?></div>
			<div class="panel-body">
				<?= Html::img(Yii::$app->homeUrl . '/../../' . $profile['avatar'], ['class' => 'img-responsive']) ?>

				<hr>

				<?php $form = ActiveForm::begin([
					                                'enableAjaxValidation' => FALSE,
					                                'options'              => [
						                                'enctype' => 'multipart/form-data'
					                                ]
				                                ]); ?>
				<?= $form->field($profile, 'avatar')->widget(
					FileInput::className(), [
					'options'       => [
						'multiple' => FALSE,
						'accept'   => 'image/*'
					],
					'pluginOptions' => [
						'browseClass'  => 'btn btn-primary btn-block',
						'browseIcon'   => '<i class="glyphicon glyphicon-camera"></i> ',
						'browseLabel'  => 'Select Photo',
						'maxFileCount' => 1,
						'uploadUrl'    => Url::to(['/user/account/upload-avatar'])
					],
				]) ?>

				<?php $form::end(); ?>
			</div>
		</div>
	</div>
</div>
