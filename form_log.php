<?php
	session_start();
	include 'utils.php';

	$link = connexionLangues();
	langSet();

	$header = echo_header();
	echo $header;

?> 

</div>

<div id="center" class="container"><div id=mainTitle>Login <br><br></div>
<?php
	if (isset($_GET['fail']) && $_GET['fail'] == 'Y') {
		echo "Le login ou le mot de passe n'était pas correct. Merci de réessayer.<br>";
	}
?>
	<br>
	<form action="doLogin.php" method="post">
	Login : 
	<input type = "text" name = "login" value="" required><br><br>
	Password : 
	<input type = "password" name ="password" value="" required>
	<p><button type="submit" name= "Connexion" value = "Connexion">Connexion</button></p>
</body>

