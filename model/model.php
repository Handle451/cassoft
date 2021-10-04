<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$path = $_SERVER['DOCUMENT_ROOT'];
include_once "$path/cassoft/config.php";


function connectBD(){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) { 
        printf("Connect failed: %s\n", mysqli_connect_error()); 
        exit(); 
    }
    return $mysqli;
}

function getAuth($email, $password){
    $mysqli = connectBD();
    $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = $password";
    $result = $mysqli->query($query);
    $mysqli->close();
    return $result;
}

function getUser($id){
    $mysqli = connectBD();
    $query = "SELECT * FROM `users` LEFT JOIN `user_groups` ON users.id = user_groups.user_id  WHERE `id` = $id";
    $result = $mysqli->query($query);
    $mysqli->close();
    return $result;
}

function getUserMessages($id_user, $group_id){
    $mysqli = connectBD();
    $query = "SELECT * FROM `messages` WHERE (`sendler_id` = $id_user OR `receiver_id` = $id_user) AND `group_id`= $group_id";
    $result = $mysqli->query($query);
    $mysqli->close();
    $row = $result->fetch_all(MYSQLI_ASSOC);
    return $row;
}

function getMessageQuery($id_message){
    $mysqli = connectBD();
    $query = "SELECT * FROM `messages` WHERE `id` = $id_message";
    $result = $mysqli->query($query);

    $queryUpdate = "UPDATE `messages` SET `readed` = '1' WHERE `id` = $id_message";
    $mysqli->query($queryUpdate);

    $mysqli->close();
    $row = $result->fetch_assoc();
    return $row;
}

function getGroups($id_user){
    $mysqli = connectBD();
    $query = "SELECT * FROM `message_group` WHERE `user_id` = $id_user OR `receiver_id` = $id_user";
    $result = $mysqli->query($query);
    $mysqli->close();
    $row = $result->fetch_all(MYSQLI_ASSOC);
    return $row;
}