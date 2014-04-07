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

$route->get('/',function(){
	echo '<html><body style="background-color : #ccc;">Work !</body></html>';
});

$route->get('/about','about@index');

$route->post('/contact','contact');

$route->get('/contact','Contact@index');

$route->request('login','login');