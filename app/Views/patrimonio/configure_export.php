<?php /* header é incluído pelo controller */ ?>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Configurar Exportação</h1>
                    <p class="text-gray-600">Configure os dados do documento antes da exportação</p>
                </div>
                <div class="flex gap-3">
                    <a href="<?= url('patrimonio') ?>" class="inline-flex items-center px-4 py-2 bg-secondary-500 hover:bg-secondary-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Voltar ao Sistema
                    </a>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-red-800">
                        <?php 
                        switch($_GET['error']) {
                            case 'no_items':
                                echo 'Não há itens para exportar.';
                                break;
                            case 'export_failed':
                                echo 'Erro ao gerar o PDF. Tente novamente.';
                                break;
                            default:
                                echo 'Erro desconhecido.';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="bg-primary-500 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Configurações do Documento</h2>
                    </div>
                    
                    <form method="POST" action="<?= url('patrimonio/configure-export') ?>" class="space-y-6">
                        <?php
                        $ids = $_POST['ids'] ?? $_GET['ids'] ?? [];
                        if (is_string($ids)) { $ids = explode(',', $ids); }
                        if (is_array($ids)) {
                            $countIds = count($ids);
                            foreach ($ids as $id) {
                                $idInt = is_numeric($id) ? (int)$id : null;
                                if ($idInt !== null) {
                                    echo '<input type="hidden" name="ids[]" value="' . htmlspecialchars((string)$idInt) . '">';
                                }
                            }
                        }
                        ?>
                        <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search'] ?? ($_POST['search'] ?? '')) ?>">
                        <input type="hidden" name="classe" value="<?= htmlspecialchars($_GET['classe'] ?? ($_POST['classe'] ?? '')) ?>">
                        <input type="hidden" name="estado" value="<?= htmlspecialchars($_GET['estado'] ?? ($_POST['estado'] ?? '')) ?>">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php if (!empty($ids) && is_array($ids)): ?>
                                <div class="md:col-span-2">
                                    <div class="bg-primary-50 border border-primary-200 rounded-lg p-4 mb-2">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-sm text-gray-800">Itens selecionados para exportação: <strong><?= (int)($countIds ?? 0) ?></strong></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div>
                                <label for="numero_termo" class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                                Número do Termo de Exame
                                </label>
                                <input type="text" 
                                       id="numero_termo" 
                                       name="numero_termo" 
                                       value="001/GACPAC/2025" 
                                       placeholder="Ex: 002/ICEA/2024"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                            </div>
                            <div>
                                <label for="protocolo" class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Número do Protocolo COMAER
                                </label>
                                <input type="text" 
                                       id="protocolo" 
                                       name="protocolo" 
                                       value="PAG 67748.001565/2025-16" 
                                       placeholder="Ex: PAG 67610.002510/2023-17"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="corpo_documento" class="block text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                    Corpo do Documento
                                </label>
                                <button type="button" 
                                        onclick="adicionarParagrafo()" 
                                        class="inline-flex items-center px-3 py-1.5 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Adicionar Parágrafo
                                </button>
                            </div>
                            <textarea id="corpo_documento" 
                                      name="corpo_documento" 
                                      rows="8" 
                                      required
                                      placeholder="Ex: A Comissão, abaixo assinada, designada no Bol. Int. Ostensivo n° 110 de 20/06/2023..."
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 resize-y font-mono text-sm leading-relaxed">        A Comissão abaixo assinada, designada pela Portaria GAC-PAC nº 25/SAD, de 03 de junho de 2025, publicada no Boletim Interno Ostensivo do GAP-SJ nº 105, de 09 de junho de 2025, reuniu-se nas dependências do Grupo de Acompanhamento e Controle - Programa Aeronave de Combate (GAC-PAC), para examinar as condições de materiais de informática, conforme estabelecido no Manual Eletrônico de Administração de Bens Patrimoniais, do RCA 12-1 - Regulamento de Administração da Aeronáutica, na forma eletrônica (RADA-e).
        A Comissão, após análise documental dos BMP dos ativos de TI, realizou inspeção física dos itens e com o suporte do efetivo da ATI do GAC-PAC, confeccionou laudos técnicos individuais para ratificar a condição do material a fim de auxiliar na futura destinação do material.</textarea>
                            <div class="flex items-start justify-between mt-2">
                                <p class="text-sm text-gray-500">Digite o texto principal que aparecerá no corpo do documento.</p>
                                <div class="text-xs text-gray-400 ml-4">
                                    <div class="flex items-center mb-1">
                                        <div class="w-2 h-2 bg-primary-500 rounded-full mr-2"></div>
                                        <span>Cada parágrafo com tabulação de 2,5cm</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-accent-500 rounded-full mr-2"></div>
                                        <span>Linha em branco entre parágrafos</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="oficio" class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Ofício Relacionado
                            </label>
                            <input type="text" 
                                   id="oficio" 
                                   name="oficio" 
                                   placeholder="Ex: Ofício n° 29/ATI"
                                   value="Ofício n° 29/ATI" 
                                   required
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                            <p class="text-sm text-gray-500 mt-2">Informe o número do ofício relacionado aos itens.</p>
                        </div>

                        <!-- Seção de Configurações de Assinatura -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex items-center mb-6">
                                <div class="bg-accent-500 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Configurações de Assinatura</h3>
                            </div>

                            <!-- Local e Data -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="local_assinatura" class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Local
                                    </label>
                                    <input type="text" 
                                           id="local_assinatura" 
                                           name="local_assinatura" 
                                           value="São José dos Campos" 
                                           placeholder="Ex: São José dos Campos"
                                           required
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                </div>
                                <div>
                                    <label for="data_assinatura" class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Data
                                    </label>
                                    <input type="text" 
                                           id="data_assinatura" 
                                           name="data_assinatura" 
                                           value="19 de Agosto de 2025" 
                                           placeholder="Ex: 19 de Agosto de 2025        s"
                                           required
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                </div>
                            </div>

                            <!-- Presidente -->
                            <div class="mb-6">
                                <label for="presidente_nome" class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Nome do Presidente
                                </label>
                                <input type="text" 
                                       id="presidente_nome" 
                                       name="presidente_nome" 
                                       value="Gustavo Luiz Franco - 2° Ten QOEA SUP" 
                                       placeholder="Ex: Nome Completo e Posto"
                                       required
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                            </div>

                            <!-- Membros -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <label class="block text-sm font-medium text-gray-700">
                                        <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Membros da Comissão
                                    </label>
                                    <button type="button" 
                                            onclick="adicionarMembro()" 
                                            class="inline-flex items-center px-3 py-1.5 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Adicionar Membro
                                    </button>
                                </div>
                                <div id="membros-container">
                                    <div class="membro-item mb-3 flex items-center gap-3">
                                        <input type="text" 
                                               name="membros[]" 
                                               value="Fernando dos Santos Souza 1S BMB" 
                                               placeholder="Nome Completo e Posto do Membro"
                                               required
                                               class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                        <button type="button" 
                                                onclick="removerMembro(this)" 
                                                class="px-3 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="membro-item mb-3 flex items-center gap-3">
                                        <input type="text" 
                                               name="membros[]" 
                                               value="Paulo de Tarso Freitas Barbosa - 3S QSCon" 
                                               placeholder="Nome Completo e Posto do Membro"
                                               required
                                               class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                        <button type="button" 
                                                onclick="removerMembro(this)" 
                                                class="px-3 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                    

                                </div>
                            </div>

                            <!-- Seção Confere -->
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h4 class="text-md font-semibold text-gray-900 mb-4">Seção "Confere"</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <div>
                                        <label for="confere_local" class="block text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Local (Confere)
                                        </label>
                                        <input type="text" 
                                               id="confere_local" 
                                               name="confere_local" 
                                               value="São José dos Campos" 
                                               placeholder="Ex: São José dos Campos"
                                               required
                                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                    </div>
                                    <div>
                                        <label for="confere_data" class="block text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Data (Confere)
                                        </label>
                                        <input type="text" 
                                               id="confere_data" 
                                               name="confere_data" 
                                               value="19 de Agosto de 2025" 
                                               placeholder="Ex: 19 de Agosto de 2025"
                                               required
                                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                    </div>
                                </div>
                                <div>
                                    <label for="agente_controle" class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Agente de Controle Interno
                                    </label>
                                    <input type="text" 
                                           id="agente_controle" 
                                           name="agente_controle" 
                                           value="Renan de Lacerda Lima Gonçalves Cap Int" 
                                           placeholder="Nome Completo e Posto do Agente"
                                           required
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
                                </div>
                            </div>

                            <!-- Campo de Texto Personalizado -->
                            <div>
                                <label for="texto_final" class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                    Texto Final Personalizado
                                </label>
                                <textarea id="texto_final" 
                                          name="texto_final" 
                                          rows="4" 
                                          placeholder="Digite aqui qualquer texto adicional que deve aparecer no final do documento..."
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 resize-y">Em consequência dos atos apontados pela Comissão designada, determino a Seção de Registro que:

1. Exclua o material examinado da Carga desta Unidade, Seja imputado o prejuízo ao Estado;
2. Devido à inconveniência de alienação seja o material doado conforme o Item 2.15.18 (c) do RCA, RADA-e de 21 de janeiro de 2021;
3. Publique em Boletim Interno o presente termo; e
4. Arquive no ePAG (módulo do SILOMS).</textarea>
                                <p class="text-sm text-gray-500 mt-2">Este texto aparecerá no final do documento, após as assinaturas.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end pt-6 border-t border-gray-200">
                            <a href="<?= url('patrimonio') ?>" class="btn btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Gerar Documento
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-accent-500 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informações</h3>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Este formulário permite configurar os textos que aparecerão no documento PDF antes da exportação.</p>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">O documento incluirá:</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-success-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Cabeçalho oficial
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-success-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Protocolo COMAER
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-success-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Corpo do documento
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-success-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Tabela com todos os itens
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-success-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Detalhes de cada patrimônio
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.477.859h4z"/>
                            </svg>
                            <p class="text-sm text-blue-800">
                                O documento HTML será gerado automaticamente após o preenchimento dos campos. Você pode imprimir ou salvar como PDF através do navegador.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function adicionarParagrafo() {
    const textarea = document.getElementById('corpo_documento');
    const cursorPos = textarea.selectionStart;
    const textoBefore = textarea.value.substring(0, cursorPos);
    const textoAfter = textarea.value.substring(cursorPos);
    
    // Verifica se já estamos no final de uma linha ou se precisamos adicionar quebra
    let novoTexto = '';
    
    // Se não estamos no início do textarea e o último caractere não é uma quebra de linha
    if (textoBefore.length > 0 && !textoBefore.endsWith('\n')) {
        novoTexto += '\n';
    }
    
    // Adiciona nova linha com tabulação (aproximadamente 2,5cm = 8 espaços)
    novoTexto += '        ';
    
    // Atualiza o valor do textarea
    textarea.value = textoBefore + novoTexto + textoAfter;
    
    // Posiciona o cursor após a tabulação
    const novaPosicao = cursorPos + novoTexto.length;
    textarea.setSelectionRange(novaPosicao, novaPosicao);
    
    // Foca no textarea
    textarea.focus();
    
    // Ajusta a altura do textarea se necessário
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

function adicionarMembro() {
    const container = document.getElementById('membros-container');
    const novoMembro = document.createElement('div');
    novoMembro.className = 'membro-item mb-3 flex items-center gap-3';
    
    novoMembro.innerHTML = `
        <input type="text" 
               name="membros[]" 
               placeholder="Nome Completo e Posto do Membro"
               required
               class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200">
        <button type="button" 
                onclick="removerMembro(this)" 
                class="px-3 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    `;
    
    container.appendChild(novoMembro);
    
    // Foca no novo input
    const novoInput = novoMembro.querySelector('input');
    novoInput.focus();
}

function removerMembro(button) {
    const container = document.getElementById('membros-container');
    const membros = container.querySelectorAll('.membro-item');
    
    // Não permite remover se há apenas um membro
    if (membros.length <= 1) {
        alert('É necessário ter pelo menos um membro na comissão.');
        return;
    }
    
    const membroItem = button.closest('.membro-item');
    membroItem.remove();
}

// Adiciona evento para ajustar altura automaticamente
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('corpo_documento');
    const textoFinal = document.getElementById('texto_final');
    
    // Função para ajustar altura
    function ajustarAltura(element) {
        element.style.height = 'auto';
        element.style.height = element.scrollHeight + 'px';
    }
    
    // Ajusta altura inicial
    ajustarAltura(textarea);
    ajustarAltura(textoFinal);
    
    // Ajusta altura quando o conteúdo muda
    textarea.addEventListener('input', () => ajustarAltura(textarea));
    textarea.addEventListener('paste', function() {
        setTimeout(() => ajustarAltura(textarea), 10);
    });
    
    textoFinal.addEventListener('input', () => ajustarAltura(textoFinal));
    textoFinal.addEventListener('paste', function() {
        setTimeout(() => ajustarAltura(textoFinal), 10);
    });
});
</script>

<?php /* footer é incluído pelo controller */ ?>
