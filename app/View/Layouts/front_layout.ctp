<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');

		echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css');
		echo $this->Html->css('http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=Indie+Flower|Poor+Story');
		echo $this->Html->css('front_layout.css');

		echo $this->fetch('css');

	?>
</head>

<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('Navbar/navLoggedOut'); ?>
			<?php echo $this->Session->flash(); ?>
		</div>

		<div id="content">

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		<?php echo $this->element('Footer/footerGlobal'); ?>

		</div>
	</div>
	<?= $this->Html->script('https://code.jquery.com/jquery-1.11.1.min.js'); ?>
	<?= $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'); ?>
	<?= $this->fetch('script'); ?>
</body>
</html>
