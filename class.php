<?php
session_start();
class user {
  public $connection;
  public $username;
  public $userid;
  public $baz ;
  function __construct()
  {
    $this->connection = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8;", "adminer", "adminer");
    $this->baz = new hikaye();
  }
  public static function insertUser($kullanici_adi,$kullanici_sifre,$kullanici_mail){
      $returnObj = new self;

        $deneme = $returnObj->connection->prepare("INSERT INTO kullanici(kullanici_adi,kullanici_sifre,kullanici_mail) values(:kullanici_adi,:kullanici_sifre,:mail) ");
        $deneme->execute(array('kullanici_adi' => $kullanici_adi,'kullanici_sifre' => $kullanici_sifre,'mail'=>$kullanici_mail));

        $kullanici1 = $returnObj->connection->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi and kullanici_sifre=:kullanici_sifre");
        $kullanici1->execute(array('kullanici_adi' => $kullanici_adi,'kullanici_sifre'=>$kullanici_sifre));
        $kullanici1 = $kullanici1->fetch(PDO::FETCH_OBJ);
        $kullanicidurum=0;


        $_SESSION['kullanici_adi']=$kullanici1->kullanici_adi;
        $_SESSION['kullanici_mail']=$kullanici1->kullanici_mail;
        $_SESSION['kullanici_id']=$kullanici1->kullanici_id;




  }
  public static function loginUser($kullanici_adi,$kullanici_sifre){
    $returnObj = new self;
    $kullanici = $returnObj->connection->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi and kullanici_sifre=:kullanici_sifre");
    $kullanici->execute(array('kullanici_adi' => $kullanici_adi,'kullanici_sifre'=>$kullanici_sifre));
    $kullanici = $kullanici->fetch(PDO::FETCH_OBJ);
    if ($kullanici) {
      $_SESSION['kullanici_adi']=$kullanici->kullanici_adi;
      $_SESSION['kullanici_sifre']=$kullanici->kullanici_sifre;
      $_SESSION['kullanici_id']=$kullanici->kullanici_id;
      return 1;


    }
    else {
      return 0;

    }
  }
  public function userStory($seviye,$kullanici)
  {if ($seviye==0) {
    $videos = $this->connection->prepare("SELECT * FROM anahikaye , kullanici where kullanici.kullanici_adi=:name and kullanici.kullanici_id=anahikaye.kullanici_id ORDER BY hikaye_id DESC");
    $videos->execute(array('name'=>$kullanici));
  return   $videos=$videos->fetchAll(PDO::FETCH_OBJ);
  }
  if ($seviye==1) {
    $videos = $this->connection->prepare("SELECT * FROM alternatifbir , kullanici where kullanici.kullanici_adi=:name and kullanici.kullanici_id=alternatifbir.kullanici_id ORDER BY alterbir_id DESC");
     $videos->execute(array('name'=>$kullanici));
    return  $videos=$videos->fetchAll(PDO::FETCH_OBJ);
  }
  if ($seviye==2) {
    $videos = $this->connection->prepare("SELECT * FROM alternatifiki , kullanici where kullanici.kullanici_adi=:name and kullanici.kullanici_id=alternatifiki.kullanici_id ORDER BY alteriki_id DESC");
      $videos->execute(array('name'=>$kullanici));
   return $videos=$videos->fetchAll(PDO::FETCH_OBJ);
  }

  }
  public static function kullanicivarmi()
  {
      if (isset($_SESSION['kullanici_adi'])) {
        return true;
      }
      else {
        return false;
      }
  }






}








































class hikaye
{
  public $connection;
  public  $hikaye_id;
  public  $hikaye_baslik;
  public  $hikaye_metin;
  public  $hikaye_devambir;
  public  $hikaye_devamiki;
  public  $hikaye_devamuc;
  public  $hikaye_tarih;
  public  $hikaye_seviye;
  public  $hikaye_begeni;
  public  $kullanici_id;
  public  $kullanici_adi;

  function __construct()
  {
    $this->connection = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8;", "adminer", "adminer");

  }
  public static function dolumu($hikayeid,$seviye)
  {
    if ($seviye==0) {
      $returnObj = new self;
    $videos = $returnObj->connection->prepare("SELECT hikaye_devambir,hikaye_devamiki,hikaye_devamuc FROM anahikaye where hikaye_id=$hikayeid");
    $videos->execute();
    $videos=$videos->fetch(PDO::FETCH_OBJ);
      if ($videos->hikaye_devambir == 0 or $videos->hikaye_devamiki == 0 or $videos->hikaye_devamuc == 0 ) {
        return false;
      }
      else {
        return true;
      }
    }
    if ($seviye==1) {

      $returnObj = new self;
      $videos = $returnObj->connection->prepare("SELECT alterbir_devambir,alterbir_devamiki,alterbir_devamuc FROM alternatifbir where alterbir_id=$hikayeid");
      $videos->execute();
      $videos=$videos->fetch(PDO::FETCH_OBJ);
        if ($videos->alterbir_devambir == 0 or $videos->alterbir_devamiki == 0 or $videos->alterbir_devamuc == 0 ) {
          return false;
        }
        else {
          return true;
        }
    }

  }
  public static function izin($hikaye,$seviye)
  {
    if ($seviye==0) {
      $sayac=0;
      $returnObj = new self;
      if ($hikaye->hikaye_devamuc==NULL) {
        $hikaye->haikye_devamuc="NULL";
      }
      $videos = $returnObj->connection->prepare("SELECT kullanici_adi FROM alternatifbir NATURAL JOIN kullanici where alterbir_id=$hikaye->hikaye_devambir or alterbir_id=$hikaye->hikaye_devamiki or alterbir_id=$hikaye->hikaye_devamuc");

      $videos->execute();
      $videos=$videos->fetchAll(PDO::FETCH_OBJ);

        foreach ($videos as $value) {

          if($_SESSION['kullanici_adi']==$value->kullanici_adi)
          {
            return true;
          }
          else {
            $sayac=$sayac+1;
          }

        }
        if ($sayac!=0) {
          return false;
        }
    }
    if ($seviye==1) {
      $returnObj = new self;
      if ($hikaye->alterbir_devamuc==NULL) {
        $hikaye->alterbir_devamuc="NULL";
      }
      $videos = $returnObj->connection->prepare("SELECT kullanici_adi FROM alternatifiki NATURAL JOIN kullanici where alteriki_id=$hikaye->alterbir_devambir or alteriki_id=$hikaye->alterbir_devamiki or alteriki_id=$hikaye->alterbir_devamuc");
      $videos->execute();
      $videos=$videos->fetchAll(PDO::FETCH_OBJ);

        foreach ($videos as $value) {
          if($_SESSION['kullanici_adi']==$value->kullanici_adi)
          {
            return true;
          }
          else {
            return false;
          }
        }
    }




  }

  public static function getAllVideos($page)
  {
    $returnObj = new self;
    $limitPass = ($page - 1) * 7;
    $videos = $returnObj->connection->prepare("SELECT * FROM anahikaye , kullanici where anahikaye.kullanici_id=kullanici.kullanici_id ORDER BY hikaye_id DESC LIMIT :pass , 7");
    $videos->bindValue(':pass', $limitPass, PDO::PARAM_INT);

    $videos->execute();

    return $videos->fetchAll(PDO::FETCH_OBJ);
  }
  public static function deleteStory($id,$seviye)
  {
    if ($seviye==0) {
      $returnObj = new self;
      $videos = $returnObj->connection->prepare("DELETE FROM anahikaye where anahikaye.hikaye_id=$id");
      $videos->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

      if ($seviye==1) {
        $returnObj = new self;
        $videos = $returnObj->connection->prepare("DELETE FROM alternatifbir where alterbir_id=$id");
        $videos->execute();
          header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
      if ($seviye==2) {
        $returnObj = new self;
        $videos = $returnObj->connection->prepare("DELETE FROM alternatifiki where alteriki_id=$id");
        $videos->execute();
          header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
  }
  public static function getPage()
  {
    $returnObj = new self;
    $videos = $returnObj->connection->prepare("SELECT * FROM anahikaye ");
    $videos->execute();
    $videos=$videos->fetchAll(PDO::FETCH_OBJ);


    return count($videos)/7;

  }
  public static function insertStory($hikaye_baslik,$hikaye_metin,$seviye,$kullanici_id)
  {
    $returnObj = new self;
    $hikaye = $returnObj->connection->prepare("INSERT INTO anahikaye(hikaye_baslik,hikaye_metin,hikaye_seviye,kullanici_id) VALUES (:hikaye_baslik,:hikaye_metin,:hikaye_seviye,:kullanici_id)");
    $hikaye->execute(
      array(
        'hikaye_baslik' => $hikaye_baslik,
        'hikaye_metin' => $hikaye_metin,
        'hikaye_seviye' => $seviye,
        'kullanici_id' => $kullanici_id,
      ));
      header("Location: index/1");

  }
  public function insertAlterStory($hikaye_metin,$kullanici_id)
  {
    $hikaye = $this->connection->prepare("INSERT INTO alternatifbir(alterbir_metin,kullanici_id,alterbir_parentid) VALUES(:hikaye_metin,:kullanici_id,:parid)");
    $hikaye->execute(
      array(
        'hikaye_metin' => $hikaye_metin,
        'parid' => $this->hikaye_id,
        'kullanici_id' => $kullanici_id
      ));


  }
  public function getStory($seviye,$hikaye_id)
  {
    if ($seviye==0) {
      $hikaye = $this->connection->prepare("SELECT * from kullanici natural JOIN anahikaye where anahikaye.hikaye_id=:hikaye_id ");
      $hikaye->execute(array('hikaye_id'=>$hikaye_id));
      $hikaye = $hikaye->fetch(PDO::FETCH_OBJ);
      $this->hikaye_id = $hikaye->hikaye_id;
      $this->hikaye_baslik = $hikaye->hikaye_baslik;
      $this->hikaye_metin = $hikaye->hikaye_metin;
      $this->hikaye_devambir = $hikaye->hikaye_devambir;
      $this->hikaye_devamiki = $hikaye->hikaye_devamiki;
      $this->hikaye_devamuc = $hikaye->hikaye_devamuc;
      $this->hikaye_tarih = $hikaye->hikaye_tarih;
      $this->hikaye_seviye = $hikaye->hikaye_seviye;
      $this->hikaye_begeni = $hikaye->hikaye_begeni;
      $this->kullanici_id = $hikaye->kullanici_id;
      $this->kullanici_adi = $hikaye->kullanici_adi;
    }
  }
  public function getAlterStory($seviye)
  {
    if ($seviye==0) {
      if ($this->hikaye_devambir=="") {
        $this->hikaye_devambir = "NULL";
      }
      if ($this->hikaye_devamiki=="") {
        $this->hikaye_devamiki = "NULL";
      }
      if ($this->hikaye_devamuc=="") {
        $this->hikaye_devamuc = "NULL";
      }
      $alternatifler = $this->connection->prepare("SELECT * from kullanici natural JOIN alternatifbir where (alternatifbir.alterbir_id=:id1 or alternatifbir.alterbir_id=:id2 or alternatifbir.alterbir_id=:id3) and alternatifbir.alterbir_parentid =$this->hikaye_id");
      $alternatifler->execute(
        array(
          'id1' => $this->hikaye_devambir,
          'id2' => $this->hikaye_devamiki,
          'id3' => $this->hikaye_devamuc,
        ));
      return $alternatifler = $alternatifler->fetchAll(PDO::FETCH_OBJ);

    }
  }

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class alterhikaye
{
  public $connection;
  public  $alterbir_id;
  public  $alterbir_metin;
  public  $alterbir_devambir;
  public  $alterbir_devamiki;
  public  $alterbir_devamuc;
  public  $alterbir_parentid;
  public  $alterbir_tarih;
  public  $alterbir_seviye;
  public  $alterbir_begeni;
  public  $kullanici_id;
  public  $kullanici_adi;

  function __construct()
  {
    $this->connection = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8;", "adminer", "adminer");

  }
  public function getStory($seviye,$hikaye_id)
  {
    if ($seviye==1) {
      //alternatifi görülmek istenen hikayenin bilgileri
      $hikaye = $this->connection->prepare("SELECT * from kullanici natural JOIN alternatifbir where alternatifbir.alterbir_id=:hikaye_id");
      $hikaye->execute(array('hikaye_id'=>$hikaye_id));
      $hikaye = $hikaye->fetch(PDO::FETCH_OBJ);
      $this->alterbir_id = $hikaye->alterbir_id;
      $this->alterbir_metin = $hikaye->alterbir_metin;
      $this->alterbir_devambir = $hikaye->alterbir_devambir;
      $this->alterbir_devamiki = $hikaye->alterbir_devamiki;
      $this->alterbir_devamuc = $hikaye->alterbir_devamuc;
      $this->alterbir_parentid = $hikaye->alterbir_parentid;
      $this->alterbir_tarih = $hikaye->alterbir_tarih;
      $this->alterbir_seviye = $hikaye->alterbir_seviye;
      $this->alterbir_begeni = $hikaye->alterbir_begeni;
      $this->kullanici_id = $hikaye->kullanici_id;
      $this->kullanici_adi = $hikaye->kullanici_adi;
    }


  }
  public function insertAlterStory($hikaye_metin,$kullanici_id)
  {
    $hikaye = $this->connection->prepare("INSERT INTO alternatifiki(alteriki_metin,kullanici_id,alteriki_parentid) VALUES(:hikaye_metin,:kullanici_id,:parid)");
    $hikaye->execute(
      array(
        'hikaye_metin' => $hikaye_metin,
        'kullanici_id' => $kullanici_id,
        'parid' => $this->alterbir_id,
      ));

  }
  public function getAlterStory($seviye)
  {
    if ($seviye==1) {
      if ($this->alterbir_devambir=="") {
        $this->alterbir_devambir = "NULL";
      }
      if ($this->alterbir_devamiki=="") {
        $this->alterbir_devamiki = "NULL";
      }
      if ($this->alterbir_devamuc=="") {
        $alterbir_devamuc = "NULL";
      }
      $alternatifler = $this->connection->prepare("SELECT * from kullanici natural JOIN alternatifiki where (alternatifiki.alteriki_id=:id1 or alternatifiki.alteriki_id=:id2 or alternatifiki.alteriki_id=:id3) and alternatifiki.alteriki_parentid =$this->alterbir_id");
      $alternatifler->execute(
        array(
          'id1' => $this->alterbir_devambir,
          'id2' => $this->alterbir_devamiki,
          'id3' => $this->alterbir_devamuc,
        ));
      return $alternatifler = $alternatifler->fetchAll(PDO::FETCH_OBJ);

    }

  }

  public function getRootStory()
  {
      $asilHikaye = $this->connection->prepare("SELECT * from kullanici natural JOIN anahikaye where hikaye_id=$this->alterbir_parentid");
      $asilHikaye->execute();
      return $asilHikaye = $asilHikaye->fetch(PDO::FETCH_OBJ);

  }


}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class alter2hikaye
{
  public $connection;
  public  $alteriki_id;
  public  $alteriki_metin;
  public  $alteriki_tarih;
  public  $alteriki_seviye;
  public  $alteriki_begeni;
  public  $alteriki_parentid;
  public  $kullanici_id;
  public  $kullanici_adi;

  function __construct()
  {
    $this->connection = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8;", "adminer", "adminer");

  }
  public function getStory($seviye,$hikaye_id)
  {
      if ($seviye==2) {
        $tiklananhikaye = $this->connection->prepare("SELECT *
          from alternatifiki
          natural JOIN kullanici
          where alternatifiki.alteriki_id=:hikaye_id and alternatifiki.kullanici_id=kullanici.kullanici_id");
          $tiklananhikaye->execute(array('hikaye_id'=>$hikaye_id));
          $tiklananhikaye = $tiklananhikaye->fetch(PDO::FETCH_OBJ);
          $this->alteriki_id = $tiklananhikaye->alteriki_id;
          $this->alteriki_metin= $tiklananhikaye->alteriki_metin;
          $this->alteriki_tarih= $tiklananhikaye->alteriki_tarih;
          $this->alteriki_seviye= $tiklananhikaye->alteriki_seviye;
          $this->alteriki_begeni= $tiklananhikaye->alteriki_begeni;
          $this->alteriki_parentid= $tiklananhikaye->alteriki_parentid;
          $this->kullanici_id= $tiklananhikaye->kullanici_id;
          $this->kullanici_adi= $tiklananhikaye->kullanici_adi;

      }

  }
  public function getParentStory()
  {
        $tiklananhikaye = $this->connection->prepare("SELECT *
          from alternatifbir
          natural JOIN kullanici
          where alternatifbir.alterbir_id=:hikaye_id and alternatifbir.kullanici_id=kullanici.kullanici_id");
          $tiklananhikaye->execute(array('hikaye_id'=>$this->alteriki_parentid));

          return $tiklananhikaye = $tiklananhikaye->fetch(PDO::FETCH_OBJ);

  }

  public function getRootVideo($rootid)
  {
      $asilHikaye = $this->connection->prepare("SELECT * from kullanici natural JOIN anahikaye where hikaye_id=$rootid");
      $asilHikaye->execute();
      return $asilHikaye = $asilHikaye->fetch(PDO::FETCH_OBJ);

  }


}

















 ?>
