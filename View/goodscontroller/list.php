<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
</head>
<body>
	<center>
		<table border='1'>

			<?php foreach($arr as $v){ ?>
              <tr>
			  <td><?php echo $v['name']; ?></td>
			  <td><?php echo $v['price']; ?></td>
			  <td><?php echo $v['num']; ?></td>
			  <td><a href="index.php?m=Goods&a=del&g_id=<?php echo $v['g_id']; ?>">删除</a>|| <a href="index.php?m=Goods&a=update&id=<?php echo $v['g_id']; ?>">修改</a></td>
			  </tr>
			<?php }?>
		</table>
	</center>
</body>
</html>