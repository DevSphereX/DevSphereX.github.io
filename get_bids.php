<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Seleciona todos os lances do banco de dados
$sql = "SELECT * FROM bids";
$result = $conn->query($sql);

// Cria um array para armazenar os lances
$bids = array();

// Adiciona os lances ao array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bids[] = array("name" => $row["name"], "amount" => $row["amount"]);
    }
}

// Retorna os lances em formato JSON
echo json_encode($bids);

// Fecha a conexão com o banco de dados
$conn->close();
?>
