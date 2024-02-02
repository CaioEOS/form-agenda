<?php
include_once('conexao.php');
$sql = "SELECT * FROM tbcontatos ORDER BY nome";
$res = $connpdo->query($sql);
$total = $res->rowCount();
echo "<H3 align = center> O Total de Contatos é: $total </H3>";

echo "<TR class = 'table-dark'>
            <TD> CODIGO
            <TD> NOME
            <TD> TELEFONE
            <td> ALTERAR
            <td> EXCLUIR";
while ($registro = $res->fetch(PDO::FETCH_ASSOC)) {
    echo "<TR>
            <TD>{$registro["codigo"]}
            <TD>{$registro["nome"]}
            <TD>{$registro["telefone"]}
            <TD><a href='?acao=editar&codigo={$registro["codigo"]}'>Editar</a>
            <TD><a href='?acao=excluir&codigo={$registro["codigo"]}'>Excluir</a>";
}