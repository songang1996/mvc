<?php

	//分页工具类

	class Page{

		/*
		 * 获取分页字符串
		 * @param1 string $uri，分页要请求的脚本url
		 * @param3 int $counts，总记录数
		 * @param4 int $length，每页显示的记录数
		 * @param5 int $page = 1，当前页码
		 * @return string，带有a标签的，可以点击发起请求的字符串
		*/
		public static function getPageStr($uri,$counts,$length,$page = 1){
			//构造一个能够点击的字符串
			//得到数据显示的字符串
			$pagecount = ceil($counts/$length);				//总页数
			$str_info = "当前一共有{$counts}条记录，每页显示{$length}条记录，一共{$pagecount}页，当前是第{$page}页";

			//生成可以操作的连接：首页 上一页 下一页 末页
			//求出上一页和下一页页码
			$prev = ($page <= 1) ? 1 : $page - 1;
			$next = ($page >= $pagecount) ? $pagecount : $page + 1;
			$str_click = <<<END
				<a href="{$uri}?page=1">首页</a>
				<a href="{$uri}?page={$prev}">上一页</a>
				<a href="{$uri}?page={$next}">下一页</a>
				<a href="{$uri}?page={$pagecount}">末页</a>
END;

			//按照页码分页字符串
			$str_number = '';
			for($i = 1;$i <= $pagecount;$i++){
				$str_number .= "<a href='{$uri}?page={$i}'>{$i}</a>&nbsp;";
			}

			//下拉框分页字符串：利用js的onchang事件来改变当前脚本的href
			$str_select = "<select onchange=\"location.href='{$uri}?page='+this.value\">";
			//将所有的页码放入到option
			for($i = 1;$i <= $pagecount;$i++){
				if($i == $page)
					$str_select .= "<option value='{$i}' selected='selected'>{$i}</option>";
				else
					$str_select .= "<option value='{$i}'>{$i}</option>";
			}
			$str_select .= "</select>";
		
			//返回值
			return $str_info . $str_click . $str_number . $str_select;
		}
	}