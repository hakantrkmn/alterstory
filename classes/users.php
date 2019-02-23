<?php

class users
{
    public $kullanici_id;
    public $kullanici_adi;
    public $kullanici_sifre;
    public $kullanici_mail;
    public $kullanici_ban;
    public $rootStories;
    public $firstAlters;
    public $secondAlters;


    protected $con;

    public function __construct()
    {
        $this->con = new PDO("mysql:host=localhost;dbname=hikaye;charset=utf8mb4;", "adminer", "adminer");
    }


    protected function create()
    {
        //  INSERT INTO `articles` (`title`, `content`) VALUES ('baslik', 'icerik');
        $createQuery = $this->con->prepare("INSERT INTO `kullanici` (`kullanici_adi`,`kullanici_sifre`,kullanici_mail) VALUES (':ad',:kullanici,:mail)");
        $result = $createQuery->execute(array(
            "ad" => $this->alterbir_metin,
            "kullanici" => $this->kullanici_id,
        ));

        $this->alterbir_id = $this->con->lastInsertId();

        return $result;
    }

    public function delete()
    {
        $deleteQuery = $this->con->prepare("DELETE FROM alternatifbir WHERE alterbir_id = :kimlik");
        return $deleteQuery->execute(['kimlik'=>$this->alterbir_id]);
    }

    public function initById($disaridanGelenKimlik)
    {
       
        
             //  bir Article objesinin içini, veritabanındaki ilgili kimlik
        //  bilgisiyle saklı satırın bilgileriyle dolduralım
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
        

        unset($articleResult);
        
        
       
    }

    public static function initByIdNoObj($disaridanGelenKimlik)
    {
       
        $no = new self;
             //  bir Article objesinin içini, veritabanındaki ilgili kimlik
        //  bilgisiyle saklı satırın bilgileriyle dolduralım
        $selectQuery = $no->con->prepare("SELECT * FROM kullanici WHERE kullanici_id = :kimlik");
        $selectQuery->execute(['kimlik'=>$disaridanGelenKimlik]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);
        unset($no);
        if($articleResult!=null)
        {
            return $articleResult;
        }
        
               
    }
    public static function initByNameNoObj($disaridanGelenName)
    {
       
        $no = new self;
        $no->kullanici_adi=$disaridanGelenName;
        $selectQuery = $no->con->prepare("SELECT * FROM kullanici WHERE kullanici_adi = :adi");
        $selectQuery->execute(['adi'=>$disaridanGelenName]);
        $articleResult = $selectQuery->fetch(PDO::FETCH_OBJ);
        if($articleResult!=null)
        {
          $articleResult->rootStories = $no->getRootStories();
          $articleResult->firstAlters = $no->getFirstAlters();
          $articleResult->secondAlters = $no->getSecondAlters();
          unset($no);
          return $articleResult;
        }
        
               
    }

    public function getRootStories()
    {
        $selectQuery = $this->con->prepare("select anahikaye.* from kullanici natural join anahikaye where kullanici_adi =:adi ");
        $selectQuery->execute(['adi'=>$this->kullanici_adi]);
        $stories = $selectQuery->fetchAll(PDO::FETCH_OBJ);    
        return $stories;  
               
    }
    public function getFirstAlters()
    {
        $selectQuery = $this->con->prepare("select alternatifbir.* from kullanici natural join alternatifbir where kullanici_adi =:adi ");
        $selectQuery->execute(['adi'=>$this->kullanici_adi]);
        $articleResult = $selectQuery->fetchAll(PDO::FETCH_OBJ);
        return $articleResult;        
               
    }
    public function getSecondAlters()
    {
        $selectQuery = $this->con->prepare("select alternatifiki.* from kullanici natural join alternatifiki where kullanici_adi =:adi ");
        $selectQuery->execute(['adi'=>$this->kullanici_adi]);
        $articleResult = $selectQuery->fetchAll(PDO::FETCH_OBJ);
        return $articleResult;    
               
    }

    public function insertUser(){
          $deneme = $this->con->prepare("INSERT INTO kullanici(kullanici_adi,kullanici_sifre,kullanici_mail) values(:kullanici_adi,:kullanici_sifre,:mail) ");
          $deneme->execute(array('kullanici_adi' => $this->kullanici_adi,'kullanici_sifre' => $this->kullanici_sifre,'mail'=>$this->kullanici_mail));
          
          $this->kullanici_id = $this->con->lastInsertId();

          

          $mc = new mailController;
          $mc->welcome($this);
          $_SESSION['kullanici_adi']=$this->kullanici_adi;
          $_SESSION['kullanici_mail']=$this->kullanici_mail;
          $_SESSION['kullanici_id']=$this->kullanici_id;
  
    }

    public function checkExist(){
        $kullanici = $this->con->prepare("SELECT * FROM kullanici where kullanici_mail=:kullanici_mail or kullanici_adi=:kullanici_adi ");
        $kullanici->execute(array('kullanici_adi' => $this->kullanici_adi,'kullanici_mail' => $this->kullanici_mail));
        $kullanici = $kullanici->fetch(PDO::FETCH_OBJ);
        
        if ($kullanici) {
          return 1;

        }
        else{
          return 0;
        }

  }
  public function loginUser(){
    $kullanici = $this->con->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi and kullanici_sifre=:kullanici_sifre");
    $kullanici->execute(array('kullanici_adi' => $this->kullanici_adi,'kullanici_sifre'=>$this->kullanici_sifre));
    $kullanici = $kullanici->fetch(PDO::FETCH_OBJ);
    if ($kullanici) {
      $_SESSION['kullanici_adi']=$this->kullanici_adi;
      $_SESSION['kullanici_sifre']=$this->kullanici_sifre;
      $_SESSION['kullanici_id']=$kullanici->kullanici_id;
      return 1;

    }
    else {
      return 0;

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