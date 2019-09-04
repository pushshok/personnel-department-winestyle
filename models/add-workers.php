<?php
require_once "connect.php";

$id = isset($_POST['id']) ? strip_tags(htmlspecialchars($_POST['id'])) : "0";
$name = isset($_POST['name']) ? strip_tags(htmlspecialchars($_POST['name'])) : "";
$last_name = isset($_POST['last_name']) ? strip_tags(htmlspecialchars($_POST['last_name'])) : "";
$position_id = isset($_POST['position_id']) ? strip_tags(htmlspecialchars($_POST['position_id'])) : "";
$img = isset($_POST['img']) ? strip_tags(htmlspecialchars($_POST['img'])) : "";






if($id == 0) {
    $sql = "INSERT INTO `personnel_department`.`workers` (`name`, `last_name`, `position_id`) VALUES ('".."', '".."', '".."');";
    $connect = DB::getConnect();
    $connect
} else {
    $sql = "UPDATE `personnel_department`.`workers` SET `name`= '".$name."', `last_name`= '".$last_name."', `position_id`= '".$position_id."', `path`= '".."', 'path_mini'= '".."' WHERE `id` = '".$id."' ;";
    $connect = DB::getConnect();

}