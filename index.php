<?php
require_once 'models/select-workers.php';
$workers = getWorkers();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Отдел персонала</title>


    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <h1>Список сотрудников:</h1>
    <?php foreach ($workers as $worker): ?>
        <div class="col-md-3 worker">
            <a href='/worker.php?id=<?= $worker['id']; ?>'><?= $worker['id'] . "<br>"; ?></a>
            <?= $worker['name'] . "<br>"; ?>
            <?= $worker['last_name'] . "<br>"; ?>
            Должность: <?= getPosition($worker['position_id']) . "<br>"; ?>
        </div>
    <?php endforeach; ?>
</div>
<hr>
<div class="container">
    <div class="col-md-6">
        <h2>Добавить сотрудника:</h2>
        <form name="worker-add" action="models/add-workers.php" method="post">
            <label for="name">Имя: </label><input name="name" id="name" placeholder="Иван"><br>
            <label for="last_name">Фамилия: </label><input name="last_name" id="last_name" placeholder="Иванов"><br>
            <label for="position_id">Должность: </label><input name="position_id" id="position_id"
                                                               placeholder="1-бухгалтер; 2-курьер; 3-менеджер;"><br>
            <label for="img">Загрузить фото: </label><input type="file" name="img" id="img"
                                                            accept="image/jpeg,image/png,image/gif"><br>
            <input type="submit" value="Добавить" class="btn btn-default">
        </form>
    </div>
    <div class="col-md-6">
        <h2>Подготовка БД к работе:</h2>
        <ul>
            <li><a href="install.php">Создание таблиц</a></li>
            <li><a href="insert.php">Наполнение таблиц демо-данными</a></li>
        </ul>
    </div>
</div>
<br><br>

</body>
</html>