<?php
	session_start();
	include 'utils.php';
	langSet();

	$header = echo_header();
	echo $header;

	$link = connexionLangues();

	$menu = sideLec();
	echo $menu;

	if (isset($_GET['conf']) && $_GET['conf'] == 'n') {
			unset($_SESSION['desc']);
		}

?>

<div id="center" class="container">
<br>
<?php /*
	if (isset($_GET['add']) && $_GET['add']=='trad') {
		*/?>
<div id=mainTitle>Modifier utilisateur<br><br></div>
	<form action="modif_util.php" method="get">
	Login de l'utilisqteur à modifier* : 
	<input type = "text" name = "login" value="" required><br>
	Prénom : <input type = "text" name = "prenom" value="" ><br>
	Nom : <input type = "text" name = "nom" value=""><br>
	Email : <input type = "text" name = "email" value=""><br>
	Nouveau rôle (utilisateur/administrateur/contributeur) : <input type = "text" name = "role" value=""><br>
	
	<p><button type="submit" name= "add" value = "add">Modifier</button></p>
	</form>
</body>