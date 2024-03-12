<?php
include "config.php";

$name = $_POST["name"];
$amount = $_POST["amount"];

$sql = "INSERT INTO bids (name, amount) VALUES ('$name', '$amount')";

if ($conn->query($sql) === TRUE) {
    echo "Lance salvo com sucesso!";
} else {
    echo "Erro ao salvar o lance: " . $conn->error;
}

$conn->close();
?>