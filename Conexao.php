<?php

class Conexao{
    //Função para pegar todas as moedas
    public function Obter_todas_moedas(){
        //Iniciando o curl
        $curl = curl_init();

        //Configurações do curl
        curl_setopt_array($curl,[
            CURLOPT_URL => "economia.awesomeapi.com.br/json/all/",
            CURLOPT_RETURNTRANSFER => true,
        ]);

        //Retorno da requisição
        $resposta = curl_exec($curl);

        //Convertendo para array
        $todas_moedas = json_decode($resposta,true);

        //Retornanto o array
        return $todas_moedas;

        //Fechando o curl
        curl_close($curl);
    }

    //Função para pegar a contação da moeda
    public function Cotacao_moeda($primeira_m, $segunda_m){
        //Iniciando o curl
        $curl = curl_init();

        //Configurações do curl
        curl_setopt_array($curl, [
            CURLOPT_URL => "economia.awesomeapi.com.br/json/last/$primeira_m-$segunda_m",
            CURLOPT_RETURNTRANSFER => true
        ]);

        //Retorno da requisição
        $resposta = curl_exec($curl);

        //Convertendo para array
        $cotacao = json_decode($resposta,true);

        //Retornanto o array com a os dados da cotação
        if(isset($cotacao["status"])){
            return [$cotacao["message"]." na API"];
        } else {
            return $cotacao[$primeira_m.$segunda_m];
        }

        //Fechando o curl
        curl_close($curl);
    }
}