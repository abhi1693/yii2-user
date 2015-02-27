<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 13:58
	 */

	use kartik\alert\AlertBlock;
	use kartik\grid\GridView;
	use yii\helpers\Html;

	/** @var $this \yii\web\View */
	/** @var $dataProvider \abhimanyu\user\models\UserSearch */
	/** @var $searchModel \abhimanyu\user\models\UserSearch */

	$this->title = 'User Admin - ' . Yii::$app->name;

	echo AlertBlock::widget([
		                        'delay'           => 5000,
		                        'useSessionFlash' => TRUE
	                        ]);
?>

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
		                     [
			                     'header' => 'Status',
			                     'value'  => function ($model) {
				                     return $model->isStatus;
			                     },
			                     'format' => 'raw'
		                     ],
		                     [
			                     'class'    => \kartik\grid\ActionColumn::className(),
			                     'template' => '{confirm} {update} {delete}',
			                     'buttons'  => [
				                     'confirm' => function ($url, $model) {
					                     if ($model->isConfirmed) {
						                     return Html::a('<i class="glyphicon glyphicon-ok"></i>', NULL, [
							                     'class' => 'btn btn-xs btn-default',
						                     ]);
					                     } else {
						                     return Html::a('<i class="glyphicon glyphicon-ok"></i>', $url, [
							                     'class'        => 'btn btn-xs btn-success',
							                     'data-method'  => 'post',
							                     'data-confirm' => 'Are you sure to confirm this user?',
							                     'title'        => 'Confirm User'
						                     ]);
					                     }
				                     },

				                     'update' => function ($url, $model) {
					                     return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, [
						                     'class' => 'btn btn-xs btn-primary',
						                     'title' => 'Update User'
					                     ]);
				                     },

				                     'delete'  => function ($url, $model) {
					                     return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
						                     'class'        => 'btn btn-xs btn-danger',
						                     'data-method'  => 'post',
						                     'data-confirm' => 'Are you sure to delete this user?',
						                     'title'        => 'Delete User',
					                     ]);
				                     }
			                     ]
		                     ]
	                     ],
	                     'responsive'   => TRUE,
	                     'hover'        => TRUE,
	                     'condensed'    => TRUE,
	                     'export'       => FALSE,
	                     'panel'        => [
		                     'heading' => 'Manage Users',
		                     'before' => Html::a('Create User', ['create'], ['class' => 'btn btn-primary'])
	                     ]
                     ]) ?>