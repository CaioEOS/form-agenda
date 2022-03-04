<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            include_once('conexao.php');

            $btnName = "btnCad";
            $btnValue = "Cadastrar";
            if(!isset($_REQUEST['Codigo'])) $_REQUEST['Codigo']="";
            if(!isset($_REQUEST['Nome'])) $_REQUEST['Nome']="";
            if(!isset($_REQUEST['Telefone'])) $_REQUEST['Telefone']="";

            if(isset($_POST['btnCad'])){
                //recebe os dados do formulário
                $nome = $_POST['Nome'];
                $telefone = $_POST['Telefone'];
                //verifica se o nome e telefone já existem no Banco de dados
                $sql = "SELECT * FROM tbcontatos WHERE nome='$nome' and telefone='$telefone'";
                $res = $connpdo->query($sql);
                if($res->rowCount() == 0){
                    //monta a string de inserção de dados
                    $insere = "INSERT INTO tbcontatos (nome,telefone) VALUES ('$nome', '$telefone')";
                    //executa o sql
                    $connpdo->query($insere);
                    //fecha a conexão com banco de dados
                    $_REQUEST['Nome']="";
                    $_REQUEST['Telefone']="";
                }else{
                    echo"<H4 align = center> Impossivel Cadastrar. $nome Já existe. </H4>";
                }
            }
            //Deleta do Banco de dados
            elseif(isset($_POST['btnDel'])){
                $sql = "DELETE FROM tbcontatos WHERE codigo = $_REQUEST[Codigo] ";
                $connpdo->query($sql);
                $_REQUEST['Codigo'] = "";
                $_REQUEST['Nome']="";
                $_REQUEST['Telefone']="";
            }
            //Atualiza o banco de dados
            elseif(isset($_POST['btnSalvar'])){
                $sql = "UPDATE tbcontatos SET nome = '$_REQUEST[Nome]', telefone = '$_REQUEST[Telefone]' WHERE codigo = $_REQUEST[Codigo] ";
                $connpdo->query($sql);
                $_REQUEST['Codigo'] = "";
                $_REQUEST['Nome']="";
                $_REQUEST['Telefone']="";            
            }

            if(isset($_GET['acao'])){
                $sql = "SELECT * FROM tbcontatos WHERE codigo = '{$_GET['codigo']}' ";
                $res = $connpdo->query($sql);
                $registro = $res->fetch(PDO::FETCH_ASSOC);
                $_REQUEST["Codigo"] = $registro["codigo"];
                $_REQUEST["Nome"] = $registro["nome"];
                $_REQUEST["Telefone"] = $registro["telefone"];
                    if($_GET['acao']=="excluir"){
                        $btnName = "btnDel";
                        $btnValue = "Excluir Definitivamento";
                    } else {
                        $btnName = "btnSalvar";
                        $btnValue = "Salvar Alterações";        
                    }
            }
        ?>

        <form method="POST" action="lista.php" align = center>
            <input type="hidden" name="Codigo" value="<?php echo $_REQUEST["Codigo"] ?>">
            Nome: <input type="text" name="Nome" value="<?php echo $_REQUEST["Nome"] ?>" required ><p>
            Telefone: <input type="number" name="Telefone" value="<?php echo $_REQUEST["Telefone"] ?>" required step="0.01" ><p>
            
            <input type="submit" value="<?php echo $btnValue ?>" name="<?php echo $btnName ?>">
        </form>

        <?php
            include_once('conexao.php');
            $sql = "SELECT * FROM tbcontatos ORDER BY nome";
            $res = $connpdo->query($sql);
            $total = $res->rowCount();
            echo "<H3 align = center> O Total de Contatos é: $total </H3>
            <p align = center><a href='?'>Novo</a></p>";
            echo "<TABLE BORDER = 10 align = center >
            <TR>
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
            echo "</TABLE>";
        ?>
    </body>
</html>
