<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<form action="index.php?r=goods/loginok" method="post">
		<tr>
			  	<td>姓名</td>
			  	<td><input type="text"  name="username"/></td>
			  </tr>
			  <tr>
			  	<td>密码</td>
			  	<td><input type="password" name="pwd"/></td>
			  </tr>
			  <tr><td>验证码：</td>
	<td><input type="text" name="validate" value="" size=10> 
	<img  title="点击刷新" src="index.php?r=Goods/capcha" align="absbottom" onclick="this.src='index.php?r=Goods/capcha&'+Math.random()"></img></td>
   </tr>
			  <tr>
			  	<td>登录</td>
			  	<td><input type="submit" value="登录"/></td>
			  </tr>

			  
		</form>
	</table>
</body>
</html>
