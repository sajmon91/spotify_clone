<?php 


// DB params
if($_SERVER['SERVER_NAME'] == "localhost")
{
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'spotify_clone');
}else{
    define('DB_HOST', 'sql.freedb.tech');
    define('DB_USER', 'freedb_sajmon');
    define('DB_PASS', '4eVKqHkXCH#73?Y');
    define('DB_NAME', 'freedb_simonfy');
}








 ?>