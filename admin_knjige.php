<?php
require_once 'povezava.php';
session_start();

if ($_SESSION['vloga'] != "admin") {
    echo "Nimate dovoljenja.";
    exit;
}

$gumb = "Dodaj";
$id_knjiga = "";
$naslov = "";
$opis = "";
$slika = "";
$datoteka = "";
$ime_avtorja = "";
$priimek_avtorja = "";
$naziv_kategorije = "";

if (isset($_GET['brisi'])) {
    $id_knjiga = $_GET['brisi'];

    $sql = "DELETE FROM komentarji WHERE id_knjiga = '$id_knjiga'";
    mysqli_query($link, $sql);

    $sql = "DELETE FROM prenosi WHERE id_knjiga = '$id_knjiga'";
    mysqli_query($link, $sql);

    $sql = "DELETE FROM knjige WHERE id_knjiga = '$id_knjiga'";
    mysqli_query($link, $sql);

    header("Location: admin_knjige.php");
}

if (isset($_GET['uredi'])) {
    $id_knjiga = $_GET['uredi'];

    $sql = "SELECT k.*, a.ime, a.priimek, kat.naziv
            FROM knjige k, avtorji a, kategorije kat
            WHERE k.id_avtor = a.id_avtor
            AND k.id_kategorija = kat.id_kategorija
            AND k.id_knjiga = '$id_knjiga'";
    $rezultat = mysqli_query($link, $sql);
    $knjiga = mysqli_fetch_array($rezultat);

    $naslov = $knjiga['naslov'];
    $opis = $knjiga['opis'];
    $slika = $knjiga['slika'];
    $datoteka = $knjiga['datoteka'];
    $ime_avtorja = $knjiga['ime'];
    $priimek_avtorja = $knjiga['priimek'];
    $naziv_kategorije = $knjiga['naziv'];
    $gumb = "Shrani";
}

if (isset($_POST['dodaj'])) {
    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];
    $slika = $_POST['slika'];
    $datoteka = $_POST['datoteka'];
    $ime_avtorja = $_POST['ime_avtorja'];
    $priimek_avtorja = $_POST['priimek_avtorja'];
    $naziv_kategorije = $_POST['naziv_kategorije'];

    $sql = "SELECT * FROM avtorji
            WHERE ime = '$ime_avtorja'
            AND priimek = '$priimek_avtorja'";
    $rezultat = mysqli_query($link, $sql);

    if (mysqli_num_rows($rezultat) > 0) {
        $avtor = mysqli_fetch_array($rezultat);
        $id_avtor = $avtor['id_avtor'];
    }
    else {
        $sql = "INSERT INTO avtorji (ime, priimek)
                VALUES ('$ime_avtorja', '$priimek_avtorja')";
        mysqli_query($link, $sql);
        $id_avtor = mysqli_insert_id($link);
    }

    $sql = "SELECT * FROM kategorije
            WHERE naziv = '$naziv_kategorije'";
    $rezultat = mysqli_query($link, $sql);

    if (mysqli_num_rows($rezultat) > 0) {
        $kategorija = mysqli_fetch_array($rezultat);
        $id_kategorija = $kategorija['id_kategorija'];
    }
    else {
        $sql = "INSERT INTO kategorije (naziv)
                VALUES ('$naziv_kategorije')";
        mysqli_query($link, $sql);
        $id_kategorija = mysqli_insert_id($link);
    }

    $sql = "INSERT INTO knjige (naslov, opis, slika, datoteka, id_avtor, id_kategorija)
            VALUES ('$naslov', '$opis', '$slika', '$datoteka', '$id_avtor', '$id_kategorija')";
    mysqli_query($link, $sql);

    header("Location: admin_knjige.php");
}

if (isset($_POST['shrani'])) {
    $id_knjiga = $_POST['id_knjiga'];
    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];
    $slika = $_POST['slika'];
    $datoteka = $_POST['datoteka'];
    $ime_avtorja = $_POST['ime_avtorja'];
    $priimek_avtorja = $_POST['priimek_avtorja'];
    $naziv_kategorije = $_POST['naziv_kategorije'];

    $sql = "SELECT * FROM avtorji
            WHERE ime = '$ime_avtorja'
            AND priimek = '$priimek_avtorja'";
    $rezultat = mysqli_query($link, $sql);

    if (mysqli_num_rows($rezultat) > 0) {
        $avtor = mysqli_fetch_array($rezultat);
        $id_avtor = $avtor['id_avtor'];
    }
    else {
        $sql = "INSERT INTO avtorji (ime, priimek)
                VALUES ('$ime_avtorja', '$priimek_avtorja')";
        mysqli_query($link, $sql);
        $id_avtor = mysqli_insert_id($link);
    }

    $sql = "SELECT * FROM kategorije
            WHERE naziv = '$naziv_kategorije'";
    $rezultat = mysqli_query($link, $sql);

    if (mysqli_num_rows($rezultat) > 0) {
        $kategorija = mysqli_fetch_array($rezultat);
        $id_kategorija = $kategorija['id_kategorija'];
    }
    else {
        $sql = "INSERT INTO kategorije (naziv)
                VALUES ('$naziv_kategorije')";
        mysqli_query($link, $sql);
        $id_kategorija = mysqli_insert_id($link);
    }

    $sql = "UPDATE knjige
            SET naslov = '$naslov',
                opis = '$opis',
                slika = '$slika',
                datoteka = '$datoteka',
                id_avtor = '$id_avtor',
                id_kategorija = '$id_kategorija'
            WHERE id_knjiga = '$id_knjiga'";
    mysqli_query($link, $sql);

    header("Location: admin_knjige.php");
}

$sql = "SELECT * FROM knjige";
$rezultat_knjige = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <title>Admin knjige</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<?php require_once 'glava.php'; ?>

<div id="forma">
    <h1>Urejanje knjig</h1>

    <form method="POST" action="admin_knjige.php">
        <input type="hidden" name="id_knjiga" value="<?php echo $id_knjiga; ?>">

        <p>Naslov:<br><input type="text" name="naslov" value="<?php echo $naslov; ?>"></p>
        <p>Opis:<br><textarea name="opis"><?php echo $opis; ?></textarea></p>
        <p>Slika:<br><input type="text" name="slika" value="<?php echo $slika; ?>"></p>
        <p>Datoteka:<br><input type="text" name="datoteka" value="<?php echo $datoteka; ?>"></p>

        <p>Ime avtorja:<br>
            <input type="text" name="ime_avtorja" value="<?php echo $ime_avtorja; ?>">
        </p>

        <p>Priimek avtorja:<br>
            <input type="text" name="priimek_avtorja" value="<?php echo $priimek_avtorja; ?>">
        </p>

        <p>Kategorija:<br>
            <input type="text" name="naziv_kategorije" value="<?php echo $naziv_kategorije; ?>">
        </p>

        <?php
        if ($gumb == "Dodaj") {
            echo '<p><input type="submit" name="dodaj" value="Dodaj"></p>';
        }
        else {
            echo '<p><input type="submit" name="shrani" value="Shrani"></p>';
        }
        ?>
    </form>
</div>

<div class="sekcija sredina">
    <h2>Seznam knjig</h2>

    <table>
        <tr>
            <th>Naslov</th>
            <th>Uredi</th>
            <th>Brisi</th>
        </tr>

        <?php
        while ($knjiga = mysqli_fetch_array($rezultat_knjige)) {
            echo '<tr>';
            echo '<td>' . $knjiga['naslov'] . '</td>';
            echo '<td><a href="admin_knjige.php?uredi=' . $knjiga['id_knjiga'] . '">Uredi</a></td>';
            echo '<td><a href="admin_knjige.php?brisi=' . $knjiga['id_knjiga'] . '">Brisi</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

</body>
</html>