<?php
	session_start();
	include 'utils.php';

	$header = echo_header();
	echo $header;

?>
<div id="side" class="container">
<div id=menuTitle>Leçons</div>

<?php

	$link = connexionLangues();
	$_SESSION['lang_site'] = "fr";


	if (isset($_GET['id_lec'])) {
		$_SESSION['id_lec'] = $_GET['id_lec'];
	}	
	else {$_SESSION['id_lec'] = 1;}

	$sql_menu = "SELECT NOM, ID_LEC FROM lecon WHERE LANG ='".$_SESSION['lang_site']."'";

	echo '<div class="menu">';

	if ($result_menu = mysqli_query($link,$sql_menu)) {
		while ($line = mysqli_fetch_assoc($result_menu)) {
			printf('<li><a href="lecon.php?id_lec=%s" id="sideMenu">Lecon %s - %s</a></li>', $line["ID_LEC"],$line["ID_LEC"], $line["NOM"]);
			}
		}

	echo '<li><a href="quiz.php">Quiz</a></li>';
	echo "</div>";
?>

</div>
<div id="center" class="container">

<?php

if (isset($_GET['lt']) && $_GET['lt'] == 'en') {

	 $_SESSION['lt'] = 'en';
	 echo 'Langue étudiée a été changée à "'.$_SESSION['lt'].' ".<br>';

	}

elseif (isset($_GET['lt']) && $_GET['lt'] == 'cz') {

	$_SESSION['lt'] = 'cz';
	echo 'Langue étudiée a été changée à "'.$_SESSION['lt'].' ".<br>';
	}

else {

	echo "Langue non-définie:";

	}
?>


<a href="lecon.php" class=button>Lecons</a>
	
</div>

  </body>
</html>
