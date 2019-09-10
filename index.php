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
    <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ymCal.css" rel="stylesheet" type="text/css">
    <script src="js/ymCal.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("a.photo").fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                speedIn: 500,
                speedOut: 500
            });
        });

        $(document).ready(function () {
            ymCal(
                $(".date-bounty"),
                null,
                "bottom",
                null,
                null,
                function (event, month, year) {
                    event = "";
                    var mon;
                    if (month < 10) {
                        mon = "0" + month
                    }
                    var date = mon + "." + year;
                    $(".date-bounty").val(date);
                },
                100000,
                10
            );
        });

        $(document).ready(function () {
            ymCal(
                $(".date-pay"),
                null,
                "bottom",
                null,
                null,
                function (event, month, year) {
                    event = "";
                    var mon;
                    if (month < 10) {
                        mon = "0" + month
                    }
                    var date = mon + "." + year;
                    $(".date-pay").val(date);
                },
                100000,
                10
            );
        });

        function setPay() {
            var id = $('#prof-pay').val();
            var datePay = $('#date-pay').val();
            var payAmount = $('#set-pay').val();

            $.ajax({
                method: "GET",
                url: "models/set-pay.php",
                data: {'id': id, 'date': datePay, 'pay': payAmount},
                success: function (answer) {
                    alert(answer);
                }
            });
        }

        function setBounty() {
            var nid = $('#prof-bounty').val();
            var dateBounty = $('#date-bounty').val();
            var bountyAmount = $('#set-bounty').val();

            $.ajax({
                method: "GET",
                url: "models/set-bounty.php",
                data: {'id': nid, 'date': dateBounty, 'bounty': bountyAmount},
                success: function (answer) {
                    alert(answer);
                }
            });
        }
    </script>


</head>
<body>

<div class="container">
    <h1>Список сотрудников:</h1>
    <?php foreach ($workers as $worker): ?>
        <div class="col-md-3 worker">
            <a href='/worker.php?id=<?= $worker['id']; ?>'>Профайл сотрудника № <?= $worker['id'] . "<br>"; ?></a>
            <?= $worker['name'] . "<br>"; ?>
            <?= $worker['last_name'] . "<br>"; ?>
            Должность: <?= getPosition($worker['position_id']) . "<br>"; ?>
            <?php if ($worker['path_mini']): ?>
                <a class="photo" href="<?= $worker['path']; ?>"><img src="<?= $worker['path_mini']; ?>"></a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<hr>
<div class="container">
    <div class="col-md-6">
        <h2>Добавить сотрудника:</h2>
        <form name="worker-add" action="models/add-workers.php" method="post" enctype="multipart/form-data">
            <label for="name">Имя:</label><input name="name" id="name" placeholder="Иван"><br>
            <label for="last_name">Фамилия:</label><input name="last_name" id="last_name" placeholder="Иванов"><br>
            <label for="position_id">Должность:</label><input name="position_id" id="position_id"
                                                              placeholder="1-бухгалтер; 2-курьер; 3-менеджер;"
                                                              size="30"><br>
            <label for="img">Загрузить фото:</label><input type="file" name="img" id="img"
                                                           accept="image/jpeg,image/png,image/gif"><br>
            <input type="submit" value="Добавить" class="btn btn-default">
        </form>
    </div>
    <div class="col-md-6">
        <h2>Подготовка БД к работе:</h2>
        <ul>
            <li><a href="models/install.php">Создание таблиц</a></li>
            <li><a href="models/insert.php">Наполнение таблиц демо-данными</a></li>
            <li><a href="models/payment-generate.php">Начислить зарплату</a></li>
            <li><label for="prof-pay">Выдать зарплату:</label>
                <select id="prof-pay" class="prof-pay" name="prof-pay">
                    <option selected value="1">Бухгалтерам</option>
                    <option value="2">Курьерам</option>
                    <option value="3">Менеджерам</option>
                </select><br>
                <label for="date-pay">Выбрать месяц:</label>
                <input type='text' id="date-pay" class="date-pay" name="date-pay" data-position="right top"
                       value=""><br>
                <label for="set-pay">Сумма:</label>
                <input type="text" id="set-pay" class="set-pay" name="set-pay"><br>
                <button onclick="setPay()">Начислить</button>
            </li>
            <li>
                <label for="prof-bounty">Выдать премию:</label>
                <select id="prof-bounty" class="prof-bounty" name="prof-bounty">
                    <option selected value="1">Бухгалтерам</option>
                    <option value="2">Курьерам</option>
                    <option value="3">Менеджерам</option>
                </select><br>
                <label for="date-bounty">Выбрать месяц:</label>
                <input type='text' id="date-bounty" class="date-bounty" name="date-bounty" data-position="right top"
                       value=""><br>
                <label for="set-bounty">Сумма:</label>
                <input type="text" id="set-bounty" class="set-bounty" name="set-bounty"><br>
                <button onclick="setBounty()">Начислить</button>
            </li>
        </ul>
    </div>
</div>
<br><br>
<div class="container">
    <span class="center">&copy; <?= SITENAME; ?></span>
</div>
</body>
</html>