<?php
require_once 'povezava.php';
session_start();

$iskanje = "";
$rezultat_iskanje = null;

if (isset($_GET['iskanje'])) {
    $iskanje = $_GET['iskanje'];

    $sql_iskanje = "SELECT k.id_knjiga, k.naslov, k.slika, k.datoteka, a.ime, a.priimek
                    FROM knjige k
                    JOIN avtorji a ON k.id_avtor = a.id_avtor
                    WHERE k.naslov LIKE '%$iskanje%'
                    OR a.ime LIKE '%$iskanje%'
                    OR a.priimek LIKE '%$iskanje%'";

    $rezultat_iskanje = mysqli_query($link, $sql_iskanje);
}

$sql_kat = "SELECT * FROM kategorije";
$rezultat_kat = mysqli_query($link, $sql_kat);

$sql_priporocene = "SELECT k.id_knjiga, k.naslov, k.slika, k.datoteka, a.ime, a.priimek
                    FROM knjige k
                    JOIN avtorji a ON k.id_avtor = a.id_avtor
                    LIMIT 3";
$rezultat_priporocene = mysqli_query($link, $sql_priporocene);

$sql_najnovejse = "SELECT k.id_knjiga, k.naslov, k.slika, k.datoteka, a.ime, a.priimek
                   FROM knjige k
                   JOIN avtorji a ON k.id_avtor = a.id_avtor
                   ORDER BY k.id_knjiga DESC
                   LIMIT 3";
$rezultat_najnovejse = mysqli_query($link, $sql_najnovejse);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <title>Spletna knjigarna</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<?php require_once 'glava.php'; ?>

<div id="uvod">
    <h1>Dobrodosli v spletni knjigarni</h1>

    <form method="GET" action="index.php">
        <input type="text" name="iskanje" placeholder="Isci knjige ali avtorje..." value="<?php echo $iskanje; ?>">
        <input type="submit" value="Isci">
    </form>
</div>

<?php
if ($rezultat_iskanje != null)
{
    echo '<div class="sekcija sredina">';
    echo '<h2>Rezultati iskanja</h2>';
    echo '<div class="seznam-knjig">';

    if (mysqli_num_rows($rezultat_iskanje) == 0)
    {
        echo '<p>Ni rezultatov.</p>';
    }

    while($row = mysqli_fetch_array($rezultat_iskanje))
    {
        echo '<div class="knjiga">';
        echo '<img src="' . $row['slika'] . '" alt="">';
        echo '<h3>' . $row['naslov'] . '</h3>';
        echo '<p>' . $row['ime'] . ' ' . $row['priimek'] . '</p>';
        echo '<a href="knjiga.php?id=' . $row['id_knjiga'] . '">Vec info</a>';

        if (isset($_SESSION['idu'])) {
            echo '<a href="datoteke/' . $row['datoteka'] . '" download>Prenesi</a>';
        }
        else {
            echo '<a href="prijava.php">Prijavi se za prenos</a>';
        }

        echo '</div>';
    }

    echo '</div>';
    echo '<div class="cisti"></div>';
    echo '</div>';
}
?>

<div id="vsebina">

    <div id="kategorije">
        <h3>Kategorije</h3>

        <?php
        while($row = mysqli_fetch_array($rezultat_kat))
        {
            echo '<a href="knjige.php?kategorija=' . $row['id_kategorija'] . '">' . $row['naziv'] . '</a>';
        }
        ?>
    </div>

    <div id="knjige-del">

        <div class="sekcija">
            <h2>Priporocene knjige</h2>

            <div class="seznam-knjig">
            <?php
            while($row = mysqli_fetch_array($rezultat_priporocene))
            {
                echo '<div class="knjiga">';
                echo '<img src="' . $row['slika'] . '" alt="">';
                echo '<h3>' . $row['naslov'] . '</h3>';
                echo '<p>' . $row['ime'] . ' ' . $row['priimek'] . '</p>';
                echo '<a href="knjiga.php?id=' . $row['id_knjiga'] . '">Vec info</a>';

                if (isset($_SESSION['idu'])) {
                    echo '<a href="datoteke/' . $row['datoteka'] . '" download>Prenesi</a>';
                }
                else {
                    echo '<a href="prijava.php">Prijavi se za prenos</a>';
                }

                echo '</div>';
            }
            ?>
            </div>
        </div>

        <div class="sekcija">
            <h2>Najnovejse knjige</h2>

            <div class="seznam-knjig">
            <?php
            while($row = mysqli_fetch_array($rezultat_najnovejse))
            {
                echo '<div class="knjiga">';
                echo '<img src="' . $row['slika'] . '" alt="">';
                echo '<h3>' . $row['naslov'] . '</h3>';
                echo '<p>' . $row['ime'] . ' ' . $row['priimek'] . '</p>';
                echo '<a href="knjiga.php?id=' . $row['id_knjiga'] . '">Vec info</a>';

                if (isset($_SESSION['idu'])) {
                    echo '<a href="datoteke/' . $row['datoteka'] . '" download>Prenesi</a>';
                }
                else {
                    echo '<a href="prijava.php">Prijavi se za prenos</a>';
                }

                echo '</div>';
            }
            ?>
            </div>
        </div>

    </div>
</div>

<div id="footer">
    <a href="info.php">Informacije</a>
    <a href="kontakt.php">Kontakt</a>
    <a href="viri.php">Viri</a>
    <p>2026 Spletna knjigarna</p>
</div>

</body>
</html>
