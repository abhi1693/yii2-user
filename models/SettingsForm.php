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
		];
	}

	public function attributeLabels()
	{
		return [
			'canRegister'          => 'Allow Registration?',
			'canRecoverPassword'   => 'Allow Password Recovery?',
			'googleClientId'       => 'Google Client Id',
			'googleClientSecret'   => 'Google Client Secret',
			'facebookClientId'     => 'Facebook Client Id',
			'facebookClientSecret' => 'Facebook Client Secret',
		];
	}
}