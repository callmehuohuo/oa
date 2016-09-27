<?php
#声明并继承
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明并继承
class TestController extends Controller{

	#index方法,模板展示
    public function index(){
    	#第一种方法
    	$this -> display();
    	#第二种方法
    	#$this -> display('index2');
    	#第三种方法
    	#$this -> display('Index\test');
    }

    #test1方法
    public function test1()
    {
    	echo time();
    }

    #tets2 u方法的测试
    public function test2()
    {
    	#生成当前控制器下index方法的访问地址
    	echo U('index') . "<br/>";
    	#生成Index控制器下的index方法的地址
    	echo U('Index/index') . "<br/>";
    	#生成当前控制器下index方法的访问地址并且传递参数id=1
    	echo U('index',array('id' => 1));
    }

    #test3方法,成功跳转
    public function test3(){
    	#成功跳转
    	$this -> success('执行成功',U('test1'));
    }

    #test4方法,跳转失败
    public function test4(){
    	#跳转失败
    	$this -> error('执行失败',U('test1'));
    }

    #test5,变量的传递,分配
    public function test5(){
    	#定义变量
    	$date = date('Y-m-d H:i:s',time());
    	#传递变量
    	$this -> assign('date',$date);
    	#展示模板
    	$this -> display();
    }

    #test6,展示模板,模板常量替换机制
    public function test6(){
    	#展示模板
    	$this -> display();
    }

    #test7,展示模板,模板中的注释
    public function test7()
    {
        #展示模板
        $this -> display();
    }

    #test8,输出一维数组
    public function test8()
    {
        #定义一维数组
        $arr = array('西游记','水浒炸','三国演义','红楼梦');
        #分配变量
        $this -> assign('arr',$arr);
        #展示模板
        $this -> display();
    }

    #test9, 输出二维数组
    public function test9()
    {
        #定义二位数组
        $arr = array(
              array('name' => 'xiaoming','sex' => '男', 'age' => 13),
              array('name' => 'xiaohei','sex' => '女','age' => 65)
            );
        #传递给模板
        $this -> assign('arr',$arr);
        #展示模板
        $this -> display();
    }

    #test10,对象的输出
    public function test10(){
        #实例化对象
        $stu = new Stu;//如果实例化的时候不引入类文件,则实例化当前命名空间下
        #给Stu添加几个属性
        $stu -> id = 1;
        $stu -> name = '韩梅梅';
        $stu -> name2 = '李磊';
        #将对象传递给模板
        $this -> assign('stu',$stu);
        #展示模板
        $this -> display(); 
    }

    #test11,系统变量
    public function test11()
    {
        #展示模板
        $this -> display();
    } 

    #test12,模板中使用函数格式化时间戳
    public function test12()
    {
        #时间戳
        $date = time();
        #定义字符串
        $str = 'REurgTUTT';
        #传递给模板
        $this -> assign('date',$date);
        $this -> assign('str',$str);
        #展示模板
        $this -> display();
    }

    #test13，默认值
    public function test13(){
        #定义签名
        $sign = '';
        #传递
        $this -> assign('sign',$sign);
        #展示模版
        $this -> display();
    }

    #test14，运算符
    public function test14(){
        #定义两个变量
        $a = 10;
        $b = 2;
        #传递给模版
        $this -> assign('a',$a);
        $this -> assign('b',$b);
        #展示模版
        $this -> display();
    }


    #顶部
    public function head()
    {
        $this ->　display();
    }

    #中间
    public function body()
    {
        $this -> display();
    }

    #尾部
    public function foot()
    {
        $this -> display();
    }

    #volist的遍历
    public function test15()
    {
        #定义数组
        $arr = array('西游记','三国','红楼梦','水浒传');
        $arr2 = array(
              array('猴哥','八戒','师傅'),
              array('孙早','书吧','昆明'),
              array('林黛玉','贾宝玉','叙宝钗',''),
              array('手机','GAOQIU','XIMENQIN')
            );
        #传递给模板
        $this -> assign('arr',$arr);
        $this -> assign('arr2',$arr2);
        #模板展示
        $this -> display();
    }

    #test16, if标签
    public function test16()
    {
        #输出今天是星期几
        $day = date('N');
        #传递给模板
        $this -> assign('day',$day);
        #展示模板
        $this -> display();
    }

    #test17,php标签
    public function test17()
    {
         #展示模板
         $this ->　display();
    }

    #test18 普通实例化方式
    public function test19()
    {
        #实例化模型
        $model = D('Dept');
        dump($model);
    }
    
    #test20,快速实例化方式
    public function test20()
    {
         #实例化模型
         $model = M();
         dump($model);
    }

    #test21,增加操作
    public function test21()
    {
        #实例化模型
        $model = M('Dept');
        #定义数组
        $data = array(
                'name'  =>  '总裁办',
                'pid'   =>  '1',
                'sort'  =>  '2',
                'remark'=> '总裁部门'
            );
        #增加操作
        $rst = $model -> add($data);
        dump($rst);
    }

    #test22,修改操作
    public function test22()
    {
        #实例化模型
        $model = M('Dept');
        #定义数组
        $data = array(
              'id'   => '5',
              'name' => '技术部门'
            );
        #修改
        $rst = $model -> save($data);
        dump($rst);
    }

    #test23,查询操作
    public function test23()
    {
        #实例化模型
        $model = M('Dept');
        #find
        $data = $model -> find();//等价于limit1
        $data = $model -> find(9);
        #select
        $data = $model -> select();
        $data = $model -> select(9);
        $data = $model -> select('6,9');
        dump($data); 
    }
    
    #test24  删除操作
    public function test24()
    {
         #实例化模型
        $model = M('Dept');
        #定义数组
        $data = array(
              'id'   => '5',
              'status' => '1'
            );
        #修改
        $rst = $model -> save($data);
        dump($rst);
    }

    #test26, sql调试
    public function test26()
    {
        #实例化模型
        $model = M('Dept');
        #查询
        $rst = $model -> find(4);
        #sql 语句
        //echo $model -> getLastSql();
        echo $model -> _sql();
    }

    #test27 行能统计
    public function test27()
    {
        #开始标记
        G('start');
        for ($i = 0; $i < 10000;$i++) {

        }
        #结束标记
        G('end');
        #输出执行时间
        echo G('start','end',6);
    }

    #test28,AR模式增加操作
    public function test28()
    {
        #实例化模型
        $model = M('Dept');
        #AR  数据
        $model -> name = '行政部';
        $model -> pid  = '0';
        $model -> sort = '2';
        $model -> remark = '管理行政的部门';
        #增加操作
        $rst = $model -> add();
        dump($rst);
    }

    #test19  AR模式的修改
    public function test29()
    {
         #实例化操作
         $model = M('Dept');
         #ar数据
         #$model -> id ='5';
         $model ->　status = '1';
         #修改操作
         $model -> find(7);
         $rst = $model -> save();
         dump($rst);
    }

    #test30,AR模式的删除操作
    public function test30()
    {
        #实例化
        $model = M('Dept');
        #数据
        $model -> id = 7;
        #删除操作
        $rst = $model -> delete();
        dump($rst);
    } 

    #test31, where方法
    public function test31()
    {
        #实例化模型
        $model = M('Dept');
        #设置条件
        $model -> where('id = 8');
        #查询
        $data = $model -> select();
        dump($data);
    }

    #limit方法, test32
    public function test32()
    {
        #模型实例化
        $model = M('Dept');
        #限制记录输出数量
        $model -> limit(1);
        #查询
        $data = $model -> select();
        dump($data);
    }

    #test33,field方法
    public function test33()
    {
        #实例化模型
        $model = M('Dept');
        #限制字段
        $model -> field('id,name');
        #查询
        $data = $model -> select();
        dump($data);
    }

    #test34, order方法
    public function test34()
    {
        #实例化模型
        $model = M('Dept');
        #排序
        $model -> order('id desc');
        #查询
        $data = $model -> select();
        dump($data);
    }

    #test35, group方法
    public function test35()
    {
        #实例化模型
        $model = M('Dept');
        #操作
        //$model -> group('name');
        //$model -> field('name,count(*) as count');
        #连贯操作
        $data = $model -> group('name') -> field('name,count(*) as count') -> select();
        dump($data);
    }
    
    #test36,count方法
    public function test36()
    {
        #实例化模型
        $model = M('Dept');
        #求取总数
        $data = $model -> count();
        dump($data);
    } 

    #test37,max方法
    public function test37()
    {
        #实例化模型
        $model = M('Dept');
        #查询指定字段的最大值
        $max = $model -> max('id');
        dump($max);
    }
    #test38,min方法
    public function test38()
    {
        #实例化模型
        $model = M('Dept');
        #查询指定字段的最小值
        $min = $model -> min('id');
        dump($min);
    }
    #test39,avg方法
    public function test39()
    {
        #实例化模型
        $model = M('Dept');
        #查询指定字段的平均值
        $avg = $model -> avg('id');
        dump($avg);
    }
    #test40, sum方法
    public function test40()
    {
        #实例化模型
        $model = M('Dept');
        #查询总和
        $sum = $model -> sum('id');
        dump($sum);
    }

    #test41,特殊的实例化
    public function test41()
    {
        #实例化
        $model = D('Stu');
        dump($model);
    }

    #test42, fetchSql方法
    public function test42()
    {
        #实例化
        $model = M('Dept');
        #查询
        $data = $model ->fetchSql(true) -> where('id > 6')  -> limit(2) -> select();
        dump($data); 
    }

    #test43, session的使用
    public function test43()
    {
        #1、设置session
        session('name','lilei');
        dump($_SESSION);
        #2、获取session
        dump(session('name'));//$_SESSION['name'];
        #3、删除耽搁session
        session('name',null);
        dump($_SESSION);
        #4、删除全部
        session('name1','hanmeimei');
        session('name2','madongmei');
        #session(null);
        dump($_SESSION);
        #5、获取全部
        dump(session());
        #6、判断某个session是否存在
        dump(session('?name1'));
    }

    #test44, cookie的支持
    public function test44()
    {
        #1、设置cookie
        cookie('name','meimei');
        cookie('name1','hanmeimei',3600);
        #3、获取cookie
        dump(cookie('name1'));
        #4、删除单个
        cookie('name',null);
        #5、删除全部
        #cookie(null);
        #6、获取全部
        dump(cookie());
    }

    #test45,自定义函数库使用
    public function test45()
    {
        #调用函数的语法就是和php内置函数语法一样
        gbk2utf8();
    }

    #test46,动态加载函数的调用
    public function test46()
    {
        #调用函数的语法就是使用php内置函数语法一样
        test_run();
    }

    #test47,使用load方法调用getInfo函数
    public function test47()
    {
        #load方法载入
        load('@/info');
        #函数的调用方法就是和使用php内置函数语法一样
        getInfo();
    }

    #test48,常规验证码
    public function test48()
    {
        #配置
        $cfg = array(
              'fontSize'  => 14,
              'useCurve'  => false,
              'useNoise'  => false,
              'imageH'    => 0,
              'imageW'    => 0,
              'length'    => 4,
              'fontttf'   => '4.ttf'
            );
        #实例化验证码类
        $verify = new \Think\Verify($cfg);
        #输出验证码
        $verify -> entry();
    }
}
