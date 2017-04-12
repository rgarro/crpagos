<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class ImageToolboxComponent extends Object {
	public function __construct()
	{
		parent::__construct();
		App::import('Vendor', 'Swift', array('file' => 'imagetoolbox'.DS.'Image_Toolbox.class.php'));
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
