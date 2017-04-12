<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;

use App\Lib\Object;


class ImageToolboxComponent extends Object {
	public function __construct()
	{
		parent::__construct();
		include('Image_Toolbox.php');
	}
	public function makeToolbox()
	{
		$args = func_get_args();
		$argc = func_num_args();
		$params = array();
		for($i = 0; $i < $argc; $i++)
		{
			$params[] = '"'.$args[$i].'"';
		}
        $pstring = implode(",", $params);
		$estring = "return new Image_Toolbox($pstring);";
		return eval($estring);
	}
}
