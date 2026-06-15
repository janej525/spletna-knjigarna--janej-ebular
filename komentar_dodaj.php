<?php
require_once 'povezava.php';
session_start();

if (!isset($_SESSION['idu'])) {
    header("Location: prijava.php");

}

if (isset($_POST['dodaj'])) {
    $id_knjiga = $_POST['id_knjiga'];
    $id_uporabnik = $_SESSION['idu'];
    $besedilo = $_POST['besedilo'];

    $sql = "INSERT INTO komentarji (besedilo, id_uporabnik, id_knjiga)
            VALUES ('$besedilo', '$id_uporabnik', '$id_knjiga')";

    mysqli_query($link, $sql);

    header("Location: knjiga.php?id=$id_knjiga");
    exit;
}
?>