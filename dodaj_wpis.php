<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tytul = $_POST["tytul"];
    $tresc = $_POST["tresc"];

    require_once "connect.php";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($polaczenie->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {

    $sql = "INSERT INTO wpisy (tytul, tresc) VALUES ('$tytul', '$tresc')";

    if ($conn->query($sql) === TRUE) {
        echo "Wpis dodany pomyślnie.";
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: main.php');
}
}
?>
