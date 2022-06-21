<?php 


// DB params
if($_SERVER['SERVER_NAME'] == "localhost")
{
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'spotify_clone');
}else{
    define('DB_HOST', 'remotemysql.com');
    define('DB_USER', '6jQAwTiyjt');
    define('DB_PASS', 'IiaNcZv0Hc');
    define('DB_NAME', '6jQAwTiyjt');
}








 ?>