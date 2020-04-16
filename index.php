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

    <div class="row">
<div class="col-lg-4">
  <?php 
  foreach ($manager->getList(0, 5) as $news)
  {
    if (strlen($news->contenu()) <= 200)
    {
      $contenu = $news->contenu();
    }
    
    else
    {
      $debut = substr($news->contenu(), 0, 200);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $contenu = $debut;
    }

    ?>

<div class="card mb-3" style="width: 20rem;">
		<div class="card-body">
    <h5 class="card-title">
    	<?php 
    	echo '<a href="?id=', $news->id(), '">', $news->titre(), '</a>';
    	?>
  
    </h5>
</div>
</div>

    <?php
  }
  ?> 
</div>
</div>
	

  <?php
}

?>





</body>
</html>