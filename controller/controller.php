<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
    $row = getMessageQuery($id_message);
    p($row);die;
    return $row;   
}

if(isset($_POST['email']) && isset($_POST['password'])){
    authorize();
}
if(isset($_GET['exit'])){
    if(!isset($_SESSION)){
        session_start();
    }        
    session_unset();
}

function p($p){
    echo '<pre>';
    print_r($p);
    echo '</pre>';
}