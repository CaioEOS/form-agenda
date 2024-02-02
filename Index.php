<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <?php 
        include 'cadastro.php'; 
        ?>

        <form method="POST" action="">
            <div class="d-flex justify-content-center">
                <div class="mb-3 col-2">
                    <input type="hidden" name="Codigo" value="<?php echo $_REQUEST["Codigo"] ?>">
                    <label for="Nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="Nome" id="Nome"
                        value="<?php echo $_REQUEST["Nome"] ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="mb-3 col-2">
                    <label for="Telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" name="Telefone" id="Telefone" maxlength="15"
                        onkeyup="handlePhone(event)" value="<?php echo $_REQUEST["Telefone"] ?>" required>
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