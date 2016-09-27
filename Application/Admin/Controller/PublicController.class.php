<?php
#声明命名空间
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明类并且继承父类
class PublicController extends Controller{

	#login方法
	public function login(){
		#展示模版
		$this -> display();
		#使用fetch方法获取模版内容
		#$code = $this -> fetch();
		#echo $code;
	}

	#验证码
	public function captcha(){
		#配置
		$cfg = array(
				'fontSize'  =>  10,              // 验证码字体大小(px)
		        'useCurve'  =>  false,            // 是否画混淆曲线
		        'useNoise'  =>  false,            // 是否添加杂点	
		        'imageH'    =>  40,               // 验证码图片高度
		        'imageW'    =>  75,               // 验证码图片宽度
		        'length'    =>  4,               // 验证码位数
		        'fontttf'   =>  '4.ttf',          // 验证码字体，不设置随机获取
			);
		#实例化
		$verify = new \Think\Verify($cfg);	
		#画图
		$verify -> entry();
	}

	#登录验证
	public function check(){
		#接收数据
		$post = I('post.');
		#验证验证码
		$verify = new \Think\Verify();//不需要传递配置
		#验证
		$rst = $verify -> check($post['captcha']);
		#判断验证码是否正确
		if($rst){
			#判断用户名和密码
			$model = M('User');
			#删除验证码元素
			unset($post['captcha']);
			#查询
			$data = $model -> where($post) -> find();
			#判断用户是否存在
			if($data){
				#会话控制记录用户登录信息
				session('uid',$data['id']);//记录用户id
				session('uname',$data['username']);//记录用户名
				session('role_id',$data['role_id']);//记录用户角色id
				#提示
				$this -> success('登录成功！',U('Index/index'),3);
			}else{
				#用户名或密码错误
				$this -> error('用户名或密码错误',U('login'),3);
			}
		}else{
			#验证码错误
			$this -> error('验证码错误...',U('login'),3);
		}
	}

	#用户退出
	public function logout()
	{
		#清空session
		session(null);
		if (!session('?uid')) {
			#清空成功
			$this -> success('退出成功',U('login'),3);
		}
	}

}