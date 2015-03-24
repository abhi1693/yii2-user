<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 12-03-2015
 * Time: 09:56
 */

use abhimanyu\installer\helpers\enums\Configuration as Enum;
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

		<hr>

		<h3><strong><?= Html::encode(Yii::t('user', 'Enable Auth Clients?')) ?></strong></h3>

		<div class="form-group">
			<?= $form->field($model, 'googleClientId')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::GOOGLE_CLIENT_ID, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'googleClientSecret')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::GOOGLE_CLIENT_SECRET, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= $form->field($model, 'facebookClientId')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::FACEBOOK_CLIENT_ID, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'facebookClientSecret')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::FACEBOOK_CLIENT_SECRET, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= $form->field($model, 'linkedInClientId')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::LINKED_IN_CLIENT_ID, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'linkedInClientSecret')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::LINKED_IN_CLIENT_SECRET, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= $form->field($model, 'githubClientId')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::GITHUB_CLIENT_ID, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'githubClientSecret')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::GITHUB_CLIENT_SECRET, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= $form->field($model, 'liveClientId')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::LIVE_CLIENT_ID, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'liveClientSecret')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::LIVE_CLIENT_SECRET, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= $form->field($model, 'twitterConsumerKey')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::TWITTER_CONSUMER_KEY, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'twitterConsumerSecret')->textInput([
				'value'   => Yii::$app->config->get
				(Enum::TWITTER_CONSUMER_SECRET, NULL),
				'class'   => 'form-control',
				'options' => [
					'autocomplete' => 'off'
				]
			]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php $form::end(); ?>
	</div>
</div>