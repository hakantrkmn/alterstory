<?php

use Carbon\Carbon;

class rootStory
{
    public $hikaye_id;
    public $hikaye_baslik;
    public $hikaye_metin;
    public $hikaye_devambir;
    public $hikaye_devamiki;
    public $hikaye_devamuc;
    public $hikaye_tarih;
    public $devamlar;
    public $devamsayisi;
    public $hikaye_seviye;
    public $hikaye_begeni;
    public $kullanici_id;
    public $kullanici;
    protected $con;

    public function __construct()
    {
        $this->con = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8mb4;", "adminer", "adminer");
        $this->devamsayisi = 0;
       
    }

    public function create()
    {
        $hikaye = $this->con->prepare("INSERT INTO anahikaye(hikaye_baslik,hikaye_metin,hikaye_seviye,kullanici_id) VALUES (:hikaye_baslik,:hikaye_metin,:hikaye_seviye,:kullanici_id)");
        $hikaye->execute(
          array(
            'hikaye_baslik' => $this->hikaye_baslik,
            'hikaye_metin' => $this->hikaye_metin,
            'hikaye_seviye' => $this->seviye,
            'kullanici_id' => $this->kullanici_id,
          ));

        $this->hikaye_id = $this->con->lastInsertId();

        

    }

    public function delete()
    {
        $deleteQuery = $this->con->prepare("DELETE FROM anahikaye WHERE hikaye_id = :kimlik");
        return $deleteQuery->execute(['kimlik'=>$this->hikaye_id]);
    }

    public function izin()
    {
      $videos = $this->con->prepare("SELECT kullanici_adi FROM alternatifbir NATURAL JOIN kullanici where alterbir_id=:birid or alterbir_id=:ikiid or alterbir_id=:ucid");

      $videos->execute([
          'birid'=> $this->hikaye_devambir,
          'ikiid'=> $this->hikaye_devamiki,
          'ucid'=> $this->hikaye_devamuc,
      ]);
      $videos=$videos->fetchAll(PDO::FETCH_OBJ);
      


        foreach ($videos as $value) {

          if($_SESSION['kullanici_adi']==$value->kullanici_adi)
          {
            return true;
          }
          else {
            
          }

        }
        
          return false;
        
    }

    public function initById($disaridanGelenKimlik)
    {
        //  bir Article objesinin içini, veritabanındaki ilgili kimlik
        //  bilgisiyle saklı satırın bilgileriyle dolduralım
        $selectQuery = $this->con->prepare("SELECT * FROM anahikaye WHERE hikaye_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);

        $this->hikaye_id = $articleResult->hikaye_id;
        $this->hikaye_baslik = $articleResult->hikaye_baslik;
        $this->hikaye_metin = $articleResult->hikaye_metin;
        $this->hikaye_devambir = $articleResult->hikaye_devambir;
        $this->hikaye_devamiki = $articleResult->hikaye_devamiki;
        $this->hikaye_devamuc = $articleResult->hikaye_devamuc;
        $this->hikaye_tarih = $articleResult->hikaye_tarih;
        $this->hikaye_seviye = $articleResult->hikaye_seviye;
        $this->hikaye_begeni = $articleResult->hikaye_begeni;
        $this->kullanici_id = $articleResult->kullanici_id;

        $this->hikaye_tarih=Carbon::createFromTimestamp(strtotime($this->hikaye_tarih))->diffForHumans(); 
        

        $this->devamlar = array(firstAlter::initByIdNoObj($articleResult->hikaye_devambir),
        firstAlter::initByIdNoObj($articleResult->hikaye_devamiki),
       firstAlter::initByIdNoObj($articleResult->hikaye_devamuc));
       if ($this->hikaye_devambir!=null) 
       {
           $this->devamsayisi +=1;   
       }
       if ($this->hikaye_devamiki!=null) 
       {
        $this->devamsayisi +=1;
        }   
        if ($this->hikaye_devamuc!=null) 
        {
        $this->devamsayisi +=1;
        }
        $this->kullanici = users::initByIdNoObj($this->kullanici_id);




        unset($articleResult);
    }

    public static function initByIdNoObj($disaridanGelenKimlik)
    {
       
        $no = new self;
             //  bir Article objesinin içini, veritabanındaki ilgili kimlik
        //  bilgisiyle saklı satırın bilgileriyle dolduralım
        $selectQuery = $no->con->prepare("SELECT * FROM anahikaye WHERE hikaye_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);
        unset($no);
        if($articleResult!=null)
        {
            $articleResult->kullanici = users::initByIdNoObj($articleResult->kullanici_id);
            $articleResult->hikaye_tarih=Carbon::createFromTimestamp(strtotime($articleResult->hikaye_tarih))->diffForHumans(); 
            return $articleResult;
        }
        
               
    }


    public static function find($id)
    {
        $no = new self;
        $no->initById($id);
        return $no;
    }

    public function allArticles($page)
    {
        $limitPass = ($page - 1) * 7;
        $allQuery = $this->con->prepare("SELECT * FROM anahikaye ORDER BY hikaye_id DESC LIMIT :pass , 7");
        $allQuery->bindValue(':pass', $limitPass, PDO::PARAM_INT);
        $allQuery->execute();
        $allArticles = $allQuery->fetchAll(PDO::FETCH_CLASS, 'rootStory');
        return $allArticles;
    }

    public static function all($page)
    {
        $articleHelper = new self;
        return $articleHelper->allArticles($page);
    }   
    public static function storyNumber()
    {
        $no = new self;
        $allQuery = $no->con->prepare("SELECT count(hikaye_id) as sayi FROM anahikaye");
        $allQuery->execute();
        $allArticles = $allQuery->fetch(PDO::FETCH_OBJ);
        return $allArticles->sayi;
    } 

}