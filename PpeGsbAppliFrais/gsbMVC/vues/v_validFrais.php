
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> :
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>


    </p>

    <form action="index.php?uc=validFrais&action=envoiFormulaire" method="post" id="FraisForfait">

  <table class="listeLegere">
     <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ($lesFraisForfait as $unFraisForfait) {
             $libelle = $unFraisForfait['libelle']; ?>
<th> <?php echo $libelle?></th>
<?php
         }
        ?>
            <th>Situation</th>
</tr>
        <tr>
        <?php
          foreach ($lesFraisForfait as $unFraisForfait) {
              $quantite = $unFraisForfait['quantite'];
              $id = $unFraisForfait['idfrais']; ?>
                <td class="qteForfait">
                    <input type="text" value="<?php echo $quantite?>" name="FraisForfait[<?php echo $id?>]">
                </td>
 <?php
          }
        ?>
            <td>
                <select name="EtatFraisForfait">
                <?php
                foreach ($lesEtats as $unEtat) {
                    $id = $unEtat['id'];
                    $libelle= $unEtat['libelle'];
                    if (strcmp($unEtat['id'], $etatSelectionne[0])) {
                        ?>
                    <option value="<?php echo $id?>"><?php echo $libelle ?></option>
                    <?php
                    } else {
                        ?>
                    <option selected="selected" value="<?php echo $id?>"><?php echo $libelle ?></option>
                    <?php
                    }
                }
                ?>
                </select>
            </td>
</tr>
    </table>


  <table class="listeLegere">
     <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
         <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>
            <th class="Situation">Situation</th>
         </tr>
        <?php
          $i=0;
          foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
              $i+=1;
              $date = $unFraisHorsForfait['date'];
              $libelle = $unFraisHorsForfait['libelle'];
              $montant = $unFraisHorsForfait['montant'];
              $idFrais = $unFraisHorsForfait['id']; ?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td><select name="EtatFraisHorsForfait[<?php echo $idFrais?>]">
                <?php
                foreach ($lesEtats as $unEtat) {
                    $id = $unEtat['id'];
                    $libelle= $unEtat['libelle'];
                    if (strcmp($unEtat['id'], $etatSelectionne[$i])) {
                        ?>
                        <option value="<?php echo $id?>"><?php echo $libelle ?></option>
                    <?php
                    } else {
                        ?>
                        <option selected="selected" value="<?php echo $id?>"><?php echo $libelle ?></option>
                    <?php
                    }
                } ?>
            </select></td>
             </tr>
        <?php
          }
        ?>
    </table>
    <input type="submit" value="Envoyer"/>
    <input type="reset" value="Effacer"/>
  </form>
  </div>
  </div>
