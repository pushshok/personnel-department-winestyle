<?php
require_once 'config.php';
require_once 'models/select-workers.php';
$id = isset($_GET['id']) ? $_GET['id'] : "0";
$worker = getWorker($id);

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

<div class="container  worker">
    <?php if ($id != 0): ?>
        <div class="container">
            <div class="col-md-3">
                <h1>Профайл сотрудника: <?= $worker['id'] . "<br>"; ?></h1>
                <?php if ($worker['path']): ?>
                    <img src="<?= UPLOAD . $worker['path']; ?>">
                <?php endif; ?>
            </div>
        </div>
        <form name="worker" action="models/add-workers.php" method="post">
            <input name="id" id="id" value="<?= $worker['id']; ?>" type="hidden">
            <label for="name">Имя:</label><input name="name" id="name" value="<?= $worker['name']; ?>"><br>
            <label for="last_name">Фамилия:</label><input name="last_name" id="last_name"
                                                          value="<?= $worker['last_name']; ?>"><br>
            <label for="position_id"><acronym
                        title="1 - бухгалтер; 2 - курьер; 3 - менеджер;">Должность:</acronym></label><input name="position_id"
                                                                                                      id="position_id"
                                                                                                      value="<?= $worker['position_id']; ?>">
            - <?= getPosition($worker['position_id']); ?><br>
            <label for="img">Загрузить фото: </label><input type="file" name="img" id="img"
                                                            accept="image/jpeg,image/png,image/gif"><br><br>
            <input type="submit" value="Редактировать" class="btn bg-primary">
        </form><br><br>
        <a href="/">В отдел персонала</a>
    <?php else: ?>
        Не выбрано ни одного сотрудника<br>
    <?php endif; ?>
</div>
<br><br>

</body>
</html>
