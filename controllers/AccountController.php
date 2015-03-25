<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 01-03-2015
	 * Time: 22:08
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\Profile;
	use abhimanyu\user\models\UserIdentity;
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
							'actions' => ['profile', 'avatar', 'upload-avatar'],
							'allow'   => TRUE,
							'roles'   => ['@'],
						],
					],
				]
			];
		}

		public function actionProfile()
		{
			$profile = Profile::findOne(['uid' => Yii::$app->user->getId()]);

			if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
				Yii::$app->getSession()->setFlash(Yii::t('user','User Profile successfully updated'));
			}

			return $this->render('profile', ['profile' => $profile]);
		}

		public function actionAvatar()
		{
			$profile = Profile::findOne(['uid' => Yii::$app->user->getId()]);

			return $this->render('avatar', ['profile' => $profile]);
		}

		public function actionUploadAvatar()
		{
			if (isset($_FILES['avatar'])) {
				$avatar = $_FILES['avatar'];
				$path = '../vendor/abhi1693/yii2-user/uploads/profile_image/';

				$model         = Profile::findOne(['uid' => Yii::$app->user->getId()]);
				$model->avatar = 'vendor/abhi1693/yii2-user/uploads/profile_image/' . $avatar['name'];

				if ($model->save())
					if (move_uploaded_file($avatar['tmp_name'], $path . $avatar['name']))
						return json_encode((object)NULL);
					else {

						return json_encode(['error' => 'An Error Occurred. Please try again!']);
					}
			}

			return json_encode(['error' => 'An Error Occurred. Please try again!']);
		}

		public function actionEmail()
		{
			$user = UserIdentity::findByUsername(Yii::$app->user->identity->username);

			return $this->render('email', ['user' => $user]);
		}
	}