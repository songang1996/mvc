<?php
  return array(
	  		//'配置项'=>'配置值'
		//'DEFAULT_MODULE'     => 'Home', //默认模块   
		//'URL_MODEL'          => '1', //URL模式
		'SESSION_AUTO_START' => true, //是否开启session
		'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
		'DEFAULT_ACTION'        =>  'index', // 默认操作名称
		'mysql'=>array
		(
			'DB_TYPE'   => 'mysql', // 数据库类型
			'DB_HOST'   => '127.0.0.1', // 数据库地址
			'DB_NAME'   => 'mvc', // 数据库名
			'DB_USER'   => 'root', // 用户名
			'DB_PWD'    => 'root', // 密码
			'DB_PORT'   => 3306, // 端口
			//'DB_PREFIX' => 'think_', // 数据库表前缀 
			'DB_CHARSET'=> 'utf8', // 字符集
		)
  
  );