<?php

class TGlobal
{
    public static $default_url_path = 'http://localhost/agrohost';
    
    public static function getDbPath()
    {
        return dirname(__DIR__).'\config\db_mysql.ini';
    }
}

?>