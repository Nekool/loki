?php
	$titre="connexion";
	$erreur='';
	include_once 'inc/init.inc.php';
	include_once 'inc/header.inc.php';
	test....

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