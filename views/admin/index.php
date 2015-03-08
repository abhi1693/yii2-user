<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 13:58
	 */

	use abhimanyu\user\models\Profile;
	use kartik\alert\AlertBlock;
	use kartik\grid\GridView;
	use yii\helpers\Html;

	/** @var $this \yii\web\View */
	/** @var $dataProvider \abhimanyu\user\models\UserSearch */
	/** @var $searchModel \abhimanyu\user\models\UserSearch */

	$this->title = Yii::t('user', 'User Admin - ' . Yii::$app->name);

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
				                     $avatar = Profile::findOne(['uid' => $model->id]);

				                     return '<div class="text-center">' . Html::img(Yii::$app->homeUrl . '/../../' . $avatar['avatar'], [
					                     'width' => 30,
					                     'alt'   => 'Profile Image'
				                     ]) . '</div>';
			                     },
			                     'format' => 'raw',
		                     ],
		                     'username',
		                     'email',
		                     [
			                     'attribute' => 'super_admin',
			                     'value'     => function ($model) {
				                     if ($model->super_admin == 1)
					                     return '<div class="text-center text-success"><i class="glyphicon glyphicon-ok"></i></div>';
				                     else
					                     return '<div class="text-center text-danger"><i class="glyphicon glyphicon-remove"></i></div>';
			                     },
			                     'format'    => 'raw'
		                     ],
		                     [
			                     'header' => 'Status',
			                     'value'  => function ($model) {
				                     return $model->isStatus;
			                     },
			                     'format' => 'raw'
		                     ],
		                     [
			                     'class'    => \kartik\grid\ActionColumn::className(),
			                     'template' => '{confirm} {block} {update} {delete}',
			                     'buttons'  => [
				                     'confirm' => function ($url, $model) {
					                     if ($model->isConfirmed) {
						                     return Html::a('<i class="glyphicon glyphicon-ok"></i>', NULL);
					                     } else {
						                     return Html::a('<i class="glyphicon glyphicon-ok"></i>', $url, [
							                     'data-method'  => 'post',
							                     'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
							                     'title'        => Yii::t('user', 'Confirm User')
						                     ]);
					                     }
				                     },

				                     'block'   => function ($url, $model) {
					                     if ($model->isBlocked) {
						                     $title = Yii::t('user', 'Unblock User');
					                     } else {
						                     $title = Yii::t('user', 'Block User');
					                     }

					                     return Html::a('<i class="glyphicon glyphicon-lock"></i>', $url, [
						                     'data-method'  => 'post',
						                     'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
						                     'title'        => $title
					                     ]);
				                     },

				                     'update'  => function ($url, $model) {
					                     return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, [
						                     'title' => Yii::t('user', 'Update User')
					                     ]);
				                     },

				                     'delete'  => function ($url, $model) {
					                     return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
						                     'data-method'  => 'post',
						                     'data-confirm' => Yii::t('user', 'Are you sure to delete this user?'),
						                     'title'        => Yii::t('user', 'Delete User'),
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
		                     'heading' => Yii::t('user', 'Manage Users'),
		                     'before'  => Html::a(Yii::t('user', 'Create User'), ['create'], ['class' => 'btn btn-primary'])
	                     ]
                     ]) ?>