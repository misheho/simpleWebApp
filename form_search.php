<?php
	session_start();
	include 'utils.php';
	langSet();
	$link = connexionLangues();
	langSet();

	$header = echo_header();
	echo $header;

	$menu = sideLec();
	echo $menu;
?>

</div>

<?php

echo '<div id="center" class="container"><div id=mainTitle>Recherche traduction vers '.$_SESSION['lt'].'';

?>

<br><br></div>
	<br>
	<form action="search.php" method="GET">
	Mot recherché : 
	<input type = "text" name = "mot" value="" required><br><br>
	<p><button type="submit" name= "Connexion" value = "Connexion">Recherche</button></p>
</body>

