<?php
    require('db/config.php');
    require('validacao.php');
?>

<div class="container">
    <p>O efetivo é exibido por ordem de patente, da maior para a menor.</p>
</div>

<div class="container">
    <?php
        //listando os elementos
        $sql = $pdo->prepare("SELECT * FROM efetivo_policia");
        $sql->execute();

        $dados = $sql->fetchAll();

        //verificando se existem dados na tabela
        if(count($dados)>0){
            echo"<table>
                    <tr>
                        <th>ID</th>
                        <th>Matricula</th>
                        <th>Patente</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>";

            foreach($dados as $chave=>$valor){
                echo "<tr>
                        <td>".$valor['id']."</td>
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