<!DOCTYPE html>
<head>
    <meta charset="UTF-8" >
    <title>Mój Blog</title>
    <style>
        /* Ukryj wszystkie artykuły poza pierwszym */
        article:not(:first-of-type) {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Tablica asocjacyjna zawierająca tytuły i treści wiadomości
$wiadomosci = array(
    array("tytul" => "Nagłówek pierwszej wiadomości", "tresc" => "Treść pierwszej wiadomości."),
    array("tytul" => "Nagłówek drugiej wiadomości", "tresc" => "Treść drugiej wiadomości."),
    array("tytul" => "Nagłówek trzeciej wiadomości", "tresc" => "Treść trzeciej wiadomości.")
    // Możesz dodawać kolejne wiadomości w podobny sposób
);
?>
<header>
    BLOG KĄKUTEROWY
</header>
<section id="Main">
    <section id="left">
        <h1> Menu </h1>
        <dl>
            <dt><a href="main.php">Strona główna</a></dt><br>
            <dt><a href="Gry.php">Gry</a></dt><br>
            <dt>Kontakt</dt><br>
        </dl>
    </section>
    <section id="right">
    <article>
    <h2><?php echo $wiadomosci[0]['tytul']; ?></h2>
    <p><?php echo $wiadomosci[0]['tresc']; ?></p>
</article>

<!-- Przycisk do przełączania między wiadomościami -->
<button id="nextButton">Następna wiadomość</button>

<script>
    // Pobierz wszystkie artykuły
    const articles = document.querySelectorAll('article');
    let currentArticle = 0;

    // Ukryj wszystkie artykuły poza pierwszym
    function hideAllArticles() {
        articles.forEach(article => {
            article.style.display = 'none';
        });
    }

    // Funkcja wywoływana po kliknięciu przycisku
    document.getElementById('nextButton').addEventListener('click', function() {
        // Ukryj aktualny artykuł
        articles[currentArticle].style.display = 'none';

        // Przełącz do kolejnego artykułu
        currentArticle++;

        // Jeśli przekroczono ilość artykułów, wróć do pierwszego
        if (currentArticle >= articles.length) {
            currentArticle = 0;
        }

        // Wyświetl kolejny artykuł
        articles[currentArticle].style.display = 'block';
    });

    // Ukryj wszystkie artykuły poza pierwszym na starcie
    hideAllArticles();
    articles[0].style.display = 'block';
</script>
    </section>
</section>
</body>
</html>