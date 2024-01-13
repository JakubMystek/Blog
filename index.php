<?php
	session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8" >
    <title>Mój Blog</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<SITE_KEY>"></script>
</head>
<body>
<header>
    BLOG KĄKUTEROWY
</header>
<section id="Main">
    <section id="left">
        <h1> Menu </h1>
        <dl>
        <dt><a href="contact.php">Kontakt</a></dt><br>
        </dl>
    </section>
    <section id="right">
        <section id="left_right">
            <h1>Zaloguj się:</h1>
        <form method="POST" action="login.php">
            <b>Login:</b> <input type="text" name="login"><br>
            <b>Hasło:</b> <input type="password" name="haslo"><br>
            <input type="submit" value="Zaloguj" name="loguj">
        </form>
        </section>
        <section id="double_right"></section>
        <h1>Nie masz konta? <a href="register.php">Zarejestruj się</a></h1>

        </section>
    </section>
</section>
</body>
</html>