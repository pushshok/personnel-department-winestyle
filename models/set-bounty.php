<?php
require_once "../connect.php";
$id = isset($_GET['id']) ? strip_tags(htmlspecialchars($_GET['id'])) : "0";
$data = isset($_GET['date']) ? (string)strip_tags(htmlspecialchars($_GET['date'])) : "";
$bounty = isset($_GET['bounty']) ? (integer)strip_tags(htmlspecialchars($_GET['bounty'])) : "0";
$data = str_replace('.', '', $data);


function setPay($id, $data, $bounty)
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
                $prepare = $connect->prepare("SELECT `bounty` FROM `personnel_department`.`payment` WHERE `worker_id`=:id AND `date`=:data;");
                $prepare->bindParam(':id', $person);
                $prepare->bindParam(':data', $data);
                $prepare->execute();
                $bountyment = $prepare->fetch(PDO::FETCH_ASSOC);


                if ((!$bountyment) OR empty($bountyment)) {
                    $prepare_null = $connect->prepare("INSERT INTO `personnel_department`.`payment` (`worker_id`, `date`, `bounty`) VALUES (?, ?, ?);");

                    $prepare_null->bindParam('1', $person);
                    $prepare_null->bindParam('2', $data);
                    $prepare_null->bindParam('3', $bounty);
                    $prepare_null->execute();
                    print_r($prepare_null->errorInfo());
                    echo "Работнику " . $person . " начислена премия в размере ";
                    echo $bounty . " рублей.\n";
                } else {
                    $prepare_bounty = $connect->prepare("UPDATE `personnel_department`.`payment` SET `bounty`=:bounty  WHERE `worker_id`=:id AND `date`=:data;");
                    $prepare_bounty->bindParam(':id', $person);
                    $prepare_bounty->bindParam(':data', $data);
                    $prepare_bounty->bindParam(':bounty', $bounty);
                    $prepare_bounty->execute();
                    echo "Работнику " . $person . " переначислена премия в размере ";
                    echo $bounty . " рублей.\n";
                }
            }
        }
    } else {
        echo "В нашей компании нет сотрудников этой профессии!";
    }
}

setPay($id, $data, $bounty);
