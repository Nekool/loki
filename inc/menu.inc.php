<a href="<?= URL ?>"><img src="<?= URL ?>/assets/images/logo.png" alt=""></a>
<nav class="collapse navbar-collapse col-md-10">
<ul class="nav navbar-nav navbar-inverse">
<?php if(empty($_SESSION['membre'])) :  ?>
<li><a href="<?= URL ?>/connexion.php">Se connecter</a></li>
<li><a href="<?= URL ?>/inscription.php">Créer un nouveau compte</a></li>

<?php endif; ?>
<li><a href="<?= URL ?>/index.php">Accueil </a></li>
<li><a href="<?= URL ?>/reservation.php">Réservation</a></li>
<li><a href="<?= URL ?>/recherche.php">  Recherche </a></li>

<?php if(userConnected()) : ?>
<li><a href="<?= URL ?>/connexion.php?action=deconnexion">deconnexion</a></li>
<?php endif; ?>
<?php if(userAdmin()) : ?>
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
	<ul class="dropdown-menu" role="menu">
		<li><a href="<?= URL ?>/admin/gestion_salles.php">Gestion des salles</a></li>
		<li><a href="<?= URL ?>/admin/gestion_produits.php">Gestion des produits</a></li>
		<li><a href="<?= URL ?>/admin/gestion_membres">Gestion des membres</a></li>
		<li><a href="<?= URL ?>/admin/gestion_commandes.php">Gestion des commandes</a></li>
		<li><a href="<?= URL ?>/admin/gestion_avis.php">Gestion des avis </a></li>
		<li><a href="<?= URL ?>/admin/gestion_promo.php?">Gestion des promotions</a></li>
		<li><a href="<?= URL ?>/admin/statistique.php?">Gestion de la boutique</a></li>
		<li><a href="<?= URL ?>/admin/newsletter.php?">Envoyer la newsletter</a></li>
	</ul>
</li>
<?php endif; ?>
</ul>
</nav>