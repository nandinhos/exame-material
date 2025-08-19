<?php
require_once '../config/database.php';
require_once '../app/Models/Database.php';
require_once '../app/Models/Patrimonio.php';

echo "<h2>Teste do Controller Patrimônio</h2>";

try {
    echo "1. Iniciando teste...<br>";
    
    $patrimonioModel = new Patrimonio();
    echo "2. ✅ Modelo Patrimônio criado com sucesso!<br>";
    
    echo "3. Testando getAll()...<br>";
    $patrimonios = $patrimonioModel->getAll();
    echo "4. ✅ getAll() executado! Total: " . count($patrimonios) . " registros<br>";
    
    echo "5. Testando getClasses()...<br>";
    $classes = $patrimonioModel->getClasses();
    echo "6. ✅ getClasses() executado! Total: " . count($classes) . " classes<br>";
    
    echo "7. Testando getEstadosMaterial()...<br>";
    $estados = $patrimonioModel->getEstadosMaterial();
    echo "8. ✅ getEstadosMaterial() executado! Total: " . count($estados) . " estados<br>";
    
    echo "9. Testando getTotalValue()...<br>";
    $totalValue = $patrimonioModel->getTotalValue();
    echo "10. ✅ getTotalValue() executado! Valor: R$ " . number_format($totalValue, 2, ',', '.') . "<br>";
    
    echo "11. Testando getTotalQuantidade()...<br>";
    $totalQuantidade = $patrimonioModel->getTotalQuantidade();
    echo "12. ✅ getTotalQuantidade() executado! Quantidade: " . $totalQuantidade . "<br>";
    
    echo "<br><strong>✅ Todos os testes passaram com sucesso!</strong><br>";
    
} catch (Exception $e) {
    echo "❌ Erro no teste: " . $e->getMessage() . "<br>";
    echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<br>Teste concluído em: " . date('Y-m-d H:i:s');
?>