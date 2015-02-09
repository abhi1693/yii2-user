<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 09-02-2015
	 * Time: 17:54
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\User;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;

	/**
	 * Controller that manages user registration process.
	 */
	class RegistrationController extends Controller
	{
		/**
		 * @inheritdoc
		 */
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'allow'   => TRUE,
							'actions' => ['register'],
							'roles'   => ['?']
						]
					]
				],
			];
		}

		/**
		 *  Register the user
		 *
		 * @return string|\yii\web\Response
		 */
		public function actionRegister()
		{
			$model           = new User();
			$model->scenario = 'register';

			if ($model->load(Yii::$app->request->post()) && $model->register(FALSE, User::STATUS_PENDING)) {
				Yii::$app->session->setFlash('success', 'You\'ve successfully been registered. Check your mail to activate your account');

				return $this->redirect(Yii::$app->urlManager->createUrl('//user/auth/login'));
			}

			return $this->render('register', ['model' => $model]);
		}
	}