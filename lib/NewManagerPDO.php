<?php 

class NewManagerPDO extends NewsManager {


	protected $bdd; 


public function __construct(PDO $bdd) {
	$this->bdd = $bdd; 
}

// on ajout une methode Add 

protected function add(News $news) {

	$requete = $this->bdd->prepare("INSERT INTO news
		(auteur,titre,contenu,dateAjout,dateModif) VALUES(:auteur,:titre,:contenu,:NOW(),NOW())"); 


	$requete->binValue(':titre', $news->titre());
	$requete->binValue(':auteur', $news->auteur());
	$requete->binValue(':contenu', $news->contenu());
	$requete->execute(); 
}


// on ajoute une methode count() qui sert renvoyer le nmbre de news total 

public function count()

{
	return $this->bdd->query('SELECT COUNT(*) FROM news')->fetchColumn(); 
}


// On ajourz une methode delete 

public function delete($id) {
	$this->bdd->exec('DELETE FROM news WHERE id='.(int)$id); 
}



// on ajoute une methode update 

protected function update(News $news)
  {
    $requete = $this->db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':auteur', $news->auteur());
    $requete->bindValue(':contenu', $news->contenu());
    $requete->bindValue(':id', $news->id(), PDO::PARAM_INT);
    
    $requete->execute();
  }



   public function getUnique($id)
  {
    $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = :id');
    $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

    $news = $requete->fetch();

    $news->setDateAjout(new DateTime($news->dateAjout()));
    $news->setDateModif(new DateTime($news->dateModif()));
    
    return $news;
  }


 public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC';
    

    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->bdd->query($sql);
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
    
    $listeNews = $requete->fetchAll();


    foreach ($listeNews as $news)
    {
      $news->setDateAjout(new DateTime($news->dateAjout()));
      $news->setDateModif(new DateTime($news->dateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeNews;
  }


}