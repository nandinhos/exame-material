<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Patrimônio</title>
    <link rel="stylesheet" href="../css/tailwind.min.css">
</head>
<body class="export-body">

<?php
// ==============================
// Variáveis vindas do banco
// ==============================
// $classe                 -> coluna 'classe'
// $bmp                    -> coluna 'bmp'
// $nomenclatura           -> coluna 'nomenclatura'
// $qtd                    -> coluna 'quantidade'
// $data_inclusao          -> coluna 'data_inclusao' (formato dd/mm/aaaa)
// $preco_unit              -> coluna 'preco_unit'
// $preco_total             -> coluna 'preco_total'
// $estado_material         -> coluna 'estado_material'
// $dano_sofrido            -> coluna 'dano_sofrido'
// $causa_dano              -> coluna 'causa_dano'
// $motivo_forca_maior      -> coluna 'motivo_forca_maior'
// $responsavel_dano        -> coluna 'responsavel_dano'
// $materia_prima_aproveitavel -> coluna 'materia_prima_aproveitavel'
// $outros_esclarecimentos  -> coluna 'outros_esclarecimentos'
?>

<div class="no-print margin-bottom-20 text-center">
    <button onclick="window.print()" class="export-btn">Imprimir/Salvar PDF</button>
    <button onclick="window.close()" class="export-btn export-btn-secondary">Fechar</button>
</div>

<div class="export-container">

<table class="export-table">
    <tr>
        <th class="export-titulo">CLASSE</th>
        <th class="export-titulo">BMP</th>
        <th class="export-titulo">NOMENCLATURA</th>
        <th class="export-titulo">QTD</th>
        <th class="export-titulo">DATA INCLUSÃO</th>
        <th class="export-titulo">PREÇO UNIT</th>
        <th class="export-titulo">PREÇO TOTAL</th>
    </tr>
    <tr>
        <td><?= $classe ?></td>
        <td><?= $bmp ?></td>
        <td><?= $nomenclatura ?></td>
        <td><?= $qtd ?></td>
        <td><?= $data_inclusao ?></td>
        <td><?= number_format($preco_unit, 2, ',', '.') ?></td>
        <td><?= number_format($preco_total, 2, ',', '.') ?></td>
    </tr>
</table>

<table class="export-table margin-top-minus-1">
     <tr>
         <td class="export-titulo width-20-percent">Estado do material</td>
         <td class="export-titulo width-80-percent">Dano sofrido</td>
    </tr>
    <tr>
        <td><?= $estado_material ?></td>
        <td><?= $dano_sofrido ?></td>
    </tr>
</table>

<table class="export-table margin-top-minus-1">
     <tr>
         <td class="export-titulo width-25-percent">Causa do Dano</td>
         <td class="export-titulo width-25-percent">Motivo de Força Maior</td>
         <td class="export-titulo width-25-percent">Responsável pelo Dano</td>
         <td class="export-titulo width-25-percent">Matéria prima aproveitável</td>
    </tr>
    <tr>
        <td><?= $causa_dano ?></td>
        <td><?= $motivo_forca_maior ?></td>
        <td><?= $responsavel_dano ?></td>
        <td><?= $materia_prima_aproveitavel ?></td>
    </tr>
</table>

<table class="export-table margin-top-minus-1">
     <tr>
         <td class="export-titulo width-100-percent">Outros Esclarecimentos</td>
    </tr>
    <tr>
        <td><?= $outros_esclarecimentos ?></td>
    </tr>
</table>

</body>
</html>