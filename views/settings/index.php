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
		<?= $form->field($model, 'canRegister')->checkbox() ?>
		<?php $form::end(); ?>
	</div>
</div>