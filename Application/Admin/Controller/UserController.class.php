<?php
#命名空间
namespace Admin\Controller;
#引入父类
use Think\Controller;
#定义类
class UserController extends CommonController
{
	#添加职员,展示添加职员模板
	public function add()
	{
		#查出各级部门
		#实例化模型
		$model = M('Dept');
		#查询
		$data = $model -> select();
		#分配变量
	    $this -> assign('data',$data);
	    #展示模板
		$this -> display();
	}
	#添加职员方法addOk,
	public function addOk()
	{
		#获取数据
		$post = I('post.');
		#模型实例化
		$model = M('User');
		#数据入库
		$rst = $model -> add($post);
        #判断是否写入成功
        if ($rst) {
             $this -> success('添加成功',U('showlist'),3);
        } else {
             $this -> error('添加失败',U('add'),3);
        }
	}	

	#职员列表方法, 展示职员列表模板
	public function showList()
	{
		#模型实例化
		$model = M('User');
		#1、查询总的记录数
		$count = $model -> count();
        #2、实例化分页类,传递总的记录数,每页显示3条记录
        $page = new \Think\Page($count,3);
        #可选步骤,定义按钮提示文字
        //每页显示的页码数,如果需要显示出首页/末页,则要求这个页码必须要小于分页的总的页码数
        $page -> rollPage = 3;
        #让最后一页不显示数字
        $page -> lastSuffix = false;
        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $page -> setConfig('first','首页');
        $page -> setConfig('last','末页');
        #3、组装页码地址
        $show = $page -> show();
        #4、通过limit方法限制输出的记录数
		#联表查询
		#$sql = select t1.*,t2.name as deptname from tp_user as t1,tp_dept as t2 where t1.sort = t2.sort;
		$data = $model -> limit($page -> firstRow,$page -> listRows) -> field('t1.*,t2.name as deptname') -> table('tp_user as t1,tp_dept as t2') -> where('t1.dept_id = t2.id') ->select();
		#分配变量
		$this -> assign('show',$show);
		$this -> assign('data',$data);
		$this -> assign('count',$count);
		#展示模板
		$this -> display();
	}

	#charts方法,获取统计数据,然后展示模板
	public function charts()
	{
        #select t2.name,count(*) as count from tp_user as t1,tp_dept as t2 where t1.dept_id = t2.id group by t2.name;
        #实例化模型
        $model = M();
        #连贯操作查询
        $data = $model -> field('t2.name,count(*) as count') 
        			   -> table('tp_user as t1,tp_dept as t2') 
        			   -> where('t1.dept_id = t2.id') 
        			   -> group('t2.name') 
        			   -> select();
        // 定义字符串
		$str = '[';
		foreach ($data as $key => $value) {
				$str .= "['". $value['name']."',".$value['count']."],";
		}
		// #去除最后一个多余逗号
		$str = rtrim($str,',') . ']';
        //$str = json_encode($data);
        #传递数据给模板
        $this -> assign('str',$str);
        #展示模板
        $this -> display();
	}
}
 
