<h4 class='text-center mt-4'>Liste des catégories</h4>
<?php

if(!empty($categories)){
	foreach ($categories as $cat) {
		echo "<p>".$cat['nom'] . " : <a href=?page=cat_produit&categorie=".$cat['id'].">Voir</a>";
		if($_SESSION["profil"] === "admin")
		{
			echo ' : / <a href="?page=cat_update&id='.$cat['id'].'">Editer</a> 
		/ <a href="?page=cat_delete&id='.$cat['id'].'">Supprimer</a></p><hr>';
		}
		
	}
}
else{
	echo '<p>Il n\'y a aucune catégorie</p>';
}