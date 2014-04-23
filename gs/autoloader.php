<?php

/**
 * Description of Autoloader
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

class Autoload {

	public function __construct(){


		/*
		* Include Gs
		*/
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'app'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'controller'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'http'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'model'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'routing'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'utils'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'view'));

		/*
		* Include App User
		*/
		set_include_path(get_include_path().PATH_SEPARATOR.APP_PATH.'controller');

		//var_dump(APP_PATH.'controller');

		spl_autoload_register(array('Autoload','autoload'));
	}

	public function autoload($className){
		require_once str_replace('_','/',$className).'.php';
	}
}