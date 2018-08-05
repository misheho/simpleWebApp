<?php
	session_start();
	include 'utils.php';
	$link = connexionLangues();
	langSet();

	$header = echo_header();
	echo $header;

	$menu = sideLec();
	echo $menu;
?>

</div>

<div id="center" class="container"><div id=mainTitle>Quiz <br><br></div>
<?php

	//quiz
	//$_SESSION['login'] = 'User1';
	//$_SESSION['id_ut'] = 1;


	//ID mot aleatoire parmi les mots disponibles pour la langue choisie avec une traduction vers la langue trad (i.e. leur ID_concept existe pour la lague trad)

	//tout d'abord, verification s'il y a des echecs relevants dans l'historique de l'utilisateur
if (isset($_SESSION['id_ut'])) {
	$sql_echec= "SELECT uh.ID_MOT,m.ID_CONCEPT from utilisateur_hist uh join mots m on uh.ID_MOT = m.ID_MOT where uh.ID_UT = '".$_SESSION['id_ut']."' and ECHEC = 1 and LANG = '".$_SESSION['lang_site']."' and ID_CONCEPT in (SELECT ID_CONCEPT from mots where LANG = '".$_SESSION['lt']."') ORDER BY RAND() LIMIT 1";

	$result_echec = mysqli_query($link,$sql_echec);
		if (!$result_echec) {
			die ("<br>Query failed: ". mysqli_error($link));
		} 
	$echec = mysqli_fetch_assoc($result_echec);

	//si plus d'echecs, recherche parmi les mots non-visites
	if (!isset($echec['ID_MOT'])) {
		$sql_nonvisID = "SELECT ID_MOT, ID_CONCEPT from mots where LANG = '".$_SESSION['lang_site']."' and ID_CONCEPT in (SELECT ID_CONCEPT from mots where LANG = '".$_SESSION['lt']."') and ID_MOT not in (SELECT uh.ID_MOT from utilisateur_hist uh join mots m on uh.ID_MOT = m.ID_MOT where uh.ID_UT = '".$_SESSION['id_ut']."' and LANG = '".$_SESSION['lang_site']."') ORDER BY RAND() LIMIT 1";
			//SELECT m.ID_MOT FROM mots AS m JOIN (SELECT (RAND() * (SELECT MAX(ID_MOT) FROM mots)) AS ID_MOT) AS r2 WHERE m.ID_MOT >= r2.ID_MOT ORDER BY m.ID_MOT ASC LIMIT 1
		$result_nonvisID = mysqli_query($link,$sql_nonvisID);
			if (!$result_nonvisID) {
				die ("<br>Query failed: ". mysqli_error($link));
			} 
		$nonvisID = mysqli_fetch_assoc($result_nonvisID);

		if (!isset($nonvisID['ID_MOT'])) {
			$sql_randID = "SELECT ID_MOT, ID_CONCEPT from mots where LANG = '".$_SESSION['lang_site']."' and ID_CONCEPT in (SELECT ID_CONCEPT from mots where LANG = '".$_SESSION['lt']."') ORDER BY RAND() LIMIT 1";
			//SELECT m.ID_MOT FROM mots AS m JOIN (SELECT (RAND() * (SELECT MAX(ID_MOT) FROM mots)) AS ID_MOT) AS r2 WHERE m.ID_MOT >= r2.ID_MOT ORDER BY m.ID_MOT ASC LIMIT 1
			$result_randID = mysqli_query($link,$sql_randID);
				if (!$result_randID) {
					die ("<br>Query failed: ". mysqli_error($link));
				} 
			$randID = mysqli_fetch_assoc($result_randID);

			$_SESSION['ID_mot'] = $randID["ID_MOT"];
			$_SESSION['ID_concept']= $randID["ID_CONCEPT"];
		}

		else {
			$_SESSION['ID_mot'] = $nonvisID["ID_MOT"];
			$_SESSION['ID_concept']= $nonvisID["ID_CONCEPT"];
		}
	}

	else {
		$_SESSION['ID_mot'] = $echec['ID_MOT'];
		$_SESSION['ID_concept']= $echec['ID_CONCEPT'];
	}
}

elseif (!isset($_SESSION['id_ut'])) {
			$sql_randID = "SELECT ID_MOT, ID_CONCEPT from mots where LANG = '".$_SESSION['lang_site']."' and ID_CONCEPT in (SELECT ID_CONCEPT from mots where LANG = '".$_SESSION['lt']."') ORDER BY RAND() LIMIT 1";
			//SELECT m.ID_MOT FROM mots AS m JOIN (SELECT (RAND() * (SELECT MAX(ID_MOT) FROM mots)) AS ID_MOT) AS r2 WHERE m.ID_MOT >= r2.ID_MOT ORDER BY m.ID_MOT ASC LIMIT 1
			$result_randID = mysqli_query($link,$sql_randID);
				if (!$result_randID) {
					die ("<br>Query failed: ". mysqli_error($link));
				} 
			$randID = mysqli_fetch_assoc($result_randID);

			$_SESSION['ID_mot'] = $randID["ID_MOT"];
			$_SESSION['ID_concept']= $randID["ID_CONCEPT"];
		}

	//audio ou mot ou image : les fichiers audio et les images  sont disponibles pour tous les mots simples - qui sont pas phrases - identifiable par la presence de ID_concept ; comme le quiz est limite aux mots simples par defaut - il n'y a pas de traduction pour les phrases - pas besoin de condition specifique pour assurer qu'il y aie de fichier audio pour un ID_mot parmi ceux retrouves
$i = rand(0,2);
switch($i) {
	 	case '0':			
	 	//mot
	 	$sql_mot = "SELECT label from mots where ID_MOT = '".$_SESSION['ID_mot']."'";
	 	$result_label = mysqli_query($link,$sql_mot);
		if (!$result_label) {
			die ("<br>Query failed: ". mysqli_error($link));
		} 
						
		$label = mysqli_fetch_assoc($result_label);		
		$label_return = $label["label"];
		echo $label_return;
		mysqli_free_result ($result_label);
		break;
		//echo "<br>ID concept is: ".$_SESSION['ID_concept']."<br>";

		//audio
		case '1':
		$audio = "audio/".$_SESSION['ID_mot'].".mp3";	
		//$audio = "https://dictionary.cambridge.org/fr/media/english/uk_pron/u/ukr/ukreg/ukregul023.mp3";		
		echo '<audio controls>';
		echo '<source src="'.$audio.'"';
		echo ' type="audio/mpeg">';
		echo 'Your browser does not support audio elements.';
		echo '</audio>';
		break;

		default:
		$img = $_SESSION['ID_concept'].".jpg";
		echo '<img src="img/'.$img.'"';
		echo '>';
	}

/*	echo '<div id="quiz_submit">';
	echo '<br>	<form action="check_quiz.php" method="GET">';
	echo '<input type="text" name="rep"/><br>';
	echo '<p><button type="submit" name= "submit" value = "submit">Next</button></p>';
	echo '</div>';*/

	echo '<br>	<form action="check_quiz.php" method="GET"><br>';
	echo '<input type="text" name="rep"/><br>';
	echo '<p><button type="submit" name= "submit" value = "submit">Next</button></p>';

	mysqli_close ($link); // fermeture de la connexion
?>

</div>

  </body>
</html>
