<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 20-02-2015
 * Time: 14:12
 */

namespace abhimanyu\user\controllers;

use abhimanyu\user\Mailer;
use abhimanyu\user\models\Profile;
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
						'actions' => ['index', 'delete', 'create', 'confirm', 'update', 'block'],
						'allow'   => TRUE,
						'roles'   => ['@'],
					],
				],
			],
			'verb'   => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete'  => ['post'],
					'confirm' => ['post'],
					'block'   => ['post']
				]
			]
		];
	}

	public function actionIndex()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel'  => $searchModel
		]);
	}

	public function actionCreate()
	{
		$model = new User();
		$model->scenario = 'create';

		if ($model->load(Yii::$app->request->post()) && $model->create($model->super_admin === '0' ? TRUE : FALSE)
		) {
			Mailer::sendWelcomeMessage($model);

			Yii::$app->session->setFlash('success', Yii::t('user', 'User has been created'));

			return $this->redirect(['index']);
		}

		return $this->render('create', ['model' => $model]);
	}

	public function actionConfirm($id)
	{
		$user = $this->findModel($id);
		$user->confirm();

		Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User has been confirmed'));

		return $this->redirect(Yii::$app->urlManager->createUrl('//user/admin/index'));
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
		$user = User::findOne(['id' => $id]);;

		if ($user === NULL) {
			throw new NotFoundHttpException(Yii::t('user', 'The requested page does not exist'));
		}

		return $user;
	}

	public function actionUpdate($id)
	{
		$user = $this->findModel($id);
		$user->scenario = 'update';
		$profile = Profile::findOne(['uid' => $id]);

		if ($user->load(Yii::$app->request->post()) &&
			$profile->load(Yii::$app->request->post()) &&
			$user->save() &&
			$profile->save()
		) {
			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User has been successfully updated'));
		}

		return $this->render('update', ['user' => $user, 'profile' => $profile]);
	}

	public function actionBlock($id)
	{
		if ($id == Yii::$app->user->getId()) {
			Yii::$app->getSession()->setFlash('error', Yii::t('user', 'You can not block your own account'));
		} else {
			$user = $this->findModel($id);
			if ($user->getIsBlocked()) {
				$user->unblock();
				Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User has been unblocked'));
			} else {
				if ($user->getIsConfirmed()) {
					$user->block();
					Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User has been blocked'));
				} else {
					Yii::$app->getSession()->setFlash('error', Yii::t('user', 'User cannot be blocked'));
				}
			}
		}

		return $this->redirect(Yii::$app->urlManager->createUrl('//user/admin/index'));
	}

	public function actionDelete($id)
	{
		// todo: add more conditions
		$model = $this->findModel($id);

		if ($id == Yii::$app->user->getId()) {
			Yii::$app->getSession()->setFlash('error', Yii::t('user', 'You can not remove your own account'));
		} else {
			$model->delete();
			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User has been deleted'));
		}

		return $this->redirect(['index']);
	}
}