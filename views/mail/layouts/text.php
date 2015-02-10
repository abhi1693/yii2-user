<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 10-02-2015
	 * Time: 16:46
	 */

	/**
	 * @var $content string main view render result
	 */
?>

<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>