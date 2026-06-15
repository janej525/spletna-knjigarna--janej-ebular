<div id="navigacija">
    <span id="logo"><img src="knjiga.jfif" alt="Knjiga"> Spletna knjigarna</span>

    <span id="povezave">
        <a href="index.php">Domov</a>
        <a href="knjige.php">Vse knjige</a>

        <?php
        if (isset($_SESSION['idu']))
        {
            echo '<span>Pozdravljeni, ' . $_SESSION['imeu'] . '</span>';

            if (isset($_SESSION['vloga'])) {
                if ($_SESSION['vloga'] == "admin") {
                    echo '<a href="admin_knjige.php">Admin</a>';
                }
            }

            echo '<a href="odjava.php">Odjava</a>';
        }
        else
        {
            echo '<a href="prijava.php">Prijava</a>';
            echo '<a href="registracija.php">Registracija</a>';
        }
        ?>
    </span>
</div>
