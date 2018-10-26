<?php 

// Start Session
session_start();

require_once 'config.php';

// Include helper file

require_once 'helpers/system_helper.php';

function __autoload($class_name){
    require_once 'lib/'.$class_name.".".'php';
}

?>