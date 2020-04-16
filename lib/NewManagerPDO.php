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















}