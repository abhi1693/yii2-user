<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 13-02-2015
	 * Time: 18:19
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\Profile;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	/**
	 * ProfileController shows users profiles.
	 */
	class ProfileController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'allow'   => TRUE,
							'actions' => ['index'],
							'roles'   => ['@']
						]
					]
				],
			];
		}

		/**
		 * Shows user's profile.
		 *
		 * @return \yii\web\Response
		 * @throws \yii\web\NotFoundHttpException
		 */
		public function actionIndex()
		{
			$profile = Profile::findOne(['uid' => Yii::$app->user->id]);

			if ($profile == NULL)
				throw new NotFoundHttpException;

			return $this->render('index', ['profile' => $profile]);
		}
	}