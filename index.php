<?php

session_start();
require_once "vendor/autoload.php";
require_once "classes/firstAlter.php";
require_once "classes/secondAlter.php";
require_once "classes/rootStory.php";
require_once "classes/storyController.php";
require_once "classes/users.php";
require_once "classes/mailController.php";



$requestedOperation = 'stories';
if(isset($_GET['op']) && method_exists('StoryController', $_GET['op']))
    $requestedOperation = $_GET['op'];

storyController::$requestedOperation();
