<?php   

include("db.php");

function getProdutos(){
    $conect = getConnection();
    $query = "select * from produtos";

    return $conect->query($query)->fetchAll();
    
    /*[
        ["titulo"=>"PHP Básico", "descricao"=>"Curso basico de php", "valor"=>"120.90" ],
        ["titulo"=>"PHP PDO", "descricao"=>"Curso basico de php PDO", "valor"=>"140.90" ],
        ["titulo"=>"PHP OO", "descricao"=>"Curso basico de php OO", "valor"=>"15000.90" ],   
    ];*/
}
function buscaProdutos($busca){
    $produtos = getProdutos();
    $result = [];
    foreach($produtos as $produto){
        $existe = in_array(strtolower($busca), array_map('strtolower', $produto));
        if($existe){
            array_push($result, $produto);
        }
    }
    return $result;
}
function adicionarProduto($produto){
    $conect = getConnection();
    $query = "Insert into produtos (titulo,descricao,valor) values (:titulo,:descricao,:valor)";

    $stmt = $conect->prepare($query);

    $stmt->bindValue(':titulo', $produto["titulo"]);
    $stmt->bindValue(':descricao', $produto["descricao"]);
    $stmt->bindValue(':valor', $produto["valor"]);

    $stmt->execute();

    return $conect->lastInsertId();
/*
    echo "<pre>";
    var_dump($produto);exit;*/
}

function produtoEditar($id){
    $conect = getConnection();
    
    $query = "select * from produtos where id = :id";

    $stmt = $conect->prepare($query);
    $stmt->bindValue(':id', (int)$id);   
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
}
function editarProduto($produto){
 //   var_dump($produto);exit;
    $conect = getConnection();
    $query = "update produtos set titulo=:titulo, descricao=:descricao, valor=:valor where id = :id";

    $stmt = $conect->prepare($query);

    $stmt->bindValue(':id', (int)$produto["id"]);
    $stmt->bindValue(':titulo', $produto["titulo"]);
    $stmt->bindValue(':descricao', $produto["descricao"]);
    $stmt->bindValue(':valor', $produto["valor"]);

    return $stmt->execute();
}
function deletarProduto($id){
    $conect = getConnection();

    $query = "Delete from produtos where id=:id";

    $stmt = $conect->prepare($query);
    $stmt->bindValue(':id', (int) $id);
    
    return $stmt->execute();

}