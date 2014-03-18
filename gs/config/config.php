<?php

/**
 * Description of Config
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

final class Config {
	private static $donnees = null;

	public static function getConfig($section = null){
        if ($section === null){
            return self::getDonnees();
        }
        $donnees = self::getDonnees();
        if (!array_key_exists($section, $donnees)){
            throw new Exception('Section chargement donnees config non conforme :'.$section);
        }
        return $donnees[$section];
    }
    
    public static function getDonnees(){
        if (self::$donnees !== null){
            return self::$donnees;
        }
        self::$donnees = parse_ini_file(CONFIG_FILE_PATH,true);
        return self::$donnees;
    }

}