<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de Exame de Material - Todos os Itens</title>
    <link href="<?= url('css/tailwind.min.css') ?>" rel="stylesheet">
    <script>
        // Função para abrir automaticamente a janela de impressão/PDF
        window.onload = function() {
            // Aguardar um pequeno delay para garantir que a página carregou completamente
            setTimeout(function() {
                window.print();
            }, 500);
        };
        
        // Função para fechar a janela após a impressão (opcional)
        window.onafterprint = function() {
            // Opcional: fechar a janela após a impressão
            // window.close();
        };
    </script>
</head>
<body class="export-body">
    <div class="export-header">        <h1>Termo de Exame de Material</h1>
        <br>
        <img src="../brasão.png" alt="Brasão" class="brasao">
        <h2>MINISTÉRIO DA DEFESA</h2>
        <h2>COMANDO DA AERONÁUTICA</h2>
        <h2>GRUPO DE ACOMPANHAMENTO E CONTROLE DO PROGRAMA AERONAVE DE COMBATE</h2>

        <p><strong>TERMO DE EXAME DE MATERIAL Nº <?= htmlspecialchars($numero_termo ?? '001/GACPAC/2025') ?>, <?= date('d/m/Y') ?>.</strong></p>
        <p><strong>Protocolo COMAER nº <?= htmlspecialchars($protocolo ?? 'PAG 67748.001565/2025-16') ?>.</strong></p>
        <br>
        <div class="text-justify margin-0-20 line-height-1-6">
             <?php 
             $corpo_formatado = htmlspecialchars($corpo_documento ?? '');
             // Divide o texto em parágrafos e aplica formatação
             $paragrafos = explode("\n", $corpo_formatado);
             $primeiro_paragrafo = true;
             foreach ($paragrafos as $paragrafo) {
                 $paragrafo = trim($paragrafo);
                 if (!empty($paragrafo)) {
                     if (!$primeiro_paragrafo) {
                         echo '<br>'; // Quebra de linha simples entre parágrafos
                     }
                     echo '<p class="text-indent-2-5 margin-0">' . $paragrafo . '</p>';
                     $primeiro_paragrafo = false;
                 }
             }
             ?>
         </div>
        
        <br>
        
        <br>
        <p><strong>Seção do Material a ser analisado:</strong></p>
        <p><strong><?= htmlspecialchars($oficio ?? 'Ofício nº 29/ATI') ?>:</strong></p>
    </div>

    <?php foreach ($patrimonios as $index => $item): ?>
        <?php if ($index > 0): ?>
            <div class="margin-top-30"></div>
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
                <td class="export-label width-20-percent">Estado do material</td>
                <td class="export-label width-80-percent">Dano sofrido</td>
                
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                
            </tr>
            <tr>
                <td class="export-value width-20-percent"><?= htmlspecialchars($item['estado_material'] ?? 'Antieconômico') ?></td>
                <td class="export-value width-80-percent"><?= htmlspecialchars($item['dano_sofrido'] ?? 'Em virtude do bem encontrar-se inoperante e sem condições de reparo, conforme Laudo Técnico: 74/ATTI/2021.') ?></td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td class="export-label width-20-percent">Causa do Dano</td>
                <td class="export-label width-25-percent">Motivo de Força Maior</td>
                <td class="export-label width-25-percent">Responsável pelo Dano</td>
                <td class="export-label width-30-percent">Matéria prima aproveitável</td>
            </tr>
            <tr>
                <td class="export-value width-20-percent"><?= htmlspecialchars($item['causa_dano'] ?? 'Não há') ?></td>
                <td class="export-value width-25-percent"><?= htmlspecialchars($item['motivo_forca_maior'] ?? 'Não há') ?></td>
                <td class="export-value width-25-percent"><?= htmlspecialchars($item['responsavel_dano'] ?? 'Não há') ?></td>
                <td class="export-value width-30-percent"><?= htmlspecialchars($item['materia_prima_aproveitavel'] ?? 'Não passível de alienação') ?></td>
            </tr>
        </table>
        
        <table class="info-table">
            <tr>
                <td class="export-label width-100-percent">Outros Esclarecimentos</td>
            </tr>
            <tr>
                <td class="export-value width-100-percent"><?= htmlspecialchars($item['outros_esclarecimentos'] ?? 'Esta comissão sugere que o material seja descartado, conforme o item 2.14.8.1 do Manual eletrônico de Bens Patrimoniais – RADA-e, letras "c" e "e".') ?></td>
            </tr>
        </table>
    <?php endforeach; ?>
    
    <!-- Seção de Assinaturas e Término do Documento -->
    <?php if (!empty($local_data) || !empty($presidente_nome) || !empty($membros) || !empty($confere_local_data) || !empty($agente_controle_nome) || !empty($texto_final)): ?>
    <div style="page-break-before: always; margin-top: 50px; font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6;">
        
        <!-- Texto Fixo Padrão -->
        <div style="margin-bottom: 30px; text-align: right;">
            E para constar, foi lavrado o constante termo,
            
        </div>
        
        <!-- Local e Data -->
        <?php if (!empty($local_data)): ?>
        <div style="margin-bottom: 40px; text-align: right;">
            <?= htmlspecialchars($local_data) ?>
        </div>
        <?php endif; ?>
        
        <!-- Assinaturas da Comissão -->
        <div style="margin-bottom: 50px;">
            <!-- Presidente -->
            <?php if (!empty($presidente_nome)): ?>
            <div style="margin-bottom: 40px; text-align: center;">
                <div style="border-bottom: 1px solid #000; width: 300px; margin: 0 auto 10px; height: 40px;"></div>
                <div style="font-weight: bold;"><?= htmlspecialchars($presidente_nome) ?></div>
                <div>Presidente</div>
            </div>
            <?php endif; ?>
            
            <!-- Membros -->
            <?php if (!empty($membros) && is_array($membros)): ?>
                <?php foreach ($membros as $membro): ?>
                    <?php if (!empty($membro)): ?>
                    <div style="margin-bottom: 40px; text-align: center;">
                        <div style="border-bottom: 1px solid #000; width: 300px; margin: 0 auto 10px; height: 40px;"></div>
                        <div style="font-weight: bold;"><?= htmlspecialchars($membro) ?></div>
                        <div>Membro</div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Seção Confere -->
        <?php if (!empty($confere_local_data) || !empty($agente_controle_nome)): ?>
        <div style="margin-top: 60px;">
            <div style="font-weight: bold; margin-bottom: 20px;">Confere:</div>
            
            <!-- Local e Data do Confere -->
            <?php if (!empty($confere_local_data)): ?>
            <div style="margin-bottom: 30px; text-align: right;">
                <?= htmlspecialchars($confere_local_data) ?>
            </div>
            <?php endif; ?>
            
            <!-- Agente de Controle Interno -->
            <?php if (!empty($agente_controle_nome)): ?>
            <div style="text-align: center; margin-bottom: 40px;">
                <div style="border-bottom: 1px solid #000; width: 300px; margin: 0 auto 10px; height: 40px;"></div>
                <div style="font-weight: bold;"><?= htmlspecialchars($agente_controle_nome) ?></div>
                <div>Agente de Controle Interno</div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Texto Final Personalizável -->
        <?php if (!empty($texto_final)): ?>
        <div style="margin-top: 30px; text-align: justify;">
            <?= nl2br(htmlspecialchars($texto_final)) ?>
        </div>
        <?php endif; ?>
        
    </div>
    <?php endif; ?>
    

</body>
</html>