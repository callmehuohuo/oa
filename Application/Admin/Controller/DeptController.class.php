<?php

//声明命名空间
namespace Admin\Controller;
//引入父类元素
use Think\Controller;
//声明并且继承父类
class DeptController extends CommonController
{
	#showList方法,展示数据显示模板
	public function showList()
	{
        #实例化
        $model = M('Dept');
        #查询
        $data = $model -> select();
        #遍历data使用二次查询出上级部门的名字
        foreach ($data as $key => $value) {
        	#判断pid是否大于0
        	if ($value['pid'] > 0) {
        		$info = $model -> find($value['pid']);
        		#保存name的值
        		$data[$key]['parentName'] = $info['name'];
        	}
        }
        #load方法引入tree.php
        load('@/tree');
        #无限极分类操作
        $data = getTree($data);
        #分配变量
        $this -> assign('data',$data);
        #展示模板
        $this -> display();
	}

	#add方法,展示添加页面的模板
	public function add()
	{
		#展示模板
		$this -> display(); 
	}
	
	#addOk方法,搜集数据并保存数据
	public function addOk()
	{
         #搜集数据
         #post = $_POST;
         $post = I('post.');
         #实例化模型
         $model = M('Dept');
         #数据入库
         $rst = $model -> add($post);
         #判断返回值
         if($rst){
         	#添加成功
         	$this -> success('添加成功',U('showList'),3);
         }else{
         	#添加失败
         	$this -> error('添加失败',U('add'),3);
         }
	}

	#del方法，实现删除
	public function del(){
		#接收参数
		$ids = I('get.ids');
		#实例化模型
		$model = M('Dept');
		#删除操作
		$rst = $model -> delete($ids);
		#判断返回值
		if($rst){
			#删除成功
			$this -> success('删除成功',U('showList'),3);
		}else{
			#删除失败
			$this -> error('删除失败',U('showList'),3);
		}
	}

	#edit方法,实现编辑
	public function edit()
	{
		#获取id
		$id = I('get.id');
		#查询原有的数据
		$model = M('Dept');
		#查询
		$data = $model -> find($id);
		#查询全部部门的信息
		$info = $model -> select();
		#传递给模板
		$this -> assign('data',$data);
		$this -> assign('info',$info);
		#展示模板
		$this -> display();
	}

	#editOk方法,实现数据入库
	public function editOk()
	{
		#接收数据
		$post = I('post.');
		#实例化
		$model = M('Dept');
		#写入
		$rst = $model -> save($post);
		#判断结果
		if ($rst !== false) {
			#成功
			$this -> success('修改成功',U('showList'),3);
		} else {
			#失败
			$this -> error('修改失败',U('edit',array('id' => $post['id'])),3);
		}
	}
}