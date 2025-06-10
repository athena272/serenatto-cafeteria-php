<?php

/** @var PDO $pdo */
$pdo = require __DIR__ . '/src/Database/db-connection.php';

function fetchProductsByCategory(PDO $pdo, string $category): array
{
    $statement = $pdo->prepare('SELECT name, description, price, image FROM products WHERE type = :category');
    $statement->bindValue(':category', $category);
    //$stmt->execute(['category' => $category]);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

$cafeProducts = fetchProductsByCategory($pdo, 'Coffee');
$lunchProducts = fetchProductsByCategory($pdo, 'Lunch');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Menu</title>
</head>
<body>
<main>
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/logo-serenatto.png" class="logo" alt="serenatto-logo">
        </div>
    </section>
    <h2>Digital Menu</h2>
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Coffee Options</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($cafeProducts as $product): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    </div>
                    <p><?= $product['name'] ?></p>
                    <p><?= $product['description'] ?></p>
                    <p><?= "R$ " . $product['price'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Lunch Options</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">
            <?php foreach ($lunchProducts as $product): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    </div>
                    <p><?= $product['name'] ?></p>
                    <p><?= $product['description'] ?></p>
                    <p><?= "R$ " . $product['price'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>