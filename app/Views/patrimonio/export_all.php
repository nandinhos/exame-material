<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de Exame de Material - Todos os Itens</title>
    <style>
        @page {
            margin: 2cm;
            size: A4;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 20px;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .header h2 {
            font-size: 12px;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .brasao {
            display: block;
            width: 80px;
            height: 80px;
            margin: 0 auto 10px;
        }
        
        .item-container {
            margin-bottom: 40px;
            page-break-inside: avoid;
            border: 1px solid #000;
            padding: 15px;
        }
        
        .item-title {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 15px;
            text-decoration: underline;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        
        .info-table th,
        .info-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }
        
        .info-table th {
            background-color: #e6e6e6;
            font-weight: bold;
            text-align: center;
        }
        
        .details-section {
            margin-top: 15px;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .details-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        
        .label {
            font-weight: bold;
            background-color: #e6e6e6;
            width: 25%;
        }
        
        .value {
            width: 75%;
        }
        
        .observations {
            margin-top: 15px;
            font-size: 10px;
            line-height: 1.3;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            .item-container {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Termo de Exame de Material</h1>
        <img src="data:image/png;base64,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
" alt="Brasão" class="brasao">
        <h2>MINISTÉRIO DA DEFESA</h2>
        <h2>COMANDO DA AERONÁUTICA</h2>
        <h2>INSTITUTO DE CONTROLE DO ESPAÇO AÉREO</h2>
        <br>
        <p><strong>TERMO DE EXAME DE MATERIAL Nº <?= htmlspecialchars($numero_termo ?? '001/GACPAC/2025') ?>, <?= date('d/m/Y') ?>.</strong></p>
        <p><strong>Protocolo COMAER nº <?= htmlspecialchars($protocolo ?? 'PAG 67748.001565/2025-16') ?>.</strong></p>
        <br>
        <p style="text-align: justify; margin: 0 20px; text-indent: 2.5cm;">
            <?= nl2br(htmlspecialchars($corpo_documento ?? '')) ?>
        </p>
        
        <br>
        
        <br>
        <p><strong>Seção do Material a ser analisado:</strong></p>
        <p><strong><?= htmlspecialchars($oficio ?? 'Ofício nº 29/ATI') ?>:</strong></p>
    </div>

    <?php foreach ($patrimonios as $index => $item): ?>
        <?php if ($index > 0): ?>
            <div style="margin-top: 30px;"></div>
        <?php endif; ?>
        
        <table class="info-table">
            <thead>
                <tr>
                    <th>CLASSE</th>
                    <th>BMP</th>
                    <th>NOMENCLATURA</th>
                    <th>QTD</th>
                    <th>DATA INCLUSÃO</th>
                    <th>PREÇO UNIT</th>
                    <th>PREÇO TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($item['classe'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($item['bmp'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($item['nomenclatura'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($item['quantidade'] ?? '1') ?></td>
                    <td><?= $item['data_inclusao'] ? date('d/m/Y', strtotime($item['data_inclusao'])) : 'N/A' ?></td>
                    <td><?= number_format($item['preco_unit'] ?? 0, 2, ',', '.') ?></td>
                    <td><?= number_format($item['preco_total'] ?? 0, 2, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
        
        <table class="info-table">
            <tr>
                <td class="label" style="width:20%;">Estado do material</td>
                <td class="value" style="width:80%;"><?= htmlspecialchars($item['estado_material'] ?? 'Antieconômico') ?></td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td class="label" style="width:80%;">Dano sofrido</td>
            </tr>
            <tr>
                <td class="value"><?= htmlspecialchars($item['dano_sofrido'] ?? 'Em virtude do bem encontrar-se inoperante e sem condições de reparo, conforme Laudo Técnico: 74/ATTI/2021.') ?></td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td class="label" style="width:25%;">Causa do Dano</td>
                <td class="label" style="width:25%;">Motivo de Força Maior</td>
                <td class="label" style="width:25%;">Responsável pelo Dano</td>
                <td class="label" style="width:25%;">Matéria prima aproveitável</td>
            </tr>
            <tr>
                <td class="value"><?= htmlspecialchars($item['causa_dano'] ?? 'Não há') ?></td>
                <td class="value"><?= htmlspecialchars($item['motivo_forca_maior'] ?? 'Não há') ?></td>
                <td class="value"><?= htmlspecialchars($item['responsavel_dano'] ?? 'Não há') ?></td>
                <td class="value"><?= htmlspecialchars($item['materia_prima_aproveitavel'] ?? 'Não passível de alienação') ?></td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td class="label" style="width:100%;">Outros Esclarecimentos</td>
            </tr>
            <tr>
                <td class="value"><?= htmlspecialchars($item['outros_esclarecimentos'] ?? 'Esta comissão sugere que o material seja descartado, conforme o item 2.14.8.1 do Manual eletrônico de Bens Patrimoniais – RADA-e, letras "c" e "e".') ?></td>
            </tr>
        </table>
    <?php endforeach; ?>
    
    <div style="margin-top: 50px; text-align: center; font-size: 10px;">
        <p>Documento gerado automaticamente em <?= date('d/m/Y H:i:s') ?></p>
        <p>Total de itens: <?= count($patrimonios) ?></p>
    </div>
</body>
</html>