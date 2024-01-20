<?php
session_start();

if ($_SESSION['login'] != 'admin') {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['post_id']) && is_numeric($_POST['post_id'])) {
        $postId = $_POST['post_id'];

        require_once "connect.php";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM wpisy WHERE id = $postId";

        if ($conn->query($sql) === TRUE) {
            echo '<script>';
            echo 'alert("Wpis został usunięty pomyślnie.");';
            echo 'window.location.href = "main.php";'; 
            echo '</script>';
        } else {
            echo "Błąd podczas usuwania wpisu: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Błędne żądanie.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
?>
