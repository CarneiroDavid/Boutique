<?php

class ProduitController extends ProduitManager{
	public function getModelesByMarque($id_marque){
		ob_start();

		$modeles = $this->findByMarque($id_marque);

		require 'views/produits/list_by_marque.php';

		$vue = ob_get_clean();
		return $vue;
	}

	public function add(){
		ob_start();
		$manager = new CategorieManager();
		$categories = $manager->allCategorie();
		require 'views/produits/form.php';
		$page = ob_get_clean();
		return $page;
	}

	public function save($formulaire){
		if($this->isValid($formulaire)){
			if($this->insertProduit($formulaire)){
				header('Location: index.php?page=marques');
			}
			else{
				echo '<p>Une erreur est survenue lors de l\'ajout du modèle</p>';
			}
		}
		else{
			echo '<p>Formulaire invalide</p>';
		}
	}

	public function isValid($donnees){
		if(
			isset($donnees['nom']) && !empty($donnees['nom'])
			&&
			isset($donnees['prix']) && !empty($donnees['prix'])
			&&
			isset($donnees['description']) && !empty($donnees['description'])
			&&
			isset($donnees['quantite']) && !empty($donnees['quantite'])
			&&
			isset($donnees['categorie']) && !empty($donnees['categorie'])
		){
			return true;
		}
		else{
			return false;
		}
	}

	public function update($id_modele){
		ob_start();
		$modele = $this->findOneById($id_modele);
		$manager = new CategorieManager();
		$categories = $manager->allCategorie();
		require 'views/produits/form.php';
		$page = ob_get_clean();
		return $page;
	}

	public function persistUpdate($formulaire, $id_prod){
		if($this->isValid($formulaire)){
			if($this->majProduit($formulaire, $id_prod) > 0){
				header('Location: index.php?page=categorie');
			}
			else{
				echo '<p>Une erreur est survenue lors de la mise à jour</p>';
			}
		}
		else{
			echo '<p>Formulaire invalide</p>';
		}
	}

	public function delete($id_prod){
		if($this->delProduit($id_prod) > 0){
			header('Location: index.php?page=categorie&success=produitSuppr');
		}
		else{
			echo '<p>Une erreur est survenue lors de la suppression du modèle</p>';
		}
	}
}