<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mój Blog</title>
    <link rel="stylesheet" href="style_main.css">
    <script>
        function insertBBCode(startTag, endTag) {
            var textarea = document.getElementById('postContent');
            var start = textarea.selectionStart;
            var end = textarea.selectionEnd;
            var selectedText = textarea.value.substring(start, end);
            var replacement = startTag + selectedText + endTag;
            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
        }
    </script>
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
                <dt><a href="logout.php">Wyloguj się</a></dt><br>
                <dt><a href="contact.php">Kontakt</a></dt><br>
                <dt><?php
                    if($_SESSION['login'] == 'admin')
                    echo '<a href="admin.php">Panel administracyjny</a></dt><br>';
                    ?>
            </dl>
        </section>
        <section id="right">
            <form action="dodaj_wpis.php" method="post">
                <label>Tytuł:</label><br>
                <input type="text" name="tytul"><br>
                <label>Treść:</label><br>
                <textarea name="tresc" id="postContent" rows="4" cols="50"></textarea><br>
                <button type="button" onclick="insertBBCode('[b]', '[/b]')"><b>B</b></button>
                <button type="button" onclick="insertBBCode('[i]', '[/i]')"><i>I</i></button>
                <button type="button" onclick="insertBBCode('[u]', '[/u]')"><u>U</u></button>
                <input type="submit" value="Dodaj wpis">
            </form>
            
            <?php
            function bbcode_to_html($bbtext) {
                $bbtags = array(
                    '[b]' => '<strong>',
                    '[/b]' => '</strong>',
                    '[i]' => '<em>',
                    '[/i]' => '</em>',
                    '[u]' => '<u>',
                    '[/u]' => '</u>',
                );

                return str_replace(array_keys($bbtags), array_values($bbtags), $bbtext);
            }

            require_once "connect.php";
            echo "<br><br>";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT wpisy.id, wpisy.tytul, wpisy.tresc, wpisy.data_publikacji, uzytkownicy.user FROM wpisy JOIN uzytkownicy ON wpisy.id_autora = uzytkownicy.id ORDER BY data_publikacji DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h2>" . $row["tytul"] . "</h2>";
                    $tresc_html = bbcode_to_html($row["tresc"]);
                    echo "<p>" . $tresc_html . "</p>";
                    echo "<p>Data publikacji: " . $row["data_publikacji"] . "</p>";
                    echo "<p>Autor: " . $row["user"] . "</p>";
                    
                    
                    if($_SESSION['login'] == 'admin' || $_SESSION['login'] == $row["user"])
                    {
                    echo "<form action='usun.php' method='POST'>";
                    echo "<input type='hidden' name='post_id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' value='Usun wpis'>";
                    echo "</form>";
                    }
                    if($_SESSION['login'] == $row["user"])
                    {
                    echo "<form action='edytuj.php' method='POST'>";
                    echo "<input type='hidden' name='post_id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' value='Edytuj wpis'>";
                    echo "</form>";
                    }


                    echo "<hr>";
                }
            } else {
                echo "Brak wpisów.";
            }

            $conn->close();
            ?>
        </section>
    </section>
</body>
</html>
