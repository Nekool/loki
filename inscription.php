<?php

$titre = 'Inscription';
// à inclure dans un fichier inc/init
require_once 'inc/connexion_bdd.inc.php';

$pseudo = (!empty($_POST['pseudo'])) ? trim(strip_tags($_POST['pseudo'])) : '';
$mdp = (!empty($_POST['mdp'])) ? trim(strip_tags($_POST['mdp'])) : '';
$nom = (!empty($_POST['nom'])) ? trim(strip_tags($_POST['nom'])) : '';
$prenom = (!empty($_POST['prenom'])) ? trim(strip_tags($_POST['prenom'])) : '';
$email = (!empty($_POST['email'])) ? trim(strip_tags($_POST['email'])) : '';
$sexe = (!empty($_POST['genre'])) ? trim(strip_tags($_POST['genre'])) : '';
$ville = (!empty($_POST['ville'])) ? trim(strip_tags($_POST['ville'])) : '';
$cp = (!empty($_POST['code_postale'])) ? trim(strip_tags($_POST['code_postale'])) : '';
$adresse = (!empty($_POST['adresse'])) ? trim(strip_tags($_POST['adresse'])) : ''; 

$alert='';

if(isset($_POST['confirm'])){

	// Vérification par l'adresse email et du pseudo pour éviter un doublon dans la base de donnée
	$check = $lokisalle->prepare('SELECT email FROM membre WHERE email = :email');
	$check->bindValue(':email', $email, PDO::PARAM_STR);
	$check->execute();

	$check_pseudo = $lokisalle->prepare('SELECT pseudo FROM membre WHERE pseudo = :pseudo');
	$check_pseudo->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
	$check_pseudo->execute();

	if($check->rowCount() > 0) {
		// Style css à définir
		$alert = '<p>Un compte avec cet email a déjà été créé </p>';
		echo $alert;

	} else { 

		
		if($check_pseudo->rowCount() > 0){
			// style css à définir
			$alert = 'Ce pseudo est déjà utilisé, veuillez en choisir un nouveau';
			echo $alert;
		} else {

			// cette partie du code evite d'enregistrer un nouveau membre avec des champs vides
			if(!empty($pseudo) && !empty($mdp) && !empty($nom) && !empty($prenom) && !empty($email) && !empty($sexe) && !empty($ville) && !empty($cp) && !empty($adresse)) {
				
				if(strlen($pseudo) < 3 || strlen($mdp) < 3){
					$alert = 'Le pseudo et le mot de passe doivent faire au minimum 3 caractères';
					echo $alert;
				}

			if(preg_match('/@/', $email)){

				$new_member = $lokisalle->prepare('INSERT INTO membre (pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) 
												VALUES (:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse)');

				$mdp = sha1($mdp, PASSWORD_DEFAULT);

				$new_member->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
				$new_member->bindValue(':mdp', $mdp, PDO::PARAM_STR);
				$new_member->bindValue(':nom', $nom, PDO::PARAM_STR);
				$new_member->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$new_member->bindValue(':email', $email, PDO::PARAM_STR);
				$new_member->bindValue(':sexe', $sexe, PDO::PARAM_STR);
				$new_member->bindValue(':ville', $ville, PDO::PARAM_STR);
				$new_member->bindValue(':cp', $cp, PDO::PARAM_INT);
				$new_member->bindValue(':adresse', $adresse, PDO::PARAM_STR);

				$new_member->execute();
			}

			
			}



		}
	}

}

 ?>




<!DOCTYPE html>

<!-- Partie à récupérer d'un include -->
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet"  href="css/style.css">
		<title>titre</title>

	</head>

	<!-- Zone du formulaire -->
	<main>
		<section>
			<form action="inscription.php" method="post" >
			
	            <label for="pseudo">Pseudo</label>
				<input type="text" name="pseudo" value="<?= $pseudo ?>" required>

	            <label for="mdp">Mot de passe</label>
				<input type="text" name="mdp" value=""  required>

	            <label for="nom">Nom</label>
				<input type="text" name="nom" value="<?= $nom ?>" required>

	            <label for="prenom">Prenom</label required>
				<input type="text" name="prenom" value="<?= $prenom ?>">

	            <label for="email">Email</label>
				<input type="text" name="email" value="<?= $email ?>" required>

	            <label for="genre">Sexe</label>
				<input type="radio" value="m" name="genre">M
				<input type="radio" value="f" name="genre">F

	            <label for="ville">Ville</label>
				<input type="text" name="ville" value="<?= $ville ?>">

	            <label for="cp">Code postale</label>	
				<input type="text" name="code_postale" value="<?= $cp ?>">
				
				<label for="adresse">adresse</label>
				<textarea rows="5" cols="19" name="adresse"><?= $adresse ?></textarea>

				<button type="submit" name="confirm" >Inscription</button>

			</form>
		</section>
	</main>

<?php include_once 'inc/footer.inc.php' ?>
	
</html>