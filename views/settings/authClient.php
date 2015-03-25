<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 3/25/2015
 * Time: 2:56 PM
 */

use abhimanyu\installer\helpers\enums\Configuration as Enum;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this \yii\web\View */

$this->title = 'Auth Client - ' . Yii::$app->name;

?>

<div class="panel panel-default">
	<div class="panel-heading"><?= Yii::t('user', Html::encode($this->title)) ?></div>

	<div class="panel-body">
		<?php $form = ActiveForm::begin([
			'id'                   => 'authClientSettingsForm',
			'enableAjaxValidation' => FALSE
		]);?>

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

		<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>

		<?php $form::end(); ?>
	</div>
</div>