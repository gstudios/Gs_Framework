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

		// A Faire : verifier si le tableau database_pdo est conforme

		DataBase::configure($this->registry->config['database_pdo']);

		$this->registry->db = DataBase::instancie();

		return $this;
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

		return $this;
	}

	function stop(){
		var_dump($this->registry->config);
		var_dump($this->registry->db);
	}
}