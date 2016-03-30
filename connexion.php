<?php
	$titre="connexion";
	$erreur='';
	include_once 'inc/init.inc.php';
	include_once 'inc/header.inc.php';

	if(isset($_SESSION['membre'])){
		header('location:index.php');
		die();
	}
	$pseudo = (!empty($_POST['pseudo'])) ? trim(strip_tags($_POST['pseudo'])) : '';

	$mdp = (!empty($_POST['mdp'])) ? trim(strip_tags($_POST['mdp'])) : '';

	$verif_user=$lokisalle->prepare('SELECT * from membre where pseudo =:pseudo ');
	$verif_user->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
	$verif_mdp=$lokisalle->prepare('SELECT * from membre where mdp =:mdp ');
	$verif_mdp->bindValue(':mdp',$mdp, PDO::PARAM_STR);
	$verif_user->execute();
	$verif_mdp->execute();
	if($verif_user->rowCount()>0 && $verif_mdp->rowCount()>0){
		$verif_user=$verif_user->fetchAll(PDO::FETCH_ASSOC);
		$verif_mdp=$verif_mdp->fetchAll(PDO::FETCH_ASSOC);

		if(!isset($_SESSION['membre'])){
			session_start();
			$_SESSION['membre']['id_membre']=$verif_user[0]['id_membre'];
			$_SESSION['membre']['nom']=$verif_user[0]['nom'];
			$_SESSION['membre']['prenom']=$verif_user[0]['prenom'];
			$_SESSION['membre']['ville']=$verif_user[0]['ville'];
			$_SESSION['membre']['cp']=$verif_user[0]['cp'];
			$_SESSION['membre']['adresse']=$verif_user[0]['adresse'];
			unset($_POST['mdp']);
			unset($_POST['pseudo']);
		}
	}
	else if($verif_user->rowCount()>0 ){
		$erreur="le pseudo n'existe pas";
	}
	else($verif_mdp->rowCount()>0 ){
		$erreur="Le mot de passe est faux";
	}
?>
<body>
<div>
	<?php
		echo $erreur;
	?>
</div>
<form method="post" >	
		<label>	Pseudo</label>
		<input type="text" name="pseudo">
		<label>	MDP</label>
		<input type="text" name="mdp">
		<input type="submit">	
		</form>
</body>
</html>