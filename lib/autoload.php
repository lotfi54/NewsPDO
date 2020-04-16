<?php 

function autoload($classname){

	if (file_exists($file='classes/'.$classname.'.php'))
		{

			require $file; 
		}else 

		{
			echo "erreur de pages";
		}


}

spl_autoload_register('autoload'); 

?>