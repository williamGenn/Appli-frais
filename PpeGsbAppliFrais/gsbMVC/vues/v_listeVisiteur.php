<form action="index.php?uc=validFrais&action=voirListMois" method="post">
    <div class="corpsForm">
        <p>
            <label for="lstVisiteur" accesskey="n">Visiteur : </label>
            <select id="lstVisiteur" name="lstVisiteur">
                <?php
                foreach ($lesVisiteur as $unVisiteur) {
                    $idVisiteur = $unVisiteur['id'];
                    $nomVisiteur= $unVisiteur['nom'];
                    if ($idVisiteur == $visiteurSelectionne) {
                        ?>
                    <option selected value="<?php echo $idVisiteur ?>"><?php echo  $nomVisiteur ?> </option>
                    <?php
                    } else { ?>
                    <option value="<?php echo $idVisiteur ?>"><?php echo  $nomVisiteur ?> </option>
                    <?php
                    }
                }

               ?>

            </select>
        </p>
    </div>
        <div class="piedForm">
        <p>
            <input id="ok" type="submit" value="Valider" size="20" />
        </p>
    </div>
</form>
