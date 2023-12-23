<?php
    if (isset($_POST['loguj']))
    { 
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        if($login == 'admin' && $haslo == 'admin')
        {
            header('Location: main.php');
        }
        else
        {
            //to się jeszcze ustali
        }
    }
?>