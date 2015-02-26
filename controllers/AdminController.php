<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 20-02-2015
	 * Time: 14:12
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\Mailer;
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
							'actions' => ['index', 'delete', 'create', 'confirm'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				],
				'verb'   => [
					'class'   => VerbFilter::className(),
					'actions' => [
						'delete' => ['post']
					]
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

		public function actionCreate()
		{
			$model           = new User();
			$model->scenario = 'create';

			if ($model->load(Yii::$app->request->post()) && $model->create($model->super_admin === '0' ? FALSE : TRUE)) {
				Mailer::sendWelcomeMessage($model);

				Yii::$app->session->setFlash('success', 'User has been created');

				return $this->redirect(['index']);
			}

			return $this->render('create', ['model' => $model]);
		}

		public function actionConfirm($id)
		{
			$user = $this->findModel($id);
			$user->confirm();
			
			Yii::$app->getSession()->setFlash('success', 'User has been confirmed');

			return $this->redirect(Yii::$app->urlManager->createUrl('//user/admin/index'));
		}

		// todo: add more conditions

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
			$user = User::findOne(['id' => $id]);;

			if ($user === NULL) {
				throw new NotFoundHttpException('The requested page does not exist');
			}

			return $user;
		}

		public function actionDelete($id)
		{
			$model = $this->findModel($id);

			if ($id == Yii::$app->user->getId()) {
				Yii::$app->getSession()->setFlash('error', 'You can not remove your own account');
			} else {
				$model->delete();
				Yii::$app->getSession()->setFlash('success', 'User has been deleted');
			}

			return $this->redirect(['index']);
		}
	}