<?php
require_once "../connect.php";
$id = isset($_GET['id']) ? strip_tags(htmlspecialchars($_GET['id'])) : "0";
$data = isset($_GET['date']) ? (string)strip_tags(htmlspecialchars($_GET['date'])) : "";
$pay = isset($_GET['pay']) ? (integer)strip_tags(htmlspecialchars($_GET['pay'])) : "0";
$data = str_replace('.', '', $data);


function setPay($id, $data, $pay)
{
    $connect = DB::getConnect();

    $prepared = $connect->prepare("SELECT `id` FROM `personnel_department`.`workers` WHERE `position_id`=:id;");
    $prepared->bindParam(':id', $id);
    $prepared->execute();
    $workers_prepare[] = $prepared->fetchAll(PDO::FETCH_COLUMN);
    $workers[] = isset($workers) ? $workers : '0';
    foreach ($workers_prepare[0] as $worker) {
        $workers[] = $worker;
    }
    if ($workers != 0) {
        foreach ($workers as $person) {
            if ($person != 0) {
                $prepare = $connect->prepare("SELECT * FROM `personnel_department`.`payment` WHERE `worker_id`=:id AND `date`=:data;");
                $prepare->bindParam(':id', $person);
                $prepare->bindParam(':data', $data);
                $prepare->execute();
                $payment = $prepare->fetch(PDO::FETCH_ASSOC);

                print_r($payment);

                if ((!$payment) OR empty($payment)) {
                    $prepare_null = $connect->prepare("INSERT INTO `personnel_department`.`payment` (`worker_id`, `date`, `pay`) VALUES (?, ?, ?);");
                    $prepare_null->bindParam('1', $person);
                    $prepare_null->bindParam('2', $data);
                    $prepare_null->bindParam('3', $pay);
                    $prepare_null->execute();

                    echo "Работнику " . $person . " начислена зарплата в размере ";
                    echo $pay . " рублей.\n";
                } else {
                    $prepare_pay = $connect->prepare("UPDATE `personnel_department`.`payment` SET `pay`=:pay  WHERE `worker_id`=:id AND `date`=:data;");
                    $prepare_pay->bindParam(':id', $person);
                    $prepare_pay->bindParam(':data', $data);
                    $prepare_pay->bindParam(':pay', $pay);
                    $prepare_pay->execute();
                    echo "Работнику " . $person . " переначислена зарплата в размере ";
                    echo $pay . " рублей.\n";
                }
            }
        }
    } else {
        echo "В нашей компании нет сотрудников этой профессии!";
    }
}

setPay($id, $data, $pay);