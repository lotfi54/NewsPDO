<?php
class DBFactory
{
  public static function getMysqlConnexion()
  {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $bdd;
  }
  
}

?>
