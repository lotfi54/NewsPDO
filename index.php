<?php 
require './lib/autoload.php'; 
$bdd = DBFactory::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($bdd); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>News</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<h1>Hello</h1>
</body>
</html>