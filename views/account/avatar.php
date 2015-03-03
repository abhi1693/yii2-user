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

	/** @var $this \yii\web\View */

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
				<?= FileInput::widget() ?>
			</div>
		</div>
	</div>
</div>
