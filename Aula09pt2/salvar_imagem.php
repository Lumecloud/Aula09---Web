<?php


include 'conexao.php';

if (isset($_FILES['figura']) && $_FILES['figura']['error'] == 0) {
    
    $nome_original = $_FILES['figura']['name'];
    $local_temporario = $_FILES['figura']['tmp_name'];
    
    $extensao = pathinfo($nome_original, PATHINFO_EXTENSION);
    $novo_nome = uniqid() . '-' . time() . '.' . $extensao;
    
    $pasta_destino = 'fotos/';
    $caminho_final = $pasta_destino . $novo_nome;

    if (move_uploaded_file($local_temporario, $caminho_final)) {
        
        try {
            
            $sql = "INSERT INTO imagens_ex4 (caminho) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$caminho_final]);
            
        } catch (PDOException $e) {
            
            die("Erro ao salvar no banco de dados: " . $e->getMessage());
        }

    } else {
        die("Erro ao mover o arquivo. Verifique se a pasta 'fotos' existe e tem permissão de escrita.");
    }
    
} else {
    die("Erro no envio do arquivo. Código do erro: " . $_FILES['figura']['error']);
}

header("Location: index.php");
exit;
?>