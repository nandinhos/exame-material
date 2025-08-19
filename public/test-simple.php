<?php
require_once '../config/database.php';
require_once '../app/Models/Database.php';
require_once '../app/Models/Patrimonio.php';

echo "<h1>Teste Simples da Página Principal</h1>";

try {
    echo "Iniciando...<br>";
    
    $patrimonioModel = new Patrimonio();
    echo "Modelo criado...<br>";
    
    $patrimonios = $patrimonioModel->getAll();
    echo "Dados carregados: " . count($patrimonios) . " itens<br>";
    
    $classes = $patrimonioModel->getClasses();
    echo "Classes carregadas: " . count($classes) . " classes<br>";
    
    $estados = $patrimonioModel->getEstadosMaterial();
    echo "Estados carregados: " . count($estados) . " estados<br>";
    
    $totalValue = $patrimonioModel->getTotalValue();
    echo "Valor total: R$ " . number_format($totalValue, 2, ',', '.') . "<br>";
    
    $totalQuantidade = $patrimonioModel->getTotalQuantidade();
    echo "Quantidade total: " . $totalQuantidade . "<br>";
    
    echo "<br><strong>✅ Simulação do controller index() executada com sucesso!</strong><br>";
    
    echo "<h2>Primeiros 3 itens:</h2>";
    for($i = 0; $i < min(3, count($patrimonios)); $i++) {
        $item = $patrimonios[$i];
        echo "<p>BMP: {$item['bmp']} - {$item['nomenclatura']}</p>";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
    echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<br>Teste concluído em: " . date('Y-m-d H:i:s');
?>