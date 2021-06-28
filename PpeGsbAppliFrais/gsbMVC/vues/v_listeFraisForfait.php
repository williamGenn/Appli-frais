<section class="page-section clearfix">
  <div class="container">
    <div class="intro">
      <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="images/intro.jpg" alt="">
      <div class="intro-text left-0 text-center bg-faded p-5 rounded">
        <h2 class="section-heading mb-4">
          <span class="section-heading-upper"><?php echo $numMois."-".$numAnnee ?></span>
        </h2>
        <form method="POST"  action="index.php?uc=gererFrais&action=validerMajFraisForfait">
          <div class="corpsForm">
            <fieldset>
              <legend>Eléments forfaitisés</legend>

<?php
foreach ($lesFraisForfait as $unFrais) {
    $idFrais = $unFrais['idfrais'];
    $libelle = $unFrais['libelle'];
    $quantite = $unFrais['quantite']; ?>
              <p>
                <label for="idFrais"><?php echo $libelle ?></label>
                <input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" size="10" maxlength="5" value="<?php echo $quantite?>" >
              </p>

<?php
}
?>
            </fieldset>
          </div>
          <div class="intro-button mx-auto">
            <div class="btn btn-primary btn-xl" >
              <input id="ok" type="submit" value="Valider" size="20">
              <input id="annuler" type="reset" value="Effacer" size="20">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
