<?php
#声明空间
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明和继承
class EmptyController extends Controller
{
	#空方法
	public function _empty()
	{
		#展示错误模板
		$this -> display('Empty/error');
	}
}