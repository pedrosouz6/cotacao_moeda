<?php
require_once "Conexao.php";
session_start();
session_destroy();

//Instanciando a class que tem os nomes das moedas
$instacia_moedas = new Conexao;
$moedas = $instacia_moedas -> Obter_todas_moedas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotação</title>
    <link rel="stylesheet" href="s1.css">
</head>
<body>
    <section>
        <form action="pegarValores.php" method="post">

            <div class="escolher_moedas">

                <select name="select1">
                    <option hidden value="">Escolha a moeda</option>
                    <option value="BRL">Real Brasileiro</option>
    
                    <?php
                    //Pegar os nomes de cada moeda
                    foreach($moedas as $nome_moedas){
                        $dados_nome = $nome_moedas["name"];
                        $nome = explode("/", $dados_nome);
    
                        //Criando options com seus devido valores
                        $sigla_moeda = $nome_moedas['code'];
                        echo "<option value='$sigla_moeda'>$nome[0]</option>";
                    }
                    ?>
                </select>
    
                <p>Para</p>
    
                <select name="select2">
                    <option hidden value="">Escolha a moeda</option>
                    <option value="BRL">Real Brasileiro</option>
    
                    <?php
                    //Pegar os nomes de cada moeda
                    foreach($moedas as $nome_moedas){
                        $dados_nome = $nome_moedas["name"];
                        $nome = explode("/", $dados_nome);
                        
                        //Criando options com seus devido valores
                        $sigla_moeda = $nome_moedas['code'];
                        echo "<option value='$sigla_moeda'>$nome[0]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="container_grid">
                <article>
                    <?php

                    if(isset($_SESSION["cotacao"])){

                        if(!(count($_SESSION["cotacao"]) > 1)){
                            

                    ?>
                        <div class="valor_convertido">
                            <p><?php echo $_SESSION["cotacao"][0]?></p>
                        </div>

                    <?php

                    } else {
                        $dados_cotacao = $_SESSION["cotacao"];
                        $format_bid = number_format($dados_cotacao["bid"], 2, ",", ".");
                    ?>

                        <div class="valor_convertido">
                            <p><span>1</span> <?php echo $dados_cotacao["code"]?> é igual a <?php echo $format_bid?> <?php echo $dados_cotacao["codein"]?></p>
                        </div>

                    <?php
                    }};
                    ?>
                </article>
                <input type="submit" value="Enviar" name="enviar">
            </div>

            <?php
            if(isset($_SESSION["mensagem"])){
            ?>

            <div class="msg_erro">
                <p><?php echo $_SESSION["mensagem"]?></p>
            </div>

            <?php
            };
            ?>
        </form>
    </section>
</body>
</html>