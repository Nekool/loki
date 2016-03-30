<?php
	$titre="Recherche";
	include_once 'inc/init.inc.php';
	include_once 'inc/header.inc.php';
	$postRecherche=(!empty($_POST['recherche'])) ? trim(strip_tags($_POST['recherche'])) : '';
	if(isset($_POST['recherche'])&&isset($_POST['parMot']))
	{
		$recherche=$lokisalle->prepare('Select * from salle where  pays LIKE :recherche OR ville LIKE :recherche OR categorie LIKE :recherche ORDER BY id_salle');
		$recherche->bindValue(':recherche',$postRecherche,PDO::PARAM_STR);
		$recherche->execute();
		$resultat_recherche=$recherche->fetchAll(PDO::FETCH_ASSOC);

	}
	if(isset($_POST['recherche'])&&isset($_POST['parMot']))
	
?>
<main>
	<form method="post">
		<h2>Recherche d’une location de salle pour réservation.</h2>
			<div><h3>Par Date</h3></div>

		<span>
			<div><h3> date arrivé</h3></div>

			<?php
			$année =date('Y');
			echo '<select name="arrive_année">';

			for ($i=$année; $i !=$année+5 ; $i++) { 
				# code...
				echo '<option>'.$i.'</option>';

			}
			echo'</select>';

			setlocale(LC_TIME, "fr_FR");
			$month = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
			echo '<select name="arrive_mois">';
			for ($i=0; $i !=count($month) ; $i++){ 
				# code...
				echo '<option>'.$month[$i].'</option>';

			}
			echo'</select>';

			?>

			<div><h3> date depart</h3></div>
			<?php
				echo '<select name="depart_année">';

				for ($i=$année; $i !=$année+5 ; $i++) { 
					# code...
					echo '<option>'.$i.'</option>';

				}
				echo'</select>';

				echo '<select name="depart_mois">';
				for ($i=0; $i !=count($month) ; $i++){ 
				# code...
					echo '<option>'.$month[$i].'</option>';

				}
				echo'</select>';
			?>
			<input type="submit" name="byDate">
		</span>
		</form>
		<div>
			<h3> Par mots clés</h3>
			
		</div>           

	
	<form method="post">
		<label>votre recherche</label>
		<input type="text" name="recherche">
		<input type="submit" name="parMot">

	</form>
	<div style="width:400px;margin: auto;">
		<?php
				if($recherche->rowCount() > 0){
				foreach ($resultat_recherche as $key => $value) {
					foreach ($value as $key2 => $value2) {
						echo $key2.' : '.$value2.'<br>';
					}
					echo "<br><hr>";	
				}
			}
		?>
	</div>
</main>