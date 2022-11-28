<?php
    define('DB_SERVER', 'db5010673134.hosting-data.io');
    define('DB_USERNAME', 'dbu2428118');
    define('DB_PASSWORD', 'bANDUP00!');
    define('DB_NAME', 'dbs9032055');
    
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if($link === false) {
        die("Error en la conexión: " . mysqli_connect_error());
    }
?>