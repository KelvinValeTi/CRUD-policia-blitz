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

        //ATUALIZANDO POLICIAL
        //se houver algum erro, não insere no banco de dados.
        if($erroNome=="" && $erroMatricula==""){

            $id = $_REQUEST['id'];
            $matricula = $_POST['matricula'];
            $patente = $_POST['patente'];
            $nome = validaNome($_POST['nome']);
            
            $sql = $pdo->prepare("UPDATE efetivo_policia SET matricula=?, patente=?, nome=? WHERE id=?");
            $sql->execute(array($matricula,$patente,$nome,$id));
            
            echo "<p class='alert alert-success'>ALTERADO com sucesso!</p>";
            header("location: index.php");
        }

    }//if (isset..)

?>


<form method="post">

    <h1>Atualizar Policial</h1>
        
    <div class="container">             
        <label>Matrícula:</label>
        <input type="text" name="matricula" 
        value="<?php print $dados['matricula'];?>" required>

        <span><?php echo"$erroMatricula"; ?></span>
    </div>

    <div class="container">
        <label>Patente:</label>
        <select name="patente" id="patente">
            <option value="<?php print $dados['patente'];?>"><?php print $dados['patente'];?></option>
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
    </div>

    <div class="container">
        <label>Nome:</label>
        <input type="text" name="nome" 
        value="<?php print $dados['nome'];?>" required>
        <span><?php echo"$erroNome"; ?></span>
    </div>

    <div class="container">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</form>

<button class="btn btn-primary"><a class="nav-link" href="index.php">Voltar</a></button>

