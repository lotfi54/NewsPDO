<?php 
require 'lib/autoload.php'; 
$bdd = DBfactory::getMysqlConnexionWhitPDO(); 
$manager = new NewsManagerPDO($bdd); 

?>