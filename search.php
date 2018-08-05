<?php
	session_start();
	include 'utils.php';
	langSet();
	$link = connexionLangues();

	$header = echo_header();
	echo $header;

	$menu = sideLec();
	echo $menu;

	if (isset($_GET['conf']) && $_GET['conf'] == 'n') {
			unset($_SESSION['desc']);
		}

?>
</div>
<div id="center" class="container">

<?php
	$sql_ID_CONCEPT = "SELECT ID_CONCEPT, LANG from mots where LABEL ='".$_GET['mot']."'";
	$result_ID_conc = mysqli_query($link,$sql_ID_CONCEPT);
	$ID_concept = mysqli_fetch_assoc($result_ID_conc);
	$ID = $ID_concept["ID_CONCEPT"];

	if (!isset($ID)) {
		echo 'Le mot cherché - " '.$_GET['mot'].' " - n\'a pas été trouvé.';
	}

	else {

		if ($ID_concept['LANG'] == $_SESSION['lang_site']) {
		//recherche traduction
			$sql_trad = "SELECT ID_MOT,LABEL, ATTRIBUT_1, ATTRIBUT_2, ATTRIBUT_3  FROM mots WHERE ID_CONCEPT = $ID and LANG = '".$_SESSION['lt']."'";
			$result_trad = mysqli_query($link,$sql_trad);
		}


		if ($ID_concept['LANG'] == $_SESSION['lt']) {
			$sql_trad = "SELECT ID_MOT,LABEL, ATTRIBUT_1, ATTRIBUT_2, ATTRIBUT_3  FROM mots WHERE ID_CONCEPT = $ID and LANG = '".$_SESSION['lang_site']."'";
			$result_trad = mysqli_query($link,$sql_trad);
		}


		//recherche phrases
		$sql_phrases = "SELECT LABEL FROM mots WHERE (LABEL like '%".$_GET['mot']."%' and LABEL != '".$_GET['mot']."')";
		$result_phrases = mysqli_query($link,$sql_phrases);
		$phrases = mysqli_fetch_assoc($result_phrases);

		//else echo "<br>Query successful<br>";

		// Afficher le resultat
		echo "<br>Mot recherché : <div id=mot>".$_GET['mot']."</div>";
		echo "<br><br>";

		echo "Traduction(s) : <br>";
		while ($line = mysqli_fetch_assoc($result_trad)) {
			
				echo '<div id=trad>'.$line['LABEL'].'</div>(';
				if ($line['ATTRIBUT_1']!='') {
					echo $line['ATTRIBUT_1'];}
				if ($line['ATTRIBUT_2']!='') {
					echo ', '.$line['ATTRIBUT_2'];}
				if ($line['ATTRIBUT_3']!='') {
					echo ', '.$line['ATTRIBUT_3'];}
				echo ')<br><br><audio controls>';
				echo '<source src="audio/'.$line['ID_MOT'].'.mp3" type="audio/mpeg">';
				echo 'Your browser does not support audio elements.';
				echo '</audio><br><br>';
			}

		echo "<br><br>";

		if (isset($phrases['ID_CONCEPT'])) {

			echo "Phrase(s) avec ce mot : ";
			while ($line = mysqli_fetch_assoc($result_phrases)) {
				
				echo "<table>";
				foreach ($line as $col=>$col_value) {
						echo "<td>$col_value</td>";
				}
				echo "</tr>";
				echo "</table>";
			}

		}
		// Liberation des resultats
		mysqli_free_result ($result_phrases);
		mysqli_free_result ($result_trad);
		mysqli_free_result ($result_ID_conc); 

	}
	echo '<br><a href="form_search.php" class=button>Chercher un autre mot</a>';
	mysqli_close ($link); // fermeture de la connexion

?>
</div>

  </body>
</html>
