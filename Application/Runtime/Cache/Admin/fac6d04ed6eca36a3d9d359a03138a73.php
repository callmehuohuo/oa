<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	a=<?php echo ($a); ?>，b=<?php echo ($b); ?><br/>
	加法运算：a+b=<?php echo ($a+$b); ?><br/>
	减法运算：a-b=<?php echo ($a-$b); ?><br/>
	乘法运算：a*b=<?php echo ($a*$b); ?><br/>
	除法运算：a/b=<?php echo ($a/$b); ?><br/>
	取余运算：a%b=<?php echo ($a%$b); ?><br/>
	自增：<?php echo ($a++); ?>  <?php echo ++$a;?><br/>
	自减：<?php echo ($b--); ?>  <?php echo --$b;?>
</body>
</html>