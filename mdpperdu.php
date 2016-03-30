<!-- <meta charset="UTF-8" /> -->
<?php
include 'inc/head.inc.php';
require_once 'inc/connexion_bdd.inc.php';
// header avec le menu à insérer
// require_once 'inc/head.inc.php'

$titre = 'récupération du mot de passe';
$check_mail = '';
$recup_mdp = '';
$message = '';
$new_mdp = '';

// fonction pour envoyer un mail
// variables à définir au préalable
// mail($mailClient, $subject, $content);


$email = (!empty($_POST['email'])) ? trim(strip_tags($_POST['email']))  : '';

if(isset($_POST['confirm'])) {
	if(preg_match('/@/', $email)){ //Sert à vérifier si c'est bien une adresse email

		if(!empty($email)){

		// cela servira à vérifier qu'il y a bien une adresse email qui correspond à la demande
		$verif_mail=$lokisalle->prepare('SELECT email FROM membre WHERE email = :email');
		$verif_mail->bindValue(':email',$email,PDO::PARAM_STR);
		$verif_mail->execute();
		// var_dump(get_class_methods($verif_mail));

			if($verif_mail->rowCount() > 0){

				// Fonctions de modification de mot de passe et envoie d'email.

				// génération aléatoire de mot de passe
				$chars = 'azertyuiopqsdfghjklmwxcvbn0123456789';
				$new_mdp = str_shuffle($chars);
				$new_mdp = substr($new_mdp, 1, 12);
				// echo $new_mdp;

				// remplacement du mot de passe dans la BDD
				$remp_mdp = $lokisalle->prepare("UPDATE membre SET mdp = :new_mdp WHERE email = :email");
				$remp_mdp->bindValue(':email', $email, PDO::PARAM_STR);
				$remp_mdp->bindValue(':new_mdp',$new_mdp,PDO::PARAM_STR);
				$remp_mdp->execute();

				// envoi de l'email
				


				// balise '<p>' qui pourrait changer pour faciliter le paramétrage du style
				$message = '<p>Un email vous a été envoyé </p>';
				echo $message;
			} else {
				echo $message = '<p>Aucun compte ne correspond à cet adresse email</p>';
			}

		}
	} else {
		echo $message = '<p>Ceci n\'est pas une adresse email</p>';
	}

}

 ?>

<h2>Afin de réinitialiser votre mot de passe, vous devez nous fournir votre adresse</h2>

<form action="mdpperdu.php" method="post" >
	<label for="email">Email:</label>
	<input type="text" name="email" required>

	<label for="email">un essai:</label>
	<input type="text" name="email" required>


	<button type="submit" name="confirm" >Valider</button>

</form>



<?php 
include_once 'inc/footer.inc.php'; 
?>