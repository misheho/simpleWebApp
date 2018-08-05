<?php
	session_start();
	include 'utils.php';
	langSet();

	$header = echo_header();
	echo $header;

	$link = connexionLangues();

	$menu = sideLec();
	echo $menu;
?>

</div>
<div id="center" class="container">

<?php
	$sql= "SELECT ID_LEC from lecon where ID_LEC ='".$_POST['lec']."'";
	$result = mysqli_query($link,$sql);
	$res = mysqli_fetch_assoc($result);

	if (!isset($res['ID_LEC'])) {
		echo "Le numéro de la leçon n'existe pas. Merci de renseigner un numéro valide.<br>";
		echo '<a href="form_add.php" class=button>Retour</a>';
	}

if (isset($_GET['add']) && $_GET['add'] == 'phr') {

	$sql= "SELECT ID_MOT from mots where LABEL ='".$_POST['phr']."' AND ID_LEC = ".$_POST['lec'];
	$result = mysqli_query($link,$sql);
	$res = mysqli_fetch_assoc($result);

	if (isset($resp['ID_MOT'])) {
		echo "La phrase existe déjà pour la leçon.<br>";
		}

	else {
		$sql = "INSERT INTO mots (LABEL, ID_LEC,LANG) VALUES ('".$_POST['phr']."','".$_POST['lec']."','".$_POST['lt']."')";
			mysqli_query($link,$sql);
			echo "La phrase a été ajoutée.<br>";
	}

	echo '<a href="form_add.php?add=phr" class=button>Retour</a>';

}

elseif (!isset($_GET['conf'])) {	

	$uploadOk = 1;
	$finfo = new finfo();
	$fileMMimeType = $finfo->file($_FILES["audioM"]["tmp_name"], FILEINFO_MIME_TYPE);
	$fileTMimeType = $finfo->file($_FILES["audioT"]["tmp_name"], FILEINFO_MIME_TYPE);
	$checkImage = getimagesize($_FILES["img"]["tmp_name"]);

	if (($fileMMimeType !== 'audio/mpeg')|| ($fileTMimeType !== 'audio/mpeg') || (!$checkImage)){
		$uploadOk = 0;
	 	echo 'Un des fichiers n\'est pas valide. Uniquement des fichiers mp3 sont acceptés pour audio.<br>';
	 	echo '<a href="form_add.php" class=button>Retour</a>';
	}


	else {	
		//si le mot existe
		$sql_ID_CONCEPT = "SELECT ID_CONCEPT, ID_LEC from mots where LABEL ='".$_POST['mot']."'";
		$result_ID_conc = mysqli_query($link,$sql_ID_CONCEPT);
		if (!$result_ID_conc) {
				die ("<br>Query failed: ". mysqli_error($link));
				} 
		$ID_concept = mysqli_fetch_assoc($result_ID_conc);

		/*si la traduction existe deja
		$sql_ID_CONCEPTtrad = "SELECT ID_CONCEPT, ID_LEC from mots where LABEL ='".$_POST['trad']."'";
		$result_ID_concTrad = mysqli_query($link,$sql_ID_CONCEPTtrad);
		if (!$result_ID_concTrad) {
			die ("<br>Query failed: ". mysqli_error($link));
		} 
		$ID_conceptTrad = mysqli_fetch_assoc($result_ID_concTrad);*/

		//le mot existe
		if (isset($ID_concept["ID_CONCEPT"])) {
			echo 'Le mot et sa traduction existent déjà. Souhaitez-vous le mettre à jour avec les détails renseignés ?';
			//details mot
			$_SESSION['mot'] = $_POST['mot'];
			$_SESSION['pron'] = $_POST['pron'];
			$_SESSION['att1t'] = $_POST['att1'];
			$_SESSION['att2t'] = $_POST['att2'];
			$_SESSION['att3t']=$_POST['att3'];
			$_SESSION['audioM'] = $_FILES['audioM'];
			$_SESSION['img'] = $_FILES['img'];
			$_SESSION['ID_lec'] = $_POST['lec'];
			$_SESSION['ID_concept'] = $ID_concept["ID_CONCEPT"];
			//details trad
			$_SESSION['trad'] = $_POST['trad'];
			$_SESSION['pront'] = $_POST['pront'];
			$_SESSION['att1'] = $_POST['att1t'];
			$_SESSION['att2'] = $_POST['att2t'];
			$_SESSION['att3']=$_POST['att3t'];
			$_SESSION['lt'] = $_POST['lt'];
			$_SESSION['audioT'] = $_FILES['audioT'];

			echo '<a href="add.php?conf=y" class=button>Ajouter le mot</a>';
			echo '<a href="form_add.php?conf=n" class=button>Annuler</a>';
		}

	//le mot n'existe pas encore
		else {
			$sqlIDConcN = "SELECT ID_CONCEPT from mots ORDER BY ID_CONCEPT DESC LIMIT 1";
			$resIDCN = mysqli_query($link,$sqlIDConcN);
			$topIDconc = mysqli_fetch_assoc($resIDCN);
			$IDCN = $topIDconc['ID_CONCEPT'] + 1;

			$sqlTrad = "INSERT INTO mots (ID_CONCEPT, LABEL, PRON, ID_LEC, ATTRIBUT_1, ATTRIBUT_2, ATTRIBUT_3, LANG) VALUES ('".$IDCN."','".$_POST['trad']."','".$_POST['pront']."','".$_POST['lec']."','".$_POST['att1t']."','".$_POST['att2t']."','".$_POST['att3t']."','".$_POST['lt']."')";
			mysqli_query($link,$sqlTrad);


			$sqlMot = "INSERT INTO mots (ID_CONCEPT, LABEL, PRON, ID_LEC, ATTRIBUT_1, ATTRIBUT_2, ATTRIBUT_3, LANG) VALUES ('".$IDCN."','".$_POST['mot']."','".$_POST['pron']."','".$_POST["lec"]."','".$_POST['att1']."','".$_POST['att2']."','".$_POST['att3']."','".$_SESSION['lang_site']."')";
			mysqli_query($link,$sqlMot);

			//ajouter la prononciation sous l'ID mot
			$sqlIDmot = "SELECT ID_MOT FROM mots WHERE LABEL = '".$_POST['mot']."' and LANG = '".$_SESSION['lang_site']."'";
			$result_IDmot = mysqli_query($link,$sqlIDmot);
			$IDmot = mysqli_fetch_assoc($result_IDmot);

			$target_dir = "audio/";
			$_FILES["audioM"]["name"] = $IDmot['ID_MOT'].'.mp3';
			$target_file = $target_dir . basename($_FILES["audioM"]["name"]);
			$uploadOk = 1;
			move_uploaded_file($_FILES["audioM"]["tmp_name"], $target_file);

			//ajouter la prononciation de la traduction sous l'ID trad
			$sqlIDtrad = "SELECT ID_MOT FROM mots WHERE LABEL = '".$_POST['trad']."' and LANG = '".$_POST['lt']."'";
			$result_IDtrad = mysqli_query($link,$sqlIDtrad);
			$IDtrad = mysqli_fetch_assoc($result_IDtrad);
			
			$target_dir = "audio/";
			$_FILES['audioT']['name'] = $IDtrad['ID_MOT'].'.mp3';
			$target_file = $target_dir . basename($_FILES['audioT']['name']);
			$uploadOk = 1;
			move_uploaded_file($_FILES['audioT']['tmp_name'], $target_file);

			$target_dir = "img/";
			$imageFileType = strtolower(pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION));
			$_FILES['img']['name'] = $IDCN.'.jpg';
			$target_file = $target_dir.basename($_FILES['img']['name']);
			$uploadOk = 1;
			move_uploaded_file($_FILES['img']['tmp_name'], $target_file);

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

			echo 'Le mot et la traduction ont été ajoutés.<br>';
			echo '<a href="form_add.php?conf=n" class=button>Retour</a>';
		}

	}
}

elseif ($_GET['conf'] == 'y') {
	$sqlTrad = "INSERT INTO mots (ID_CONCEPT, LABEL, PRON, ID_LEC, ATTRIBUT_1, ATTRIBUT_2, ATTRIBUT_3, LANG) VALUES ('".$_SESSION['ID_concept']."','".$_SESSION['trad']."','".$_SESSION['pront']."','".$_SESSION['ID_lec']."','".$_SESSION['att1t']."','".$_SESSION['att2t']."','".$_SESSION['att3t']."','".$_SESSION['lt']."')";
	mysqli_query($link,$sqlTrad);

	$sqlMot = "INSERT INTO mots (ID_CONCEPT, LABEL, PRON, ID_LEC, ATTRIBUT_1, ATTRIBUT_2, ATTRIBUT_3, LANG) VALUES ('".$_SESSION['ID_concept']."','".$_SESSION['mot']."','".$_SESSION['pron']."','".$_SESSION["ID_lec"]."','".$_SESSION['att1']."','".$_SESSION['att2']."','".$_SESSION['att3']."','".$_SESSION['lang_site']."')";
	mysqli_query($link,$sqlMot);

	//ajouter la prononciation sous l'ID mot
	$sqlIDmot = "SELECT ID_MOT FROM mots WHERE LABEL = '".$_SESSION['mot']."'";
	$result_IDmot = mysqli_query($link,$sqlIDmot);
	$IDmot = mysqli_fetch_assoc($result_IDmot);

	$target_dir = "audio/";
	$_SESSION["audioM"]["name"] = $IDmot['ID_MOT'].'.mp3';
	$target_file = $target_dir . basename($_SESSION["audioM"]["name"]);
	$uploadOk = 1;
	move_uploaded_file($_SESSION["audioM"]["tmp_name"], $target_file);

	//ajouter la prononciation de la traduction sous l'ID trad
	$sqlIDtrad = "SELECT ID_MOT FROM mots WHERE LABEL = '".$_SESSION['trad']."'";
	$result_IDtrad = mysqli_query($link,$sqlIDtrad);
	$IDtrad = mysqli_fetch_assoc($result_IDtrad);
		
	$target_dir = "audio/";
	$_SESSION["audioT"]["name"] = $IDtrad['ID_MOT'].'.mp3';
	$target_file = $target_dir . basename($_SESSION["audioT"]["name"]);
	$uploadOk = 1;
	move_uploaded_file($_SESSION["audioT"]["tmp_name"], $target_file);

	$target_dir = "img/";
	$imageFileType = strtolower(pathinfo($_SESSION['img']['name'],PATHINFO_EXTENSION));
	$_SESSION['img']['name'] = $_SESSION['ID_concept'].'.jpg';
	$target_file = $target_dir.basename($_SESSION['img']['name']);
	$uploadOk = 1;
	move_uploaded_file($_SESSION['img']['tmp_name'], $target_file);

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

	echo 'Le mot et la traduction ont été ajoutés.';
	echo '<a href="form_add.php?conf=n" class=button>Retour</a>';
}


?>
