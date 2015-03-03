<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 01-03-2015
	 * Time: 22:08
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\Profile;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;

	class AccountController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'actions' => ['profile', 'avatar'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				]
			];
		}

		public function actionProfile()
		{
			$profile = Profile::findOne(['uid' => \Yii::$app->user->getId()]);

			if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
				Yii::$app->getSession()->setFlash('User Profile successfully updated');
			}

			return $this->render('profile', ['profile' => $profile]);
		}

		public function actionAvatar()
		{
			$profile = Profile::findOne(['uid' => \Yii::$app->user->getId()]);

			return $this->render('avatar', ['profile' => $profile]);
		}
	}