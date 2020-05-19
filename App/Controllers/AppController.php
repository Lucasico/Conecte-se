<?php
namespace App\Controllers;

//os recursos do miniframework
//abstração do controlador
use MF\Controller\Action;
//instanciar modelos
use MF\Model\Container;

class AppController extends Action{
    public function timeline(){
        session_start();
        if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
           $this->render('timeline');
        }else{
            header('Location: /?login=erro');
        }


       
    }
}

?>