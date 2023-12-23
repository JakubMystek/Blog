<!DOCTYPE html>
<head>
    <meta charset="UTF-8" >
    <title>Mój Blog</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<SITE_KEY>"></script>
</head>
<!-- Use this site key in the HTML code your site serves to users.
6LcJXhopAAAAACcG5rKDyYQL4KiiI7IBcfy7LNxh
Use this secret key for communication between your site and reCAPTCHA.
6LcJXhopAAAAABz8h3I9BD4JB11YtQwzP94XRw_f -->
<body>
<header>
    BLOG KĄKUTEROWY
</header>
<section id="Main">
    <section id="left">
        <h1> Menu </h1>
        <dl>
            Left
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
        <?php include 'login.php'; ?>
        </section>
        <section id="double_right"></section>
        <h1>Nie masz konta? Nic nie szkodzi, tu możesz je utworzyć:</h1>
        <form method="POST" action="LINK2.php">
            <b>Login:</b><br> <input type="text" name="login"><br>
            <b>Hasło:</b><br> <input type="password" name="haslo1"><br>
            <b>Powtórz hasło:</b><br> <input type="password" name="haslo2"><br>
            <input type="submit" value="Utwórz konto" name="rejestruj">
        </form>
        </section>
    </section>
</section>
</body>
</html>