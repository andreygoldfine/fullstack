<?php require_once './form.php';
/**
 * Подключаем файл 'form.php', в котором вся логика обработки скрипта
 * Зачем это? Чтобы разбить логику по файлам и не хранить все в одном файле, в котором потом трудно что-то найти
 */


?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3>Форма обратной связи</h3>

    <?php if (isset($result)) : ?>
        <p class="alert-success col-md-4"><?= $result ?? '' ?></p>
    <?php else: ?>
        <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Имя</label>
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Имя">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Номер телефона</label>
                <div class="col-md-4">
                    <input type="text" name="phone" class="form-control" placeholder="Введите номер">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-md-10">
                    <button type="submit" class="btn btn-primary" name="submit">Отправить</button>
                </div>
            </div>
            <p class="alert-danger col-md-4"><?= $error ?? '' ?></p>
        </form>
    <?php endif; ?>
</div>

</body>
</html>