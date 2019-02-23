<?php

require_once "vendor/autoload.php";
require_once "classes/firstAlter.php";
require_once "classes/secondAlter.php";
require_once "classes/rootStory.php";
require_once "classes/storyController.php";
require_once "classes/users.php";

if (isset($_POST['login']) and $_POST['login']==1) {
session_start();
$user = new users;
$sifre = hash('sha256', $_POST['ksifre']);
$user->kullanici_adi=$_POST['kadi'];
$user->kullanici_sifre=$sifre;


if ($user->loginUser()==1) {
$giris['durum']="1";

}
else{
$giris['durum']="0";
}   
echo json_encode($giris);


}

if (isset($_POST['insert']) and $_POST['insert']==0) { 
    session_start();
    $user = new users;
    $user->kullanici_adi=$_POST['kullanici_adi'];
    $user->kullanici_mail=$_POST['kullanici_mail'];
    $data['hatali']= $user->checkExist();


    echo json_encode($data);

}

if (isset($_POST['ban']) and $_POST['ban']==1) { 
    session_start();
    $user = new users();
    $user->kullanici_id = $_SESSION['kullanici_id'];
    $user->initById();
    if($user->kullanici_ban=="1")
    {
        $_SESSION['kullanici_ban']="1";
    }
    $data['ban'] = $user->kullanici_ban;


    echo json_encode($data);

}


