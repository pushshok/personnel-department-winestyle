<?php
require_once "connect.php";


function getWorkers()
{
    $connect = DB::getConnect();
    $workers = $connect->query("SELECT * FROM `personnel_department`.`workers`;")->fetchAll(PDO::FETCH_ASSOC);

    return $workers;
}

function getPosition($id)
{
    $connect = DB::getConnect();
    $position = $connect->query("SELECT `position` FROM `personnel_department`.`professions` WHERE `id`= '".$id."';")->fetch(PDO::FETCH_ASSOC);

    return $position['position'];
}

function getWorker($id)
{
    $connect = DB::getConnect();
    $worker = $connect->query("SELECT * FROM `personnel_department`.`workers` WHERE `id`='".$id."';")->fetch(PDO::FETCH_ASSOC);

    return $worker;
}

