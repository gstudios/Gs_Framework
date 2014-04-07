<?php

class Contact extends Controller{
	public function __construct(){
		echo 'construteur Contact';
	}

	public function index(){
		echo '<html><body style="background-color : #ccc;"><div><h1>Contact Form</h1><form><label>Username : <input type="text"></label></form></div></body></html>';
	}
}