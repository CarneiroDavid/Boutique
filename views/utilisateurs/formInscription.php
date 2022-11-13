<h4 class="text-center mt-4">Inscription</h4>
<form method="post" action="">
    <div class="form-group">
        <label for="email">Adresse mail</label>
        <input type="text" class="form-control" id="email" name="email">

        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom">

        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom">

        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Password">
            <label for="exampleInputPassword1">Vérification mot de passe</label>
            <input type="password" class="form-control" name="mdp2" id="mdp2" placeholder="Password">
        </div>
        
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <br>
    <a href="?page=connexion">Déjà enregistré ?</a>
</form>