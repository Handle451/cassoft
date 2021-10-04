<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once "$path/cassoft/model/model.php";

function authorize(){
	$email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = getAuth($email, $password);
    if($result){
        while($row = $result->fetch_object()) {
            if(isset($row)){
                session_start(); 
                $_SESSION['email']=$row->email;
                $_SESSION['id']=$row->id;
                header('Location: http://localhost/cassoft/profile.php');
                exit();
            }
        }
    }else{
        header('Location: http://localhost/cassoft/login.php');
    }
}

function getUserInfo($id){
    $result = getUser($id);
    
    $row = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($row as $key => $value) {
        $groups[] = $value['description'];

        $data = array(
            'id' => $value['id'],
            'status' => $value['status'],
            'name' => $value['name'],
            'email' => $value['email'],
            'phone' => $value['phone'],
            'password' => $value['password'],
            'newsletter' => $value['newsletter'],
            'groups' => $groups
        );
    }
    return $data;
}

function getMessageGroups($id_user){
    $row = getGroups($id_user);
    foreach($row as $value){
        $group_id = $value['id'];
        $group_title = $value['group_title'];
        $rowMes = getUserMessages($id_user, $group_id);
        $messages[$group_title] = $rowMes;
    }
    return $messages;       
}

function getMessage($id_message){
    $user_id = $_SESSION['id'];
    $row = getMessageQuery($id_message, $user_id);
    p($row);die;
    return $row;   
}

function getAllGroups(){
    $result = getAllGroupsBD();
    return $result;
}

function getVerifiedUsers(){
    $result = getVerifiedUsersBD();
    return $result;
}

function sendMessage(){
    $group_id = $_POST['group_message'];
    $title = $_POST['title_message'];
    $text = $_POST['text_message'];
    $receiver_id =$_POST['user_message'];

    session_start();
    $sendler_id = $_SESSION['id'];

    saveMessge($group_id, $title, $text, $sendler_id, $receiver_id);

    header('Location: http://localhost/cassoft/posts.php');
    exit();
}


if(isset($_POST['email']) && isset($_POST['password'])){
    authorize();
}
if(isset($_POST['title_message']) && isset($_POST['user_message']) && isset($_POST['group_message'])){
    sendMessage();
}
if(isset($_GET['exit'])){
    if(!isset($_SESSION)){
        session_start();
    }        
    session_unset();
}
