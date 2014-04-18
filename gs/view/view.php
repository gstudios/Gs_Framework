<?php

class View{
	//private $_registry;
	private static $_vars = array();

	public function __construct(){

	}

	public static function show($view){
		echo $view;
	}

	public static function make($view){
		$view = explode('.', $view);
		$path = APP_PATH.'view';
		foreach ($view as $key => $value) {
			$path .= DIRECTORY_SEPARATOR.$value;
		}
		$path .= '.php';
		if(!file_exists($path)){
			throw new Exception("La Vue [".$path."] est introuvable.", 1);
		}

		//extract($this->_vars);
		extract(self::$_vars);

		ob_start();
		include $path;
		return ob_get_clean();
	}

	public static function set($key,$value){
		self::$_vars[$key] = $value;
	}

	/*public function __set($index, $value){
		$this->_vars[$index] = $value;
	}*/
}