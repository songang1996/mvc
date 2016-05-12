<?php
  //判断用户是否是通过入口文件访问
   if(!defined('ACCESS'))
   {
     echo '非法请求';
	 die;
   }
   //封装初始化类
   class Application
   {
		//设置字符编码
		private static function setCharset()
		{
			header('Content-type:text/html;charset=utf-8');
		}

		//设置系统常量
		private static function setDir()
		{
			//设置项目根目录的路径常量
			define('ROOT_DIR',str_replace('\\', '/', dirname(__DIR__)));
			//设置核心类库文件的路径
			define('CORE_DIR',ROOT_DIR.'/Core');
			//设置配置类文件的路径
			define('Config_DIR',ROOT_DIR.'/Config');
			//设置控制器的路径
			define('CONTROLLER_DIR',ROOT_DIR.'/Controller');
			//设置model类文件的路径
			define('MODEL_DIR',ROOT_DIR.'/Model');
			//设置模板 文件的路径
			define('VIEW_DIR',ROOT_DIR.'/View');
			//设置 公共文件类的路径
			define('PUBLIC_DIR',ROOT_DIR.'/Public');
		}
		//设置错误信息
		private static function setErrors()
		{
			ini_set('display_errors', 1);// 0 为关闭报错  1 为开启报错
			error_reporting(E_ALL);
		}
		
		//初始化配置信息
		private static function setConfig()
		{
			$GLOBALS['config'] = include Config_DIR.'/config.php';
		}
		
		//自动加载,把所有的类文件自动加载, 以后获取对象是直接通过new
		public static function loadCore($class)
		{
			if(is_file(CORE_DIR."/$class.class.php"))
			{
				include CORE_DIR."/$class.class.php";
			}
		}
		
		//加载控制器文件
		public static function loadController($class)
		{
		    // echo CONTROLLER_DIR."/".$class.".php";die;
			if(is_file(CONTROLLER_DIR."/".$class.".php"))
			{
				include CONTROLLER_DIR."/".$class.".php";
			}
		}
		
		//加载模型文件
		public static function loadModel($class)
		{
			 // echo MODEL_DIR."/".$class.".php";die;
			if(is_file(MODEL_DIR."/".$class.".php"))
			{
				include_once MODEL_DIR."/".$class.".php";
			}
		}
		
		//自动加载机制
		private static function setAutoLoad()
		{
			//通过以下方式可以将loadCore,loadController,loadModel追加到系统__autoload函数栈中
			//当系统初始化对象时，系统会自动到以下三个函数中寻找，但是有顺序要求，先注册先使用，如在当
			//前文件中已找到，其将不会继续向下寻找
			spl_autoload_register(array('Application','loadCore'));
	        spl_autoload_register(array('Application','loadController'));
	        spl_autoload_register(array('Application','loadModel'));
		}
		
		//设置 session
		private static function setSession()
		{
			if ($GLOBALS['config']['SESSION_AUTO_START'])
			{
				session_start();
			}
			
		}
		
		//设置url
		private static function setUrl()
		{	
			//接受url传入的 控制器与方法名
			$route = $_GET;
		    // print_r($route);die;
			if (!empty($route))
			{
				list($controller,$action)=explode('/',$route['r']);
				//默认显示Index控制器下的index方法
				$controller = isset($controller)?$controller:$GLOBALS['config']['DEFAULT_CONTROLLER'];
				$action = isset($action)?$action:$GLOBALS['config']['DEFAULT_ACTION'];
			}
			else
			{
				$controller = $GLOBALS['config']['DEFAULT_CONTROLLER'];
				$action = $GLOBALS['config']['DEFAULT_ACTION'];
			}

			//把接收到的所有参数转化为小写
			$controller = strtolower($controller);
			$action = strtolower($action);
			//由于命名习惯问题，我们需要将模块参数的首字母转化为大写
			$controller = ucfirst($controller);
			
			// echo $controller,$action;die;
			define('CONTROLLER',$controller);
			define('ACTION',$action);
		}
		
		//设置权限
		// private static function setPrivilege()
		// {
		// 	//如果是提供登录表单和登录验证方法，不需要验证用户是否已登录，其他均需用户登录后才可以进行操作
		// 	if(!(MODULE=='Privilege' && (ACTION=='login' || ACTION=='sigin' || ACTION=='captcha')))
		// 	{
		// 		$_SESSION['user'] = 1;
		// 		if(!isset($_SESSION['user']))
		// 		{
		// 			header('Location:index.php');
		// 		}
		// 	}
		// }
		
		//设置分发
		private static function setDispatch()
		{
			$controller = CONTROLLER.'Controller';
			//echo $controller;die;
			$action = ACTION;
			//创建对象
			$controller = new $controller();
			$controller->$action();
		}
		
		//定义初始化方法
		public static function run()
		{
			//1）初始化字符集
			self::setCharset();
			//2）初始化系统路径常量
			self::setDir();
			//3 ）初始化错误配置
			self::setErrors();
			//4）初始化配置信息
			self::setConfig();
			//5）自动加载
			self::setAutoLoad();
			//6）开启session
			self::setSession();
			//7）url初始化
			self::setUrl();
			//8）权限验证
			//self::setPrivilege();
			//9）分发
			self::setDispatch();
		}
	}
?>