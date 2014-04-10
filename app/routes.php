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

$route->get('/','HomeController@index');

$route->get('about',function(){
	echo '<h1>About</h1>';
});

$route->post('contact','contact');

$route->request('login','login');

$route->request('{id}','UserController@show');

$route->request('{identifiant}','UserController@index');