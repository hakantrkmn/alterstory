<?php
use PHPMailer\PHPMailer\PHPMailer;
class mailController
{
    protected $mailer;
    
    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->CharSet = 'utf-8';
        $this->mailer->SMTPDebug = 0;
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.mailtrap.io';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = '71c6d39b1291a3';
        $this->mailer->Password = 'bfbdc9a1acc661';
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 465;
        $this->mailer->setFrom('support@alterstory.org', 'AlterStory');
    }
    
    public function welcome(users $user)
    {
        $this->mailer->addAddress($user->kullanici_mail, $user->kullanici_adi);     // Add a recipient

        $this->mailer->isHTML(true);
        $this->mailer->Subject = 'Hoşgeldin '. $user->kullanici_adi;
        $this->mailer->Body    = '<html>
        <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="telephone=no" name="format-detection">
        <title></title>
        <!--[if (mso 16)]>
        <style type="text/css">
        a {text-decoration: none;}
        </style>
        <![endif]-->
        <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
        <!--[if !mso]><!-- -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
        <!--<![endif]-->
      <style>
        /* CONFIG STYLES Please do not delete and edit CSS styles below */
  
  
    /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */
  
    #outlook a {
        padding: 0;
    }
  
    .ExternalClass {
        width: 100%;
    }
  
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
        line-height: 100%;
    }
  
    .es-button {
        mso-style-priority: 100 !important;
        text-decoration: none !important;
        transition: all 100ms ease-in;
    }
  
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
  
    .es-button:hover {
        background: #555555 !important;
        border-color: #555555 !important;
    }
  
    .es-desk-hidden {
        display: none;
        float: left;
        overflow: hidden;
        width: 0;
        max-height: 0;
        line-height: 0;
        mso-hide: all;
    }
  
  
    /*
    END OF IMPORTANT
    */
  
    html,
    body {
        width: 100%;
        font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
  
    table {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        border-collapse: collapse;
        border-spacing: 0px;
    }
  
    table td,
    html,
    body,
    .es-wrapper {
        padding: 0;
        Margin: 0;
    }
  
    .es-content,
    .es-header,
    .es-footer {
        table-layout: fixed !important;
        width: 100%;
    }
  
    img {
        display: block;
        border: 0;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
    }
  
    table tr {
        border-collapse: collapse;
    }
  
    p,
    hr {
        Margin: 0;
    }
  
    h1,
    h2,
    h3,
    h4,
    h5 {
        Margin: 0;
        line-height: 120%;
        mso-line-height-rule: exactly;
        font-family: lato, "helvetica neue", helvetica, arial, sans-serif;
    }
  
    p,
    ul li,
    ol li,
    a {
        -webkit-text-size-adjust: none;
        -ms-text-size-adjust: none;
        mso-line-height-rule: exactly;
    }
  
    .es-left {
        float: left;
    }
  
    .es-right {
        float: right;
    }
  
    .es-p5 {
        padding: 5px;
    }
  
    .es-p5t {
        padding-top: 5px;
    }
  
    .es-p5b {
        padding-bottom: 5px;
    }
  
    .es-p5l {
        padding-left: 5px;
    }
  
    .es-p5r {
        padding-right: 5px;
    }
  
    .es-p10 {
        padding: 10px;
    }
  
    .es-p10t {
        padding-top: 10px;
    }
  
    .es-p10b {
        padding-bottom: 10px;
    }
  
    .es-p10l {
        padding-left: 10px;
    }
  
    .es-p10r {
        padding-right: 10px;
    }
  
    .es-p15 {
        padding: 15px;
    }
  
    .es-p15t {
        padding-top: 15px;
    }
  
    .es-p15b {
        padding-bottom: 15px;
    }
  
    .es-p15l {
        padding-left: 15px;
    }
  
    .es-p15r {
        padding-right: 15px;
    }
  
    .es-p20 {
        padding: 20px;
    }
  
    .es-p20t {
        padding-top: 20px;
    }
  
    .es-p20b {
        padding-bottom: 20px;
    }
  
    .es-p20l {
        padding-left: 20px;
    }
  
    .es-p20r {
        padding-right: 20px;
    }
  
    .es-p25 {
        padding: 25px;
    }
  
    .es-p25t {
        padding-top: 25px;
    }
  
    .es-p25b {
        padding-bottom: 25px;
    }
  
    .es-p25l {
        padding-left: 25px;
    }
  
    .es-p25r {
        padding-right: 25px;
    }
  
    .es-p30 {
        padding: 30px;
    }
  
    .es-p30t {
        padding-top: 30px;
    }
  
    .es-p30b {
        padding-bottom: 30px;
    }
  
    .es-p30l {
        padding-left: 30px;
    }
  
    .es-p30r {
        padding-right: 30px;
    }
  
    .es-p35 {
        padding: 35px;
    }
  
    .es-p35t {
        padding-top: 35px;
    }
  
    .es-p35b {
        padding-bottom: 35px;
    }
  
    .es-p35l {
        padding-left: 35px;
    }
  
    .es-p35r {
        padding-right: 35px;
    }
  
    .es-p40 {
        padding: 40px;
    }
  
    .es-p40t {
        padding-top: 40px;
    }
  
    .es-p40b {
        padding-bottom: 40px;
    }
  
    .es-p40l {
        padding-left: 40px;
    }
  
    .es-p40r {
        padding-right: 40px;
    }
  
    .es-menu td {
        border: 0;
    }
  
    .es-menu td a img {
        display: inline !important;
    }
  
  
    /* END CONFIG STYLES */
  
    a {
        font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;
        font-size: 15px;
        text-decoration: underline;
    }
  
    h1 {
        font-size: 30px;
        font-style: normal;
        font-weight: bold;
        color: #333333;
    }
  
    h1 a {
        font-size: 30px;
        text-align: center;
    }
  
    h2 {
        font-size: 20px;
        font-style: normal;
        font-weight: bold;
        color: #333333;
    }
  
    h2 a {
        font-size: 20px;
        text-align: left;
    }
  
    h3 {
        font-size: 18px;
        font-style: normal;
        font-weight: normal;
        color: #333333;
    }
  
    h3 a {
        font-size: 18px;
        text-align: left;
    }
  
    p,
    ul li,
    ol li {
        font-size: 15px;
        font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;
        line-height: 150%;
    }
  
    ul li,
    ol li {
        Margin-bottom: 15px;
    }
  
    .es-menu td a {
        text-decoration: none;
        display: block;
    }
  
    .es-wrapper {
        width: 100%;
        height: 100%;
        background-image: ;
        background-repeat: repeat;
        background-position: center top;
    }
  
    .es-wrapper-color {
        background-color: #f1f1f1;
    }
  
    .es-content-body {
        background-color: #ffffff;
    }
  
    .es-content-body p,
    .es-content-body ul li,
    .es-content-body ol li {
        color: #555555;
    }
  
    .es-content-body a {
        color: #26a4d3;
    }
  
    .es-header {
        background-color: transparent;
        background-image: ;
        background-repeat: repeat;
        background-position: center top;
    }
  
    .es-header-body {
        background-color: #333333;
    }
  
    .es-header-body p,
    .es-header-body ul li,
    .es-header-body ol li {
        color: #ffffff;
        font-size: 14px;
    }
  
    .es-header-body a {
        color: #ffffff;
        font-size: 14px;
    }
  
    .es-footer {
        background-color: transparent;
        background-image: ;
        background-repeat: repeat;
        background-position: center top;
    }
  
    .es-footer-body {
        background-color: #ffffff;
    }
  
    .es-footer-body p,
    .es-footer-body ul li,
    .es-footer-body ol li {
        color: #666666;
        font-size: 12px;
    }
  
    .es-footer-body a {
        color: #666666;
        font-size: 12px;
    }
  
    .es-infoblock,
    .es-infoblock p,
    .es-infoblock ul li,
    .es-infoblock ol li {
        line-height: 120%;
        font-size: 12px;
        color: #cccccc;
    }
  
    .es-infoblock a {
        font-size: 12px;
        color: #cccccc;
    }
  
    a.es-button {
        border-style: solid;
        border-color: #26a4d3;
        border-width: 15px 30px 15px 30px;
        display: inline-block;
        background: #26a4d3;
        border-radius: 50px;
        font-size: 14px;
        font-family: arial, "helvetica neue", helvetica, sans-serif;
        font-weight: bold;
        font-style: normal;
        line-height: 120%;
        color: #ffffff;
        text-decoration: none !important;
        width: auto;
        text-align: center;
    }
  
    .es-button-border {
        border-style: solid solid solid solid;
        border-color: #26a4d3 #26a4d3 #26a4d3 #26a4d3;
        background: #26a4d3;
        border-width: 0px 0px 0px 0px;
        display: inline-block;
        border-radius: 50px;
        width: auto;
    }
  
  
  
    @media only screen and (max-width: 600px) {
        p,
        ul li,
        ol li,
        a {
            font-size: 17px !important;
            line-height: 150% !important;
        }
        h1 {
            font-size: 30px !important;
            text-align: center;
            line-height: 120% !important;
        }
        h2 {
            font-size: 26px !important;
            text-align: left;
            line-height: 120% !important;
        }
        h3 {
            font-size: 20px !important;
            text-align: left;
            line-height: 120% !important;
        }
        h1 a {
            font-size: 30px !important;
            text-align: center;
        }
        h2 a {
            font-size: 20px !important;
            text-align: left;
        }
        h3 a {
            font-size: 20px !important;
            text-align: left;
        }
        .es-menu td a {
            font-size: 16px !important;
        }
        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li,
        .es-header-body a {
            font-size: 16px !important;
        }
        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li,
        .es-footer-body a {
            font-size: 17px !important;
        }
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li,
        .es-infoblock a {
            font-size: 12px !important;
        }
        *[class="gmail-fix"] {
            display: none !important;
        }
        .es-m-txt-c,
        .es-m-txt-c h1,
        .es-m-txt-c h2,
        .es-m-txt-c h3 {
            text-align: center !important;
        }
        .es-m-txt-r,
        .es-m-txt-r h1,
        .es-m-txt-r h2,
        .es-m-txt-r h3 {
            text-align: right !important;
        }
        .es-m-txt-l,
        .es-m-txt-l h1,
        .es-m-txt-l h2,
        .es-m-txt-l h3 {
            text-align: left !important;
        }
        .es-m-txt-r img,
        .es-m-txt-c img,
        .es-m-txt-l img {
            display: inline !important;
        }
        .es-button-border {
            display: inline-block !important;
        }
        a.es-button {
            font-size: 14px !important;
            display: inline-block !important;
            border-width: 15px 25px 15px 25px !important;
        }
        .es-btn-fw {
            border-width: 10px 0px !important;
            text-align: center !important;
        }
        .es-adaptive table,
        .es-btn-fw,
        .es-btn-fw-brdr,
        .es-left,
        .es-right {
            width: 100% !important;
        }
        .es-content table,
        .es-header table,
        .es-footer table,
        .es-content,
        .es-footer,
        .es-header {
            width: 100% !important;
            max-width: 600px !important;
        }
        .es-adapt-td {
            display: block !important;
            width: 100% !important;
        }
        .adapt-img {
            width: 100% !important;
            height: auto !important;
        }
        .es-m-p0 {
            padding: 0px !important;
        }
        .es-m-p0r {
            padding-right: 0px !important;
        }
        .es-m-p0l {
            padding-left: 0px !important;
        }
        .es-m-p0t {
            padding-top: 0px !important;
        }
        .es-m-p0b {
            padding-bottom: 0 !important;
        }
        .es-m-p20b {
            padding-bottom: 20px !important;
        }
        .es-mobile-hidden,
        .es-hidden {
            display: none !important;
        }
        .es-desk-hidden {
            display: table-row!important;
            width: auto!important;
            overflow: visible!important;
            float: none!important;
            max-height: inherit!important;
            line-height: inherit!important;
        }
        .es-desk-menu-hidden {
            display: table-cell!important;
        }
        table.es-table-not-adapt,
        .esd-block-html table {
            width: auto !important;
        }
        table.es-social {
            display: inline-block !important;
        }
        table.es-social td {
            display: inline-block !important;
        }
    }
  
  
    /* END RESPONSIVE STYLES */
  
    .es-p-default {
        padding-top: 20px;
        padding-right: 40px;
        padding-bottom: 0px;
        padding-left: 40px;
    }
  
    .es-p-all-default {
        padding: 0px;
    }
  
      </style>
    </head>
  
    <body>
        <div class="es-wrapper-color">
            <!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="#f1f1f1"></v:fill>
                </v:background>
            <![endif]-->
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td class="esd-email-paddings" valign="top">
                            <table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="7388" align="center">
                                            <table class="es-content-body" style="background-color: rgb(51, 51, 51);" width="600" cellspacing="0" cellpadding="0" bgcolor="#333333" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure esd-checked es-p40t es-p40b es-p40r es-p40l" style="background-image: url("https://tlr.stripocdn.email/content/guids/CABINET_85e4431b39e3c4492fca561009cef9b5/images/93491522393929597.png"); background-repeat: no-repeat;" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="520" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" class="esd-block-text es-p40t es-p10b">
                                                                                            <h1 style="color: #ffffff;">HOŞGELDİN ' . $user->kullanici_adi . '</h1>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center">
                                            <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p40t es-p40r es-p40l" esd-custom-block-id="7389" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="520" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" class="esd-block-text es-p10b">
                                                                                            <p><strong>Site yapım aşamasında olduğu için bazı eksiklikler olabilir.Bunları bildirirseniz bizim için çok güzel olur.</strong></p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="7392" align="center">
                                            <table class="es-content-body" style="background-color: rgb(38, 164, 211);" width="600" cellspacing="0" cellpadding="0" bgcolor="#26a4d3" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p40t es-p20b es-p40r es-p40l" style="background-color: rgb(38, 164, 211);" bgcolor="#26a4d3" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="520" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" class="esd-block-text es-m-txt-c">
                                                                                            <h2 style="color: #ffffff;">Geri Bildirimleriniz Bizim İçin Çok Önemli</h2>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="esd-block-button es-p10" align="center"> <span class="es-button-border" style="background: none 0% 0% repeat scroll rgb(255, 255, 255);"> <a href="mailto:support@alterstory.org" class="es-button" target="_blank" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-color: rgb(255, 255, 255); color: rgb(38, 164, 211); border-width: 15px 25px;">Geri Bildirim</a> </span> </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="es-footer esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" esd-custom-block-id="7394" align="center">
                                            <table class="es-footer-body" style="background-color: rgb(255, 255, 255);" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p40t es-p40b es-p40r es-p40l" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-container-frame" width="520" valign="top" align="center">
                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" class="esd-block-text es-p10b">
                                                                                            <p>AlterStory</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" class="esd-block-text">
                                                                                            <p>Copyright © 2015-2018 <strong>AlterStory</strong>, All Rights Reserved.</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
  
    </html>';        
        $this->mailer->send();
    }
}