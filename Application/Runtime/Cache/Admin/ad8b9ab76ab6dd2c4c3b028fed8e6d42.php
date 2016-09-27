<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	$Think.server.path:<?php echo ($_SERVER['PATH']); ?><br/>
	$Think.get.id:<?php echo ($_GET['id']); ?><br/>
	$Think.request.pid:<?php echo ($_POST['pid']); ?>
	$Think.cookie.PHPSESSID:<?php echo (cookie('PHPSESSID')); ?><br/>
	$Think.config.URL_MODEL:<?php echo (C("URL_MODEL")); ?>
</body>
</html>