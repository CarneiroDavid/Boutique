<?php
if($_SESSION["profil"] ==="admin")
{
	if(isset($modele)){
		?>
			<h4 class="text-center mt-4">Modification de produits</h4>
		<?php
	}
	?>
	<form action="" method="POST">
		<div class="form-group col-6">
			<label for="nom">Nom : </label>
			<input type="text" class="form-control" name="nom" id="nom"
				<?php
				$btn = 'Ajouter';
				if(isset($modele)){
					$btn = 'Mettre à jour';
					echo 'value="'.$modele['nom'].'"';
				}
				?>
			>
		</div>
		<div class="form-group col-6">
			<label for="prix">Prix : </label>
				<input class="form-control" type="number" name="prix" id="prix"
					<?php
					if(isset($modele)){
						echo 'value="'.$modele['prix'].'"';
					}
					?>
				>
		</div>
		
		<div class="form-group col-6">
			<label for="prix">Description : </label>
			<input class="form-control" type="textarea" name="description" id='description'
				<?php
				if(isset($modele)){
					echo 'value="'.$modele['description'].'"';
				}
				?>
			>
		</div>
		<div class="form-group col-6">
			<label for="prix">Quantite : </label>
				<input type="number" class="form-control" name="quantite" id='quantite'
					<?php
					if(isset($modele)){
						echo 'value="'.$modele['quantite'].'"';
					}
					?>
				>
		</div>
		
		<br>
		<div class="form-group col-6">
			<label for="categorie">Categorie : </label>
			<select class="form-control" name="categorie" id="categorie">
			<?php
				
				foreach($categories as $cat){
					?>
					<option value="<?= $cat['id']; ?>" 
					<?php
						if(isset($modele) && $cat['id'] == $modele['idCategorie']){
							echo 'selected';
						}
					?>
					><?= $cat['nom']; ?></option>
					<?php
				}
			?>
			</select>
		</div>
		
		
		<br>
		<input type="submit" name="envoyer" value="<?= $btn; ?>">
	</form>
	<?php
}
?>
