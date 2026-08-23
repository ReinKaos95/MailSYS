<?php 

spl_autoload_register(function ($clase)
{
	$file = ROOT_PATH . str_replace('\\', '/', $clase) . '.php'
	
	if (file_exists($file)) {
		require_once $file;
	}

});

 ?>