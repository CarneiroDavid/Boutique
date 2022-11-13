<?php

if(!empty($modeles)){
	?>
	<h4 class='text-center mt-4'>Liste des produits</h4>
	<?php
	foreach ($modeles as $m) {
		echo "<p>".$m['nom']." : ".$m['prix']."€"; 
		if($_SESSION["profil"] === "admin")
		{
			echo "/ <a href=?page=produit&action=update&id=".$m['id'].">Edit</a> / <a href=?page=produit&action=delete&id=".$m['id'].">Supprimer</a></p><hr>";
		}
		
	}
}
else{
	echo '<p>Il n\'y a aucun modèle</p>';
}