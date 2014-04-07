<?php

/**
 * Description of Constant
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

define('RACINE_PATH',realpath(dirname(dirname($_SERVER['SCRIPT_FILENAME']))).DIRECTORY_SEPARATOR);

define('APP_PATH',RACINE_PATH.'app'.DIRECTORY_SEPARATOR);

define('PUBLIC_PATH',RACINE_PATH.'public'.DIRECTORY_SEPARATOR);

$config_file_path = APP_PATH.'configuration'.DIRECTORY_SEPARATOR.'configuration.ini';

if(file_exists($config_file_path)){
	define('CONFIG_FILE_PATH',$config_file_path);
}
else{
	throw new Exception("Le Fichier de configuiration est inexistant [".$config_file_path."]", 1);
}

