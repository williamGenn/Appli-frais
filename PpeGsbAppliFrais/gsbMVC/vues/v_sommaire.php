    <!-- Division pour le sommaire -->
<?php
if ($liste) {
    ?>
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
   <div class="container">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarResponsive">


        <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
                <p class="nav-link text-uppercase text-expanded">
                    <?php echo $_SESSION['role']?> :
                    <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
                </p>
            </li>
    <?php
    foreach ($listeMenu as $nom => $action) {
        ?>
            <li class="nav-item px-lg-4">
                <a class="nav-link text-uppercase text-expanded" href=<?php echo $action ?> title=<?php echo $nom ?>><?php echo $nom ?></a>
            </li>

    <?php
    } ?>
        </ul>
     </div>
   </div>
</nav>
<?php
}
?>
