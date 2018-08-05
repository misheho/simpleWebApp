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
			unset($_SESSION['mot']);
			unset($_SESSION['pron']);
			unset($_SESSION['att1t']);
			unset($_SESSION['att2t']);
			unset($_SESSION['att3t']);
			unset($_SESSION['audioM']);
			unset($_SESSION['img']);
			unset($_SESSION['ID_lec'] );
			unset($_SESSION['ID_concept']);
			//details trad
			unset($_SESSION['trad']);
			unset($_SESSION['pront']);
			unset($_SESSION['att1t']);
			unset($_SESSION['att2t']);
			unset($_SESSION['att3t']);
			unset($_SESSION['lt']);
			unset($_SESSION['audioT']);
	}
?>

<div id="center" class="container">
<br>
<?php 
	if (isset($_GET['add']) && $_GET['add']=='phr') {
		?>

		<div id=mainTitle>Ajouter une nouvelle phrase <br><br></div>
	<form action="add.php?add=phr" method="post">
	Phrase* : 
	<input type = "text" name = "phr" value="" required><br>
	Langue de la phrase* :
		<select name='lt' required>
		<option value='en'>anglais</option>
		<option value='cz'>tchèque</option>
	</select><br>
	Numéro de la leçon* : <input type = "text" name = "lec" value="" required><br><br>
	<p><button type="submit" name= "add" value = "add">Ajouter</button></p>
		</form>
<?php
	}

	else {

		?>
<div id=mainTitle>Ajouter un mot avec la traduction <br><br></div>
	<form action="add.php" method="post" enctype="multipart/form-data">
	Mot à traduire* : 
	<input type = "text" name = "mot" value="" required><br>
	Prononciation* : <input type = "text" name = "pron" value="" required><br>
	Categorie (nom, verbe,...)* : <input type = "text" name = "att1" value="" required><br>
	Genre (m/f/n)* : <input type = "text" name = "att2" value="" required><br>
	Nombre (sg./pl.)* : <input type = "text" name = "att3" value="" required><br>
	Prononciation (fichier mp3)* : <input type="file" name="audioM" id="audioM" required><br>
	Image* : <input type="file" name="img" id="img" required><br>
	Numéro de la leçon* : <input type = "text" name = "lec" value="" required><br><br>
	
	Langue de traduction* : 
	<select name='lt' required>
		<option value='en'>anglais</option>
		<option value='cz'>tchèque</option>
	</select><br>
	Traduction* : <input type = "text" name = "trad" value="" required><br>
	Prononciation* : <input type = "text" name = "pront" value="" required><br>
	Categorie (nom, verbe,...)* : <input type = "text" name = "att1t" value="" required><br>
	Genre (m/f/n)* : <input type = "text" name = "att2t" value="" required><br>
	Nombre (sg./pl.)* : <input type = "text" name = "att3t" value="" required><br>
	Prononciation (fichier mp3)* : <input type="file" name="audioT" id="audioT" required><br>
		<p><button type="submit" name= "add" value = "add">Ajouter</button></p>

<?php
	}
	?>
		</form>
</body>

