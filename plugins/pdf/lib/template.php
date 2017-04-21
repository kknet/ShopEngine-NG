<?php
class template
{
	private $pathTPL;
	
	public $values=array();
	public $html;
	
	function get_tpl($tpl_name)
	{
		$this->pathTPL = __DIR__ . "/views/";
		$tpl_name=$this->pathTPL . str_ireplace("_", "/", $tpl_name) . ".php";
		
		if (empty($tpl_name) || !file_exists($tpl_name))
		{
			return false;	
		}else{
			$f = fopen($tpl_name, "r");	
			$this->html = fread($f, filesize($tpl_name));
			fclose($f);	
		}
		
		return true;
	}
	
	function set_value($key,$var)
	{
		$key='{{'.$key.'}}';
		$this->values[$key]=$var;
		
		return true;	
	}
	
	function tpl_parse()
	{
		foreach($this->values as $find=>$replace)
		{
			$this->html=str_ireplace($find, $replace, $this->html);	
		}
		
		return true;
	}
	
	function __toString()
	{
		return $this->html;
	}
}
?>
