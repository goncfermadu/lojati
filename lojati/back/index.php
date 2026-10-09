<?php

require "config.php";

$rota = $_GET["rota"] ?? "teste";

function teste() {
    echo json_encode([
        "mensagem" => "Back-end respondendo"
    ]);
}

function listarClientes($con) {
    $stmt = $con->query("SELECT * FROM clientes");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC),
        JSON_UNESCAPED_UNICODE
    );
}

function cadastrarClientes($con) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    $stmt = $con->prepare("INSERT INTO clientes (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $endereco,]);

    header("Location: ../front/clientes.html");
}
    switch ($rota) {
    case "clientes":
        listarClientes($con);
        break;
    case "clientes/create":
        cadastrarClientes($con);
        break;
    default:
        teste();
        break;
}
