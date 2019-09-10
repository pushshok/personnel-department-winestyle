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
    $arr_workers = $connect->query("SHOW TABLES LIKE 'workers'")->fetchAll(PDO::FETCH_NUM);

    if ($arr_workers[0] != "workers") {
        $connect->exec("CREATE TABLE `personnel_department`.`workers` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL , `last_name` VARCHAR(255) NULL, `path` VARCHAR(255) NULL , `path_mini` VARCHAR(255) NULL , `position_id` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;" );
    }

    $arr_payment = $connect->query("SHOW TABLES LIKE 'payment'")->fetchAll(PDO::FETCH_NUM);

    if ($arr_payment[0] != "payment") {
        $connect->exec("CREATE TABLE `personnel_department`.`payment` (`id` INT(11) NOT NULL AUTO_INCREMENT, `worker_id` INT(11) NOT NULL, `date` VARCHAR(6) NOT NULL, `pay` INT(11) NULL, `bounty` INT(11) NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;" );
    }

    $arr_professions = $connect->query("SHOW TABLES LIKE 'professions'")->fetchAll(PDO::FETCH_NUM);

    if ($arr_professions[0] != "professions") {
        $connect->exec("CREATE TABLE `personnel_department`.`professions` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `position` VARCHAR(255) NULL, PRIMARY KEY (`id`) ) ENGINE = InnoDB;" );
    }

} catch (PDOException $error) {
	echo "Error message: ".$error-getMessage()."<br>";
	echo "At line: ".$error-getLine();
}