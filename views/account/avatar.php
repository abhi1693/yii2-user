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

	/** @var $this \yii\web\View */
	/** @var $profile \abhimanyu\user\models\Profile */

	$this->title = Yii::t('user', 'Upload Avatar - ' . Yii::$app->name);
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
				<?= Html::img(Yii::$app->homeUrl . '/../../' . $profile['avatar'], [
					'class' => 'img-responsive',
					'width' => 150
				]) ?>

				<hr>

				<?= FileInput::widget([
					                      'name'          => 'avatar',
					                      'model'         => $profile,
					                      'pluginOptions' => [
						                      'showPreview'  => TRUE,
						                      'uploadAsync'  => FALSE,
						                      'uploadUrl'    => Url::to(['upload-avatar']),
						                      'maxFileSize'  => 1024 * 10,
						                      'maxFileCount' => 1,
						                      'browseIcon'   => '<i class="glyphicon glyphicon-camera"></i> ',
						                      'browseLabel'  => 'Select Avatar'
					                      ],
					                      'options'       => [
						                      'accept'   => 'image/*',
						                      'multiple' => FALSE,
					                      ],
				                      ]) ?>
			</div>
		</div>
	</div>
</div>
