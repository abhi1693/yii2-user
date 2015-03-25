Yii2-User
=========

[![Dependency Status](https://www.versioneye.com/user/projects/54e1e6490a910b6b0100023e/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54e1e6490a910b6b0100023e)
[![Code Climate](https://codeclimate.com/github/abhi1693/yii2-user/badges/gpa.svg)](https://codeclimate.com/github/abhi1693/yii2-user)
[![Latest Stable Version](https://poser.pugx.org/abhi1693/yii2-user/v/stable.svg)](https://packagist.org/packages/abhi1693/yii2-user) [![Total Downloads](https://poser.pugx.org/abhi1693/yii2-user/downloads.svg)](https://packagist.org/packages/abhi1693/yii2-user) [![Latest Unstable Version](https://poser.pugx.org/abhi1693/yii2-user/v/unstable.svg)](https://packagist.org/packages/abhi1693/yii2-user)

Yii2-User provides a web interface for advanced access control, user management and includes following features:

> **NOTE:** Module is not yet in alpha version. Use it on your own risk. Some features are missing. Anything can be changed at any time.

**Works only with [Yii2 app advanced startup kit](https://github.com/abhi1693/yii2-app-advanced-startup-kit)**

- Configurable Settings
    - Account(Login, Register, Password Reset, Password Recovery etc.)
    - Profile
    - Admin
- Notification Settings
- Ability to upload avatar
- Rbac Implementation
- Configurable Widgets
- All settings configurable via GUI

## Documentation

### Installation

This document will guide you through the process of installing Yii2-User using **composer**.

Add Yii2-User to the require section of your **composer.json** file:

```php
{
    "require": {
        "abhi1693/yii2-user": "*"
    }
}
```

And run following command to download extension using **composer**:

```bash
$ composer update
```

### Configuration

To enable module you should configure your application as follows:

```php
		'modules'    => [
		...
			'user'      => [
				'class'  => \abhimanyu\user\UserModule::className(),
			],
        ],
		'components' => [
		...
			'user'       => [
				'identityClass' => \abhimanyu\user\models\UserIdentity::className(),
				'loginUrl'      => ['/user/auth/login'],
			],
		],
```

### Updating database schema

Run application `Self-Test` to update the database. 

#### Why feature *X* is missing?
Because it is not implemented yet or will never be implemented. Check out roadmap.

#### How to contribute?

Contributing instructions are located in [CONTRIBUTING.md](CONTRIBUTING.md) file.

## Roadmap

- [x] User Registration
- [x] Password Retrieval
- [x] Account Management
- [x] Profile Management
- [ ] Console Commands
- [x] User Management Interface
- [x] Documentation
- [x] Compatibility with MySQL
- [ ] Compatibility with other databases
- [ ] Compatibility with other templates

## Change Log

Refer to [Change Logs](CHANGE.md)

## License

Yii2-user is released under the MIT License. See the bundled [LICENSE](LICENSE) for details.
