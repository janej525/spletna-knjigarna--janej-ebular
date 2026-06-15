<?php
require_once 'povezava.php';
session_start();

$sporocilo = "";
if(isset($_POST['registracija']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $geslo = $_POST['geslo'];
    $vloga = "uporabnik";
	
    $sql_email = "SELECT * FROM uporabniki WHERE email='$email'";
    $rezultat_email = mysqli_query($link, $sql_email);

    if(mysqli_num_rows($rezultat_email) > 0)
    {
        $sporocilo = "Uporabnik s tem emailom ze obstaja.";
    }
    else
    {
        $sql = "INSERT INTO uporabniki (username, email, geslo, vloga)
                VALUES ('$username', '$email', '$geslo', '$vloga')";

        if(mysqli_query($link, $sql))
        {
            $sporocilo = "Registracija je uspesna.";
        }
        else
        {
            $sporocilo = "Napaka pri registraciji.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <title>Registracija</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<?php require_once 'glava.php'; ?>

<div id="forma">
    <h1>Registracija</h1>

 <?php
echo '<p class="uspeh">' . $sporocilo . '</p>';
?>
<form method="POST" action="registracija.php">
    <p>Uporabnisko ime:<br><input type="text" name="username"></p>
    <p>Email:<br><input type="email" name="email"></p>
    <p>Geslo:<br><input type="password" name="geslo"></p>
    <p><input type="submit" class="gumb" name="registracija" value="Registracija"></p>
</form>
</div>

</body>
</html>
