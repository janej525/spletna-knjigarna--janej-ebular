<?php
require_once 'povezava.php';
session_start();

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "SELECT k.*, a.ime, a.priimek, kat.naziv AS kategorija
        FROM knjige k, avtorji a, kategorije kat
        WHERE k.id_avtor = a.id_avtor
        AND k.id_kategorija = kat.id_kategorija
        AND k.id_knjiga = '$id'";
$rezultat = mysqli_query($link, $sql);
$knjiga = mysqli_fetch_array($rezultat);

$sql_kom = "SELECT kom.besedilo, u.username
            FROM komentarji kom, uporabniki u
            WHERE kom.id_uporabnik = u.id_uporabnik
            AND kom.id_knjiga = '$id'
            ORDER BY kom.id_komentar DESC";
$rez_kom = mysqli_query($link, $sql_kom);
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <title>Podrobnosti knjige</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<?php require_once 'glava.php'; ?>

<div class="stran-vsebina">
<?php
if (!$knjiga) {
    echo '<div class="osnovna-sekcija">';
    echo '<h1>Knjiga ne obstaja</h1>';
    echo '<p><a href="knjige.php">Nazaj na knjige</a></p>';
    echo '</div>';
}
else {
?>
    <div class="osnovna-sekcija knjiga-podrobnosti">
        <div class="knjiga-slika">
            <img src="<?php echo $knjiga['slika']; ?>" alt="">
        </div>

        <div class="knjiga-podatki">
            <h1><?php echo $knjiga['naslov']; ?></h1>
            <p><b>Avtor:</b> <?php echo $knjiga['ime'] . ' ' . $knjiga['priimek']; ?></p>
            <p><b>Kategorija:</b> <?php echo $knjiga['kategorija']; ?></p>
            <p><b>Opis:</b> <?php echo $knjiga['opis']; ?></p>

            <?php
            if (isset($_SESSION['idu'])) {
                echo '<a class="gumb" href="datoteke/' . $knjiga['datoteka'] . '" download>Prenesi knjigo</a>';
            }
            else {
                echo '<a class="gumb" href="prijava.php">Prijavi se za prenos</a>';
            }
            ?>
        </div>
    </div>

    <div class="osnovna-sekcija">
        <h2>Komentarji</h2>

        <?php
        if (mysqli_num_rows($rez_kom) == 0) {
            echo '<p>Ni komentarjev.</p>';
        }

        while ($komentar = mysqli_fetch_array($rez_kom)) {
            echo '<div class="komentar-kartica">';
            echo '<b>' . $komentar['username'] . '</b>';
            echo '<p>' . $komentar['besedilo'] . '</p>';
            echo '</div>';
        }
        ?>

        <?php
        if (isset($_SESSION['idu'])) {
        ?>
            <form class="komentar-obrazec" method="POST" action="komentar_dodaj.php">
                <input type="hidden" name="id_knjiga" value="<?php echo $id; ?>">
                <p>
                    Dodaj komentar:<br>
                    <textarea name="besedilo" required></textarea>
                </p>
                <p><input type="submit" class="gumb" name="dodaj" value="Dodaj komentar"></p>
            </form>
        <?php
        }
        else {
            echo '<p>Za dodajanje komentarja se morate <a href="prijava.php">prijaviti</a>.</p>';
        }
        ?>
    </div>
<?php
}
?>
</div>

<div id="footer">
    <a href="info.php">Informacije</a>
    <a href="kontakt.php">Kontakt</a>
    <a href="viri.php">Viri</a>
    <p> 2026 Spletna knjigarna</p>
</div>

</body>
</html>
