<?php
try{
    $servidor="localhost";
    $usuario="root";
    $senha="";
    $dbname="bdagenda";
    //criando a conexão
    //$conn = mysqli_connect($servidor, $usuario, $senha, $dbname) or die ("erro");
    $connpdo = new PDO("mysql:host=$servidor;dbname=$dbname", $usuario, $senha);
}catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage() . "<\br>";
    exit;
  }
?>