<?php

include_once "Conexao.php";
session_start();

if(isset($_POST["enviar"])){
    $primeira_moeda = $_POST["select1"];
    $segunda_moeda = $_POST["select2"];

    //Verificando se o usuário escolheu moedas
    if(!($primeira_moeda == "" || $segunda_moeda == "")){

        //Verificando se as moedas estão iguais
        if(!($primeira_moeda == $segunda_moeda)){

            //Instânciando a classe
            $cotacao = new Conexao;

            //Colocando os dados em uma variavel
            $cotacao_moeda = $cotacao -> Cotacao_moeda($primeira_moeda, $segunda_moeda);

            //Colocando a variavel em uma sessão
            $_SESSION["cotacao"] = $cotacao_moeda;

            header("Location: index.php");

        } else {
            $_SESSION["mensagem"] = "Moedas iguais";
            header("Location: index.php");
        }

    } else {
        $_SESSION["mensagem"] = "Você precisa selecionar a moeda";
        header("Location: index.php");
    }
}