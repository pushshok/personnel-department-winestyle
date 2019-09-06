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

    if ($connect->exec("INSERT INTO `personnel_department`.`professions` (`id`, `position`) VALUES ('1', 'бухгалтер'), ('2', 'курьер'), ('3', 'менеджер');"))
        echo "Профессии добавлены.<br>"; else {
        echo "Профессии не добавлены.<br>";
    }

    if ($connect->exec("INSERT INTO `personnel_department`.`workers` (`name`, `last_name`, `position_id`) VALUES ('Иван', 'Иванов', '1'), ('Петр', 'Иванов', '1'), ('Александр', 'Иванов', '1'), ('Максим', 'Иванов', '1'), ('Алексей', 'Иванов', '1'), ('Иван', 'Петров', '2'), ('Петр', 'Петров', '2'), ('Александр', 'Петров', '2'), ('Максим', 'Петров', '2'), ('Алексей', 'Петров', '2'), ('Иван', 'Сидоров', '3'), ('Петр', 'Сидоров', '3'), ('Александр', 'Сидоров', '3'), ('Максим', 'Сидоров', '3'), ('Алексей', 'Сидоров', '3');"))
        echo "Работники добавлены.<br>"; else {
        echo "Работники не добавлены.<br>";
    }


} catch (PDOException $error) {
    echo "Error message: " . $error - getMessage() . "<br>";
    echo "At line: " . $error - getLine();
}