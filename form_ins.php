<?php
	session_start();
	include 'utils.php';

	$header = echo_header();
	echo $header;
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
En tant qu'utilisateur inscrit, vous pourrez reprendre le quiz et les leçons là où vous les avez abandonnés.
	<br><br>
	<form action="doIns.php" method="POST">
	Prénom* : 
	<input type = "text" name ="prenom" value="" required><br>
	Nom* : 
	<input type = "text" name ="nom" value="" required><br>
	Email* : 
	<input type = "text" name ="email" value="" required><br>
	Login* : 
	<input type = "text" name = "login" value="" required><br>
	Mot de passe* : 
	<input type = "password" name ="password" value="" required>
	Confirmer le mot de passe* : 
	<input type = "password" name ="pwConf" value="" required>
	<p><button type="submit" name= "confirm" value = "confirm">Inscrire</button></p>
</body>

