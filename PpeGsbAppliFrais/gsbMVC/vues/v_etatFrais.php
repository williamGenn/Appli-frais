              <div class="encadre mx-auto" style="margin-top: 50px;">
                <h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> :</h3>
                <p>Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?></p>
                <caption><span style=" border-bottom:0.5px solid black; padding-bottom:1px;">Eléments forfaitisés </span></caption>
                <table class="listeLegere mx-auto" style="border-collapse: separate;border-spacing: 35px;font-variant: normal;">
                  <thead>
               <?php
              foreach ($lesFraisForfait as $unFraisForfait) {
                  $libelle = $unFraisForfait['libelle']; ?>
                    <th> <?php echo $libelle?></th>
              <?php
              }
              ?>
                  </thead>
                    <tbody>
                      <tr>
                  <?php
                  foreach ($lesFraisForfait as $unFraisForfait) {
                      $quantite = $unFraisForfait['quantite']; ?>
                          <td class="qteForfait"><?php echo $quantite?> </td>
                  <?php
                  }
                  ?>
                      </tr>
                    </tbody>
                  </table>
                  <table class="listeLegere mx-auto" style="border-collapse: separate;border-spacing: 35px;font-variant: normal;">
                    <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -</caption>
                      <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>
                        <th class='montant'>Montant</th>
                      </tr>
              <?php
              foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                  $date = $unFraisHorsForfait['date'];
                  $libelle = $unFraisHorsForfait['libelle'];
                  $montant = $unFraisHorsForfait['montant']; ?>
                      <tr>
                        <td><?php echo $date ?></td>
                        <td><?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>
                      </tr>
              <?php
              }
              ?>
                </table>
              </div>
