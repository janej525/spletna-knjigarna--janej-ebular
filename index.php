<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Spletna knjigarna</title>
    <link href="still.css" rel="stylesheet">
</head>
<body>

<div id="navbar">
    <span id="logo"><img src="knjiga.jfif"> Spletna knjigarna</span>
    <span id="nav-povezave">
        <a href="prijava.php">Prijava</a>
        <a href="registracija.php">Registracija</a>
    </span>
</div>

<div id="hero">
    <h1>Dobrodošli v spletni knjigarni</h1>
    <form method="GET" action="index.php">
        <input type="text" name="iskanje" placeholder="Išči knjige ali avtorje...">
        <input type="submit" value="Išči">
    </form>
</div>

<div id="vsebina">

    <div id="kategorije">
        <h3>Kategorije</h3>
        <a href="knjige.php?kategorija=1">Fantazija</a><br>
        <a href="knjige.php?kategorija=2">Drama</a><br>
        <a href="knjige.php?kategorija=3">Kriminalka</a><br>
    </div>

    <div id="knjige-del">

        <div class="sekcija">
            <h2>Priporočene knjige</h2>
            <div class="knjige-mreza">

                <div class="knjiga-kartica">
                    <img src="harrypotter.jpg" 
                    <h3>Harry Potter</h3>
                    <p>J.K. Rowling</p>
                    <a href="knjiga.php?id=1">Več info</a>
                    <a href="prenos.php?id=1">Prenesi</a>
                </div>

                <div class="knjiga-kartica">
                    <img src="naklancu.jfif" >
                    <h3>Na klancu</h3>
                    <p>Ivan Cankar</p>
                    <a href="knjiga.php?id=2">Več info</a>
                    <a href="prenos.php?id=2">Prenesi</a>
                </div>

                <div class="knjiga-kartica">
                    <img src="orient.jpg" >
                    <h3>Umor na Orient ekspresu</h3>
                    <p>Agatha Christie</p>
                    <a href="knjiga.php?id=3">Več info</a>
                    <a href="prenos.php?id=3">Prenesi</a>
                </div>

            </div>
            <a href="knjige.php">Vse knjige</a>
        </div>

        <div class="sekcija">
            <h2>Najnovejše knjige</h2>
            <div class="knjige-mreza">

                <div class="knjiga-kartica">
                    <img src="orient.jpg" >
                    <h3>Umor na Orient ekspresu</h3>
                    <p>Agatha Christie</p>
                    <a href="knjiga.php?id=3">Več info</a>
                    <a href="prenos.php?id=3">Prenesi</a>
                </div>

                <div class="knjiga-kartica">
                    <img src="naklancu.jfif" >
                    <h3>Na klancu</h3>
                    <p>Ivan Cankar</p>
                    <a href="knjiga.php?id=2">Več info</a>
                    <a href="prenos.php?id=2">Prenesi</a>
                </div>

                <div class="knjiga-kartica">
                    <img src="harrypotter.jpg" >
                    <h3>Harry Potter</h3>
                    <p>J.K. Rowling</p>
                    <a href="knjiga.php?id=1">Več info</a>
                    <a href="prenos.php?id=1">Prenesi</a>
                </div>

            </div>
        </div>

    </div>
</div>

<div id="footer">
    <a href="info.php">Informacije</a>
    <a href="kontakt.php">Kontakt</a>
    <p>© 2026 Spletna knjigarna</p>
</div>

</body>
</html>