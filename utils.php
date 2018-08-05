<?php
// Connexion et selection de la base
function connexionLangues () {
	$link = mysqli_connect("localhost","root","root");
	// Selection de la base
	mysqli_select_db($link,"langues");
	return $link;
}

function langSet() {
	if (!isset($_SESSION['lang_site'])) {
		$_SESSION['lang_site'] = 'fr';
	}
	if (!isset($_SESSION['lt'])) {
		$_SESSION['lt'] = 'en';
	}
}

function echo_header() {
	?>
<html>
<head>
<title></title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<div class="header">
  <div id="nom">
		<a href="#">AppLango</a>
	</div>
    <div class="menu">
			<ul>
				<li><a href="changer_lang.php" accesskey="1" title="">Langue</a></li>				
				<li><a href="lecon.php" accesskey="4" title="">Leçons</a></li>
				<li><a href="form_search.php" accesskey="2" title="">Recherche traduction</a></li>

				
<?php
				if (!isset($_SESSION['role'])) {
					echo '<li><a href="form_ins.php" accesskey="3" title="">Inscription</a></li>';
					echo '<li class="login"><a href="form_log.php" accesskey="4" title="">Login</a></li>';

				}

				elseif (isset($_SESSION['role'])) {
					if (($_SESSION['role'] == 'admin')||($_SESSION['role'] == 'cont')) {
						echo '<li><a href="form_add.php" accesskey="1" title="">Ajouter mot</a></li>';
						echo '<li><a href="form_add.php?add=phr" accesskey="1" title="">Ajouter phrase</a></li>';
					}

					if ($_SESSION['role'] == 'admin') {
						echo '<li><a href="modif_util_form.php" accesskey="1" title="">Modifier utilisateur</a></li>';
					}
				echo '<li class="login"><a href="doLogout.php" accesskey="4" title="">Déconnexion</a></li>';
				}
		echo '</ul>';
echo '</div>';
echo '</div>';
}

function sideLec() {
	?>
	<div id="side" class="container">
	<div id=menuTitle>Leçons</div>

<?php
	$link = connexionLangues();

	$lang_source = $_SESSION['lang_site'];
	$lang_trad = $_SESSION['lt'];
	$lang_site = $_SESSION['lang_site'];

	if (isset($_GET['id_lec'])) {
		$_SESSION['id_lec'] = $_GET['id_lec'];
	}	
	else {$_SESSION['id_lec'] = 1;}

	$sql_menu = "SELECT NOM, ID_LEC FROM lecon WHERE LANG ='".$lang_site."'";

	echo '<div class="menu">';

	if ($result_menu = mysqli_query($link,$sql_menu)) {
		while ($line = mysqli_fetch_assoc($result_menu)) {
			printf('<li><a href="lecon.php?id_lec=%s" id="sideMenu">Lecon %s - %s</a></li>', $line["ID_LEC"],$line["ID_LEC"], $line["NOM"]);
			}
		}

	echo '<li><a href="quiz.php">Quiz</a></li>';

	if (isset($_SESSION['role']) && ($_SESSION['role'] == 'cont' || $_SESSION['role'] == 'admin')) {
		echo '<li><a href="form_add_lec.php">Ajouter leçon</a></li>';
	}
	echo "</div>";
	echo "</div>";
}

/*function defineView() {
	if (isset($_SESSION['role'])) {

		if ($_SESSION['role'] == 'user') {
			$header = echo_header();
			echo $header;
		}

		elseif ($_SESSION['role'] == 'admin') {
			$header = echo_header_admin();
			echo $header;
		}

		elseif ($_SESSION['role'] == 'cont') {
			$header = echo_header_cont();
			echo $header;
		}

		else {echo "Le role de l'utilisateur est inconnue. Veuillez contacter l'administrateur.";}
	}

	else {
		$header = echo_header();
		echo $header;
	}
}

function echo_header_admin() {
	if (!isset($_SESSION['lang_site'])) {
		$_SESSION['lang_site'] = 'fr';
	}
	if (!isset($_SESSION['lt'])) {
		$_SESSION['lt'] = 'en';
	}
	?>
<html>
<head>
<title></title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<div class="header">
  <div id="nom">
		<a href="#">AppLango</a>
	</div>
    <div class="menu">
			<ul>
				<li><a href="changer_lang.php" accesskey="1" title="">Langue</a></li>				
				<li><a href="lecon.php" accesskey="4" title="">Leçons</a></li>
				<li><a href="form_search.php" accesskey="2" title="">Recherche traduction</a></li>
				<li><a href="form_add_mot.php" accesskey="1" title="">Ajouter traduction</a></li>
				<!--li><a href="form_ins.php" accesskey="3" title="">Inscription</a></li>-->
<?php
				if (isset($_SESSION['id_ut'])) {
?>
				<li class="login"><a href="doLogout.php" accesskey="4" title="">Déconnexion</a></li> 

<?php
				}
				if (!isset($_SESSION['id_ut'])) {

				echo '<li class="login"><a href="form_log.php" accesskey="4" title="">Login</a></li>';
				}
?>

        </ul>
	</div>
</div>

<?php
}*/
?>