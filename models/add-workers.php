<?php
require_once "../connect.php";
require_once '../config.php';
include_once 'other-function.php';
include_once 'class-simple-image.php';

$id = isset($_POST['id']) ? strip_tags(htmlspecialchars($_POST['id'])) : "0";
$name = isset($_POST['name']) ? strip_tags(htmlspecialchars($_POST['name'])) : "";
$last_name = isset($_POST['last_name']) ? strip_tags(htmlspecialchars($_POST['last_name'])) : "";
$position_id = isset($_POST['position_id']) ? (integer) strip_tags(htmlspecialchars($_POST['position_id'])) : "";
$data = isset($_POST['datepick']) ? (string) strip_tags(htmlspecialchars($_POST['datepick'])) : "";


$data = str_replace('', '', $data);

echo "<br>ID = ".$id."   DATA = ".$data."<br>";
$path = isset($_POST['path']) ? strip_tags(htmlspecialchars($_POST['path'])) : "";
$path_mini = isset($_POST['path_mini']) ? strip_tags(htmlspecialchars($_POST['path_mini'])) : "";

if (!empty($path)) {
    echo "Файл уже существует!";
} elseif (empty($path) && ($_FILES['img']['size'] <= 10000000)) {
    $path = "../".UPLOAD . transliteraciya($_FILES['img']['name']);
    $path_mini = "../".UPLOAD_MINI . transliteraciya($_FILES['img']['name']);
    if (move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
        echo "Файл " . transliteraciya($_FILES['img']['name']) . " успешно загружен!";
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToWidth(175);
        $image->save($path_mini);
    } else {
        $path = "";
        $path_mini = "";
        echo "Файл не загружен!";
    }
} else {
    $path = "";
    $path_mini = "";
    echo "Файл слишком большой!";
}


if ($id == 0) {
    try {
        var_dump($position_id);
        $sql = "INSERT INTO `personnel_department`.`workers` (`name`, `last_name`, `position_id`, `path`, `path_mini`) VALUES (:name, :last_name, :position_id, :path, :path_mini);";
        $connect = DB::getConnect();
        $prepared = $connect->prepare($sql);
        $prepared->bindParam(':name', $name, PDO::PARAM_STR);
        $prepared->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $prepared->bindParam(':position_id', $position_id, PDO::PARAM_INT);
        $prepared->bindParam(':path', $path, PDO::PARAM_STR);
        $prepared->bindParam(':path_mini', $path_mini, PDO::PARAM_STR);
        $prepared->execute();

    } catch (PDOException $error) {
        echo $error->getCode() . "<br>";
        echo $error->getMessage() . "<br>";
        echo $error->getLine() . "<br>";
    }
    header( 'Refresh: 3; url=/index.php' );
} else {
    try {
        //echo $id.$name.$last_name.$position_id.$path.$path_mini;
        $sql = "UPDATE `personnel_department`.`workers` SET `name`= :name, `last_name`= :last_name, `position_id`= :position_id, `path`= :path, `path_mini`=:path_mini WHERE `id` = :id;";
        $connect = DB::getConnect();
        $prepared = $connect->prepare($sql);
        $prepared->bindParam(':id', $id, PDO::PARAM_INT);
        $prepared->bindParam(':name', $name, PDO::PARAM_STR);
        $prepared->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $prepared->bindParam(':position_id', $position_id, PDO::PARAM_INT);
        $prepared->bindParam(':path', $path, PDO::PARAM_STR);
        $prepared->bindParam(':path_mini', $path_mini, PDO::PARAM_STR);
        $prepared->execute();
        print_r($prepared->errorInfo());
    } catch (PDOException $error) {
        echo $error->getCode() . "<br>";
        echo $error->getMessage() . "<br>";
        echo $error->getLine() . "<br>";
    }
    header( "Refresh: 3; url=/worker.php?id=$id");
}

