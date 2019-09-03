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
    <?php foreach ($workers as $worker): ?>
        <div class="col-md-3 worker">
            <a href='/worker.php?id=<?= $worker['id']; ?>'><?= $worker['id'] . "<br>"; ?></a>
            <?= $worker['name'] . "<br>"; ?>
            <?= $worker['last_name'] . "<br>"; ?>
            Должность: <?=getPosition($worker['position_id']) . "<br>"; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>