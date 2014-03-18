<?php

/**
 * Description of DataBase
 * 
 * La classe DataBase utilise le pattern singleton.
 * Elle fournit une seul et même instance PDO.
 * Elle reçoit les Configuration pour charger les paramètres
 * utiles à l'objet PDO.
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */
class DataBase {
    
    private static $instance = null;

    private static $isActive = false;

    private static $config = array();
    
    public static function instancie (){
    	//throw new Exception("Database : Config not active or not present", 1);
    	
        if(self::$instance === null && self::$isActive) self::$instance = new PDO(self::$config['dsn'], self::$config['username'], self::$config['password']);
        return self::$instance;
    }

    public static function configure($config = array('dsn'=>'','username'=>'','password'=>'')){
    	if(is_array($config)){
    		try{
    			$pdo = new PDO($config['dsn'], $config['username'], $config['password']);
    			self::$config = $config;
    			self::$isActive = true;
    		}catch(PDOException $ex){
    			self::$isActive = false;
    		}
    	}
    	else throw new Exception("Database : Config is not array", 1);
    	
    }
}