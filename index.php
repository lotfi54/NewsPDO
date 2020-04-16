<?php 
require './lib/autoload.php'; 
$bdd = DBFactory::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($bdd); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>News</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>


<?php 

if (isset($_GET['id']))
{
  $news = $manager->getUnique((int) $_GET['id']);
  
  echo '<p>Par <em>', $news->auteur(), '</em>, le ', $news->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $news->titre(), '</h2>', "\n",
       '<p>', nl2br($news->contenu()), '</p>', "\n";

  if ($news->dateAjout() != $news->dateModif())
  {
    echo '<p style="text-align: right;"><small><em>Modifiée le ', $news->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
  }

}else

{
  echo '<div class="container"><h2 style="text-align:center">Liste des 5 dernières news</h2></div>';
  ?>
  <div class="container mt-5">
  	<a href="admin.php"><button class="btn btn-primary">Ajoutr une news</button></a>
  </div>
  <div class="container mt-5">

    <div class="row">

  <?php 
  foreach ($manager->getList(0, 5) as $news)
  {
    if (strlen($news->contenu()) <= 10)
    {
      $contenu = $news->contenu();
    }
    
    else
    {
      $debut = substr($news->contenu(), 0, 10);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $contenu = $debut;
    }

    ?>
<div class="col-lg-4">
<div class="card card-news mb-3" style="width: 20rem;">
		<div class="card-body">
    <h5 class="card-title">
    	<?php 
    	echo '<p>', $news->titre(), '</p>';

    	?>
    </h5>

     <p class="card-text text-truncate"> <?php 
     echo '<p>', $news->contenu(), '</p>';

?>
     </p>

     <div class="view  text-center mt-5">
     	<?php 
echo '<a href="?id=', $news->id(), '">View</a>';
     	?>
     </div>
</div>
</div>
</div>
    <?php
  }
  ?> 

</div>
	

  <?php
}

?>





</body>
</html>