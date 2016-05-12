<?php
  /*
  *  数据库基类
  *  
  */
  //
  class DB
  {
    //定义属性
    //设置  单例模式的静态常量
    static private $_instance = NULL; 
    private $host;
    private $port;
    private $user;
    private $pwd;
    private $dbname;
    private $charset;
    private $pdo;
   
    /*
    *  初始化 构造方法
    *  把参数值放在数组里面$arr=array('host'=>$host,'port'=>$port,'user'=>$user,..)
    */
    private function __construct($arr=array())
    {
      $this->host=isset($arr['host']) ? $arr['host'] : $GLOBALS['config']['mysql']['DB_HOST'];
      $this->port=isset($arr['port']) ? $arr['port'] : $GLOBALS['config']['mysql']['DB_PORT'];
      $this->user=isset($arr['user']) ? $arr['user'] : $GLOBALS['config']['mysql']['DB_USER'];
      $this->pwd=isset($arr['pass']) ? $arr['pass'] : $GLOBALS['config']['mysql']['DB_PWD'];
      $this->dbname=isset($arr['dbname']) ? $arr['dbname'] : $GLOBALS['config']['mysql']['DB_NAME'];
      $this->charset=isset($arr['charset']) ? $arr['charset'] :$GLOBALS['config']['mysql']['DB_CHARSET'];

      //自动加载 链接数据库方法
      $this->db_connect();

      //自动加载  设置字符集方法
      $this->db_charset();
    }

    /*
    *  pdo 链接数据库
    */
    private function db_connect()
    {
      $this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->pwd); 
      if(!$this->pdo)
      {
    	  echo '数据库连接失败<br>';
    	  echo '错误编码是'.mysql_errno().'<br>';
    	  echo '错误信息是'.mysql_error().'<br>';
    	  exit;
  	  }
    }

    /*
    *  设置字符集
    */
    private function db_charset()
    {
      $this->pdo->query("set names {$this->charset}");
    }

    /*
    *  私有 空克隆函数 防止被克隆
    */
  
    private function __clone()
    {

    }

    /*
    *  静态方法  单例模式
    */
  
    static public function getInstance()
    {
      // 判断这个类  是否被实例化过
      if(!self::$_instance instanceof self)
      {
        self::$_instance = new self;
      }
      return self::$_instance;
    } 



    /*
    *  数据库执行sql 语句
    *  传入 sql 
    *   return    受影响的行数 
    */

    private function db_query($sql)
    {
        // echo $sql;die;
        $res=$this->pdo->query($sql);
        if(!$res)
        {
          echo 'SQL语句有错误<br>';
      	  echo '错误编号是'.mysql_errno().'<br>';
      	  echo '错误信息是'.mysql_error().'<br>';
          exit;
        }
        return $res;
    }

    /*
    * 数据库增加操作
    * 传入 表名 $table  string  数据  $data  array()
    * return  true/false
    */
    //增加操作
    public function db_insert($table,$data)
    {
  	  //遍历数组，得到每一个字段和字段的值
  	  $key_str='';
  	  $val_str='';

  	  foreach($data as $key=>$val)
      {
  	        //$key的值是每一个字段
  		      //$v的值是每一个字段所对应的值
            $key_str.=$key.',';
            $val_str.="'$val',";
  	  }

      $key_str=rtrim($key_str,',');
  	  $val_str=rtrim($val_str,',');

  	  $sql="insert into $table ($key_str) values ($val_str)";
      return  $this->db_query($sql);
    }


    /*
    * 数据库查询操作 查询全部
    * 传入 表名 $table  string  条件 $where string
    * return array
    */
    public function db_getAll($table,$where=1)
    {
      $sql="select * from $table $where";
      $res=$this->db_query($sql);

      $array = array();
      while($row = $res->fetch())
      {
        $array[] = $row;
      } 
      return $array;
   
    }

    /*
    * 数据库查询操作 获取总记录数的方法
    * 传入 表名 $table  string  条件 $where string
    * return int
    */
    public function getCount($table)
    {
      $sql="select count(*)as c from $table";
      $res=$this->db_query($sql);

      $array = array();
      while($row = $res->fetch())
      {
        $array[] = $row;
      } 
      return $array[0]['c'];
    }

    /*
    * 数据库删除操作
    * 传入 表名 $table  string  条件 $condition string  数据 $data  array()
    * return  true/false
    */
    
    public function db_delete($table,$condition,$data)
    {
      
      //遍历数组，得到每一个字段和字段的值
      $val_str='';

      foreach($data as $key=>$val)
      {

            //$val的值是每一个字段所对应的值
            $val_str.="'$val',";
      }

      $val_str=rtrim($val_str,',');

      $sql="delete from  '$table' where '$condition'  in  ('$val_str')";

      return  $this->db_query($sql);
    } 




    //修改操作
    public function db_update($table,$data,$where)
    {
      //遍历数组，得到每一个字段和字段的值
  	  $str='';
  	  foreach($data as $key=>$val)
      {
  	    $str.="$key='$val',";  
  	  }
      
  	  $str=rtrim($str,',');
      //修改SQL语句
  	  $sql="update $table set $str where $where";

      $this->db_query($sql);
      //返回受影响的行数
      return mysql_affected_rows();
    }
 

 }