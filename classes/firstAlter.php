<?php

use Carbon\Carbon;
class firstAlter
{
    public $alterbir_id;
    public $alterbir_metin;
    public $alterbir_devambir;
    public $alterbir_devamiki;
    public $alterbir_devamuc;
    public $alterbir_parentid;
    public $alterbir_tarih;
    public $alterbir_seviye;
    public $alterbir_begeni;
    public $kullanici_id;
    public $kullanici;
    public $devamsayisi;
    public $devamlar;
    public $parent;

    protected $con;

    public function __construct()
    {
        $this->con = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8mb4;", "adminer", "adminer");
    }

    public function save()
    {
        if(is_null($this->id)) {
            $this->create();
        } else {
            $this->update();
        }
    }

    public function create()
    {
        
        $hikaye = $this->con->prepare("INSERT INTO alternatifbir(alterbir_metin,kullanici_id,alterbir_parentid) VALUES(:hikaye_metin,:kullanici_id,:parid)");
        $hikaye->execute(
          array(
            'hikaye_metin' => $this->alterbir_metin,
            'parid' => $this->alterbir_parentid,
            'kullanici_id' => $this->kullanici_id
          ));
          $this->alterbir_id = $this->con->lastInsertId();

          $this->parent = rootStory::initByIdNoObj($this->alterbir_parentid);



  
  
         if ($this->parent->hikaye_devambir==NULL)
         {
            
           $hikaye2 = $this->con->prepare("UPDATE anahikaye set hikaye_devambir=$this->alterbir_id where hikaye_id = $this->alterbir_parentid ");
           $hikaye2->execute(); 
         }
         elseif ($this->parent->hikaye_devamiki==NULL)
         {
           $hikaye2 = $this->con->prepare("UPDATE anahikaye set hikaye_devamiki=$this->alterbir_id where hikaye_id = $this->alterbir_parentid ");
           $hikaye2->execute();
         }
        elseif($this->parent->hikaye_devamuc==NULL)
        {
         $hikaye2 = $this->con->prepare("UPDATE anahikaye set hikaye_devamuc=$this->alterbir_id where hikaye_id = $this->alterbir_parentid ");
            $hikaye2->execute();
        }

    }

    public function izin()
    {
      $videos = $this->con->prepare("SELECT kullanici_adi FROM alternatifiki NATURAL JOIN kullanici where alteriki_id=:birid or alteriki_id=:ikiid or alteriki_id=:ucid");

      $videos->execute([
          'birid'=> $this->alterbir_devambir,
          'ikiid'=> $this->alterbir_devamiki,
          'ucid'=> $this->alterbir_devamuc,
      ]);
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

    public function delete()
    {
        $deleteQuery = $this->con->prepare("DELETE FROM alternatifbir WHERE alterbir_id = :kimlik");
        return $deleteQuery->execute(['kimlik'=>$this->alterbir_id]);
    }

    public function initById($disaridanGelenKimlik)
    {
        $selectQuery = $this->con->prepare("SELECT * FROM alternatifbir WHERE alterbir_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);

        $this->alterbir_id = $articleResult->alterbir_id;
        $this->alterbir_metin = $articleResult->alterbir_metin;
        $this->alterbir_devambir = $articleResult->alterbir_devambir;
        $this->alterbir_devamiki = $articleResult->alterbir_devamiki;
        $this->alterbir_devamuc = $articleResult->alterbir_devamuc;
        $this->alterbir_parentid = $articleResult->alterbir_parentid;
        $this->alterbir_tarih = $articleResult->alterbir_tarih;
        $this->alterbir_seviye = $articleResult->alterbir_seviye;
        $this->alterbir_begeni = $articleResult->alterbir_begeni;
        $this->kullanici_id = $articleResult->kullanici_id;
        $this->kullanici = users::initByIdNoObj($this->kullanici_id);
        $this->parent = rootStory::initByIdNoObj($this->alterbir_parentid);
        $this->alterbir_tarih=Carbon::createFromTimestamp(strtotime($this->alterbir_tarih))->diffForHumans(); 



        $this->devamlar = array(secondAlter::initByIdNoObj($articleResult->alterbir_devambir),
        secondAlter::initByIdNoObj($articleResult->alterbir_devamiki),
       secondAlter::initByIdNoObj($articleResult->alterbir_devamuc));
       if ($this->alterbir_devambir!=null) {
           $this->devamsayisi +=1;
          echo $this->devamsayisi;
       }
       else if ($this->alterbir_devamiki!=null) {
        $this->devamsayisi +=1;
        echo $this->devamsayisi;
        }   
        else if ($this->alterbir_devamiki!=null) {
        $this->devamsayisi +=1;
        echo $this->devamsayisi;
        }

        unset($articleResult);
        
        
       
    }

    public static function initByIdNoObj($disaridanGelenKimlik)
    {
       
        $no = new self;
        $selectQuery = $no->con->prepare("SELECT * FROM alternatifbir WHERE alterbir_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);
        unset($no);
        if($articleResult!=null)
        {
            $articleResult->kullanici = users::initByIdNoObj($articleResult->kullanici_id);
            $articleResult->parent = rootStory::initByIdNoObj($articleResult->alterbir_parentid);
            $articleResult->alterbir_tarih=Carbon::createFromTimestamp(strtotime($articleResult->alterbir_tarih))->diffForHumans(); 



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