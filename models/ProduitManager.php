<?php

class ProduitManager extends BDD{
	/**
	 * Récupère la liste des modèles en fonction de la marque reçue
	 */
	public function findByMarque($id_cat){
		$sql = 'SELECT * FROM produits WHERE idCategorie = :id';
		$select = $this->co->prepare($sql);
		$select->execute(['id' => $id_cat]);

		return $select->fetchAll();
	}

	public function insertProduit($donnees){
		$sql = 'INSERT INTO produits(nom, description, quantite, prix, idCategorie) VALUES (:n,:descr, :qte, :p, :id)';
		$insert = $this->co->prepare($sql);
		$insert->execute([
			'n' => $donnees['nom'],
			'p' => $donnees['prix'],
			'descr' => $donnees['description'],
			'qte'=>$donnees["quantite"],
			'id' => $donnees['categorie']
		]);

		return $insert->rowCount();
	}

	public function findOneById($id){
		$sql = 'SELECT * FROM produits WHERE id = :id';
		$select = $this->co->prepare($sql);
		$select->execute(['id' => $id]);

		return $select->fetch();
	}

	public function majProduit($donnees, $id){
		$sql = "UPDATE produits SET nom = :n, prix = :p, description = :descr, quantite = :qte, idCategorie = :idCat WHERE id = :id";
		$update = $this->co->prepare($sql);
		$update->execute([
			'n'=>$donnees['nom'],
			'p'=>$donnees['prix'],
			'descr'=>$donnees['description'],
			'qte'=>$donnees['quantite'],
			'id' => $id,
			'idCat'=>$donnees["categorie"]
		]);

		return $update->rowCount();
	}

	public function delProduit($id){
		$sql = 'DELETE FROM produits WHERE id = :id';
		$del = $this->co->prepare($sql);
		$del->execute(['id' => $id]);

		return $del->rowCount();
	}
}