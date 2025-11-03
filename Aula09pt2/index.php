<?php
// index.php

include 'conexao.php';

try {
    // CORRIGIDO: O nome da tabela é 'imagens_ex4'
    $stmt_curtidas = $pdo->query("SELECT * FROM imagens_ex4 ORDER BY curtidas DESC LIMIT 5");
    $mais_curtidas = $stmt_curtidas->fetchAll();

    // CORRIGIDO: O nome da tabela é 'imagens_ex4'
    $stmt_novas = $pdo->query("SELECT * FROM imagens_ex4 ORDER BY data_envio DESC LIMIT 5");
    $mais_novas = $stmt_novas->fetchAll();

} catch (PDOException $e) {
    die("Erro ao buscar imagens: " . $e->getMessage());
}

$galeria = [];
$ids_na_galeria = [];

foreach ($mais_curtidas as $imagem) {
    $galeria[] = $imagem;
    $ids_na_galeria[] = $imagem['id'];
}

foreach ($mais_novas as $imagem) {
    if (!in_array($imagem['id'], $ids_na_galeria)) {
        $galeria[] = $imagem;
    }
}
?>

<!DOCTYPE html>
<!-- O restante do arquivo index.php permanece o mesmo, pois o HTML está correto -->
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício 4 - Galeria de Imagens</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        h1, h2 { color: #333; }
        .formulario-envio {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .galeria {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .foto {
            width: 250px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .foto img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .foto-info {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .foto-info span {
            font-weight: bold;
            color: #555;
        }
        .foto-info a {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
        }
        .foto-info a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Galeria de Imagens Anônima - Rede social do Enrico, Rafaela, Guilherme e Lavínia</h1>
    
    <div class="formulario-envio">
        <h3>Enviar Nova Imagem</h3>
        <form action="salvar_imagem.php" method="post" enctype="multipart/form-data">
            <label for="id_figura">Arquivo:</label>
            <input type="file" name="figura" id="id_figura" accept="image/png, image/jpeg, image/gif" required>
            <input type="submit" value="Enviar Imagem">
        </form>
    </div>

    <h2>Galeria</h2>
    <div class="galeria">
        
        <?php if (empty($galeria)): ?>
            <p>Nenhuma imagem foi enviada ainda. Seja o primeiro!</p>
        
        <?php else: ?>
            <?php foreach ($galeria as $imagem): ?>
                <div class="foto">
                    <img src="<?php echo htmlspecialchars($imagem['caminho']); ?>" alt="Imagem da galeria">
                    
                    <div class="foto-info">
                        <span>
                            ❤️ <?php echo $imagem['curtidas']; ?>
                        </span>
                        
                        <a href="curtir.php?id=<?php echo $imagem['id']; ?>">Curtir</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
</body>
</html>