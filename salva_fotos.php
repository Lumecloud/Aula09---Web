<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Processando Envio</title>
</head>
<body>
<?php

if (isset($_FILES['figura']) && $_FILES['figura']['error'] == 0) {

    
    $nome_original = $_FILES['figura']['name'];
    
    
    $local_temporario = $_FILES['figura']['tmp_name'];
    
    
    $pasta_destino = 'fotos/';
    
    
    $caminho_final = $pasta_destino . $nome_original;
    
    
    if (move_uploaded_file($local_temporario, $caminho_final)) {
        
        echo "<h1>Sucesso!</h1>";
        echo "<p>O arquivo <strong><?php echo htmlspecialchars($nome_original); ?></strong> foi salvo com sucesso na pasta 'fotos'.</p>";
    } else {
        
        echo "<h1>Erro ao mover o arquivo.</h1>";
        echo "<p>Verifique se a pasta 'fotos' existe e se o servidor (Apache/XAMPP) tem permissão para escrever nela.</p>";
    }
    
} else {
    
    echo "<h1>Erro no envio.</h1>";
    echo "<p>Nenhum arquivo foi recebido ou ocorreu um erro no upload.</p>";
}
?>

<br>
<a href="index.php">Enviar outra imagem</a>

</body>
</html>