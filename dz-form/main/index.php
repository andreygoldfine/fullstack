<?php
    require_once './products.php'; //подключили файл с скриптом
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Products</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/album.css" rel="stylesheet">

</head>

<body>

<div class="album text-muted">
    <div class="container">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="card">
                    <img height="250px" width="100%" src="<?php echo getImage($product) ?>" alt="Card image cap">
                    <h6><?php echo getName($product) ?></h6>
                    <span>Цена: <?php echo getPrice($product) ?></span>
                    <p class="card-text"><?php echo getDescription($product) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>

