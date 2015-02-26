<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 13:58
	 */

	use kartik\grid\GridView;
	use yii\helpers\Html;

	/** @var $this \yii\web\View */
	/** @var $dataProvider \abhimanyu\user\models\UserSearch */
	/** @var $searchModel \abhimanyu\user\models\UserSearch */

	$this->title = 'User Admin - ' . Yii::$app->name;
?>

<?= $this->render('/alert') ?>

<?= GridView::widget([
	                     'dataProvider' => $dataProvider,
	                     'filterModel'  => $searchModel,
	                     'columns'      => [
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
	                     'responsive'   => TRUE,
	                     'hover'        => TRUE,
	                     'condensed'    => TRUE,
	                     'export'       => FALSE,
	                     'panel'        => [
		                     'heading' => 'Manage Users',
		                     'before'  => Html::a('Create User', ['/'], ['class' => 'btn btn-primary'])
	                     ]
                     ]) ?>