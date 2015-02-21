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
	/** @var $searchModel \abhimanyu\user\models\UserSearch */

	$this->title = 'User Admin - ' . Yii::$app->name;
?>

<?= $this->render('/alert') ?>

<div class="panel panel-default">
	<div class="panel-heading">Manage Users</div>

	<div class="panel-body">
		<p>In this overview you can find every registered user and manage him.</p>

		<?= GridView::widget([
			                     'dataProvider' => $dataProvider,
			                     'filterModel' => $searchModel,
			                     'columns'     => [
				                     ['class' => \kartik\grid\SerialColumn::className()],
				                     [
					                     'header' => '',
					                     'value'  => function ($model) {
						                     // todo implement profile pic
						                     //return Html::img('');
					                     },
					                     'format' => 'raw',
				                     ],
				                     'username',
				                     'email',
				                     ['class' => \kartik\grid\ActionColumn::className()]
			                     ],
			                     'responsive'  => TRUE,
			                     'hover'       => TRUE,
			                     'condensed'   => TRUE,
			                     'export'       => FALSE
		                     ]) ?>
	</div>
</div>