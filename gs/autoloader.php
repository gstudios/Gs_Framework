<?php

/**
 * Description of Autoloader
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

class Autoload {

	public function __construct(){

		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'app'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'config'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'controller'));
		set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'model'));

		//var_dump(get_include_path());

		spl_autoload_register(array('Autoload','autoload'));
	}

	public function autoload($className){
		require_once str_replace('_','/',$className).'.php';
	}
}