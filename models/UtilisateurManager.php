<?php

class UtilisateurManager extends BDD{

	public function conUser($data){
		
		$sql = "SELECT * FROM utilisateurs WHERE email =:email";
		$select = $this->co->prepare($sql);
		$select->execute(['email' => $data["email"]]);

		return $select->fetchAll();
	}

	public function selectUserByEmail($email){
		
		$sql = "SELECT * FROM utilisateurs WHERE email =:email";
		$select = $this->co->prepare($sql);
		$select->execute(['email' => $email]);

		return $select->fetch();
	}

	public function insertUser($donnees){
		$mdpHash = password_hash($donnees["mdp"], PASSWORD_BCRYPT);

		$sql = 'INSERT INTO utilisateurs (email, nom, prenom, mdp) VALUES (:e, :n, :p, :mdp)';
		$insert = $this->co->prepare($sql);
		$insert->execute([
			'e' => $donnees['email'],
            'n' => $donnees['nom'],
            'p' => $donnees['prenom'],
            'mdp' => $mdpHash
		]);

		return $insert->rowCount();
	}

	public function findOneById($id){
		$sql = 'SELECT * FROM utilisateurs WHERE id = :id';
		$select = $this->co->prepare($sql);
		$select->execute(['id' => $id]);

		return $select->fetch();
	}

	public function getComptes()
	{
		$sql = 'SELECT * FROM utilisateurs';
		$select = $this->co->prepare($sql);
		$select->execute();
		return $select -> fetchAll();
	}

	public function getProfil($id)
    {
		$sql = 'SELECT * FROM utilisateurs WHERE id = :id';
		$select = $this->co->prepare($sql);
		$select->execute(['id' => $id]);
		return $select->fetch();
	}

	public function majUser($donnees){
		$sql = 'UPDATE utilisateurs SET nom = :n, prenom = :p, profil = :profil WHERE id = :id';
		$update = $this->co->prepare($sql);
		$update->execute([
			'n'=>$donnees['modifNom'],
			'p'=>$donnees['modifPrenom'],
			'profil'=>$donnees['profil'],
			'id'=>$donnees['id']
		]);

		return $update->rowCount();
	}

	public function delUser($id){
		$sql = 'DELETE FROM utilisateurs WHERE id = :id';
		$del = $this->co->prepare($sql);
		$del->execute(['id' => $id]);

		return $del->rowCount();
	}
}