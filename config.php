<?php
ob_start();
session_start();
$session = session_id();
/**
* Константы для подключения к БД
*/
// Создана таблица "Управление персоналом": CREATE SCHEMA `personnel_department` DEFAULT CHARACTER SET utf8mb4 ;

const DRIVER = "mysql";
const HOST = "localhost";
const DATABASE = "personnel_department";
const USER = "root";
const PASS = "un1imite";
const SITENAME = "winestyle.test";


/**
* Константы для папок
*/

const UPLOAD = "images/upload/";
const UPLOAD_MINI = "images/upload_mini/";