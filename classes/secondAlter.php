<?php

use Carbon\Carbon;

class secondAlter
{
    public $alteriki_id;
    public $alteriki_metin;
    public $alteriki_parentid;
    public $alteriki_tarih;
    public $alteriki_seviye;
    public $alteriki_begeni;
    public $kullanici_id;
    public $kullanici;
    public $parent;

    protected $con;

    public function __construct()
    {
        $this->con = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8mb4;", "adminer", "adminer");
    }

    public function create()
    {
        $hikaye = $this->con->prepare("INSERT INTO alternatifiki(alteriki_metin,kullanici_id,alteriki_parentid) VALUES(:hikaye_metin,:kullanici_id,:parid)");
        $hikaye->execute(
          array(
            'hikaye_metin' => $this->alteriki_metin,
            'parid' => $this->alteriki_parentid,
            'kullanici_id' => $this->kullanici_id
          ));
          $this->alteriki_id = $this->con->lastInsertId();

          $this->parent = firstAlter::initByIdNoObj($this->alteriki_parentid);


  
  
  if ($this->parent->alteriki_devambir==NULL)
  {
    $hikaye2 = $this->con->prepare("UPDATE alternatifbir set alterbir_devambir=$this->alteriki_id where alterbir_id = $this->alteriki_parentid ");
    $hikaye2->execute(); 
  }
  elseif ($this->parent->alteriki_devamiki==NULL)
  {
    $hikaye2 = $this->con->prepare("UPDATE alternatifbir set alterbir_devamiki=$this->alteriki_id where alterbir_id = $this->alteriki_parentid ");
    $hikaye2->execute();
  }
  elseif($this->parent->alteriki_devamuc==NULL)
  {
    $hikaye2 = $this->con->prepare("UPDATE alternatifbir set alterbir_devamuc=$this->alteriki_id where alterbir_id = $this->alteriki_parentid ");
    $hikaye2->execute();
  }

    }

    public function delete()
    {
        $deleteQuery = $this->con->prepare("DELETE FROM alternatifiki WHERE alteriki_id = :kimlik");
        return $deleteQuery->execute(['kimlik'=>$this->alteriki_id]);
    }

    public function initById($disaridanGelenKimlik)
    {
       
        
             //  bir Article objesinin içini, veritabanındaki ilgili kimlik
        //  bilgisiyle saklı satırın bilgileriyle dolduralım
        $selectQuery = $this->con->prepare("SELECT * FROM alternatifiki WHERE alteriki_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);

        $this->alteriki_id = $articleResult->alteriki_id;
        $this->alteriki_metin = $articleResult->alteriki_metin;
        $this->alteriki_parentid = $articleResult->alteriki_parentid;
        $this->alteriki_tarih = $articleResult->alteriki_tarih;
        $this->alteriki_seviye = $articleResult->alteriki_seviye;
        $this->alteriki_begeni = $articleResult->alteriki_begeni;
        $this->kullanici_id = $articleResult->kullanici_id;
        $this->kullanici = users::initByIdNoObj($this->kullanici_id);
        $this->parent = firstAlter::initByIdNoObj($this->alteriki_parentid);
        $this->alteriki_tarih=Carbon::createFromTimestamp(strtotime($this->alteriki_tarih))->diffForHumans(); 



        

        

        unset($articleResult);
        
        
       
    }

    public static function initByIdNoObj($disaridanGelenKimlik)
    {
       
        $no = new self;
             //  bir Article objesinin içini, veritabanındaki ilgili kimlik
        //  bilgisiyle saklı satırın bilgileriyle dolduralım
        $selectQuery = $no->con->prepare("SELECT * FROM alternatifiki WHERE alteriki_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);
        unset($no);
        if($articleResult!=null)
        {
            $articleResult->kullanici = users::initByIdNoObj($articleResult->kullanici_id);
            $articleResult->alteriki_tarih=Carbon::createFromTimestamp(strtotime($articleResult->alteriki_tarih))->diffForHumans(); 

            return $articleResult;
        }
        
               
    }

    public static function find($id)
    {

        if ($id !=NULL) {
        $no = new self;
        $no->initById($id);
        
        return $no;
        }
    }

    public function allArticles()
    {
        $allQuery = $this->con->prepare("SELECT * FROM anahikaye");
        $allQuery->execute();
        $allArticles = $allQuery->fetchAll(PDO::FETCH_CLASS, 'rootStory');
        return $allArticles;
    }

    public static function all()
    {
        $articleHelper = new self;
        return $articleHelper->allArticles();
    }   

}