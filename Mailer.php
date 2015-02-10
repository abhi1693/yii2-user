<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 10-02-2015
	 * Time: 17:08
	 */

	namespace abhimanyu\user;

	use abhimanyu\user\models\User;
	use Yii;
	use yii\base\Component;

	class Mailer extends Component
	{
		/**
		 * Sends welcome mail to the user upon registration
		 *
		 * @param \abhimanyu\user\models\User $user
		 *
		 * @return bool
		 */
		public static function sendWelcomeMessage(User $user)
		{
			return Mailer::sendMail($user->email, 'Welcome to ' . Yii::$app->name, 'welcome', ['user' => $user]);
		}

		/**
		 * Sends mail using the Swift Mailer
		 *
		 * @param string       $to      Senders Email
		 * @param string       $subject Message Subject
		 * @param string|array $view    Message View
		 * @param array        $params  Message Parameters
		 *
		 * @return bool
		 */
		protected function sendMail($to, $subject, $view, $params = [])
		{
			$mailer           = Yii::$app->mailer;
			$mailer->viewPath = '@abhimanyu/user/views/mail';

			return $mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
				->setTo($to)
				->setFrom(Yii::$app->config->get('mail.username'), 'no@reply.com')
				->setSubject($subject)
				->send();
		}

		/**
		 * Sends password recovery mail to the user
		 *
		 * @param \abhimanyu\user\models\User $user
		 *
		 * @return bool
		 */
		public static function sendRecoveryMessage(User $user)
		{
			return Mailer::sendMail($user->email, 'Password Recovery', 'recovery', ['user' => $user]);
		}
	}