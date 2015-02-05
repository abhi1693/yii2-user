<?php

	namespace abhimanyu\helpers\enum;

	use abhimanyu\enum\helpers\BaseEnum;

	class UserStatus extends BaseEnum
	{
		const BLOCKED = 0;
		const ACTIVE = 1;
		const PENDING = 2;
	}