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
<div id="side" class="container">
<div id=menuTitle>Leçons</div>

<?php

	$link = connexionLangues();

	$lang_source = $_SESSION['lang_site'];
	$lang_trad = $_SESSION['lt'];
	$lang_site = $_SESSION['lang_site'];
	$id_lec = 1;

	$sql_menu = "SELECT NOM, ID_LEC FROM lecon WHERE LANG ='".$lang_site."'";

	echo '<div class="menu">';

	if ($result_menu = mysqli_query($link,$sql_menu)) {
		while ($line = mysqli_fetch_assoc($result_menu)) {
			printf('<li><a href="lecon%s.php" id="sideMenu">Lecon %s - %s</a></li>',$line["ID_LEC"],$line["ID_LEC"], $line["NOM"]);
			}
		}

	echo '<li><a href="quiz.php">Quiz</a></li>';
	echo "</div>";
?>

</div>

<div id="center" class="container"><div id=mainTitle>Quiz <br><br></div>
<?php

	$lang_source = "cz";
	$lang_trad = "en";

	/*
	echo "rep is: ".$_GET['rep']."<br>";
	echo "ID UT is: ".$_SESSION['id_ut']."<br>";
	echo "ID mot is: ".$_SESSION['ID_mot']."<br>";
	echo "ID concept is: ".$_SESSION['ID_concept']."<br>";*/

	//
	$sql_ID_rep = "SELECT ID_CONCEPT from mots where LABEL = '".$_GET['rep']."' and LANG = '".$lang_trad."'";
	$result_ID_rep = mysqli_query($link,$sql_ID_rep);
	if (!$result_ID_rep) {
		die ("<br>Query failed: ". mysqli_error($link));
	} 
	
	$ID_rep = mysqli_fetch_assoc($result_ID_rep);
	//echo "ID_rep is: ".var_dump($ID_rep)."<br>";

	if ($_SESSION['ID_concept'] == $ID_rep['ID_CONCEPT']) {
		//echo "ID_concept is correct<br>";
		echo 'Correct !<br>';
		//cho "user history: ".var_dump($hist)."<br>";

		if (isset($_SESSION['id_ut'])) {

			$sql_sel = "SELECT * FROM utilisateur_hist where ID_UT = '".$_SESSION['id_ut']."' and ID_MOT = '".$_SESSION['ID_mot']."'";
			$result_sel = mysqli_query($link,$sql_sel);
			$hist = mysqli_fetch_assoc($result_sel);

			if (!isset($hist['ID_UT_HIST'])) {
				//echo "user history does not have such record<br>";
				$sql = "INSERT INTO utilisateur_hist (ID_UT, ID_MOT, ECHEC) VALUES ('".$_SESSION['id_ut']."','".$_SESSION['ID_mot']."',0)";
	    		mysqli_query($link,$sql);
	    	}
	    	else {//echo "user history has this record and it will be updated <br>" ;
	    		$sql_update = "UPDATE utilisateur_hist SET ECHEC = 0 WHERE ID_UT = '".$_SESSION['id_ut']."' and ID_MOT = '".$_SESSION['ID_mot']."'";
	    		mysqli_query($link,$sql_update);
	    	}
		}

	} 
	
	//if (($_SESSION['ID_concept'] != $ID_rep['ID_CONCEPT']) or $_GET['rep'] = '') {
	else {
		echo 'Faux<br><br>';
		echo 'Reponse correct : ';
		//var_dump($_SESSION['ID_concept']);
		//echo "<br>";

		$sql_rep_cor = "SELECT LABEL from mots where ID_CONCEPT = '".$_SESSION['ID_concept']."' and LANG = '".$lang_trad."'";

		$result_rep_cor = mysqli_query($link,$sql_rep_cor);
		if (!$result_rep_cor) {
			die ("<br>Query failed: ". mysqli_error($link));
		}
		$rep_cor = mysqli_fetch_assoc($result_rep_cor);
		$rep_cor = $rep_cor["LABEL"];
		echo $rep_cor;

		if (isset($_SESSION['id_ut'])) {
			$sql_sel = "SELECT * FROM utilisateur_hist where ID_UT = '".$_SESSION['id_ut']."' and ID_MOT = '".$_SESSION['ID_mot']."'";
			$result_sel = mysqli_query($link,$sql_sel);
			$hist = mysqli_fetch_assoc($result_sel);

			if (!isset($hist['ID_UT_HIST'])) {
				$sql = "INSERT INTO utilisateur_hist (ID_UT, ID_MOT, ECHEC) VALUES ('".$_SESSION['id_ut']."','".$_SESSION['ID_mot']."',1)";
	    		mysqli_query($link,$sql);
	   		}
	    	else {$sql_update = "UPDATE utilisateur_hist SET ECHEC = 1 WHERE ID_UT = '".$_SESSION['id_ut']."' and ID_MOT = '".$_SESSION['ID_mot']."'";
	    		mysqli_query($link,$sql_update);
	    	}
  		}
    }

		


	echo  '<br>	<form action="quiz.php" method="GET">';
	echo '<p><button type="submit" name= "Next" value = "Next">Next</button></p>';


?>

</div>

  </body>
</html>
