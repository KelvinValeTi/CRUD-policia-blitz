<?php
   require('db/config.php');
   require('validacao.php');
?>

<!---Preenchendo a tabela com os dados recebidos por REQUEST--->
<?php
   $id = $_REQUEST["id"];
   $sql = $pdo->prepare("SELECT * FROM efetivo_policia WHERE id=?");
   $sql->execute(array($id));
   $dados = $sql->fetch();
?>

<?php
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

        //emitindo erro
        if(!$erroMatricula==""){
            echo"<p class='mt-1 text-center alert alert-danger'>$erroMatricula</p>";
        }
        if(!$erroNome==""){
            echo"<p class='mt-1 text-center alert alert-danger'>$erroNome</p>";
        }

        //ATUALIZANDO POLICIAL
        //se houver algum erro, não insere no banco de dados.
        if($erroNome=="" && $erroMatricula==""){

            $id = $_REQUEST['id'];
            $matricula = $_POST['matricula'];
            $patente = $_POST['patente'];
            $nome = validaNome($_POST['nome']);
            
            $sql = $pdo->prepare("UPDATE efetivo_policia SET matricula=?, patente=?, nome=? WHERE id=?");
            $sql->execute(array($matricula,$patente,$nome,$id));
            
            header("location: index.php");
        }

    }//if (isset..)

?>


<form method="post" class="mt-5">

<div class="m-4 p-4">
    <div class="container w-100 p3 text-center"> 
        <h2>Atualizar Policial</h2>
    </div>
            
    <div class="row align-items-start p-3">             
        <div class="col p-3">
            <label class="form-label text-start">Matrícula:</label>
            <input type="text" class="form-control input-group text-start" name="matricula" 
            value="<?php print $dados['matricula'];?>" required>
        </div>

        <div class="col p-3">
            <label class="form-label text-start">Patente:</label>
            <select class="input-group form-control" name="patente" id="patente">
                <option value="<?php print $dados['patente'];?>"><?php print $dados['patente'];?></option>
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
            name="nome" 
            value="<?php print $dados['nome'];?>" required>
            <span><?php echo"$erroNome"; ?></span>
        </div>

        <div class="container p-1 text-center">
            <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
        </div>
    </div>

    <div class="container text-center">
        <button class="btn btn-danger btn-lg"><a class="nav-link" href="?page=listar">Cancelar</a></button>
    </div>
</form>

