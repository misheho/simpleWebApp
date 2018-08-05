<?php
	session_start();
	include 'utils.php';

	$header = echo_header();
	echo $header;
?> 

</div>

<div id="center" class="container"><div id=mainTitle>Choisissez la langue à apprendre : <br><br></div>
	<form action="changer.php" method="get">
			<select name='lt' required>
			<option value='en'>anglais</option>
			<option value='cz'>tchèque</option>
		</select><br>
	<p><button type="submit" name= "change" value = "change">Changer</button></p>
	</form>
</body>

