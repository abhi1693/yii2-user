<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 02-03-2015
	 * Time: 23:33
	 */
	use abhimanyu\user\models\Profile;
	use yii\helpers\Html;
	use yii\widgets\Menu;

	/** @var $profile \abhimanyu\user\models\Profile */
	$profile = Profile::findOne(['uid' => Yii::$app->user->getId()])
?>

<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title"><?= Html::img(Yii::$app->homeUrl . '/../../' .
	                                                                 $profile['avatar'], [
		                                                                 'alt'   => 'Profile Image',
		                                                                 'width' => 30,
		                                                                 'class' => 'img-rounded'])
			?> <?= Html::encode($profile['name_first'] . ' ' . $profile['name_last']) ?></h3></div>
	<div class="panel-body">
		<?= Menu::widget([
			                 'options' => [
				                 'class' => 'nav nav-pills nav-stacked'
			                 ],
			                 'items'   => [
				                 ['label' => 'Profile', 'url' => ['/user/account/profile']],
				                 ['label' => 'Avatar', 'url' => ['/user/account/avatar']],
			                 ]
		                 ]) ?>
	</div>
</div>