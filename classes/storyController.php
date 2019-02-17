<?php

class storyController
{
    static public function insertUser()
    {
        $sifre = hash('sha256', $_POST['kullanici_sifre']);
        $user = new users;
        $user->kullanici_adi=$_POST['kullanici_adi'];
        $user->kullanici_mail=$_POST['kullanici_mail'];
        $user->kullanici_sifre=$sifre;
      
        $user->insertUser();




        header("Location: ?op=stories");
    }
    static public function kayit()
    {
     
    $kullanicidurum;
    $yanlisgiris =0;
    require "view/kayit.php";


    }

    static public function login()
    {
     
        $yanlisgiris;
        require "view/login.php";


    }

    static public function profil()
    {
     
      $kendiProfili=0;
      if (isset($_SESSION['kullanici_adi'])) {
        if ($_SESSION['kullanici_adi']==$_GET['kullanici']) {
          $kendiProfili = 1;
        }
      }
      $user=users::initByNameNoObj($_GET['kullanici']);
      
        require "view/profil.php";


    }
    static public function alterEkle()
    {
      if (isset($_SESSION['kullanici_adi'])) {
        //eğer alternatif eklenmek istenen hikaye 1. seviyeyse ona göre sorgu
        if ($_POST['seviye']==1)
        {
          $firstAlter = firstAlter::find($_POST['parentid']);
        }
        if ($_POST['seviye']==0)
        {
          $rootStory = rootStory::find($_POST['parentid']);
    
        }
        require "view/alterekle.php";


      }
      else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }

    static public function deleteStory()
    {
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

    static public function addRoot()
    {
        $newRootStory = new rootStory;
        $newRootStory->hikaye_baslik=$_POST["hikaye-baslik"];
        $newRootStory->hikaye_metin=$_POST["hikaye-metin"];
         $newRootStory->seviye = 0;
        $newRootStory->kullanici_id = $_SESSION["kullanici_id"];
        $newRootStory->create();
        header("Location: ?op=alterStories&hikaye_id=$newRootStory->hikaye_id&seviye=0");
    }

    static public function addAlter()
    {
      if ($_GET['seviye']=="0") {
        $firstAlter = new firstAlter;
        $firstAlter->alterbir_metin = $_POST["alter-metin"];
        $firstAlter->alterbir_parentid = $_GET["parentid"];
        $firstAlter->kullanici_id = $_SESSION['kullanici_id'];
        $firstAlter->create();
      header("Location: ?op=alterStories&hikaye_id=$firstAlter->alterbir_parentid&seviye=0");

      }
      if ($_GET['seviye']=="1") {
        $secondAlter = new secondAlter;
        $secondAlter->alteriki_metin = $_POST["alter-metin"];
        $secondAlter->alteriki_parentid = $_GET["parentid"];
        $secondAlter->kullanici_id = $_SESSION['kullanici_id'];
        $secondAlter->create();
        $xd = $secondAlter->parent->alterbir_parentid;
        header("Location: ?op=alterStories&hikaye_id=$secondAlter->alteriki_parentid&seviye=1&id= $xd");
      

      }

    }
    static public function anahikaye()
    {
      require "view/anahikayeyaz.php";

    }
    static public function hikayeoku()
    {
      $secondAlter = secondAlter::find($_GET['hikaye_id']);

      require "view/hikayeoku.php";

    }
    static public function stories()
    {
        
        if (!isset($_GET['page'])) {
            $page=1;
          }
          else {
            $page=$_GET['page'];
          }
          
          $allArticles = rootStory::all($page);

      require "view/stories.php";
    }

    static public function alterStories()
    {

        if ($_GET['seviye']==1) {
            $firstAlter = firstAlter::find($_GET['hikaye_id']);  
          }
          if ($_GET['seviye']==0) {
            $rootStory = rootStory::find($_GET['hikaye_id']);
          }

      require "view/altergör.php";
    }

}