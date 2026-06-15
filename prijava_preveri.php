<?php
require 'povezava.php';
session_start();

if (isset($_POST['send'])) {
    $m = $_POST['mail'];
    $p = $_POST['pass'];

    $sql = "SELECT * FROM uporabniki WHERE email='$m' AND geslo='$p'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $_SESSION['imeu'] = $row['username'];
        $_SESSION['idu'] = $row['id_uporabnik'];
        $_SESSION['vloga'] = $row['vloga'];

        if ($_SESSION['vloga'] == "admin") {
            header("Location: admin_knjige.php");
        }
        else {
            header("Location: index.php");
        }
    }
    else {
        header("Refresh:2; url=prijava.php");
        echo "Uporabnik ne obstaja ali pa niso pravi podatki.";
    }
}
?>