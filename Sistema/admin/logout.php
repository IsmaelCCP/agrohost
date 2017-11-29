<?php
TSession::freeSession();

echo("
    <script>    
    	window.location.replace('" . TGlobal::$default_url_path . "/login');    
    </script>
    ");

?>

