<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	现在是: <?php echo (date('Y-m-d H:i:s',$date)); ?><br/>
	字符串案例：<?php echo (substr(strtoupper($str),0,5)); ?>
</body>
</html>