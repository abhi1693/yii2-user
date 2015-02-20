<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 13-02-2015
	 * Time: 18:26
	 */

	use yii\helpers\Html;

	/** @var $this \yii\web\View */
	/** @var $profile \abhimanyu\user\models\Profile */

	$this->title = empty($profile->name_first)
		? Html::encode(Yii::$app->user->identity->username)
		: Html::encode($profile->name_first . ' ' . $profile->name_last);
?>

<div class="jumbotron">
	<h2>Under Construction</h2>
</div>