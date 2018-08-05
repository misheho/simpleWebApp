<?php
	session_start();
	include 'utils.php';

	$header = echo_header();
	echo $header;

	$link = connexionLangues();

	$sql = "SELECT * from utilisateurs where LOGIN = '".$_POST['login']."'";
	$result = mysqli_query($link,$sql);
	if (!$result) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	
	$exist = mysqli_fetch_assoc($result);
	?>
?> <!--
<div id="side" class="container">
<div id=menuTitle>Leçons</div>-->

<?php 
/*
	$link = connexionLangues();

	$lang_source = "en";
	$lang_trad = "cz";
	$lang_site = "fr";
	$id_lec = 1;

	$sql_menu = "SELECT NOM, ID_LEC FROM lecon WHERE LANG ='".$lang_site."'";

	echo '<div class="menu">';

	if ($result_menu = mysqli_query($link,$sql_menu)) {
		while ($line = mysqli_fetch_assoc($result_menu)) {
			printf('<li><a href="lecon%s.php" id="sideMenu">Lecon %s - %s</a></li>',$line["ID_LEC"],$line["ID_LEC"], $line["NOM"]);
			}
		}

	echo '<li><a href="quiz.php">Quiz</a></li>';
	echo "</div>";*/
?>
</div>

<div id="center" class="container"><div id=mainTitle>Inscription <br><br></div>

	<?php
	
	if (isset($exist['LOGIN'])) {

		echo 'Le login choisi existe déjà. Merci de choisir un autre login.';
		echo '<br><a href="form_ins.php" class=button>Retour</a>';

		}

	else {
		if ($_POST['password'] !== $_POST['pwConf']) {

			echo 'Les mots de passe ne correspondent pas.';
			echo '<br><a href="form_ins.php" class=button>Retour</a>';

		}

		else {
			$sql="INSERT INTO utilisateurs (LOGIN, PASSWORD, NOM, PRENOM, EMAIL, ROLE) VALUES ('".$_POST['login']."','".$_POST['password']."','".$_POST['nom']."','".$_POST['prenom']."','".$_POST['email'].", 'user')";

			$result = mysqli_query($link,$sql);

			echo 'Inscription réussie.';
			echo '<br><a href="form_log.php" class=button>Login</a>';

			}
		}
?>