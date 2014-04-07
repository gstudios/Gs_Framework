<?php

class Route {
	
	private $_route = array();
	private $_method = array();
	private $_function = array();

	private function add($route, $method = 'GET', $function = null){

		$this->_route[] = '/'.trim($route,'/');

		$this->_method[] = $method;

		$this->_function[] = $function;
	}

	public function run(){

		$uri = isset($_REQUEST['uri']) ? '/'.rtrim($_REQUEST['uri'],'/') : '/';

		var_dump($uri);

		foreach ($this->_route as $key => $value) {
			if( ($_SERVER['REQUEST_METHOD'] == $this->_method[$key] || $this->_method[$key] == 'REQUEST') && preg_match('#^'.$value.'$#', $uri)){
				if(is_callable($this->_function[$key])){

					call_user_func($this->_function[$key]);

				}else {

					$ctrl_fn = explode('@', $this->_function[$key]);
					var_dump($ctrl_fn);

					/*var_dump(in_array($ctrl_fn[0], get_declared_classes()));
					var_dump(get_declared_classes());*/
					//var_dump(class_exists($ctrl_fn[0],true));
					//var_dump(class_parents($ctrl_fn[0]));

					if(@class_exists($ctrl_fn[0]) && in_array('Controller',class_parents($ctrl_fn[0]))){
						$ctrl = new $ctrl_fn[0];
						if(isset($ctrl_fn[1])){
							if(is_callable(array($ctrl, $ctrl_fn[1]))){
								call_user_func(array($ctrl, $ctrl_fn[1]));
							}
							else{
								throw new Exception("La fonction [".$ctrl_fn[1]."] n'existe pas dans la class [".$ctrl_fn[0]."]", 1);	
							}
						}
					}
					else{
						throw new Exception("Le Controlleur [".$ctrl_fn[0]."] n'existe pas ou la class n'herite de Controller", 1);
					}

				}
			}
		}
	}

	public function get($uri, $function = null){
		$method = 'GET';
		$this->add($uri,$method,$function);	
	}

	public function post($uri, $function = null){
		$method = 'POST';
		$this->add($uri,$method,$function);
	}

	public function request($uri, $function = null){
		$method = 'REQUEST';
		$this->add($uri,$method,$function);
	}
}