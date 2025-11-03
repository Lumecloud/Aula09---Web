<?php


include 'conexao.php';

if (isset($_GET['id'])) {
    
    $id_imagem = $_GET['id'];
    
    try {
        
        $sql = "UPDATE imagens_ex4 SET curtidas = curtidas + 1 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_imagem]);
        
    } catch (PDOException $e) {
        
    }
}

header("Location: index.php");
exit;
?>