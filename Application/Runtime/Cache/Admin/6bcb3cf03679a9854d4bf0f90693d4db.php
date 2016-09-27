<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	箭头形式：<?php echo ($stu -> id); ?> - <?php echo ($stu -> name); ?> - <?php echo ($stu -> name2); ?><br/>
	冒号形式：<?php echo ($stu->id); ?> - <?php echo ($stu->name); ?> - <?php echo ($stu->name2); ?>
</body>
</html>