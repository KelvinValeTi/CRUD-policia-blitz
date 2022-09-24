
<?php
    
    //validando nome
    function validaNome($valor){
        $valor = trim($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        
        return $valor;
    }

    //verifica se tem apenas espaço no primeiro caractere, evitando tambem, que seja passada uma string composta apenas de espaços em branco.
    function espacoPrimeiroCaractere($valor){
        if($valor[0]==" "){
            $valor = true;
        }else{
            $valor=false;
        }
        return $valor;
    }

    /*---- Verifica se tem somente letras---*/
    /** retorna false caso tenha algo diferente de letras e true caso não tenha.
    */
    function somenteLetras($valor){
        if(!preg_match("/^[A-Za-záàâãéèêíïóôõöúçÁÀÂÃÉÈÍÏÓÔÕÖÚÇ ]*$/", $valor)){
            $valor = false;
        }else{
            $valor = true;
        } 

        return $valor;
    }

    function somenteNumeros($valor){
        if(!preg_match("/^[0-9]*$/", $valor)){
            $valor = false;
        }else{
            $valor = true;
        } 

        return $valor;
    }




?>