<?php 

include('configuracao.php');
include('usuarios.php');
include('produtos.php');
include('validacao.php');

function getPagina(){
	$url = $_SERVER["REQUEST_URI"];
	$url = explode( "?", $url );
	$method = $_SERVER["REQUEST_METHOD"];

	if($method === "GET"){

		switch($url[0]){
			case "/":
				$produtos = getProdutos();
				include("Paginas/home.php");
				break;
			case "/home":
				$produtos = getProdutos();
				include("Paginas/home.php");
				break;
			case "/sobre":
				include("Paginas/sobre.php");
				break;
			case "/contato":
				include("Paginas/contato.php");
				break;
			case "/busca":
				$produtos = buscaProdutos($_GET['busca']);
				include("Paginas/home.php");
				break;
			case "/produto/editar":
				$produtoEditar = produtoEditar($_GET["id"]);
				$produtos = getProdutos();
				$flagEdit = true;
				include("Paginas/home.php");
				break;	
			case "/produto/deletar":
				if(!deletarProduto($_GET["id"])){
					$err = "Erro ao Deletar!";
				}
				header('location: ../');				
				break;		
			default:
				$produtos = getProdutos();
				include("Paginas/home.php");
				break;
				
		}

	}
	if($method === "POST"){

		switch($url[0]){
			case "/produto/adicionar":
				$validacao = validaProdutos($_POST);
				if($validacao){
					$err_valida = $validacao; 
					$produtos = getProdutos();
					include("Paginas/home.php");
					break;	
				}

				if(!adicionarProduto($_POST)){
					$err = "Erro ao Adicionar!";
					$produtos = getProdutos();
					include("Paginas/home.php");
					break;							
				}
				header('location: ../');
				break;
			case "/produto/salvar":
				$validacao = validaProdutos($_POST);
				$err_valida = $validacao;

				if($validacao){
					$produtoEditar = $_POST;
					$produtos = getProdutos();
					$flagEdit = true;
					include("Paginas/home.php");
					break;	
				}
				if(!editarProduto($_POST)){
					$err = "Erro ao Atualizar!";
					$produtos = getProdutos();
					include("Paginas/home.php");
					break;							
				}
				header('location: ../');
				break;
			default:
				$produtos = getProdutos();
				include("Paginas/home.php");
				break;
				
		}

	}
}