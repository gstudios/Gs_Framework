<?php

/**
 * Description of routes
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

function index(){

}

function login(){
	echo '<html><body style="background-color : #ccc;"><div><form><label>Username : <input type="text"></label></form></div></body></html>';
}

//$route->get('/','HomeController@index');

$route->get('/', function($view){
	View::set('title','Gs_Framework');
	var_dump(View::make('home'));
	return View::make('home');
	//echo $view->make('home');
});

$route->get('about',function(){
	//View::show(5);
	//echo '<h1>About</h1>';
	return '<h1>About</h1>';
});

$route->post('contact','contact');

$route->request('login','login');

$route->request('{id}','UserController@show');

$route->request('{identifiant}','UserController@index');