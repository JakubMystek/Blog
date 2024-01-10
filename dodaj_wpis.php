<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tytul = $_POST["tytul"];
    $tresc = $_POST["tresc"];

    require_once "connect.php";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        session_start();
        $login = $_SESSION['login'];

        // Pobranie id autora na podstawie nazwy użytkownika
        $query = "SELECT id FROM uzytkownicy WHERE user = '$login'";
        $result = $conn->query($query);

        if ($result) {
            // Pobranie wyniku zapytania
            $row = $result->fetch_assoc();
            $id_autora = $row['id'];

            // Wstawienie wpisu z właściwym id_autora
            $sql = "INSERT INTO wpisy (tytul, tresc, id_autora) VALUES ('$tytul', '$tresc', '$id_autora')";

            if ($conn->query($sql) === TRUE) {
                echo "Wpis dodany pomyślnie.";
            } else {
                echo "Błąd: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Błąd: " . $query . "<br>" . $conn->error;
        }

        $conn->close();
        header('Location: main.php');
    }
}

?>
