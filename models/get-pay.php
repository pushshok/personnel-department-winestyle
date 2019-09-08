<?php

require_once "../connect.php";
$id = isset($_POST['id']) ? strip_tags(htmlspecialchars($_POST['id'])) : "0";
$data = isset($_POST['date']) ? (string)strip_tags(htmlspecialchars($_POST['date'])) : "";
$data = str_replace('.', '', $data);


function getPay($id, $data)
{
    $connect = DB::getConnect();

    $prepared = $connect->prepare("SELECT * FROM `personnel_department`.`payment` WHERE `worker_id`=:id AND `date`=:data;");
    $prepared->bindParam(':id', $id);
    $prepared->bindParam(':data', $data);
    $prepared->execute();
    $pay = $prepared->fetch(PDO::FETCH_ASSOC);

    if($pay){
        //echo "Зарплата: ".$pay['pay']." рублей.<br>";
        //echo "Премия: ".$pay['bounty']." рублей.<br>";
        echo json_encode(array($pay['pay'], $pay['bounty']));

    } else {
        echo "За выбранный месяц зарплата не начислялась";
    }

}

getPay($id, $data);


