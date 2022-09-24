<?php
    require('validacao.php');
    require('db/config.php');

    //mensagens de erro
    $erroMatricula="";
    $erroNome="";


    //inserir no banco de dados
    if(isset($_POST['matricula'])&& isset($_POST['patente'])&& isset($_POST['nome'])){
        
        //validação de matricula
        if(somenteNumeros($_POST['matricula'])==false){
            $erroMatricula="Só são permitidos números";
        }

        //validação de nome
        if(espacoPrimeiroCaractere($_POST['nome'])){
            $erroNome= "Utilize apenas letras. || Verifique se não há espaços em branco antes do nome.";
            echo"<br>não passou";   
        }

        if(somenteLetras($_POST['nome'])==false){
            $erroNome= "utilize apenas letras. || Verifique se não há espaços em branco antes do nome.";
        }

        //se houver algum erro, não insere no banco de dados.
        if($erroNome=="" && $erroMatricula==""){

            $matricula = $_POST['matricula'];
            $patente = $_POST['patente'];
            $nome = validaNome($_POST['nome']);
            
            $sql = $pdo->prepare("INSERT INTO efetivo_policia VALUES(null,?,?,?) ");
            $sql->execute(array($matricula, $patente, $nome));
        }

    }//if (isset..)

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--STYLE-->
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Cadastro de efetivo policial || CRUD || Kelvin Vale</title>
</head>
<body>
    
    <form method="post">
        <h1>Cadastro de Efetivo Policial - Blitz Lei Seca</h1>

        <label>Matrícula:</label>
        <input type="text" name="matricula" required>
        <span><?php echo"$erroMatricula"; ?></span>

        <label>Patente:</label>
        <select name="patente" id="patente">
            <option value="SD">SD</option>
            <option value="CB">CB</option>
            <option value="3SGT">3º SGT</option>
            <option value="2SGT">2º SGT</option>
            <option value="1SGT">1º SGT</option>
            <option value="SUB-TEN">SUB TEN</option>
            <option value="ASP">ASP</option>
            <option value="2TEN">2º TEN</option>
            <option value="1TEN">1º TEN</option>
            <option value="CAP">CAP</option>
            <option value="MAJ">MAJ</option>
            <option value="TEN-CEL">TEN CEL</option>
            <option value="CEL">CEL</option>
        </select>

        <label>Nome:</label>
        <input type="text" name="nome" required>
        <span><?php echo"$erroNome"; ?></span>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>