<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
</head>
<body>
	<table>
		<form action="index.php?m=Goods&a=updateok" method='post'>
		 <input type="hidden" name='g_id' value="<?php  echo $row['g_id'];?>" />
			<tr>
				<td>商品名称</td>
				<td><input type="text" name='g_name' value="<?php echo $row['g_name']; ?>"/></td>
			</tr>
			<tr>
				<td>商品价格</td>
				<td><input type="text" name='g_price' value="<?php echo $row['g_price']; ?>" /></td>
			</tr>
			<tr>
				<td>商品数量</td>
				<td><input type="text" name='g_num' value="<?php echo $row['g_num'] ?>" /></td>
			</tr>
			<tr>
				<td><input type="submit" value='添加' /></td>
				<td><input type="reset" value='重置' /></td>
			</tr>
		</form>
	</table>
</body>
</html>