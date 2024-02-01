<?php
try{
    $servidor="localhost";
    $usuario="caio";
    $senha="$-12.02.Rc";
    $dbname="bdagenda";
    //criando a conexão
    //$conn = mysqli_connect($servidor, $usuario, $senha, $dbname) or die ("erro");
    $connpdo = new PDO("mysql:host=$servidor;dbname=$dbname", $usuario, $senha);
}catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage() . "<\br>";
    exit;
  }
?>