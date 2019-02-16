<?php



if ($_GET['seviye']==0) {
  $anaHikaye = $connection->prepare("SELECT hikaye_begeni FROM anahikaye where hikaye_id=:hikaye_id");
  $anaHikaye->execute(array('hikaye_id'=> $_GET['hikaye_id'] ));
  $anaHikayeler = $anaHikaye->fetch(PDO::FETCH_OBJ);
  var_dump($anaHikayeler);
  $begeni = $anaHikayeler->hikaye_begeni;

  $begeni= $begeni+1;



  $anaHikaye1 = $connection->prepare("UPDATE anahikaye  set hikaye_begeni=$begeni where hikaye_id=:hikaye_id");
  $anaHikaye1->execute(array('hikaye_id'=> $_GET['hikaye_id'] ));

  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if ($_GET['seviye']==1) {
  $anaHikaye = $connection->prepare("SELECT alterbir_begeni FROM alternatifbir where alterbir_id=:hikaye_id");
  $anaHikaye->execute(array('hikaye_id'=> $_GET['hikaye_id'] ));
  $anaHikayeler = $anaHikaye->fetch(PDO::FETCH_OBJ);
  var_dump($anaHikayeler);
  $begeni = $anaHikayeler->alterbir_begeni;

  $begeni= $begeni+1;



  $anaHikaye1 = $connection->prepare("UPDATE alternatifbir  set alterbir_begeni=$begeni where alterbir_id=:hikaye_id");
  $anaHikaye1->execute(array('hikaye_id'=> $_GET['hikaye_id'] ));
header('Location: ' . $_SERVER['HTTP_REFERER']);

}
if ($_GET['seviye']==2) {
  $anaHikaye = $connection->prepare("SELECT alteriki_begeni FROM alternatifiki where alteriki_id=:hikaye_id");
  $anaHikaye->execute(array('hikaye_id'=> $_GET['hikaye_id'] ));
  $anaHikayeler = $anaHikaye->fetch(PDO::FETCH_OBJ);
  var_dump($anaHikayeler);
  $begeni = $anaHikayeler->alteriki_begeni;

  $begeni= $begeni+1;



  $anaHikaye1 = $connection->prepare("UPDATE alternatifiki  set alteriki_begeni=$begeni where alteriki_id=:hikaye_id");
  $anaHikaye1->execute(array('hikaye_id'=> $_GET['hikaye_id'] ));

  header('Location: ' . $_SERVER['HTTP_REFERER']);
}








 ?>
