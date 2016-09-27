<?php
#名字空间
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明并且继承父类
class KnowledgeController extends CommonController
{
	#add方法
	public function add()
	{
		#展示模板
		$this -> display();
	} 

	#addOk方法
	public function addOk(){
		#接收数据
		$post =  I('post.');
		#判断是否有附件需要处理
		if($_FILES['thumb']['size'] > 0){
			#配置数组
			$cfg = array(
				'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
				);
			#实例化上传类
			$upload = new \Think\Upload($cfg);
			#正式上传操作
			$info = $upload -> uploadOne($_FILES['thumb']);
			#判断是否上传成功
			if($info){
				#picture字段
				$post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				#制作缩略图
				$image = new \Think\Image();//不需要传递参数
				#打开图片
				$image -> open(WORKING_PATH . $post['picture']);
				#操作过程
				$image -> thumb(50,50);//等比缩放原则
				#保存
				$image -> save(WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename']);
				#thumb字段
				$post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
			}
		}
		#addtime字段
		$post['addtime'] = time();
		#实例化模型
		$model = M('Knowledge');
		#写入操作
		$rst = $model -> add($post);
		#判断结果
		if($rst){
			#添加成功
			$this -> success('添加成功',U('showList'),3);
		}else{
			#添加失败
			$this -> error('你人品有问题',U('add'),3);
		}
	}
    
    #showList方法
    public function showList()
    {
        #实例化
        $model = M('Knowledge');
        #查询
        $data = $model -> select();
        $count = $model -> count();
        #分配变量
        $this -> assign("data",$data);
        $this -> assign('count',$count);
        #展示模板
        $this -> display();
    }
    #edit方法
    public function edit()
    {
    	#接收id
    	$id = I('get.id');
    	#实例化
    	$model = M('Knowledge');
        #查询
        $data = $model -> find($id);
        #传递给模板
        $this -> assign('data',$data);        
        #展示模板
    	$this -> display();
    }

    #editOk方法
	public function editOk(){
		#接收代码
		$post = I('post.');//$_POST
		#判断是否有文件上传
		if($_FILES['thumb']['size'] > 0){
			#配置
			$cfg = array(
				'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
				);
			#实例化
			$upload = new \Think\Upload($cfg);
			#上传单个文件
			$info = $upload -> uploadOne($_FILES['thumb']);
			#判断上传的结果
			if($info){
				#上传成功之后的操作
				#picture
				$post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				#制作缩略图
				$image = new \Think\Image();
				#打开图片,绝对路径
				$image -> open(WORKING_PATH . $post['picture']);
				#制作缩略图
				$image -> thumb(100,100);//等比缩放的原则
				#保存图片
				$image -> save(WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename']);
				#thumb字段
				$post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
			}
		}
		#数据入库
		$model = M('Knowledge');
		#入库
		$rst = $model -> save($post);
		#判断返回结果
		if($rst){
			#成功
			$this -> success('编辑成功',U('showList'),3);
		}else{
			#失败
			$this -> error('编辑失败',U('edit',array('id' => $post['id'])),3);
		}
	}
}