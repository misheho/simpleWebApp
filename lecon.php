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
<div id="center" class="container"><div id=mainTitle>Leçon 
<?php
	if (isset($_GET['id_lec'])) {
		$_SESSION['id_lec'] = $_GET['id_lec'];
	}
	else {$_SESSION['id_lec'] = 1;}

	$sql_lecNom = "SELECT * from lecon WHERE ID_LEC = ".$_SESSION['id_lec']." and LANG = '".$_SESSION['lang_site']."'";
	$result_lecNom = mysqli_query($link,$sql_lecNom);
	if (!$result_lecNom) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	$lecNom = mysqli_fetch_assoc($result_lecNom);

	echo $_SESSION['id_lec']." - ".$lecNom['NOM']."</div>";
	echo "<br><br>".$lecNom['DESCR']."<br><br>";

	//lecon
	$sql= "SELECT ms.LABEL as label_source, mt.LABEL as label_trad from mots as ms, mots as mt where ms.ID_CONCEPT = mt.ID_CONCEPT and ms.ID_LEC =".$_SESSION['id_lec']." and ms.LANG = '".$_SESSION['lang_site']."' AND mt.LANG = '".$_SESSION['lt']."'";
	$result = mysqli_query($link,$sql);
	if (!$result) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	$res = mysqli_fetch_assoc($result);

	echo "<table class=trad>";
	echo '<tr><th>Mot source</th><th>Traduction '.$_SESSION['lt'].'</th></tr>';
	if ($result = mysqli_query($link,$sql)) {
		while ($line = mysqli_fetch_assoc($result)) {
			printf("<tr><td><a href=\"recherche_mots.php?mot=%s&lt=".$_SESSION['lt']."\">%s</a></td><td><a href=\"recherche_mots.php?mot=%s&lt=".$_SESSION['lang_site']."\">%s</a></td></tr>",$line["label_source"], $line["label_source"], $line["label_trad"],$line["label_trad"]);
			}
	}
	echo "</table><br><br>";

	//phrases 
	$sql= "SELECT LABEL from mots where ID_CONCEPT is NULL and ID_LEC =".$_SESSION['id_lec']." and LANG = '".$_SESSION['lt']."'";
	$result = mysqli_query($link,$sql);
	if (!$result) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	$res = mysqli_fetch_assoc($result);

	echo "<table>";
	echo "<tr><th>Phrases</th>";
	if ($result = mysqli_query($link,$sql)) {
		while ($line = mysqli_fetch_assoc($result)) {
			printf('<tr><td>'.$line["LABEL"].'</td></tr>');
			}
	}
	echo "</table>";

?>
</div>

  </body>
</html>
