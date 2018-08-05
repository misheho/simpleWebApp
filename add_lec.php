<?php
	session_start();
	include 'utils.php';
	langSet();

	$header = echo_header();
	echo $header;

	$link = connexionLangues();

	$menu = sideLec();
	echo $menu;
?>

</div>
<div id="center" class="container">

<?php

//si la lecon  existe
if (!isset($_GET['conf']) || $_GET['conf'] == 'n') {

	$sql_IDlec = "SELECT ID_LEC from lecon where NOM ='".$_GET['nom']."'";
	$result = mysqli_query($link,$sql_IDlec);
	if (!$result) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	$IDlec = mysqli_fetch_assoc($result);

	if (isset($IDlec["ID_LEC"])) {
			echo 'La leçon avec ce nom existe déjà. Souhaitez-vous mettre à jour sa description ?';
			//details mot
			$_SESSION['desc'] = $_DESC['desc'];
			$_SESSION['id_lec'] = $IDlec['id_lec'];

			echo '<a href="add_lec.php?conf=y" class=button>Ajouter le mot</a>';
			echo '<a href="form_add.php?conf=n" class=button>Annuler</a>';
		}

	//le mot n'existe pas encore
		else {
			$sql_IDlec = "SELECT ID_LEC from lecon ORDER BY ID_LEC DESC LIMIT 1";
			$result = mysqli_query($link,$sql_IDlec);
			if (!$result) {
				die ("<br>Query failed: ". mysqli_error($link));
			} 
			$IDlec = mysqli_fetch_assoc($result);
			$IDnewLec = $IDlec['ID_LEC'] + 1;

			$sqlIns = "INSERT INTO lecon (ID_LEC, NOM, DESCR) VALUES (".$IDnewLec.",'".$_GET['nom']."','".$_GET['desc']."')";
			mysqli_query($link,$sqlIns);

			echo 'La leçon a été ajoutée.<br>';
			echo '<a href="form_add_lec.php?conf=n" class=button>Retour</a>';
		}

	}

elseif ($_GET['conf'] == 'y') {

	$sqlTrad = "UPDATE lecon SET DESC ='".$_GET['desc']."' WHERE ID_LEC = '".$_SESSION['id_lec']."'";
	mysqli_query($link,$sqlTrad);
	echo 'La description de la leçon a été mise à jour.<br>';
	echo '<a href="form_add_lec.php?conf=n" class=button>Retour</a>';

	unset($_SESSION['desc']);
	unset($_SESSION['id_lec']);

	}
	
?>
