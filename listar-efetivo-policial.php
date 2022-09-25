<?php
    require('db/config.php');
    require('validacao.php');
?>

<div class="container">
    <h2 class="mt-4 text-center">Efetivo policial</h2>
</div>

<div class="container">
    <?php
        //listando os elementos
        $sql = $pdo->prepare("SELECT * FROM efetivo_policia");
        $sql->execute();

        $dados = $sql->fetchAll();

        //verificando se existem dados na tabela
        if(count($dados)>0){
            echo"<table class='table table-bordered table-striped text-center'>
                    <tr>
                        <th>Matricula</th>
                        <th>Patente</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>";

            foreach($dados as $chave=>$valor){
                echo "<tr>
                        <td>".$valor['matricula']."</td>
                        <td>".$valor['patente']."</td>
                        <td>".$valor['nome']."</td>

                        <td>
                            <button onclick=\"location.href='?page=atualizar&id=".$valor['id']."';\" class='btn btn-success'>Atualiza</button>

                            <button onclick=\"location.href='?page=delete&id=".$valor['id']."';\" class='btn btn-danger'>Excluir</button>
                        </td>
                    </tr>";
            } 
        echo"</table>";
            
        }else{
            echo"<p class='alert alert-danger'>Não há dados a serem exibidos</p>";
        }
    ?>
</div>