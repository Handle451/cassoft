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

function getUserMessages($id){
    $mysqli = connectBD();
    $query = "SELECT * FROM `messages` LEFT JOIN `message_group` ON messages.group_id = message_group.id WHERE `sendler_id` = $id";
    $result = $mysqli->query($query);
    $mysqli->close();
    return $result;
}

function getGroups(){
            
}