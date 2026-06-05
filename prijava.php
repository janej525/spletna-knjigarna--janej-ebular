<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <title>Prijava</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<?php require_once 'glava.php'; ?>

<div id="forma">
    <h1>Prijava</h1>
    <form action="prijava_preveri.php" method="POST">
   <p>
    Email:<br>
    <input type="email" name="mail" required>
	</p>
	<p>
    Geslo:<br>
    <input type="password" name="pass" required>
	</p>
	<p>
    <input type="reset" class="gumb" value="Ponastavi">
    <input type="submit" class="gumb" name="send" value="Prijava">
</p>
</form>
    <p>Nimate racuna? <a href="registracija.php">Registracija</a></p>
</div>

</body>
</html>
