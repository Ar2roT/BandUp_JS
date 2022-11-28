<?php
    define('DB_SERVER', 'db5010532100.hosting-data.io');
    define('DB_USERNAME', 'dbu1610997');
    define('DB_PASSWORD', 'b8c3GW85FpLF2as');
    define('DB_NAME', 'dbs8917039');
    
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if($link === false) {
        die("Error en la conexión: " . mysqli_connect_error());
    }
?>