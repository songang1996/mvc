<?php
 //编写项目的入口文件
  //定义常量，秘钥,确保每个页面都是从入口文件访问
  define('ACCESS','ang');
  //载入核心类库文件
  include './Core/Application.class.php';
  //调用核心类库里的初始化方法
  Application::run();