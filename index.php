<?php
$cafeProducts = [
    [
        'name' => "Creamy Coffee",
        'description' => "Irresistibly smooth creamy coffee that delights your palate",
        'price' => "5.00",
        'image' => "img/cafe-cremoso.jpg"
    ],
    [
        'name' => "Coffee with Milk",
        'description' => "The harmony of coffee and milk, a comforting experience",
        'price' => "2.00",
        'image' => "img/cafe-com-leite.jpg"
    ],
    [
        'name' => "Cappuccino",
        'description' => "Smooth coffee, creamy milk, and a touch of sweet flavor",
        'price' => "7.00",
        'image' => "img/cappuccino.jpg"
    ],
    [
        'name' => "Iced Coffee",
        'description' => "Refreshing iced coffee, sweetened and with subtle hints of vanilla or caramel.",
        'price' => "3.00",
        'image' => "img/cafe-gelado.jpg"
    ]
];
$lunchProducts = [
    [
        "name" => "Steak",
        "description" => "Steak, rice with beans, and delicious French fries",
        "price" => "27.90",
        "image" => "img/bife.jpg"
    ],
    [
        "name" => "Fish Fillet",
        "description" => "Baked salmon fillet, rice, green beans, and tomato",
        "price" => "24.99",
        "image" => "img/prato-peixe.jpg"
    ],
    [
        "name" => "Chicken",
        "description" => "Delicious breaded chicken with French fries, cabbage salad, and spicy sauce",
        "price" => "23.00",
        "image" => "img/prato-frango.jpg"
    ],
    [
        "name" => "Fettuccine",
        "description" => "Authentic Italian fettuccine pasta with grilled chicken breast",
        "price" => "22.50",
        "image" => "img/fettuccine.jpg"
    ]
];
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
                        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
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
                        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
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