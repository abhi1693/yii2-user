<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 09-02-2015
	 * Time: 18:14
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\AccountRecoverPasswordForm;
	use abhimanyu\user\models\User;
	use abhimanyu\user\models\UserIdentity;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	class RecoveryController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'allow'   => TRUE,
							'actions' => ['recover-password', 'reset'],
							'roles'   => ['?']
						]
					]
				]
			];
		}

		/**
		 * Sends password recovery mail to the user
		 *
		 * @return string
		 */
		public function actionRecoverPassword()
		{
			$model = new AccountRecoverPasswordForm();

			if ($model->load(Yii::$app->request->post())) {
				if ($model->validate()) {
					$model->recoverPassword();
				}
			}

			return $this->render('recoverPassword', ['model' => $model]);
		}

		/**
		 * @param integer $id   User Id
		 * @param string  $code Password Reset Token
		 *
		 * @return string
		 * @throws \yii\web\NotFoundHttpException
		 */
		public function actionReset($id, $code)
		{
			$user            = UserIdentity::findByPasswordResetToken($id, $code);
			$model           = new User();
			$model->scenario = 'reset';

			if ($user == NULL)
				throw new NotFoundHttpException;

			if (!empty($user)) {
				if ($model->load(Yii::$app->request->post())) {
					if ($model->validate()) {
						$model->password_reset_token = NULL;
						$model->save();

						Yii::$app->session->setFlash('success', 'Your password has successfully been changed. Now you
						 can login with your new password.');

						return $this->redirect(['//user/auth/login']);
					}
				}
			}

			return $this->render('reset', ['user' => $user]);
		}
	}