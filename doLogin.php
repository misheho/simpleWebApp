<?php
	session_start();
	$login="";
	if (isset($_POST['login'])) {
		$login=$_POST['login'];
	}
	$password="";
	if (isset($_POST['password'])) {
		$password = $_POST['password'];
	}
	include 'utils.php';

	//echo $login.'<br>';
	//echo $password.'<br>';

	/*$nextPage = 'login.php';
	$logged = false;*/
	
	if (isset($login)) {
		$link = connexionLangues();

		$plogin = mysqli_real_escape_string($link, $login);
		$ppassword = mysqli_real_escape_string($link, $password);

		//echo $plogin.' and '.$ppassword;

		$sql="select ID_UT,LOGIN, ROLE from utilisateurs where LOGIN ='".$plogin."' and PASSWORD = '".$ppassword."'";

		$result = mysqli_query($link,$sql);

		$row = mysqli_fetch_assoc($result);

		//var_dump($row);
		//echo '<br>';

		if($row['ID_UT'] != "") {
			//$logged=true;
			$_SESSION['login'] = $row['LOGIN'];
			$_SESSION['role'] = $row['ROLE'];
			$_SESSION['id_ut'] = $row['ID_UT'];

			/*echo $_SESSION['login'].'<br>';
			echo $_SESSION['role'].'<br>';
			echo $_SESSION['id_ut'].'<br>';*/

			header("Location: http://localhost/lecon.php");
			die();


		}
		else {
			session_destroy();
			header("Location: http://localhost/form_log.php?fail=Y");
			die();

		}

		mysqli_close($link);

	}

	/*if ($logged) {
		$nextPage = 'menu.php';
		/*echo $_SESSION['login'].'<br>';
		echo $_SESSION['role'].'<br>';
		echo $_SESSION['id_ut'].'<br>';
	} else {
		session_destroy();
		echo 'not logged';
	}*/

?>