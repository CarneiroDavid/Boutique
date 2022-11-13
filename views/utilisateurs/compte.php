<h4 class="text-center mt-4">Gestion des comptes</h4>
<div class="col-12 d-flex">
    <?php
    foreach($comptes as $compte)
    {
        ?>
                <?php
                if($compte["id"] != $_SESSION["id"])
                {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><span style="color :red"><?="(" . $compte['profil']. ") ";?></span><?=$compte["nom"] . ' ' . $compte["prenom"];?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?=$compte["email"];?></h6>
                           
                            <a href="?page=profilUser&id=<?=$compte["id"];?>" class="card-link">Profil</a>
                            
                        </div>
                    </div>
                <?php
                }
                ?>
       
        <?php
    }
    ?>
</div>
