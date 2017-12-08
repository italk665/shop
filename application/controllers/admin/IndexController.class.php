<?php
/**
* 
*/
class IndexController 
{
	public function IndexAction()
	{
		include CUR_VIEW_PATH."index.html";
	}
	public function TopAction()	
	{
		include CUR_VIEW_PATH."top.html";
	}
	public function MenuAction()
	{
		include CUR_VIEW_PATH."menu.html";
	}
	public function MainAction()
	{
		include CUR_VIEW_PATH."main.html";
	}
}