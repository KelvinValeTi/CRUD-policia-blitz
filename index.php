<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--STYLE BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de efetivo policial || CRUD || Kelvin Vale</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=novo">Novo Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=listar">Listar Efetivo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    


    <?php
        require('db/config.php');

        switch(@$_REQUEST['page']){
            case "novo":
                include("novo-cadastro.php");
                break; 
            case "listar":
                include("listar-efetivo-policial.php");
                break;
            case "atualizar":
                include("atualizar-policial.php");
                break;
            case "delete":
                /**
                * DELETAR DADOS
                * */
                    $id = $_REQUEST["id"];
                    $sql=$pdo->prepare("DELETE FROM efetivo_policia WHERE id=?");
                    $sql->execute(array($id));

                    include("listar-efetivo-policial.php");

                    echo "<p class='alert alert-success'>Deletado com sucesso!</p>";
                break;

            default:
                include("carrosel.php");
        }
    ?>

    <!--SCRIPT BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>