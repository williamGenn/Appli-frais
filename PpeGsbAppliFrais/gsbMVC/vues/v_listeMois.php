<section class="page-section cta">
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="cta-inner text-center rounded">
          <div class="section-heading mb-4">
            <h4>Mes fiches de frais</h4>
            <h6 >Mois à sélectionner :</h6>
            <form action="index.php?uc=<?php echo $uc ?>&action=voirEtatFrais" method="post">
              <div class="corpsForm">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois">
            <?php
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $numAnnee =  $unMois['numAnnee'];
                $numMois =  $unMois['numMois'];
                if ($mois == $moisSelectionne) {
            ?>
                  <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                <?php
                } else {
                ?>
                  <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                <?php
                }
            }
            ?>

                </select>
              </div>
              <div class="piedForm">
                <p>
                  <input id="ok" type="submit" value="Valider" size="20" />
                  <input id="annuler" type="reset" value="Effacer" size="20" />
                </p>
              </div>
            </form>
          </div>
