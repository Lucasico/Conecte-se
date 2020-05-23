<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse(){
		$this->view->usuario = array(
			'nome' => '',
			'email' => '',
			'senha' => '',
		);
		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}

	public function registrar(){
		
		$usuario = Container::getModel('Usuario');
		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',md5($_POST['senha']));
		if($usuario->validaCadastro() && count($usuario->getUsuarioPorEmail()) == 0){
		
			$usuario->save();
			$this->render('cadastro');
				
		} else {
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha']
			);
			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}
		
	}

	public function alterarRegistro(){
		if( ( empty($_POST['senha']) || empty($_POST['confirmaSenha']) ) || ( $_POST['senha'] != $_POST['confirmaSenha'] ) ){
			header('Location: ../timeline?senhasDivergentes=true');
		}
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id',$_POST['usuario_id']);
		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',md5($_POST['senha']));
		$usuario->alterarRegistro();
		header('Location:../timeline');

		
	}

}


?>