<?php 
    define('INCLUDE_PATH','http://localhost/Projetos-Back-end/forum/');
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','forum');
    $autoload = function($class){
        include('classes/'.$class.'.php'); 
    };
    spl_autoload_register($autoload);
?>