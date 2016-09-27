<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
    中括号形式：
	<?php echo ($arr[0]['name']); ?>-<?php echo ($arr[0]['sex']); ?>-<?php echo ($arr[0]['age']); ?><br/>
	<?php echo ($arr[1]['name']); ?>-<?php echo ($arr[1]['sex']); ?>-<?php echo ($arr[1]['age']); ?> <br/>
	点形式：
	<?php echo ($arr["0"]["name"]); ?>-<?php echo ($arr["0"]["sex"]); ?>-<?php echo ($arr["0"]["age"]); ?>
	<?php echo ($arr["1"]["name"]); ?>-<?php echo ($arr["1"]["sex"]); ?>-<?php echo ($arr["1"]["age"]); ?>
</body>
</html>