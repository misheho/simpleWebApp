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
	$sql_IDut = "SELECT ID_UT from utilisateurs where LOGIN ='".$_GET['login']."'";
	$result = mysqli_query($link,$sql_IDut);
	if (!$result) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	$IDut = mysqli_fetch_assoc($result);

	if (!isset($IDut["ID_UT"])) {
			echo "L'utilisateur avec ce login n'a pas été retrouvé.";
			echo '<a href="form_modif_util.php?conf=n" class=button>Retour</a>';
		}

	//le mot n'existe pas encore
	else {
			if ($_GET['prenom'] !== "") {
				$sqlIns = "UPDATE utilisateurs SET PRENOM = '".$_GET['prenom']."' WHERE ID_UT = ".$IDut["ID_UT"];
				mysqli_query($link,$sqlIns);

				echo 'Le prénom de l\'utilisateur " '.$_GET['login'].' " a été modifié à " '.$_GET['prenom'].' ".<br>';
			}

			if ($_GET['nom']  !== "") {
				$sqlIns = "UPDATE utilisateurs SET PRENOM = '".$_GET['nom']."' WHERE ID_UT = ".$IDut["ID_UT"];
				mysqli_query($link,$sqlIns);

				echo 'Le nom de l\'utilisateur " '.$_GET['login'].' " a été modifié à " '.$_GET['nom'].' ".<br>';
			}

			if ($_GET['email']  !== "") {
				$sqlIns = "UPDATE utilisateurs SET PRENOM = '".$_GET['email']."' WHERE ID_UT = ".$IDut["ID_UT"];
				mysqli_query($link,$sqlIns);

				echo 'L\'email de l\'utilisateur " '.$_GET['login'].' " a été modifié à " '.$_GET['email'].' "<br>';
			}

			if ($_GET['role']  !== "") {

				if ($_GET['role'] == 'contributeur') {
				$sqlIns = "UPDATE utilisateurs SET PRENOM = 'contrib' WHERE ID_UT = ".$IDut["ID_UT"];
				mysqli_query($link,$sqlIns);

				echo 'Le rôle de l\'utilisateur " '.$_GET['login'].' " a été modifié à " '.$_GET['role'].' "<br>';
				}

				elseif ($_GET['role'] == 'administrateur') {
				$sqlIns = "UPDATE utilisateurs SET PRENOM = 'admin' WHERE ID_UT = ".$IDut["ID_UT"];
				mysqli_query($link,$sqlIns);

				echo 'Le rôle de l\'utilisateur " '.$_GET['login'].' " a été modifié à " '.$_GET['role'].' "<br>';
				}

				elseif ($_GET['role'] == 'utilisateur') {
				$sqlIns = "UPDATE utilisateurs SET PRENOM = 'user' WHERE ID_UT = ".$IDut["ID_UT"];
				mysqli_query($link,$sqlIns);

				echo 'Le rôle de l\'utilisateur " '.$_GET['login'].' " a été modifié à " '.$_GET['role'].' "<br>';
				}

				else {
					echo 'Le rôle " '.$_GET['role'].' " n\'est pas un rôle valide. Le rôle de l\'utilisateur n\'a pas été changé.<br>';
				}
			}

			echo '<a href="modif_util_form.php" class=button>Retour</a>';
		}

		<script type="text/javascript" src="https://fr.forvo.com/_ext/ext-prons.js?id=636445"></script>


?>
