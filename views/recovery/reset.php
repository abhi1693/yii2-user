<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 12-02-2015
 * Time: 23:07
 */

use kartik\alert\AlertBlock;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this \yii\web\View */
/** @var $model \abhimanyu\user\models\User */

$this->title = 'Reset Password - ' . Yii::$app->name;

echo AlertBlock::widget([
	'delay'           => 5000,
	'useSessionFlash' => TRUE
]);
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= Yii::t('user', Html::encode($this->title)) ?></h3>
			</div>
			<div class="panel-body">
				<?php $form = ActiveForm::begin([
					'enableAjaxValidation'   => FALSE,
					'enableClientValidation' => FALSE
				]); ?>

				<?= $form->field($model, 'password')->passwordInput() ?>

				<?= $form->field($model, 'password_confirm')->passwordInput() ?>

				<?= Html::submitButton(Yii::t('user', 'Finish'), ['class' => 'btn btn-success btn-block']) ?><br>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>