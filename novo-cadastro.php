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
            $erroNome= "Utilize apenas letras. || Verifique se não há espaços em branco antes do nome.";
        }

        //emitindo erro
        if(!$erroMatricula==""){
            echo"<p class='mt-1 text-center alert alert-danger'>$erroMatricula</p>";
        }
        if(!$erroNome==""){
            echo"<p class='mt-1 text-center alert alert-danger'>$erroNome</p>";
        }
        

        //se houver algum erro, não insere no banco de dados.
        if($erroNome=="" && $erroMatricula==""){

            $matricula = $_POST['matricula'];
            $patente = $_POST['patente'];
            $nome = validaNome($_POST['nome']);
            
            $sql = $pdo->prepare("INSERT INTO efetivo_policia VALUES(null,?,?,?) ");
            $sql->execute(array($matricula, $patente, $nome));

            echo"<p class='mt-1 text-center alert alert-success'>Cadastrado com sucesso!</p>";

        }

    }//if (isset..)

?>
    
<form method="post" class="mt-5">
<div class="m-4 p-4">
        <div class="container w-100 p3 text-center">  
            <h2>Cadastro de Efetivo Policial - Blitz Lei Seca</h2>
        </div>

        <div class="row align-items-start p-3">             
            <div class="col p-3">
                <label class="form-label text-start">Matrícula:</label>
                <input type="text" class="form-control input-group text-center" name="matricula" required>
            </div>
            
            <div class="col p-3">
                <label class="form-label text-start">Patente:</label>
                <select class="input-group form-control" name="patente" id="patente">
                    <option value="SD">Soldado</option>
                    <option value="CB">Cabo</option>
                    <option value="3SGT">3º Sargento</option>
                    <option value="2SGT">2º Sargento</option>
                    <option value="1SGT">1º Sargento</option>
                    <option value="SUB-TEN">Sub-tenente</option>
                    <option value="ASP">Aspira</option>
                    <option value="2TEN">2º Tenente</option>
                    <option value="1TEN">1º Tenente</option>
                    <option value="CAP">Capitão</option>
                    <option value="MAJ">Major</option>
                    <option value="TEN-CEL">Tenente Coronel</option>
                    <option value="CEL">Coronel</option>
                </select>
            </div>    
        </div>

        
        <div class="w-100 p-3">
            <label class="form-label text-start">Nome:</label>
            <input type="text" class="form-control input-group w-100" 
            name="nome" required>
        </div>

        <div class="container p-3 text-center">
            <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
        </div>
    </div>
</form>
