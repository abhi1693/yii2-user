<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 02-03-2015
	 * Time: 23:33
	 */
	use abhimanyu\user\models\Profile;
	use yii\helpers\Html;

	/** @var $profile \abhimanyu\user\models\Profile */
	$profile = Profile::findOne(['uid' => Yii::$app->user->getId()])
?>

<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title"><?= Html::img(Yii::$app->homeUrl . '/../../' .
	                                                                 $profile['avatar'], [
		                                                                 'alt'   => 'Profile Image',
		                                                                 'width' => 30,
		                                                                 'class' => 'img-rounded'])
			?></h3></div>
</div>