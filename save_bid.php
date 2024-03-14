<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Recebe os dados do lance do frontend
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$amount = $data['amount'];

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Insere o lance no banco de dados
$sql = "INSERT INTO bids (name, amount) VALUES ('$name', $amount)";
if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => $conn->error));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
