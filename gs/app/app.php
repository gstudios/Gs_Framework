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

		$this->registry->route = new Route();

		return $this;
	}

	function run(){
		
		/*
		/ Applications des filtres
		*/
		require APP_PATH.'filters.php';

		/*
		/ Application des routes
		*/
		$route = $this->registry->route;
		//$view = $this->registry->view;
		require APP_PATH.'routes.php';
		$view = $this->registry->route->run();
		View::show($view);

		return $this;
	}

	function stop(){
		var_dump($this->registry->config);
		var_dump($this->registry->db);
		var_dump($this->registry->route);
	}
}