<?php

class UtilisateurControllers extends UtilisateurManager{

    public function getForm(){
		ob_start();
		require 'views/utilisateurs/formConnexion.php';
		$vue = ob_get_clean();
		return $vue;
	}

	public function session($data)
	{
		$_SESSION["id"] = $data[0]["id"];
		$_SESSION["email"] = $data[0]["email"];
		$_SESSION["nom"] = $data[0]["nom"];
		$_SESSION["prenom"] = $data[0]["prenom"];
		$_SESSION["password"] = $data[0]["mdp"];
		$_SESSION["profil"] = $data[0]["profil"];
	}

	public function deco()
	{
		ob_start();
		require 'views/utilisateurs/deconnexion.php';
		$vue = ob_get_clean();
		return $vue;
	}

	public function inscription()
	{
		ob_start();
		require 'views/utilisateurs/formInscription.php';
		$vue = ob_get_clean();
		return $vue;
	}

	public function connexion()
	{
		ob_start();
        require 'views/utilisateurs/formConnexion.php';
        $vue = ob_get_clean();
        return $vue;
	}

	public function verifConnexion($data)
	{
		$userManager = new UtilisateurManager();
		$conn = $userManager->selectUserByEmail($data["email"]);
		if(!empty($conn))
		{
			if(password_verify($data["mdp"], $conn["mdp"]))
			{
				return true;
			}
			else
			{
				header('location:?page=connexion&error=conn');
			}
		}
		else
		{
			header('location:?page=connexion&error=identifiant');
		}
	}

	public function save($formulaire){
		if($this->isValid($formulaire))
		{
			if($formulaire['mdp'] === $formulaire['mdp2'])
			{
				try
				{
					$this->insertUser($formulaire);
				}
				catch(Exception $e)
				{
					header('Location:?page=inscription&error=requete');
				}
			}
			else
			{
				header('location: ?page=inscription&error=mdpDifferent');
			}
		}
		else{
			header('location:?page=inscription&error=formulaire');
		}
	}

	public function isValid($donnees){
		if(
			isset($donnees['email']) && !empty($donnees['email'])
			&&
			isset($donnees['nom']) && !empty($donnees['nom'])
			&&
			isset($donnees['prenom']) && !empty($donnees['prenom'])
			&&
			isset($donnees['mdp']) && !empty($donnees['mdp']) 
			&&
			isset($donnees['mdp2']) && !empty($donnees['mdp2'])
		){	
			return true;	
		}
		else{
			return false;
		}
	}	

	public function affichageCompte(){
		ob_start();
		$comptes = $this->getComptes();	
		
		require 'views/utilisateurs/compte.php';
		$page = ob_get_clean();

		return $page;
	}

	public function affichageProfil($id)
	{
		ob_start();
		$profils = $this->getProfil($id);	
		require 'views/utilisateurs/profilUser.php';
		$page = ob_get_clean();

		return $page;
	}
	public function isValidModifUser($data)
    {
		if(!empty($data["modifNom"]) && !empty($data["modifPrenom"]) && !empty($data["profil"]) && !empty($data["id"]))
		{
			$objetUtilisateur = new UtilisateurManager;
			$modif = $objetUtilisateur-> majUser($data);
			if($modif)
			{
				header("location:?page=profilUser&id=".$data['id']);
			}
			else
			{
				header("location:?page=categorie");
			}
		}
		else
		{
			header("location:?page=categorie&error=form");
		}
	}
	public function modifUser($id)
	{
		ob_start();
		$profils = $this->getProfil($id);	
		require 'views/utilisateurs/modifUser.php';
		$page = ob_get_clean();

		return $page;
	}
}