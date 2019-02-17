
<?php
include 'class.php';
require_once 'classes/rootStory.php';
require_once 'classes/users.php';
require_once 'classes/mailController.php';


if (isset($_POST['insert']) and $_POST['insert']==1) { opcode=insertUser
  $sifre = hash('sha256', $_POST['kullanici_sifre']);
  $user = new users;
  $user->kullanici_adi=$_POST['kullanici_adi'];
  $user->kullanici_mail=$_POST['kullanici_mail'];
  $user->kullanici_sifre=$sifre;

  $user->insertUser();
  $_SESSION['kullanici_adi']=$user->kullanici_adi;
  $_SESSION['kullanici_mail']=$user->kullanici_mail;
  $_SESSION['kullanici_id']=$user->kullanici_id;


}
if (isset($_POST['insert']) and $_POST['insert']==0) { opcode=checkUser
    $user = new users;
    $user->kullanici_adi=$_POST['kullanici_adi'];
    $user->kullanici_mail=$_POST['kullanici_mail'];
    $data['hatali']= $user->checkExist();


    echo json_encode($data);

}
if (isset($_POST['login']) and $_POST['login']==0) {opcode=loginuser
  $user = new users;
    $sifre = hash('sha256', $_POST['kullanici_sifre']);
    $user->kullanici_adi=$_POST['kullanici_adi'];
  $user->kullanici_sifre=$sifre;
  

  if ($user->loginUser()==1) {
    $giris['durum']=1;
    echo json_encode($giris);
  }
  if ($user->loginUser()==0) {
    $giris['durum']=0;
    echo json_encode($giris);
  }

}

if (isset($_POST['sil']) and $_POST['sil']=="1") {opcode=deletestory
  if ($_POST['seviye']=="0") {
    $delete = new rootStory;
    $delete->hikaye_id = $_POST['hikaye_id'];
    $delete->delete();
      header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

  else if ($_POST['seviye']=="1") {
      $delete = new firstAlter;
    $delete->alterbir_id = $_POST['hikaye_id'];
    $delete->delete();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
  else if ($_POST['seviye']=="2") {
      $delete = new secondAlter;
    $delete->alteriki_id = $_POST['hikaye_id'];
    $delete->delete();
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}

/*
if (isset($_GET['parentid'])) {
      $parentid = $_GET['parentid'];
  if ($_GET['seviye']==1) {
    $obj = new hikaye();
    $obj2 = new alterhikaye();
    $obj2->getStory(1,$_GET['parentid']);
    $obj->getStory(0,$obj2->alterbir_parentid);
  }
  if ($_GET['seviye']==0) {
    $obj = new hikaye();
    $obj->getStory(0,$_GET['parentid']);
  }

}
*/

//eğer getten hikaye metin geldiyse ana hikaye demektir direk yüklenir
if (isset($_POST["hikaye-metin"])) { opcode=addRoot
  $newRootStory = new rootStory;
  $newRootStory->hikaye_baslik=$_POST["hikaye-baslik"];
  $newRootStory->hikaye_metin=$_POST["hikaye-metin"];
   $newRootStory->seviye = 0;
  $newRootStory->kullanici_id = $_SESSION["kullanici_id"];
  $newRootStory->create();
  header("Location: altergör/$newRootStory->hikaye_id/0");


}
//eğer getten alter metin ve seviye 0 gelmişse 1.alternatif tablosuna yüklenir
if (isset($_POST["alter-metin"]) and $_GET['seviye']==0){addFirstAlter

  $firstAlter = new firstAlter;
  $firstAlter->alterbir_metin = $_POST["alter-metin"];
  $firstAlter->alterbir_parentid = $_GET["parentid"];
  $firstAlter->kullanici_id = $_SESSION['kullanici_id'];
  $firstAlter->create();
header("Location: altergör/$firstAlter->alterbir_parentid/0");


}

if (isset($_POST["alter-metin"]) and $_GET['seviye']==1){addSecondAlter

  $secondAlter = new secondAlter;
  $secondAlter->alteriki_metin = $_POST["alter-metin"];
  $secondAlter->alteriki_parentid = $_GET["parentid"];
  $secondAlter->kullanici_id = $_SESSION['kullanici_id'];
  $secondAlter->create();
  $xd = $secondAlter->parent->alterbir_parentid;
header("Location: altergör/$secondAlter->alteriki_parentid/1/$xd");

}
