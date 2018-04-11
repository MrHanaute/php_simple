<?php 

function getInfo($atributo){
	$dados = [ "titulo"=>"Site Base PHP Pure","descricao"=>"Programming with pure PHP, no frameworks." ];
	return $dados[$atributo];
}