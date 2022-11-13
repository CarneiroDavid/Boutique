<h4 class="text-center mt-4">Modification du profil de <?=$profils['nom'] . ' '. $profils["prenom"];?></h4>
<form method="post" >
    <div class="form-group">
        <label for="exampleInputEmail1">Nom</label>
        <input type="text" name="modifNom" value="<?=$profils["nom"];?>" class="form-control">

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Prénom</label>
        <input type="text" name="modifPrenom" value="<?=$profils["prenom"];?>" class="form-control">
        <input type="hidden" name="id" value="<?=$_GET["id"];?>" class="form-control">
    </div>

    <label for="exampleInputEmail1">Profil</label>
    <select class="form-select" name="profil" aria-label="Default select example">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>