<!DOCTYPE html>
<head>
    <meta charset="UTF-8" >
    <title>Mój Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    BLOG KĄKUTEROWY
</header>
<section id="Main">
    <section id="left">
        <h1> Menu </h1>
        <dl>
        <dt><?php
                    session_start();
                    if($_SESSION['login'] == null)
                    {header('Location: index.php');}
                    echo $_SESSION['login'];
                ?></dt><br>
            <dt><a href="main.php">Strona główna</a></dt><br>
            <dt><a href="Gry.php">Gry</a></dt><br>
            <dt><a href="contact.php">Kontakt</a></dt><br>
        </dl>
    </section>
    <section id="right">
        <h3>Gra w Oczko<h3>
        <a href="oczko.php">Zagraj</a>
        <h3>Znajdź parę<h3>
        <a href="para.html">Zagraj</a>
    </section>
</section>
</body>
</html>
