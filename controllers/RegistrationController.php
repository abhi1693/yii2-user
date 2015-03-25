<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 09-02-2015
 * Time: 17:54
 */

namespace abhimanyu\user\controllers;

use abhimanyu\user\Mailer;
use abhimanyu\user\models\User;
use abhimanyu\user\models\UserIdentity;
use abhimanyu\user\UserModule;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
						'allow'         => TRUE,
						'actions'       => ['register', 'confirm'],
						'roles'         => ['?'],
						'matchCallback' => function ($rule, $action) {
							if (UserModule::$canRegister)
								return TRUE;

							return FALSE;
						}
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
		$model = new User();
		$model->scenario = 'register';

		if ($model->load(Yii::$app->request->post()) && $model->register(FALSE, User::STATUS_PENDING)) {
			// Send Welcome Message to activate the account
			Mailer::sendWelcomeMessage($model);

			Yii::$app->session->setFlash(
				'success', Yii::t('user', 'You\'ve successfully been registered. Check your mail to activate your account'));

			return $this->redirect(Yii::$app->urlManager->createUrl('//user/auth/login'));
		}

		return $this->render('register', ['model' => $model]);
	}

	/**
	 * Confirms user's account.
	 *
	 * @param integer $id   User Id
	 * @param string  $code Activation Token
	 *
	 * @return string
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionConfirm($id, $code)
	{
		$user = UserIdentity::findByActivationToken($id, $code);

		if ($user == NULL)
			throw new NotFoundHttpException;

		if (!empty($user)) {
			$user->activation_token = NULL;
			$user->status = User::STATUS_ACTIVE;
			$user->save(FALSE);

			Yii::$app->session->setFlash('success', Yii::t('user', 'Account ' . $user->email . ' has successfully been activated'));
		} else
			Yii::$app->session->setFlash('error', Yii::t('user', 'Account ' . $user->email . ' could not been activated. Please contact the Administrator'));

		return $this->render('confirm', ['user' => $user]);
	}


}