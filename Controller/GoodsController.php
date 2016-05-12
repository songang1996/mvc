<?php

//商品控制器,专门处理业务逻辑
class GoodsController extends Controller
{

	public function index()
	{
		echo 1;
	}

	//提供表单的方法
    public function add()
    {
    	// echo 1;die;
    	$this->display('add');
    }
    public function capcha()
    {
    	// session_start();
		require 'Public/yan/ValidateCode.class.php';  //先把类包含进来，实际路径根据实际情况进行修改。
		$_vc = new ValidateCode();		//实例化一个对象
		$_vc->doimg();		
		$_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中
    }

    public function login()
    {
    	$this->display('login');
    }
    public function loginok()
    {	
    	// print_r($_POST);die;
		if(isset($_POST["validate"]))
		{	

			$validate=$_POST["validate"];
			echo 'sessionshi::'.$_SESSION["authnum_session"].'<br>';
			echo "您刚才输入的是：".$_POST["validate"]."<br>状态：";
			
			if($validate!=$_SESSION["authnum_session"])
			{
				//判断session值与用户输入的验证码是否一致;
				echo "<font color=red>输入有误</font>"; 
			}
			else
			{
				echo "<font color=green>通过验证</font>"; 
			}
		} 
    }
    //入库操作的方法
    public function addok()
    {
	    $data=$_POST;
	    // var_dump($data);die;
	    // echo 1;die;
		$goods = new GoodsModel();
		// $this->db= new GoodsModel();

		//调用model方法 
		if($goods->addgoods('goods',$data))
		{
		  echo '添加成功';
		}
		else
		{
		  echo '添加失败';
		}
    }

  	//显示所有的商品的方法
  	public function lists()
  	{
	  //获取数据，展示在静态页面
	  $goods = new GoodsModel();
	  $arr = $goods->getAll('goods');
	  // $data=$goods->getAll();
	  // var_dump($arr);
	  // print_r($arr);
	  $this->display('list',$arr);
  	}

  	//查询 总数
  	public function count()
  	{
  		  //获取数据，展示在静态页面
	  $goods = new GoodsModel();
	  $arr = $goods->getCount('goods');
	  // print_r($arr);
	  echo $arr;
  	}


  	//删除方法
  	public function del()
  	{
	    $g_id=$_GET['g_id'];
		//echo $g_id;
		$goods=new GoodsModel();
		if($goods->del($g_id))
		{
		   echo '删除成功';
		   header('refresh:3;index.php?m=Goods&a=lists');
		}
		else
		{
		   echo '删除失败';
		   header('refresh:3;index.php?m=Goods&a=lists');
		}
  	}

  	//修改的方法
    public function update()
    {
      //接收ID值，显示出该ID的信息
	  $g_id=$_GET['id'];
	  //echo $g_id;
	  $goods=new GoodsModel();
	  $row=$goods->getInfo($g_id);
	  //var_dump($row);
	  include VIEW_DIR.'/update.html';
    }
   //最终修改方法
   public function updateok()
    {
	     $data=$_POST;
	     $goods=new GoodsModel();
	     if($goods->update($data))
	     {
		   echo '修改成功';
		   header('refresh:3;index.php?m=Goods&a=lists');
		 }
		 else
		 {
		 	   echo '修改失败';
		 	  header('refresh:3;index.php?m=Goods&a=lists');   
		 }
    }

 } 