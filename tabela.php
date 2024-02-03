<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <p align=center><a href='Index.php' class="btn btn-dark">Novo</a></p>
        <TABLE class='table table-hover' align=center>
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
                        <TD><a href='Index.php?acao=editar&codigo={$registro["codigo"]}'>Editar</a>
                        <TD><a href='Index.php?acao=excluir&codigo={$registro["codigo"]}'>Excluir</a>";
            }
            ?>
        </table>
    </div>
</body>

</html>