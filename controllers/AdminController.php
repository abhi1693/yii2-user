<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 14:12
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\User;
	use abhimanyu\user\models\UserSearch;
	use Yii;
	use yii\filters\AccessControl;
	use yii\filters\VerbFilter;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	class AdminController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'actions' => ['index'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				],
				'verb' => [
					'class'  => VerbFilter::className(),
					'delete' => ['post']
				]
			];
		}

		public function actionIndex()
		{
			$searchModel  = new UserSearch();
			$dataProvider = $searchModel->search($_GET);

			return $this->render('index', [
				'dataProvider' => $dataProvider,
				'searchModel' => $searchModel
			]);
		}

		public function actionDelete($id)
		{
			$model = $this->findModel($id);

			if ($id == Yii::$app->user->getId()) {
				Yii::$app->getSession()->setFlash('danger', 'You can not remove your own account');
			} elseif (User::find()->where(['super_admin' => 1, 'id' => $id]) &&
			          User::find()->where(['super_admin' => 1])->count() == 1
			) {
				Yii::$app->getSession()->setFlash('danger', 'You can not remove this account. Please transfer your
				ownership before deleting your account.');
			} else {
				$model->delete();
				Yii::$app->getSession()->setFlash('success', 'User has been deleted');
			}

			return $this->redirect(['index']);
		}

		/**
		 * Finds the User model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 *
		 * @param  integer $id
		 *
		 * @return User                  the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			$user = new User();
			$user->findOne(['id' => $id]);
			if ($user === NULL) {
				throw new NotFoundHttpException('The requested page does not exist');
			}

			return $user;
		}
	}