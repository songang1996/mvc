<?php
 //封装php中的单文件(图片)上传类
 /*
  //参数1：$file 文件数组  5个属性值 name,type,size,tmp,error 
  //参数2：文件保存的路径$path  
  //参数3：文件上传允许的类型 $allow数组   $allow=array('image/jpeg','image/jpg','image/png','image/gif')
  //参数4: 允许文件上传的最大大小 $size
  //返回值: return $imageName文件的名字 
 */
 header('content-type:text/html;charset=utf-8');
 class Upload{
	 //定义一个属性，专门保存错误信息
	   public static $error;
	  //文件转移的方法
   public function uploadFile($file,$size,$path){
	    if(!is_dir($path)){
		  $this->mkPath($path);
		}
	    $allow=array('image/jpeg','image/jpg','image/png','image/gif');
	   
      //首先判断文件是否已上传到临时目录
       if(!is_array($file)){
	      Upload::$error='不是一个有效的文件';
		  return false;
	   }
      //判断文件是否上传到临时目录成功
	  switch($file['error']){
	    case 1:
		    Upload::$error='上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。';
		    return false;
	    case 2:
            Upload::$error='上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
		    return false;
	    case 3:
			Upload::$error='文件只有部分被上传';
		    return false;
		case 4:
			Upload::$error='没有文件被上传';
		     return false;
		case 6:
            Upload::$error='找不到临时文件夹';
		    return false;
		case 7:
             Upload::$error='文件写入失败';
		     return false;  
	  }
      //判断文件类型是否是图片
       if(!in_array($file['type'],$allow)){
	      Upload::$error='不是要求的文件类型';
	      return false;
	   }
	  //判断文件的大小是否在允许的范围内
       if($file['size']>$size){
	      Upload::$error='超出允许最大文件大小';
		  return false;
	   }
	 
	   //文件转移
	   if(move_uploaded_file($file['tmp_name'],$path.'/'.$this->getName($file))){
	      return $file['name'];
	   }else{
	      return Upload::$error;
	   }
   }
    //创建目录的方法
	    private function mkPath($path){
		mkdir($path);
	}
	//文件重命名
	    private function getName($file){
		  return time().$file['name'];
		}

 }