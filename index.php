<?php
$servername = "localhost";
$username = "seu_nome_de_usuario";
$password = "sua_senha";
$dbname = "nome_do_banco_de_dados";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Cria a query SQL que irá selecionar os dados das tabelas relacionadas
$sql = "SELECT Tb_banco.nome AS nome_do_banco, Tb_convenio.verba, Tb_contrato.codigo AS codigo_do_contrato, Tb_contrato.data_inclusao, Tb_contrato.valor, Tb_contrato.prazo
FROM Tb_contrato
INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.servico
INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo
INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo";

$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Exibe os dados na tela
    while($row = $result->fetch_assoc()) {
        echo "Nome do banco: " . $row["nome_do_banco"]. "<br>";
        echo "Verba: " . $row["verba"]. "<br>";
        echo "Código do contrato: " . $row["codigo_do_contrato"]. "<br>";
        echo "Data de inclusão: " . $row["data_inclusao"]. "<br>";
        echo "Valor: " . $row["valor"]. "<br>";
        echo "Prazo: " . $row["prazo"]. "<br>";
        echo "<br>";
    }
} else {
    echo "Não foram encontrados registros.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>