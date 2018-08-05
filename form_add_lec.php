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
<div id=mainTitle>Ajouter une nouvelle leçon <br><br></div>
	<form action="add_lec.php" method="get">
	Nom de la leçon* : 
	<input type = "text" name = "nom" value="" required><br>
	Description* : <input type = "text" name = "desc" value="" required><br>
	
	<p><button type="submit" name= "add" value = "add">Ajouter</button></p>
	</form>
</body>

