<?php

session_start();

// Funkcja do stworzenia nowej talii kart i jej potasowania
function stworzTalie() {
    $talia = array();
    $figury = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');
    $kolory = array('Karo', 'Kier', 'Trefl', 'Pik');
    
    foreach($figury as $figura) {
        foreach($kolory as $kolor) {
            $talia[] = array('figura' => $figura, 'kolor' => $kolor);
        }
    }
    
    shuffle($talia);
    return $talia;
}

// Funkcja do obliczenia wartości karty
function wartoscKarty($karta) {
    $figura = $karta['figura'];
    if ($figura === 'J' || $figura === 'Q' || $figura === 'K') {
        return 10;
    } elseif ($figura === 'A') {
        return 11;
    } else {
        return intval($figura);
    }
}

// Funkcja do wyświetlania karty
function wyswietlKarte($karta) {
    echo $karta['figura'] . ' ' . $karta['kolor'];
}

// Rozpoczęcie gry
if (!isset($_SESSION['talia']) || isset($_POST['nowa_gra'])) {
    $_SESSION['talia'] = stworzTalie();
    $_SESSION['gracz_karty'] = array();
    $_SESSION['krupier_karty'] = array();
    $_SESSION['wynik'] = '';
    
    // Rozdanie kart graczowi i krupierowi
    for ($i = 0; $i < 2; $i++) {
        $_SESSION['gracz_karty'][] = array_shift($_SESSION['talia']);
        $_SESSION['krupier_karty'][] = array_shift($_SESSION['talia']);
    }
}

// Logika gry
if (isset($_POST['dobierz'])) {
    $_SESSION['gracz_karty'][] = array_shift($_SESSION['talia']);
    $sumaGracza = array_sum(array_map('wartoscKarty', $_SESSION['gracz_karty']));
    
    if ($sumaGracza > 21) {
        $_SESSION['wynik'] = 'Przegrałeś! Suma Twoich kart wynosi ' . $sumaGracza . '.';
    }
} elseif (isset($_POST['spasuj'])) {
    $sumaGracza = array_sum(array_map('wartoscKarty', $_SESSION['gracz_karty']));
    $sumaKrupiera = array_sum(array_map('wartoscKarty', $_SESSION['krupier_karty']));
    
    // Krupier dobiera karty według zasad
    while ($sumaKrupiera < 16) {
        $_SESSION['krupier_karty'][] = array_shift($_SESSION['talia']);
        $sumaKrupiera = array_sum(array_map('wartoscKarty', $_SESSION['krupier_karty']));
    }
    
    if ($sumaKrupiera > 21 || $sumaGracza > $sumaKrupiera) {
        $_SESSION['wynik'] = 'Wygrałeś! Twoja suma kart: ' . $sumaGracza . ', suma kart krupiera: ' . $sumaKrupiera . '.';
    } elseif ($sumaKrupiera === $sumaGracza) {
        $_SESSION['wynik'] = 'Remis! Obie strony mają sumę kart równą ' . $sumaGracza . '.';
    } else {
        $_SESSION['wynik'] = 'Przegrałeś! Suma Twoich kart wynosi ' . $sumaGracza . ', suma kart krupiera: ' . $sumaKrupiera . '.';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gra w Oczko</title>
    <meta charset="UTF-8" >
    <link rel="stylesheet" href="style.css">
    <style>
        .karty {
            display: inline-block;
            margin: 10px;
            border: 1px solid #000;
            padding: 5px;
        }
    </style>
</head>
<body>
    <section id='Main'>
    <h1>Gra w Oczko</h1>
    <?php if (!empty($_SESSION['wynik'])) : ?>
        <h2><?php echo $_SESSION['wynik']; ?></h2>
        <form method="post">
            <input type="submit" name="nowa_gra" value="Rozpocznij nową grę">
        </form>
    <?php else : ?>
        <div class="karty">
            <h2>Twoje karty:</h2>
            <?php foreach ($_SESSION['gracz_karty'] as $karta) : ?>
                <p><?php wyswietlKarte($karta); ?></p>
            <?php endforeach; ?>
            <p>Suma kart: <?php echo array_sum(array_map('wartoscKarty', $_SESSION['gracz_karty'])); ?></p>
            <form method="post">
                <input type="submit" name="dobierz" value="Dobierz kartę">
                <input type="submit" name="spasuj" value="Spasuj">
            </form>
        </div>
        
        <div class="karty">
            <h2>Karty krupiera:</h2>
            <?php foreach ($_SESSION['krupier_karty'] as $index => $karta) : ?>
                <p><?php echo $index === 0 ? 'Karta zakryta' : wyswietlKarte($karta); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <a href="Gry.php">Cofnij</a>
            </section>
</body>
</html>
