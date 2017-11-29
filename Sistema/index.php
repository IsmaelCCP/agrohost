<?php
require_once 'app/util/Url.class.php';
require_once 'app/util/TGlobal.class.php';
require_once 'app/util/TSession.class.php';    

$url_0 = Url::getURL( 0 );
 
if( $url_0 == null )
    $url_0 = "index";

if( file_exists( "sistema/" . $url_0 . ".php" ) )
    require "sistema/" . $url_0 . ".php";
else
    require "sistema/404.php";

?>    