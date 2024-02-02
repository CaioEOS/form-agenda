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