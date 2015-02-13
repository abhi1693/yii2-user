<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 13-02-2015
	 * Time: 18:19
	 */

	namespace abhimanyu\user\controllers;

	use abhimanyu\user\models\Profile;
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
						['allow' => TRUE, 'actions' => ['index'], 'roles' => ['@']]
					]
				],
			];
		}

		/**
		 * Shows user's profile.
		 *
		 * @param  integer $id
		 *
		 * @return \yii\web\Response
		 * @throws \yii\web\NotFoundHttpException
		 */
		public function index($id)
		{
			$profile = Profile::findOne(['uid' => $id]);

			if ($profile == NULL)
				throw new NotFoundHttpException;

			return $this->render('index', ['profile' => $profile]);
		}
	}