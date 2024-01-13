<?php
session_start();

// Zamykanie sesji, aby przygotować do ponownego użycia
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Podziękowania</title>
</head>
<body>

    <header>
        BLOG KĄKUTEROWY
    </header>

    <section id="Main">
        <section id="left">
            <h1> Menu </h1>
            <dl>
                <dt><a href="main.php">Strona główna</a></dt><br>
                <dt><a href="Gry.php">Gry</a></dt><br>
                <dt><a href="index.php">Zaloguj się</a></dt><br>
                <dt><a href="register.php">Zarejestruj się</a></dt><br>
            </dl>
        </section>

        <section id="right">
            <h1>Dziękujemy za przesłanie wiadomości!</h1>
            <p>Doceniamy Twoją opinię. Skontaktujemy się z Tobą, jeśli będzie to konieczne.</p>
            <p>Wybierz jedną z poniższych opcji:</p>
            <ul>
                <li><a href="main.php">Przejdź do strony głównej</a></li>
                <li><a href="Gry.php">Przeglądaj Gry</a></li>
                <li><a href="index.php">Zaloguj się</a></li>
                <li><a href="register.php">Zarejestruj się</a></li>
            </ul>
        </section>
    </section>

</body>
</html>
