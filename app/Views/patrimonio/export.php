<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Patrimônio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            vertical-align: top;
        }
        .titulo {
            font-weight: bold;
        }
        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

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

<div class="no-print" style="margin-bottom: 20px; text-align: center;">
    <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Imprimir/Salvar PDF</button>
    <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Fechar</button>
</div>

<table>
    <tr>
        <th>CLASSE</th>
        <th>BMP</th>
        <th>NOMENCLATURA</th>
        <th>QTD</th>
        <th>DATA INCLUSÃO</th>
        <th>PREÇO UNIT</th>
        <th>PREÇO TOTAL</th>
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

<table style="margin-top:-1px;">
    <tr>
        <td class="titulo" style="width:20%;">Estado do material</td>
        <td class="titulo" style="width:80%;">Dano sofrido</td>
    </tr>
    <tr>
        <td><?= $estado_material ?></td>
        <td><?= $dano_sofrido ?></td>
    </tr>
</table>

<table style="margin-top:-1px;">
    <tr>
        <td class="titulo" style="width:25%;">Causa do Dano</td>
        <td class="titulo" style="width:25%;">Motivo de Força Maior</td>
        <td class="titulo" style="width:25%;">Responsável pelo Dano</td>
        <td class="titulo" style="width:25%;">Matéria prima aproveitável</td>
    </tr>
    <tr>
        <td><?= $causa_dano ?></td>
        <td><?= $motivo_forca_maior ?></td>
        <td><?= $responsavel_dano ?></td>
        <td><?= $materia_prima_aproveitavel ?></td>
    </tr>
</table>

<table style="margin-top:-1px;">
    <tr>
        <td class="titulo" style="width:100%;">Outros Esclarecimentos</td>
    </tr>
    <tr>
        <td><?= $outros_esclarecimentos ?></td>
    </tr>
</table>

</body>
</html>