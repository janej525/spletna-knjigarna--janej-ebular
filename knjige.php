<?php
require_once 'povezava.php';
session_start();

$naslov_strani = "Vse knjige";

if (isset($_GET['kategorija'])) {
    $izbrana_kategorija = $_GET['kategorija'];

    $sql_kategorija = "SELECT naziv FROM kategorije WHERE id_kategorija = '$izbrana_kategorija'";
    $rezultat_kategorija = mysqli_query($link, $sql_kategorija);

    if ($kategorija = mysqli_fetch_array($rezultat_kategorija)) {
        $naslov_strani = "Kategorija: " . $kategorija['naziv'];
    }

    $sql_knjige = "SELECT k.id_knjiga, k.naslov, k.opis, k.slika, a.ime, a.priimek, kat.naziv AS kategorija
                  FROM knjige k, avtorji a, kategorije kat
                  WHERE k.id_avtor = a.id_avtor
                  AND k.id_kategorija = kat.id_kategorija
                  AND k.id_kategorija = '$izbrana_kategorija'
                  ORDER BY k.naslov";
}
else {
    $sql_knjige = "SELECT k.id_knjiga, k.naslov, k.opis, k.slika, a.ime, a.priimek, kat.naziv AS kategorija
                  FROM knjige k, avtorji a, kategorije kat
                  WHERE k.id_avtor = a.id_avtor
                  AND k.id_kategorija = kat.id_kategorija
                  ORDER BY k.naslov";
}

$rezultat_knjige = mysqli_query($link, $sql_knjige);
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <title>Knjige</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<?php require_once 'glava.php'; ?>

<div class="sekcija sredina">
    <h1><?php echo $naslov_strani; ?></h1>

    <div class="seznam-knjig">
    <?php
    while ($knjiga = mysqli_fetch_array($rezultat_knjige)) {
        echo '<div class="knjiga">';
        echo '<img src="' . $knjiga['slika'] . '" alt="">';
        echo '<h3>' . $knjiga['naslov'] . '</h3>';
        echo '<p>' . $knjiga['ime'] . ' ' . $knjiga['priimek'] . '</p>';
        echo '<p>' . $knjiga['kategorija'] . '</p>';
        echo '<a href="knjiga.php?id=' . $knjiga['id_knjiga'] . '">Vec info</a>';
        echo '</div>';
    }
    ?>
    </div>

    <div class="cisti"></div>
</div>

<div id="footer">
    <a href="info.php">Informacije</a>
    <a href="kontakt.php">Kontakt</a>
    <a href="viri.php">Viri</a>
    <p>2026 Spletna knjigarna</p>
</div>

</body>
</html>
