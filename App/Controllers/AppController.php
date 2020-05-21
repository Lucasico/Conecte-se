<?php
namespace App\Controllers;

//os recursos do miniframework
//abstração do controlador
use MF\Controller\Action;
//instanciar modelos
use MF\Model\Container;

class AppController extends Action{
    public function dadosGeraisUsuario(){
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id',$_SESSION['id']);
        $dadosGerais = [
            'InfoUsuario' =>   $this->view->info_usuario =  $usuario->getInfoUsuario(),
            'TotaolTweets' => $this->view->total_tweets =  $usuario->getTotalTweets(),
            'TotalSeguindo' => $this->view->total_seguindo =  $usuario->getTotalSeguindo(),
            'TotalSeguidores' => $this->view->total_seguidores =  $usuario->getTotalSeguindores()
        ];
        return $dadosGerais;
    }
    public function timeline(){
        $this->validaAutentificacao();
        //recuperação dos tweets
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_usuario',$_SESSION['id']);
        $tweets = $tweet->getAll();
        //uso o render quando desejo renderizar alguma infor dinamica pra view
        $this->view->tweets = $tweets; 

        $usuario = Container::getModel('Usuario');
        $this->view->dadosGeraisUsuario = $this->dadosGeraisUsuario();
        //metodo | ação
        $this->render('timeline');
    }

    public function tweet(){
        $this->validaAutentificacao();
        $tweet = Container::getModel('Tweet');
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweet->salvar();
         //rota
        header('Location: /timeline');  
    }

    public function validaAutentificacao(){
        session_start();
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
            header('Location: /?login=erro');
        }
    }

    public function quemSeguir(){
        $this->validaAutentificacao();
        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
        $usuarios = array();
        if($pesquisarPor != ''){
            $usuario = Container::getModel('Usuario');
            $usuario->__set('id',$_SESSION['id']);
            $usuario->__set('nome',$pesquisarPor);
            $usuarios = $usuario->getAll();
        }
        //uso o render quando desejo renderizar alguma infor dinamica pra view

        $this->view->usuarios = $usuarios;
        $this->view->dadosGeraisUsuario = $this->dadosGeraisUsuario();
        //metodo | ação
        $this->render('quemSeguir');
    }

    public function acao(){
        $this->validaAutentificacao();
        $acao = isset($_GET[ 'acao' ]) ? $_GET['acao'] : '';
        $id_usuario_seguindo = isset($_GET[ 'id_usuario' ]) ? $_GET['id_usuario'] : '';
        $usuario = Container::getModel('Usuario');
        //para que o usuario em autenticado na sessão, possa seguir quem ele quer
        $usuario->__set('id',$_SESSION['id']);
        if($acao === 'seguir'){
            $usuario->seguirUsuario($id_usuario_seguindo);
        }else if($acao === 'deixar_de_seguir'){
            $usuario->deixarSeguirUsuario($id_usuario_seguindo);
        }
        //rota
        header('Location: /quem_seguir');
       
    }
}

?>