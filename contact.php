<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kontakt</title>
</head>
<body>

    <header>
        BLOG KĄKUTEROWY
    </header>

    <section id="Main">
        <section id="left">
            <h1> Menu </h1>
            <dl>
                <dt><a href="index.php">Logowanie</a></dt><br>
                <dt><a href="register.php">Rejestracja</a></dt><br>
                <dt><a href="contact.php">Kontakt</a></dt><br>
            </dl>
        </section>

        <section id="right">
            <h1>Skontaktuj się z nami</h1>
            <form action="process_contact.php" method="post">
                <label for="name">Imię i Nazwisko:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Adres Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Wiadomość:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <input type="submit" value="Wyślij">
            </form>
        </section>
    </section>

</body>
</html>
