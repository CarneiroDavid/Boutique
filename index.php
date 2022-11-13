<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Bootstrap 5 CS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- Bootstrap Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- Bootstrap 4 JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="<?= (!empty($_SESSION) ? '?page=categorie' : '?page=connexion'); ?>">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<?php
				if (!empty($_SESSION)) {
					if($_SESSION["profil"] === 'admin')
					{
						?>
				
						<li class="nav-item">
							<a class="nav-link" href="?page=categorie">Liste des Catégories</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?page=cat_add">Ajouter une catégorie</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?page=compte">Compte</a>
						</li>
						
						<?php
					}
					?>
					<li class="nav-item">
						<a class="nav-link" href="?page=deconnexion">Deconnexion</a>
					</li>
					<?php
				
				} else {
					// header('location:?page=connexion');
				}
				?>
			</ul>
		</div>
	</nav>
	
	<div class="container">

		<?php
		if (!empty($_GET["success"])) {
			switch ($_GET["success"]) {
				case "catDelete":
				?>
					<div class="alert alert-success text-center">
						La catégorie a bien été supprimé
					</div>
				<?php
					break;
				case 'produitSuppr':
				?>
					<div class="alert alert-success text-center">
						Le produit a bien été supprimé
					</div>
				<?php
					break;
				case 'updateCat':
				?>
					<div class="alert alert-success text-center">
						La catégorie a bien été mise à jour
					</div>
				<?php
					break;
				case "insertCat":
					?>
						<div class="alert alert-success text-center">
							La catégorie vient d'être créé			
						</div>
					<?php
					break;
				default:
					break;
			}
		}
		if (!empty($_GET["error"])) {
			switch ($_GET["error"]) {
				case "conn":
					?>
						<div class="alert alert-danger text-center">
							Les identifiants saisi sont faux
						</div>
					<?php
					break;
				case "identifiant":
					?>
						<div class="alert alert-danger text-center">
							Vous n'avez pas saisit d'information ou les identifants sont faux
						</div>
					<?php
					break;
				case "formulaire":
					?>
						<div class="alert alert-danger text-center">
							Tous les champs n'ont pas été renseigné
						</div>
					<?php
					break;
				case "requete":
					?>
						<div class="alert alert-danger text-center">
							L'identifiant saisit est déjà utilisé
						</div>
					<?php
					break;
				case "mdpDifferent":
					?>
						<div class="alert alert-danger text-center">
							Les mot de passe ne sont pas identiques
						</div>
					<?php
					break;
				case "formInsertCat":
					?>
						<div class="alert alert-danger text-center">
							Vous n'avez pas saisit de categorie.
						</div>
					<?php
					break;
				default:
					break;
			}
		}

		require_once 'class/Autoload.php';
		Autoload::load(); // Appel automatiquement tous les fichiers nécessaires

		if (isset($_GET['page'])) {
			// if (!empty($_SESSION)) 
			// {
			switch ($_GET['page']) 
			{
				case 'inscription':


					$ctrl = new UtilisateurControllers();
					echo $ctrl->inscription();
					if (!empty($_POST)) {
						$donnee = $ctrl->save($_POST);
						if ($donnee) {
							header('location:?page=connexion');
						} else {
							echo 'rat';
						}
					}
					break;

				case 'deconnexion':
					$ctrl = new UtilisateurControllers();
					echo $ctrl->deco();
					header('location:?page=connexion');
					break;

				case 'connexion':
					if(empty($_SESSION))
					{
						$ctrl = new UtilisateurControllers();
						echo $ctrl->getForm();
						if (!empty($_POST)) 
						{
							if($ctrl -> verifConnexion($_POST) == true)
							{
								$donnee = $ctrl->conUser($_POST);
								if ($donnee) {
									$ctrl->session($donnee);
									header('location:?page=categorie');
								}
							}
						}
					}
					break;

				case 'categorie':
					if(!empty($_SESSION))
					{
						$ctrl = new CategorieController();
						echo $ctrl->getCategorie();
					}
					else
					{
						header('location:?page=connexion');
					}
					
					break;


				case 'cat_add':
					if($_SESSION["profil"] === 'admin')
					{
						$ctrl = new CategorieController();
						if (!empty($_POST)) {
							echo $ctrl->saveCat($_POST);
						} else {
							echo $ctrl->getForm();
						}
					}
					else
					{
						header('location:?page=categorie&error=access_denied');
					}
					
					break;

				case 'cat_update':
					if($_SESSION["profil"] === 'admin')
                    {
						print_r($_POST);
						$ctrl = new CategorieController();
                        if (empty($_POST)) 
						{
                            echo $ctrl->update($_GET['id']);
							
                        } else 
						{
								$ctrl = new CategorieController();
							if (isset($_GET['id']))
							{
								if (!empty($_POST)) 
								{

									echo $ctrl->persistUpdate($_POST, $_GET['id']);
								}
								// Sinon c'est qu'on a juste demandé le formulaire
								else 
								{
									echo $ctrl->update($_GET['id']);
								}
							} else 
							{
								echo '<p>Marque introuvable</p>';
							}
						}
					}
					else
					{
						header('location:?page=categorie&error=access_denied');
					}
                        
					break;

				case 'cat_delete':
					if($_SESSION["profil"] === 'admin')
                    {
						$ctrl = new CategorieController();
						if (isset($_GET['id']) && !empty($_GET['id'])) {
							echo $ctrl->delete($_GET['id']);
							// echo 'tete';
						} else {
							echo '<p>Marque introuvable</p>';
						}
					}
					else
					{
						header('location:?page=categorie&error=access_denied');
					}
					break;

				case 'cat_produit':
					$ctrl = new ProduitController();
					echo $ctrl->getModelesByMarque($_GET['categorie']);
					// echo $ctrl->add();
					if (!empty($_POST)) {
						echo $ctrl->save($_POST);
					} else {
						echo '<h4 class="text-center">Ajouter un produit</h4>';
						echo $ctrl->add();
					}
					break;

				case 'produit':
					$ctrl = new ProduitController();

					// Echappe si action n'est pas défini dans l'URL
					if (isset($_GET['action'])) {
						$action = $_GET['action'];
					} else {
						$action = null;
					}

					switch ($action) {
						case 'add': // ?page=modele&action=add
							if($_SESSION["profil"] === 'admin')
                    		{
								if (!empty($_POST)) {
									echo $ctrl->save($_POST);
								} else {
									echo $ctrl->add();
								}
							}
							else
							{
								header('location:?page=categorie&error=access_denied');
							}
							break;

						case 'update': // ?page=modele&action=update&id=x
							if($_SESSION["profil"] === 'admin')
                    		{
								if (isset($_GET['id']) && !empty($_GET['id'])) {
									// Si le formulaire de maj a été soumis
									if (!empty($_POST)) {
										echo $ctrl->persistUpdate($_POST, $_GET['id']);
									}
									// Sinon c'est qu'on a juste demandé le formulaire
									else {
										echo $ctrl->update($_GET['id']);
									}
								} else {
									echo '<p>Modele introuvable</p>';
								}
							}
							else
							{
								header('location:?page=categorie&error=access_denied');
							}
							break;

						case 'delete': 
							if($_SESSION["profil"] === 'admin')
                    		{
								if (isset($_GET['id']) && !empty($_GET['id'])) {
									echo $ctrl->delete($_GET['id']);
								} else {
									echo '<p>Modele introuvable</p>';
								}
							}
							else
							{
								header('location:?page=categorie&error=access_denied');
							}
							break;
						default:
							$_SESSION['erreur'] = '<p class="alert alert-danger">Page introuvable</p>';
							header('Location: index.php?page=categorie');
							break;
					}
					break;
				case 'compte':
					if($_SESSION["profil"] === 'admin')
					{
						$ctrl = new UtilisateurControllers();
						echo $ctrl->affichageCompte();
						
						echo $ctrl->inscription();
						if (!empty($_POST)) {
						$donnee = $ctrl->save($_POST);
						
					}

					}
					else
					{
						header('location:?page=categorie&error=access_denied');
					}
					break;
				case 'profilUser':
					if($_SESSION["profil"] === 'admin')
					{
						$ctrl = new UtilisateurControllers();
						echo $ctrl->affichageProfil($_GET["id"]);

					}
					else
					{
						header('location:?page=categorie&error=access_denied');
					}
					break;
				case 'modifUser':

					if($_SESSION["profil"] === 'admin')
					{
						$ctrl = new UtilisateurControllers();
						echo $ctrl->modifUser($_GET['id']);
						if(!empty($_POST))
						{
							if($ctrl -> isValidModifUser($_POST))
							{
								echo 'test';
							}

						}
					}
					else
					{
						header('location:?page=categorie&error=access_denied');
					}
					break;

				case 'delUser':
					if($_SESSION["profil"] === 'admin')
					{
						$ctrl = new UtilisateurControllers();
						echo $ctrl->delUser($_GET["id"]);
						// echo'test';
						header('location:?page=compte');
					}
					else
					{
						header('location:?page=compte&error=delUser');
					}
					break;

				default:
					// INDEX
					header('Location: index.php?page=categorie');
					break;
			}
		} else {
			// 404
			echo '<h1>404</h1>';
			echo '<p>Page introuvable</p>';
		}
		?>

	</div>

</body>

</html>