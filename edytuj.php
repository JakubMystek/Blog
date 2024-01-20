<?php
session_start();

if(!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

require_once "connect.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdź czy przekazano poprawny identyfikator wpisu
    if(isset($_POST['post_id']) && is_numeric($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        // Pobierz dane wpisu do edycji
        $sql = "SELECT * FROM wpisy WHERE id = $post_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tytul = $row['tytul'];
            $tresc = $row['tresc'];
        } else {
            echo "Nie znaleziono wpisu do edycji.";
            exit();
        }
    } else {
        echo "Nieprawidłowy identyfikator wpisu.";
        exit();
    }
} else {
    echo "Nieprawidłowe żądanie.";
    exit();
}

// Obsługa formularza edycji
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
    $new_tytul = $_POST['tytul'];
    $new_tresc = $_POST['tresc'];

    // Wykonaj aktualizację wpisu w bazie danych
    $sql_update = "UPDATE wpisy SET tytul='$new_tytul', tresc='$new_tresc' WHERE id=$post_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Wpis został zaktualizowany pomyślnie.";
        header("Location: main.php"); // Przekieruj do strony głównej po edycji
        exit();
    } else {
        echo "Błąd podczas aktualizacji wpisu: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edytuj Wpis</title>
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
                <dt><?php echo $_SESSION['login']; ?></dt><br>
                <dt><a href="main.php">Strona główna</a></dt><br>
                <dt><a href="Gry.php">Gry</a></dt><br>
                <dt><a href="logout.php">Wyloguj się</a></dt><br>
                <dt><a href="contact.php">Kontakt</a></dt><br>
            </dl>
        </section>
        <section id="right">
            <form action="edytuj.php" method="post">
                <label>Tytuł:</label><br>
                <input type="text" name="tytul" value="<?php echo $tytul; ?>"><br>
                <label>Treść:</label><br>
                <textarea name="tresc" rows="4" cols="50"><?php echo $tresc; ?></textarea><br>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <input type="submit" name="edit_post" value="Zapisz zmiany">
            </form>
        </section>
    </section>
</body>
</html>
