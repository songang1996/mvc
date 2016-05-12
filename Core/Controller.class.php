<?php
 if(!defined('ACCESS'))
 {
	   echo '非法请求';
	   die;
 }
 /*
 *	控制器方法基类
 *
 */
 class Controller
 {

 	/*
 	*	封装 display 方法    渲染模板
 	*	传入 模板名字 $view   string  数据 $arr  array  
 	*/	
	public function display($view,$arr=[],$is_return=false)
	{
		//输出数组当中的变量
		extract($arr);
		$controller=strtolower(get_class($this));
		// echo $controller;die;
		if($is_return)
		{
			ob_start();
			include VIEW_DIR.'/'.$controller.'/'.$view.'.php';
			return ob_get_clean();
		}
		else
		{
			include VIEW_DIR.'/'.$controller.'/'.$view.'.php';
		}
		
	}

	public function redirect($url,$time=0,$content="")
	{
		$controller=strtolower(get_class($this));
		if(empty($url))
		{
			return false;
		}
		else
		{
			if($time&&$content=="refresh")
			{
				header($content.":".$time." index.php?r=".$controller."/".$url);
			}else
			{
				header("location: index.php?r=".$controller."/".$url);
			}
		}
	}

}


?>
