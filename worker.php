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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Профайл работника № <?= $id; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

    <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ymCal.css" rel="stylesheet" type="text/css">
    <script src="js/ymCal.js"></script>


    <script type="text/javascript">

        function convert() {
            var Rpay = $("#get-pay").html();
            var Rbounty = $("#get-bounty").html();
            $.ajax({
                method: "GET",
                url: "models/soap.php",
                data: {pay: Rpay, bounty: Rbounty},
                success: function (response) {

                    response = JSON.parse(response);
                    let payUSD = response[0] + " у.е.";
                    let bountyUSD = response[1] + " у.е.";
                    $("#get-pay").html(payUSD);
                    $("#get-bounty").html(bountyUSD);
                    $("#val-pay").html("");
                    $("#val-bounty").html("");
                }
            });
        }

        function getpay(nid) {
            var datepick = $('#datepick').val();

            $.ajax({
                method: "GET",
                url: "models/get-pay.php",
                data: {'id': nid, 'date': datepick},
                success: function (answer) {
                    alert(answer);
                    answer = JSON.parse(answer);
                    let pay = answer[0];
                    let bounty = answer[1];
                    $("#get-pay").html(pay);
                    $("#get-bounty").html(bounty);
                    $("#val-pay").html(" рублей.");
                    $("#val-bounty").html(" рублей.");
                }
            });
        }

        $(document).ready(function () {
            ymCal(
                $(".datepick"),
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
                    var datepick = mon + "." + year;
                    $(".datepick").val(datepick);
                },
                100000,
                10
            );
        });


        $(document).ready(function () {
            $("a.photo").fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                speedIn: 500,
                speedOut: 500
            });
        });

    </script>
</head>
<body>

<div class="container  worker">
    <?php if ($id != 0): ?>
        <div class="container">
            <div class="col-md-6">
                <h1>Профайл сотрудника: <?= $worker['id'] . "<br>"; ?></h1>
                <?php if ($worker['path_mini']): ?>
                    <a class="photo" href="<?= $worker['path']; ?>"><img src="<?= $worker['path_mini']; ?>"></a>
                <?php endif; ?>
            </div>
        </div><br>
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
        <h2>Узнать зарплату работника за месяц</h2>
        <label for="datepick">Выбрать месяц:</label>
        <input type='text' id="datepick" class="datepick" name="datepick" data-position="right top" value="">
        <button onclick="getpay(<?= $id; ?>)">Рассчитать</button>
        <button onclick="convert()">Конвертировать</button>
        <br>
        <div class="col-md-6">
            <p>Зарплата работника: <span id="get-pay" class="lead"></span><span id="val-pay" class="lead"></span></p>
            <p>Премия работника: <span id="get-bounty" class="lead"></span><span id="val-bounty" class="lead"></span>
            </p>
        </div>
        <br>
        <div class="col-md-12">
            <a class="lead" href="/">В отдел персонала</a>
        </div>

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
