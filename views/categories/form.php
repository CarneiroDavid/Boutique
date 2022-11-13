<?php
if(isset($marque))
{
	?>
	<h4 class="text-center mt-4">Modification de catégorie</h4>
	<?php
}
?>
<form action="" method="POST">
	<div class="form-group">
		<label for="exampleInputEmail1">Nom :</label>
		<input type="text" class="form-control" name="nom" id="nom" 
			<?php
			$btn = 'Ajouter';
			if (isset($marque)) {
				$btn = 'Mettre à jour';
				
				echo 'value="' . $marque['nom'] . '"';
			}
			?>
		>
	</div>
	<br>
	<input type="submit" class="btn btn-success" name="ajouter" value="<?= $btn; ?>">
</form>