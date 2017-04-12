<?php
namespace App\Lib;

use Cake\Core\Configure;

use App\Lib\Object;

	class FileHandler extends Object{
		var $name = 'FileHandler';
		var $useTable = false;

		var $error;
		function save($file=null, $filename=null, $directory=null, $overwrite=true){
// Check if the directory does not exist, create it
			if(!is_dir($directory)){
				mkdir($directory);
			}
// Check if a file already exists with the same name, and if overwrite is "false", create unique name
			if(file_exists($directory . $filename))	{
				if($overwrite === false){
					$current_count = 1;
					$orig_filename = $filename;
					while(file_exists($directory . $filename)){
						$split = explode('.', $orig_filename);
						$filename = '';
						for($i=0;$i<(count($split)-1);$i++)
						{
							$filename .= $split[$i];
						}
						$filename .= $current_count . '.' . $split[(count($split)-1)];
						$current_count++;
					}
				}
			}
// Move the file from temp dir to its final location
			if(!move_uploaded_file($file, $directory . $filename)){
				$this->error = 'I lost the file!';
				return false;
			}
// Return the directory/filename where is was saved
			return $directory . $filename;
		}

	}
