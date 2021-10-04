<?php
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

function getMessageQuery($id_message, $user_id){
    $mysqli = connectBD();
    $query = "SELECT * FROM `messages` WHERE `id` = $id_message";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();

    if($user_id != $row['sendler_id']){
        $queryUpdate = "UPDATE `messages` SET `readed` = '1' WHERE `id` = $id_message";
        $mysqli->query($queryUpdate);
    }
    $mysqli->close();
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

function getAllGroupsBD(){
    $mysqli = connectBD();
    $query = "SELECT `id`,`parent_id`,`group_title`,`color` FROM `message_group`";
    $result = $mysqli->query($query);
    $mysqli->close();
    $row = $result->fetch_all(MYSQLI_ASSOC);
    return $row;
}

function getVerifiedUsersBD(){
    $mysqli = connectBD();
    $query = "SELECT
                users.id,
                users.name, 
                users.email
                FROM 
                users
                LEFT JOIN user_groups ON users.id=user_groups.user_id
                 WHERE user_groups.name='Проверенные'";
    $result = $mysqli->query($query);
    $mysqli->close();
    $row = $result->fetch_all(MYSQLI_ASSOC);
    return $row;
}

function saveMessge($group_id, $title, $text, $sendler_id, $receiver_id){
    $mysqli = connectBD();
    $query = "INSERT INTO `messages` (`group_id`, `title`, `text`, `sendler_id`, `receiver_id`, `date_added`) VALUES (
        '$group_id', 
        '$title', 
        '$text', 
        '$sendler_id', 
        '$receiver_id', 
        CURRENT_TIMESTAMP);";
    $mysqli->query($query);
}