<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 12-03-2015
 * Time: 10:08
 */

namespace abhimanyu\user\models;

use yii\base\Model;

class SettingsForm extends Model
{
	public $canRegister;
	public $canRecoverPassword;
	public $googleClientId;
	public $googleClientSecret;
	public $facebookClientId;
	public $facebookClientSecret;
	public $linkedInClientId;
	public $linkedInClientSecret;
	public $githubClientId;
	public $githubClientSecret;
	public $liveClientId;
	public $liveClientSecret;
	public $twitterConsumerKey;
	public $twitterConsumerSecret;
	public $rememberMeDuration;
	public $loginType;

	public function rules()
	{
		return [
			// Can Register
			['canRegister', 'boolean'],

			// Can Recover Password
			['canRecoverPassword', 'boolean'],

			// Google Authentication
			['googleClientId', 'string'],
			['googleClientSecret', 'string'],

			// Facebook Authentication
			['facebookClientId', 'string'],
			['facebookClientSecret', 'string'],

			// LinkedIn Authentication
			['linkedInClientId', 'string'],
			['linkedInClientSecret', 'string'],

			// Github Authentication
			['githubClientId', 'string'],
			['githubClientSecret', 'string'],

			// Live Authentication
			['liveClientId', 'string'],
			['liveClientSecret', 'string'],

			// Twitter Authentication
			['twitterConsumerKey', 'string'],
			['twitterConsumerSecret', 'string'],

			// Remember Me Duration
			['rememberMeDuration', 'integer'],
			['rememberMeDuration', 'required'],

			// Login Type: Email, Username or Both
			['loginType', 'integer'],
			['loginType', 'required']
		];
	}

	public function attributeLabels()
	{
		return [
			'canRegister'           => 'Allow Registration?',
			'canRecoverPassword'    => 'Allow Password Recovery?',
			'googleClientId'        => 'Google Client Id',
			'googleClientSecret'    => 'Google Client Secret',
			'facebookClientId'      => 'Facebook Client Id',
			'facebookClientSecret'  => 'Facebook Client Secret',
			'linkedInClientId'      => 'LinkedIn Client Id',
			'linkedInClientSecret'  => 'LinkedIn Client Secret',
			'githubClientId'        => 'Github Client Id',
			'githubClientSecret'    => 'Github Client Secret',
			'liveClientId'          => 'Live Client Id',
			'liveClientSecret'      => 'Live Client Secret',
			'twitterConsumerKey'    => 'Twitter Consumer Key',
			'twitterConsumerSecret' => 'Twitter Consumer Secret',
			'rememberMeDuration'    => 'Remember Me Duration (in seconds)',
			'loginType'             => 'Login Type'
		];
	}
}