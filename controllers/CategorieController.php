<?php

class CategorieController extends CategorieManager{
	/**
	 * Récupère la liste des marques
	 */
	public function getCategorie(){
		// Mise en tampon de tout ce qui suit
		ob_start();
		// Appel du manager
		$categories = $this->allCategorie();
		// Appel de la vue (qui va posséder la variable $marques)
		require 'views/categories/index.php';
		// Récupération de la vue
		$page = ob_get_clean();

		return $page;
	}

	/**
	 * Récupère le formulaire d'ajout de categorie
	 */
	public function getForm(){
		ob_start();
		require 'views/categories/form.php';
		$vue = ob_get_clean();
		return $vue;
	}

	public function saveCat($formulaire){
		if($this->isValid($formulaire)){
			if($this->insertCat($formulaire) > 0)
			{
				header('location:?page=categorie&success=insertCat');
			}
			else
			{
				header('location:?page=categorie&error=insertCat');
			}
		}
		else
		{
			header('location:?page=categorie&error=formInsertCat');
		}
	}

	public function isValid($donnees){
		if(isset($donnees['nom']) && !empty($donnees['nom'])){
			return true;
		}
		else{
			return false;
		}
	}

	public function update($id){
		ob_start();
		$marque = $this->findOneByIdCat($id);
		require 'views/categories/form.php';
		$vue = ob_get_clean();
		return $vue;
	}

	public function persistUpdate($formulaire, $id_marque){
		if($this->isValid($formulaire)){
			if($this->editCat($formulaire, $id_marque) > 0){
				header('Location: index.php?page=categorie&success=updateCat');
			}
			else{
				header('location:?page=categorie&error=updateCat');
			}
		}
		else{
			echo '<p>Formulaire invalide</p>';
		}
	}

	public function delete($id_cat){
		if($this->delCat($id_cat) > 0){
			header('Location: index.php?page=categorie&success=catDelete');
		}
		else{
			echo '<p>Marque introuvablett</p>';
		}
	}
}