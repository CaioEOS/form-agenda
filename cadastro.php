<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <?php

        include_once('conexao.php');

        $btnName = "btnCad";
        $btnValue = "Cadastrar";
        if (!isset($_REQUEST['Codigo'])) $_REQUEST['Codigo'] = "";
        if (!isset($_REQUEST['Nome'])) $_REQUEST['Nome'] = "";
        if (!isset($_REQUEST['Telefone'])) $_REQUEST['Telefone'] = "";

        if (isset($_POST['btnCad'])) {
            //recebe os dados do formulário
            $nome = $_POST['Nome'];
            $telefone = $_POST['Telefone'];
            //verifica se o nome e telefone já existem no Banco de dados
            $sql = "SELECT * FROM tbcontatos WHERE nome='$nome' and telefone='$telefone'";
            $res = $connpdo->query($sql);

            if ($res->rowCount() == 0) {
                //monta a string de inserção de dados
                //Aqui, estou fornecendo um valor fictício para o campo 'alterar'
                $insere = "INSERT INTO tbcontatos (nome, telefone, alterar, excluir) VALUES ('$nome', '$telefone', '0', '$excluir')";
                //            $insere = "INSERT INTO tbcontatos (nome,telefone) VALUES ('$nome', '$telefone')";
                //executa o sql
                $connpdo->query($insere);
                //fecha a conexão com banco de dados
                $_REQUEST['Nome'] = "";
                $_REQUEST['Telefone'] = "";
            } else {
                echo "<div class='alert alert-danger' role='alert'>";
                echo "<H4 align = center> Impossivel Cadastrar. $nome Já existe. </H4>";
                echo "</div>";
            }
        }
        //Deleta do Banco de dados
        elseif (isset($_POST['btnDel'])) {
            $sql = "DELETE FROM tbcontatos WHERE codigo = $_REQUEST[Codigo] ";
            $connpdo->query($sql);
            $_REQUEST['Codigo'] = "";
            $_REQUEST['Nome'] = "";
            $_REQUEST['Telefone'] = "";
        }
        //Atualiza o banco de dados
        elseif (isset($_POST['btnSalvar'])) {
            $sql = "UPDATE tbcontatos SET nome = '$_REQUEST[Nome]', telefone = '$_REQUEST[Telefone]' WHERE codigo = $_REQUEST[Codigo] ";
            $connpdo->query($sql);
            $_REQUEST['Codigo'] = "";
            $_REQUEST['Nome'] = "";
            $_REQUEST['Telefone'] = "";
        }
        if (isset($_GET['acao'])) {
            $sql = "SELECT * FROM tbcontatos WHERE codigo = '{$_GET['codigo']}' ";
            $res = $connpdo->query($sql);
            $registro = $res->fetch(PDO::FETCH_ASSOC);
            $_REQUEST["Codigo"] = $registro["codigo"];
            $_REQUEST["Nome"] = $registro["nome"];
            $_REQUEST["Telefone"] = $registro["telefone"];
            if ($_GET['acao'] == "excluir") {
                $btnName = "btnDel";
                $btnValue = "Excluir Definitivamento";
            } else {
                $btnName = "btnSalvar";
                $btnValue = "Salvar Alterações";
            }
        }
        ?>
        <form method="POST" action="cadastro.php">
            <div class="d-flex justify-content-center">
                <div class="mb-3 col-2">
                    <input type="hidden" name="Codigo" value="<?php echo $_REQUEST["Codigo"] ?>">
                    <label for="Nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="Nome" id="Nome" value="<?php echo $_REQUEST["Nome"] ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="mb-3 col-2">
                    <label for="Telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" name="Telefone" id="Telefone" maxlength="15" onkeyup="handlePhone(event)" required="" value="<?php echo $_REQUEST["Telefone"] ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <input type="submit" class="btn btn-dark" value="<?php echo $btnValue ?>" name="<?php echo $btnName ?>">
            </div>
        </form>
        <p align=center><a href='?' class="btn btn-dark">Novo</a></p>

        <TABLE class='table table-hover' align=center>
            <?php
            include "lista.php";
            ?>
        </table>
    </div>
</body>
<script src="script.js"></script>

</html>