<?php 
    require_once 'connect.php';

    session_start();

    if(!isset($_SESSION['logado'])) {
        header('Location: index.php');
    }

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logado</title>
</head>
<body>
    <h3>Seja bem vindo <?php echo $dados['nome']; ?></h3>
    <a href="logout.php">Sair</a>
</body>
</html>