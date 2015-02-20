<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 13:58
	 */

	use kartik\grid\GridView;

	/** @var $this \yii\web\View */
	/** @var $dataProvider \abhimanyu\user\models\UserSearch */

	$this->title = 'User Admin - ' . Yii::$app->name;
?>
<div class="panel panel-default">
	<div class="panel-heading">Manage Users</div>

	<div class="panel-body">
		<p>In this overview you can find every registered user and manage him.</p>

		<?= GridView::widget([
			                     'dataProvider' => $dataProvider,
			                     'export'       => FALSE
		                     ]) ?>
	</div>
</div>