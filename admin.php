<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mój Blog</title>
    <link rel="stylesheet" href="style_main.css">
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
                    if($_SESSION['login'] == null) {
                        header('Location: index.php');
                    }
                    echo $_SESSION['login'];
                ?></dt><br>
                <dt><a href="main.php">Strona główna</a></dt><br>
                <dt><a href="Gry.php">Gry</a></dt><br>
                <dt><a href="logout.php">Wyloguj się</a></dt><br>
                <dt><a href="contact.php">Kontakt</a></dt><br>
            </dl>
        </section>
        <section id="right">      
            <?php
            require_once "connect.php";
            echo "<br><br>";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, user, email FROM uzytkownicy";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table border="0">';
                echo '<tr><th>ID</th><th>User</th><th>Email</th><th>Akcje</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo "<form action='delete.php' method='POST'>";
                    echo '<tr>';
                    echo '<td>' . $row["id"] . '</td>';
                    echo '<td>' . $row["user"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo "<td><input type='hidden' name='user_id' value='" . $row['id'] . "'></td>";
                    echo "<td><input type='submit' value='Usuń'></td>";
                    echo '</tr>';
                    echo "</form>";
                }

                echo '</table>';
            } else {
                echo "Brak wpisów.";
            }

            $conn->close();
            ?>
        </section>
    </section>
</body>
</html>
