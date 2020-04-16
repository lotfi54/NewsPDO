<?php 
require 'lib/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($db);

if (isset($_GET['modifier']))
{
  $news = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
  $manager->delete((int) $_GET['supprimer']);
  $message = '<div class="alert alert-danger">La news a bien été supprimée !</div>';
}

if (isset($_POST['auteur']))
{
  $news = new News(
    [
      'auteur' => $_POST['auteur'],
      'titre' => $_POST['titre'],
      'contenu' => $_POST['contenu']
    ]
  );
  
  if (isset($_POST['id']))
  {
    $news->setId($_POST['id']);
  }
  
  if ($news->isValid())
  {
    $manager->save($news);
    
    $message = $news->isNew() ? '<div class="alert alert-success">La news a bien été ajoutée !</div>' : '<div class="alert alert-info">La news a bien été modifiée !</div>';
  }
  else
  {
    $erreurs = $news->erreurs();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion de news</title>
</head>
<link rel="stylesheet" href="css/style.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	 

<body>
    <p><a href=".">Accéder à l'accueil du site</a></p>
    <div class="container">
   <div class="row">
 <div class="col-lg-8">
    <form action="admin.php" method="post">
      
<?php
if (isset($message))
{
  echo $message, '<br />';
}
?>



  
    
        
        <div class="form-group">
                   <label for="nom">Auteur</label>
                   <input type="text" class="form-control" name="auteur" value="<?php if (isset($news)) echo $news->auteur(); ?>"

                    placeholder="Auteur">  
<small id="error" class="form-text text-danger">
<?php if (isset($erreurs) && in_array(News::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
</small>



                 </div>

         <div class="form-group">
                   <label for="nom">Titre</label>
                   <input type="text" class="form-control" name="titre" value="<?php if (isset($news)) echo $news->titre(); ?>"

                    placeholder="Titre"> 
                    <small id="error" class="form-text text-danger">
        <?php if (isset($erreurs) && in_array(News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
</small>
                 </div>

         
                





  	 <textarea id="tiny" rows="8" cols="60" name="contenu"><?php if (isset($news)) echo $news->contenu(); ?></textarea>

               
<small id="error" class="form-text text-danger">
	<?php if (isset($erreurs) && in_array(News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
</small>
      
     
<?php
if(isset($news) && !$news->isNew())
{
?>
        <input type="hidden" name="id" value="<?= $news->id() ?>" />
        <input type="submit" value="Modifier" class="btn btn-warning" name="modifier" />
<?php
}
else
{
?>
        <input type="submit" class="btn btn-primary mt-3" value="Ajouter" />
<?php
}
?>
  
    </form>
    </div> 
</div>
<div class="row mt-5">
    <div class="col-lg-10">
    <p style="text-align: center">Il y a actuellement <?= $manager->count() ?> news. En voici la liste :</p>
   
    <table class="table">
      <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($manager->getList() as $news)
{
  echo '<tr><td>', $news->auteur(), '</td><td>', $news->titre(), '</td><td>', $news->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($news->dateAjout() == $news->dateModif() ? '-' : $news->dateModif()->format('d/m/Y à H\hi')), '</td><td><a href="?modifier=', $news->id(), '">Modifier</a> | <a href="?supprimer=', $news->id(), '">Supprimer</a></td></tr>', "\n";
}
?>
</table>
</div>
</div>
</div>


  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
 tinymce.init({
     selector: 'textarea#tiny'
   });
</script>
</body>
</html>