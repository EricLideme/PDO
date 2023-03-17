<?php

require 'classPessoa.php';

$p = new Pessoa("crudpdo", "localhost", "root", "");  



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>mysql</title>
</head>

<body>
    <?php 
    if(isset($_POST['nome'])) // BOTÃO CADASTRAR OU EDITAR. 
    {
        if (isset($_GET["id_up"]) && !empty($_GET["id_up"]))
        {
            $id_upd = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            header("location: index.php");
        
        if (!empty($nome) && !empty($telefone) && !empty($email))
        {
            if(!$p->atualizarDados($id_upd, $nome, $telefone, $email))
            {
                echo "Email já cadastrado!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
        
        }

        // ------------------------ CADASTRAR ------------------------------------------
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        
        if (!empty($nome) && !empty($telefone) && !empty($email))
        {
            if(!$p->Cadastrar($nome, $telefone, $email))
            {
                echo "Email já cadastrado!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
        
    }
    
    ?>

    <?php 
    
    if (isset($_GET["id_up"]))
    {
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscarDadosPessoa($id_update);
    }

    ?>
    <section id="direita">

        <form method="POST">
            <h2>Cadastrar Pessoa</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];} ?>">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];} ?>">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];} ?>">
            <input type="submit" value="Cadastrar"
                value="<?php if(isset($res)){echo 'Atualizar';} else {echo "Cadastrar";} ?>">
        </form>

    </section>
    <section id="esquerda">

        <table>
            <tr id="titulo">
                <td>NOME</td>
                <td>TELEFONE</td>
                <td colspan="2">EMAIL</td>
            </tr>

            <?php 
            
            $dados = $p->buscarDados();
            if (count($dados) > 0)
            {
                for ($i=0; $i < count($dados); $i++) 
                { 

                    echo '<tr>';
                    foreach ($dados[$i] as $k => $v) 
                    {
                        if ($k != "id")
                        {
                            echo "<td> $v </td>";
                        }
                    }
                    ?> <td>
                <a href='index.php?id_up=<?php echo $dados[$i]['id']; ?>'> Editar </a>
                <a href='index.php?id=<?php echo $dados[$i]['id']; ?>'> Excluir </a>
            </td> <?php

                    echo '</tr>';
                }
            } else {
                echo "Ainda não há pessoas cadastradas!";
            }
            
            ?>
            <tr>
            </tr>
        </table>
    </section>
</body>

</html>

<?php 

            if(isset($_GET['id']))
            {
                $id_pessoa = addslashes($_GET['id']);
                $p->Delete($id_pessoa);
                header('location: index.php');
            }

?>