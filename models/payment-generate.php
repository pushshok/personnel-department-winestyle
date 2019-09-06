<?php
require_once "connect.php";
try {
    $connect = DB::getConnect();

    if (!$connect) {
        echo "Ошибка: Невозможно установить соединение с MySQL<br>";
        echo "<br>Код ошибки errno: " . mysqli_connect_errno();
        echo "<br>Текст ошибки error: " . mysqli_connect_error();
        exit;
    }


    for ($i = 1; $i <= 15; $i++) {
        if ($connect->exec("INSERT INTO `personnel_department`.`payment` (`worker_id`, `date`, `pay`, `bounty`) VALUES ('" . $i . "', '" . date('mY') . "' ,'" . rand(30000, 70000) . "' ,'" . rand(0, 15000) . "');")) echo "Зарплата начислена работнику $i.<br>"; else {
            echo "Работнику $i зарплата не начислена.<br>";
        }
    }


} catch (PDOException $error) {
    echo "Error message: " . $error - getMessage() . "<br>";
    echo "At line: " . $error - getLine();
}