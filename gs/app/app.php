<?php

/**
 * Description of App
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

class App {

	private $registry;

	function __construct(){
		$this->registry = new Registry();
	}

	function start(){
		var_dump(APP_PATH);

		$this->registry->config = Config::getConfig();
	}

	function run(){
		try{
			/*
			/ Applications des filtres
			*/
			require APP_PATH.'filters.php';
			/*
			/ Application des routes
			*/
			require APP_PATH.'routes.php';

		}catch(Exception $e){

		}
	}

	function stop(){
		var_dump($this->registry->config);
	}
}