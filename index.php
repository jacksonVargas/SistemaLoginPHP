<?php 
    require_once 'connect.php';
    session_start();


    if(isset($_POST['logar'])) {
        $erros = array();
        $nome = mysqli_escape_string($connect, $_POST['nome']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);

        if(empty($nome) or empty($senha)) {
            $erros[] = "Campos devem ser preenchidos";
        }else {
            $sql = "SELECT nome FROM users WHERE nome = '$nome'";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0) {
                $senha = md5($senha);
                $sql = "SELECT * FROM users WHERE nome = '$nome' AND senha = '$senha'";
                $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) == 1) {
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('Location: home.php');
                }else {
                    $erros[] = "Usuário e senhas não conferem";
                }
            }else {
                $erros[] = "Usuário não existe";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h3>Login</h3>
    <?php 
      if(!empty($erros)) {
        foreach($erros as $erro) {
            echo $erro;
        }
      }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <p>Nome</p>
        <input type="text" name="nome" />
        <p>Senha</p>
        <input type="password" name="senha" />
        <button type="submit" name="logar">Logar</button>
    </form>
</body>
</html>