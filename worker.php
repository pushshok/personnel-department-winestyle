<?php
require_once 'config.php';
require_once 'models/select-workers.php';
$id = isset($_GET['id']) ? $_GET['id'] : "0";
$worker = getWorker($id);
$date = isset($date) ? $date : date("m.Y");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Профайл работника № <?=$id;?></title>

    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ymCal.css" rel="stylesheet" type="text/css">
    <script src="js/ymCal.js"></script>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("a.photo").fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                speedIn: 500,
                speedOut: 500
            });
        });

        function getpay(nid) {
            var datepick = $('#datepick').val();
            //alert (datepick + nid);
            $.ajax({
                method: "POST",
                url: "models/get-pay.php",
                data: {id: nid, date: datepick},
                success: function (answer) {
                    //alert(answer);
                    $("#get-pay").html(answer);
                }
            });
        }


        $(function () {
            ymCal(
                $(".datepick"),
                null,
                "bottom",
                null,
                null,
                function (event, month, year) {
                    //alert(event + month + year );
                    event = "";
                    var mon;
                    if (month < 10) {
                        mon = "0" + month
                    }
                    var datepick = mon + "." + year;
                    //if (mon === 'undefined') {
                    //    $(".datepick").val("Неверный формат.");
                    //} else {
                    $(".datepick").val(datepick);
                    //}

                },
                100000,
                10
            );
        });
        //]]>
    </script>
</head>
<body>

<div class="container  worker">
    <?php if ($id != 0): ?>
        <div class="container">
            <div class="col-md-3">
                <h1>Профайл сотрудника: <?= $worker['id'] . "<br>"; ?></h1>
                <?php if ($worker['path_mini']): ?>
                    <a class="photo" href="<?= $worker['path']; ?>"><img src="<?= $worker['path_mini']; ?>"></a>
                <?php endif; ?>
            </div>
        </div>
        <form name="worker" action="models/add-workers.php" method="post" enctype="multipart/form-data">
            <input name="id" id="id" value="<?= $worker['id']; ?>" type="hidden">
            <input name="path" id="path" value="<?= $worker['path']; ?>" type="hidden">
            <input name="path_mini" id="path_mini" value="<?= $worker['path_mini']; ?>" type="hidden">
            <label for="name">Имя:</label><input type="text" name="name" id="name" value="<?= $worker['name']; ?>"><br>
            <label for="last_name">Фамилия:</label><input type="text" name="last_name" id="last_name"
                                                          value="<?= $worker['last_name']; ?>"><br>
            <label for="position_id"><acronym
                        title="1 - бухгалтер; 2 - курьер; 3 - менеджер;">Должность:</acronym></label><input
                    name="position_id"
                    id="position_id" type="number"
                    value="<?= $worker['position_id']; ?>">
            - <?= getPosition($worker['position_id']); ?><br>
            <label for="img">Загрузить фото: </label><input type="file" name="img" id="img"
                                                            accept="image/jpeg,image/png,image/gif"><br>

            <br>
            <input type="submit" value="Редактировать" class="btn bg-primary">
        </form><br>

        <label for="datepick">Зарплата за выбранный месяц:</label>
        <input type='text' id="datepick" class="datepick" name="datepick" data-position="right top" value=""><button onclick="getpay(<?=$id; ?>)">Рассчитать</button>
        <br>
        <div id="get-pay" class="lead"></div>

        <br>
        <a href="/">В отдел персонала</a>
    <?php else: ?>
        Не выбрано ни одного сотрудника<br>
    <?php endif; ?>
</div>
<br><br>
<div class="container">
    <span class="center">&copy; <?= SITENAME; ?></span>
</div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
