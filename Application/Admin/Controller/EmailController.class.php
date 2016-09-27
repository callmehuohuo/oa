<?php 
#命名空间
namespace Admin\Controller;
#引入父类
use Think\Controller;
#声明类并且继承父类
class EmailController extends CommonController
{
	#send方法,展示发送页面
	public function send()
	{
		#查询全部得用户列表
		$model = M('User');
		#查询,一般情况不允许给自己发送站内信,所以需要抛出用户自身
		$data = $model -> where('id != ' . session('uid')) -> select();
		#传递给模板
		$this -> assign('data',$data);
		#展示页面
		$this -> display();
    }
		
	#sendOk方法
	public function sendOk()
	{
        #post接收数据
        $post = I('post.');
        #判断是否有附件
        if ($_FILES['file']['size'] > 0) {
        	#配置
        	$cfg = array(
                  'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
        		);
        	#实例化
        	$upload = new \Think\Upload($cfg);
        	#上传操作
        	$info = $upload -> uploadOne($_FILES['file']);
        	#判断上传结果
        	if ($info) {
        		#上传成功的处理
        		#hasfile字段
        		$post['hasfile'] = 1;
        		#hasfile字段
        		$post['filename'] = $info['name'];
        		#file字段
        		$post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
        	}
        }
        #from_id字段,当前用户的id
        $post['from_id'] = session('uid');
        #addtime字段
        $post['addtime'] = time();
        #入库
        $model = M('Email');
        #入表
        $rst = $model -> add($post);
        #判断写入结果
        if ($rst) {
        	#成功
        	$this -> success('邮件发送成功',U('sendBox'),3);
        } else {
        	#失败
        	$this -> error('发送邮件失败',U('send'),3);
        }
	}
	#sendBox方法
	public function sendBox()
	{
		#select t1.*,t2.truename as truename from tp_email as t1,tp_user as t2 where t1.to_id = t2.id and from_id = session('uid');
		#实例化模型
		$model = M('Email');
		# 连贯操作
		$data = $model -> field('t1.*,t2.truename as truename') -> table('tp_email as t1,tp_user as t2') -> where('t1.to_id = t2.id and from_id = ' . session('uid')) -> select();
		$count = $model -> count();
		#传递给模板
		$this -> assign('data',$data);
		$this -> assign('count',$count);
		#展示模板
		$this -> display();
	}

	#download方法
	public function download()
	{
		#获取id
		$id = I('get.id');
		#查询操作
		$model = M('Email');
		#查询
		$data = $model -> find($id);
		#下载
		$file = WORKING_PATH . $data['file'];
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header("Content-Length: ". filesize($file));
		readfile($file);
	}

	#del方法
	public function del()
	{
		#接收id
		$id = I('get.id');
		#删除操作,条件是id = $id, 另一条件 isread = 0, from_id = session['uid']
		$model = M('Email');
		$rst = $model -> where("id = $id and isread = 0 and from_id = " . session('uid')) -> delete();
		#判断结果
	    if ($rst) {
	    	#成功
	    	$this -> success('撤回成功',U('sendBox'),3);
	    } else {
	    	#失败
	    	$this -> error('撤回失败',U('sendBox'),3);
	    }
	}

	#getContent方法
	public function getContent()
	{
		#接收id
		$id = I('get.id');
		#实例化
		$model = M('Email');
		#查询
		$data = $model -> find($id);
		#输出邮件内容
	    echo $data['content'];
	}

	#recBox方法
	public function recBox()
	{
		#实例化模型
		$model = M('Email');
		$data = $model -> field('t1.*,t2.truename as truename') -> table('tp_email as t1,tp_user as t2') -> where('t1.from_id = t2.id and to_id = ' . session('uid')) -> select();
		#传递变量
		$this -> assign('data',$data);
		#展示模板
		$this -> display();
	}

	#setStatus方法
	public function setStatus($id)
	{
		#实例化
		$model = M('Email');
		#更新修改操作
		$model -> save(array('id' => $id,'isread' => 1));
    }

    #getMsgCount方法
	public function getMsgCount(){
		//当前用户 未读邮件 数量
		$model = M('Email');
		#查询
		$count = $model -> where('isread = 0 and to_id = ' . session('uid')) -> count();
		#输出
		echo $count;
	}
}
