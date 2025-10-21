<?php
session_start();

require_once 'vendor/autoload.php';

use Athena272\SerenattoCafeteria\Database\ConnectionCreator;
use Athena272\SerenattoCafeteria\Infrastructure\Repository\PdoProductRepository;
use Athena272\SerenattoCafeteria\Domain\Models\Product;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = $_POST['type'] === 'Coffee' ? 'Coffee' : 'Lunch';
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $price = str_replace(['R$', '.', ','], ['', '', '.'], $_POST['price']); // máscara para float
    $price = floatval($price);

    $imageName = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $targetPath = __DIR__ . "/img/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    }

    try {
        $connection = ConnectionCreator::createConnection();
        $repository = new PdoProductRepository($connection);

        $product = new Product(
            id: 0,
            type: $type,
            name: $name,
            description: $description,
            image: $imageName ?? '',
            price: $price
        );

        $repository->insertProduct($product);

        $_SESSION['flash_message'] = "Product successfully created!";
        header('Location: admin.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['flash_message'] = "Error creating product: " . $e->getMessage();
    }
}
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <title>Serenatto - Add Product</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="serenatto-logo">
        <h1>Add Product</h1>
        <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <section class="container-form">
        <form method="post" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter product name" required>

            <div class="container-radio">
                <div>
                    <label for="coffee">Coffee</label>
                    <input type="radio" id="coffee" name="type" value="Coffee" checked>
                </div>
                <div>
                    <label for="lunch">Lunch</label>
                    <input type="radio" id="lunch" name="type" value="Lunch">
                </div>
            </div>

            <label for="description">Description</label>
            <input type="text" id="description" name="description" placeholder="Enter a description" required>

            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="Enter the price" required>

            <label for="image">Product Image</label>
            <input type="file" name="image" accept="image/*" id="image">

            <input type="submit" class="botao-cadastrar" value="Create Product"/>
        </form>
    </section>
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>
