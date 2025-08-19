<?php
require_once '../config/database.php';
require_once '../app/Models/Database.php';

echo "<h2>Teste de Conexão com Banco de Dados</h2>";

try {
    $db = Database::getInstance();
    echo "✅ Conexão com banco estabelecida com sucesso!<br>";
    
    $result = $db->fetchAll("SELECT COUNT(*) as total FROM patrimonio");
    echo "✅ Consulta executada com sucesso!<br>";
    echo "📊 Total de registros: " . $result[0]['total'] . "<br>";
    
    $patrimonios = $db->fetchAll("SELECT id, bmp, nomenclatura FROM patrimonio LIMIT 3");
    echo "✅ Primeiros 3 registros:<br>";
    foreach($patrimonios as $p) {
        echo "- ID: {$p['id']}, BMP: {$p['bmp']}, Nome: {$p['nomenclatura']}<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}

echo "<br>Teste concluído em: " . date('Y-m-d H:i:s');
?>