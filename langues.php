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
<div class="container">
		<div id="intro">
		<h2 id="intro">Bienvenu dans AppLango !</h2>
		<span>Bienvenu dans AppLango, une nouvelle plateforme pour apprendre les langues.<br> 
      Vous pouvez apprendre la langue de votre choix et tester vos connaissances en quiz.<br>
      En tant qu'utilisateur inscrit, vous pouvez reprendre les leçons où vous les avez abandonnés.</span>
		</div>
			<a href="lecon.php" class="button1">Commencer</a>
	</div>
</div>

  </body>
</html>
