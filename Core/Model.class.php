<?php
 if(!defined('ACCESS')){
   echo '非法请求';
   die;
 }

 /*
 *引入数据库 DB.clss  基类
 */
 class Model 
 {
 		public function __construct()
 		{
 			$this->db = DB::getInstance();
 		}
 }