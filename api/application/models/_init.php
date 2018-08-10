<?php

require_once '_config.php';
require_once '_PDO.php';
// require_once '_Memcache.php';
require_once '_Session.php';


$pdo=_PDO::getInstance()->connect($dbhost,$dbname,$dbuser,$dbpass);
// $mem=_Memcache::getInstance()->connect($memhost,$memport);
$mem=_Session::getInstance()->connect();


?>