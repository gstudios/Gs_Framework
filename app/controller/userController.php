<?php

class UserController extends Controller{

	public function show($id){
		echo '<html><body style="background-color : #ccc;"><div><h1>'.$id.'</h1></div></body></html>';
	}

	public function index($id){
		echo '<html><body style="background-color : #ccc;"><div><h1>'.$id.'</h1></div></body></html>';
	}
}