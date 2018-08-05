<?php
	session_start();
	unset($_SESSION['id_ut']);
	unset($_SESSION['login']);
	unset($_SESSION['role']);
	session_destroy();
	include 'utils.php';

	$header = echo_header();
	echo $header;
?>
<div class="container">
		<div id="intro">
		<!--<h2 id="intro">Bienvenu dans AppLango !</h2>-->
		<span><br><br>Vous avez été déconnecté avec succès.</span>
		</div>
			<a href="lecon.php" class="button1">Leçons</a>
	</div>

  </body>
</html>
