<?php

class Route {
	
	private $_route = array();
	private $_method = array();
	private $_function = array();
	private $_parameters = array();

	/*public function __construct(){
		$this->_parameters[0] = new Route();
	}*/

	private function add($route, $method = 'GET', $function = null){
		$this->_route[] = '/'.trim($route,'/');
		$this->_method[] = $method;
		$this->_function[] = $function;
	}

	public function run(){

		$uri = isset($_REQUEST['uri']) ? '/'.rtrim($_REQUEST['uri'],'/') : '/';

		//var_dump($uri);

		//preg_match_all('/\{(\w+?)\?\}/', $uri, $matches);

		//var_dump($matches);
		//$txt='{id}';

  		$re1='(\\{.*?\\})';	# Curly Braces 1
  		//$re2='((?:[a-z][a-z]+))';	# Word 1

  		//preg_match_all ("/".$re1."/is", $txt, $matches);
  		//var_dump($matches);

  		//$model = array("galbanie", "rosine");
  		//$parametres = array();
  		//$this->_parameters[] = new Route();

		foreach ($this->_route as $key => $value) {
			if( $_SERVER['REQUEST_METHOD'] == $this->_method[$key] || $this->_method[$key] == 'REQUEST'){


				preg_match_all ("/".$re1."/is", $value, $matches);
				//var_dump($matches);
				if (isset($matches[1])){

					//$index = $matches[1];

					$this->_parameters[] = rtrim(trim($uri,'/'),'/');
					$value = preg_replace("/".$re1."/is", $this->_parameters[0], $value);

					if(!is_callable($this->_function[$key])){
						$ctrl_fn = explode('@', $this->_function[$key]);
						$ctrl = $this->getController($ctrl_fn[0]);
						if(!is_null($ctrl)) {
							$model = $ctrl->getModel();
							if(!is_null($model)){

							}
						}
					}
					
					/*foreach ($model as $keyModel => $valueModel) {
						if(preg_match('#^'.$valueModel.'$#', trim($uri,'/'))){
							$value = preg_replace("/".$re1."/is", $valueModel, $value);
							$parametres = $valueModel;
						}
						
					}*/
					
				}

				if(preg_match('#^'.$value.'$#', $uri)){
					return $this->call_fn($this->_function[$key]);
					//break;
				}
				
			}
		}
	}

	private function call_fn($callable){

		if(is_callable($callable)){

			return call_user_func_array($callable,$this->_parameters);

		}else {

			$ctrl_fn = explode('@', $callable);
			//var_dump($ctrl_fn);

			/*var_dump(in_array($ctrl_fn[0], get_declared_classes()));
			var_dump(get_declared_classes());*/
			//var_dump(class_exists($ctrl_fn[0],true));
			//var_dump(class_parents($ctrl_fn[0]));

			$ctrl = $this->getController($ctrl_fn[0]);

			if(!is_null($ctrl)){
				if(isset($ctrl_fn[1])){
					if(is_callable(array($ctrl, $ctrl_fn[1]))){
						return call_user_func_array(array($ctrl, $ctrl_fn[1]),$this->_parameters);

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

	private function getController($ctrl_name){
		return ($this->isController($ctrl_name)) ? new $ctrl_name : null;
	}

	private function isController($ctrl_name){
		return @class_exists($ctrl_name) && in_array('Controller',class_parents($ctrl_name));
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