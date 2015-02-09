<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 09-02-2015
	 * Time: 18:14
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\AccountRecoverPasswordForm;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;

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
							'actions' => ['recover-password'],
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
	}