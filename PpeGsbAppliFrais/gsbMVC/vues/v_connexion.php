<h3 style="text-align: center; color: white;">Bonjour !</h3>

<section class="page-section cta">
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="cta-inner text-center rounded">
          <div class="section-heading mb-4">
            <h4 style="margin-bottom: 1em;">Entrez vos Identifiants</h4>
            <div>
              <div class="corpsForm">
                <form method="POST" action="index.php?uc=connexion&action=valideConnexion">
                  <p style="margin-left: 4em;">
                   <label for="nom">Login*</label>
                   <input id="login" type="text" name="login" size="30" maxlength="45">
                  </p>
                  <p>
                    <label for="mdp">Mot de passe*</label>
                    <input id="mdp" type="password" name="mdp" size="30" maxlength="45">
                  </p>
                  <p>
                   <input type="submit" value="Valider" name="valider">
                   <input type="reset" value="Annuler" name="annuler">
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
