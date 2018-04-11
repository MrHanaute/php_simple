<?php

function validaProdutos($dados){
    $err_validator = false;

    if($dados['titulo'] == '')
        $err_validator .= "<li>Falta o titulo</li>";
    if($dados['descricao'] == '')
        $err_validator .= "<li>Falta a Descrição</li>";
    if($dados['valor'] == '')
        $err_validator .= "<li>Falta o Valor</li>";


    return $err_validator;
}