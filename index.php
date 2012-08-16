<?php
	require( 'utils.php' ); 
?>
<!DOCTYPE html>
<html lang="en"><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Moi je sais</title>
	<link rel="stylesheet" href="./normalize.css">
	<link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
	<div class="robot">
	</div>
	<div class="content">
		<blockquote class="oval-speech">
			<p><?= $message ?></p>
		</blockquote>
	</div>
</div>
</body>
</html>
