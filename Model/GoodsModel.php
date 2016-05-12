<?php
 class GoodsModel extends Model
 {
 	//添加操作
	function addgoods($table,$data)
	{
		return $this->db->db_insert($table,$data);
	}
 	


 	function getAll($table)
 	{
 		return $this->db->db_getAll($table);
 	}

 	function getCount($table)
 	{
 		return $this->db->getCount($table);
 	}
 }