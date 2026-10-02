<?php

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if($metodo == "POST"){

    $json = file_get_contents("php://input");

    $dados = json_decode($json,true);

    $sql = "INSERT INTO equipamentos (equipamento,setor,descricao,prioridade,status) VALUES (?,?,?,?,?)";

    $comando = $pdo -> prepare($sql);

    $comando -> execute([
        $dados["equipamento"],
        $dados["setor"],
        $dados["descricao"],
        $dados["prioridade"],
        $dados["status"]
    ]);

    echo json_encode(["Mensagem"=>"Chamado cadastrado com sucesso."]);

};


if($metodo == "GET"){

    $sql = "SELECT * FROM equipamentos ORDER BY id";

    $comando = $pdo -> query($sql);

    $equipamentos = $comando -> fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($equipamentos);
};

if($metodo =="PUT"){

    $json = file_get_contents("php://input");

    $dados = json_decode($json,true);

    $sql = "UPDATE equipamentos SET equipamento=?,setor=?,descricao=?,prioridade=?,status=? WHERE id=?";

    $comando = $pdo -> prepare($sql);

    $comando -> execute([
        $dados["equipamento"],
        $dados["setor"],
        $dados["descricao"],
        $dados["prioridade"],
        $dados["status"],
        $dados["id"]
    ]);

    echo json_encode(["Mensagem"=>"Chamado atualizado com sucesso."]);
};

if($metodo == "DELETE"){

    $json = file_get_contents("php://input");

    $dados = json_decode($json,true);

    $sql = "DELETE FROM equipamentos WHERE id=?";

    $comando = $pdo -> prepare($sql);

    $comando -> execute([
        $dados["id"]
    ]);

    echo json_encode(["Mensagem"=>"Chamado deletado com sucesso"]);
};

?>