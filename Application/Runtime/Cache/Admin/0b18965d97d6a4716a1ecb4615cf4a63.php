<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	/Public：表示站点根目录下的Public目录<br/>
	/index.php/Admin: 表示从域名后面开始寻找,一直找到分组名为止<br/>
	/index.php/Admin/Test：表示从域名后面开始寻找,一直找到控制器为止<br/>
	/index.php/Admin/Test/test6: 表示从域名后面开始寻找,一直找到方法为止<br/>
	/index.php/Admin/Test/test6：表示行域名开始寻找,一直找到最后
</body>
</html>