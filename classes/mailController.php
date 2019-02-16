<?php
use PHPMailer\PHPMailer\PHPMailer;
//Load Composer's autoloader
require 'vendor/autoload.php';
require_once "users.php";
require_once "rootStory.php";
require_once "firstAlter.php";
require_once "secondAlter.php";





class mailController
{
    protected $mailer;
    
    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->CharSet = 'utf-8';
        $this->mailer->SMTPDebug = 2;
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.mailtrap.io';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = '71c6d39b1291a3';
        $this->mailer->Password = 'bfbdc9a1acc661';
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 465;
        $this->mailer->setFrom('efendibir@yazar.com', 'Efendi Bir Yazar');
    }
    
    public function welcome(users $user)
    {
        $this->mailer->addAddress('joe@example.net');

        $this->mailer->isHTML(true);
        $this->mailer->Subject = 'Yeni kullanıcı: '. $user->kullanici_adi;
        $this->mailer->Body    = "<h1></h1><p>Sitemizde yeni bir makale yayınlandı";
        $this->mailer->Body    .= " lütfen ziyaret edip okuyun :) öpüldünüz";
        
        $this->mailer->send();
    }
}