<?php
	$titre="Menu";
	include_once 'inc/init.inc.php';
	include_once 'inc/header.inc.php';
		if(!empty($_GET['action']) && $_GET['action'] == 'deconnexion') {
		unset($_SESSION['utilisateur']); // si j'ai un get deconnexion avec la valeur "ok" alors je supprimme la session utilisateur
	}
?>
<!-- com-->
<main>
<article>
	Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
	Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker
	
</article>
<aside>
<?php
	$aside=$lokisalle->query('SELECT * from salle', PDO::FETCH_ASSOC);
	$aside->execute();
	$aside_produit=$lokisalle->query('SELECT * from produit');
	$aside_produit->execute();
	$produit=$aside_produit->fetchAll(PDO::FETCH_ASSOC);
	$aside_data=$aside->fetchAll(PDO::FETCH_ASSOC);

for ($i	=0; $i<count($aside_data) ; $i++) { 
	echo'<div><img src="'.URL.'/images/'.$aside_data[$i]["photo"].'"><span>'.$aside_produit[$i]["date_arrivee"].' '.$aside_produit[$i]["date_depart"].' '.$aside_data[$i]["ville"].'<br>'.$produit[$i]["prix"].' '.$aside_data[$i]["capacite"].'<a href="fiche_produit.php?produit='.$produit[$i]["id_produit"].'"></a></div>';
	
}
var_dump($_SESSION);
?>
</aside>	
</main>

<?php
	include_once 'inc/footer.inc.php';
?>
</body>
</html>