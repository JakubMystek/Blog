<?php
            require_once "connect.php";
            echo "<br><br>";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
                $user_id_to_delete = $_POST['user_id'];
                $sql_delete = "DELETE FROM uzytkownicy WHERE id = $user_id_to_delete";

                if ($conn->query($sql_delete) === TRUE) {
                    echo '<script>alert("Użytkownik został usunięty pomyślnie."); window.location.href = "admin.php";</script>';
                } else {
                    echo '<script>alert("Błąd podczas usuwania użytkownika: ' . $conn->error . '"); window.location.href = "admin.php";</script>';
                }
            }
?>