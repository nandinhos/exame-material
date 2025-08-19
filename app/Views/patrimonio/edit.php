<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Editar Patrimônio</h1>
                <p class="mt-2 text-gray-600">Atualize as informações do item patrimonial</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="<?= url('patrimonio') ?>" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voltar
                </a>
            </div>
        </div>
        
        <!-- Error Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <div class="text-red-800">
                        <?php 
                        switch($_GET['error']) {
                            case 'nomenclatura_required':
                                echo 'A nomenclatura é obrigatória.';
                                break;
                            case 'update_failed':
                                echo 'Erro ao atualizar o patrimônio. Tente novamente.';
                                break;
                            default:
                                echo 'Erro desconhecido.';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Dados do Patrimônio</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="<?= url('patrimonio/edit/' . $patrimonio['id']) ?>" class="space-y-6">
                    <!-- Informações Básicas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="classe" class="block text-sm font-medium text-gray-700 mb-2">Classe</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="classe" 
                                   name="classe" 
                                   value="<?= htmlspecialchars($patrimonio['classe'] ?? '') ?>"
                                   placeholder="Ex: Equipamentos">
                        </div>
                        <div>
                            <label for="bmp" class="block text-sm font-medium text-gray-700 mb-2">BMP</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="bmp" 
                                   name="bmp" 
                                   value="<?= htmlspecialchars($patrimonio['bmp'] ?? '') ?>"
                                   placeholder="Ex: BMP001">
                        </div>
                    </div>
                    
                    <div>
                        <label for="nomenclatura" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomenclatura <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                               id="nomenclatura" 
                               name="nomenclatura" 
                               required 
                               value="<?= htmlspecialchars($patrimonio['nomenclatura'] ?? '') ?>"
                               placeholder="Descrição do item">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="quantidade" class="block text-sm font-medium text-gray-700 mb-2">Quantidade</label>
                            <input type="number" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="quantidade" 
                                   name="quantidade" 
                                   min="1" 
                                   value="<?= htmlspecialchars($patrimonio['quantidade'] ?? '1') ?>">
                        </div>
                        <div>
                            <label for="data_inclusao" class="block text-sm font-medium text-gray-700 mb-2">Data de Inclusão</label>
                            <input type="date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="data_inclusao" 
                                   name="data_inclusao" 
                                   value="<?= $patrimonio['data_inclusao'] ? date('Y-m-d', strtotime($patrimonio['data_inclusao'])) : '' ?>">
                        </div>
                        <div>
                            <label for="estado_material" class="block text-sm font-medium text-gray-700 mb-2">Estado do Material</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                    id="estado_material" 
                                    name="estado_material">
                                <option value="">Selecione...</option>
                                <option value="Excelente" <?= ($patrimonio['estado_material'] ?? '') === 'Excelente' ? 'selected' : '' ?>>Excelente</option>
                                <option value="Bom" <?= ($patrimonio['estado_material'] ?? '') === 'Bom' ? 'selected' : '' ?>>Bom</option>
                                <option value="Regular" <?= ($patrimonio['estado_material'] ?? '') === 'Regular' ? 'selected' : '' ?>>Regular</option>
                                <option value="Ruim" <?= ($patrimonio['estado_material'] ?? '') === 'Ruim' ? 'selected' : '' ?>>Ruim</option>
                                <option value="Danificado" <?= ($patrimonio['estado_material'] ?? '') === 'Danificado' ? 'selected' : '' ?>>Danificado</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Informações Financeiras -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="preco_unit" class="block text-sm font-medium text-gray-700 mb-2">Preço Unitário (R$)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">R$</span>
                                <input type="number" 
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                       id="preco_unit" 
                                       name="preco_unit" 
                                       step="0.01" 
                                       min="0" 
                                       value="<?= htmlspecialchars($patrimonio['preco_unit'] ?? '') ?>"
                                       placeholder="0,00">
                            </div>
                        </div>
                        <div>
                            <label for="preco_total" class="block text-sm font-medium text-gray-700 mb-2">Preço Total (R$)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">R$</span>
                                <input type="number" 
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                       id="preco_total" 
                                       name="preco_total" 
                                       step="0.01" 
                                       min="0" 
                                       value="<?= htmlspecialchars($patrimonio['preco_total'] ?? '') ?>"
                                       placeholder="0,00">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Deixe em branco para calcular automaticamente (Preço Unitário × Quantidade)</p>
                        </div>
                    </div>
                    
                    <!-- Informações sobre Danos -->
                    <div>
                        <label for="dano_sofrido" class="block text-sm font-medium text-gray-700 mb-2">Dano Sofrido</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                  id="dano_sofrido" 
                                  name="dano_sofrido" 
                                  rows="3"
                                  placeholder="Descreva os danos identificados..."><?= htmlspecialchars($patrimonio['dano_sofrido'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="causa_dano" class="block text-sm font-medium text-gray-700 mb-2">Causa do Dano</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="causa_dano" 
                                   name="causa_dano" 
                                   value="<?= htmlspecialchars($patrimonio['causa_dano'] ?? '') ?>"
                                   placeholder="Ex: Desgaste natural, acidente...">
                        </div>
                        <div>
                            <label for="responsavel_dano" class="block text-sm font-medium text-gray-700 mb-2">Responsável pelo Dano</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="responsavel_dano" 
                                   name="responsavel_dano" 
                                   value="<?= htmlspecialchars($patrimonio['responsavel_dano'] ?? '') ?>"
                                   placeholder="Nome do responsável">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="motivo_forca_maior" class="block text-sm font-medium text-gray-700 mb-2">Motivo de Força Maior</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="motivo_forca_maior" 
                                   name="motivo_forca_maior" 
                                   value="<?= htmlspecialchars($patrimonio['motivo_forca_maior'] ?? '') ?>"
                                   placeholder="Ex: Enchente, incêndio...">
                        </div>
                        <div>
                            <label for="materia_prima_aproveitavel" class="block text-sm font-medium text-gray-700 mb-2">Matéria Prima Aproveitável</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                    id="materia_prima_aproveitavel" 
                                    name="materia_prima_aproveitavel">
                                <option value="">Selecione...</option>
                                <option value="Sim" <?= ($patrimonio['materia_prima_aproveitavel'] ?? '') === 'Sim' ? 'selected' : '' ?>>Sim</option>
                                <option value="Não" <?= ($patrimonio['materia_prima_aproveitavel'] ?? '') === 'Não' ? 'selected' : '' ?>>Não</option>
                                <option value="Parcialmente" <?= ($patrimonio['materia_prima_aproveitavel'] ?? '') === 'Parcialmente' ? 'selected' : '' ?>>Parcialmente</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="outros_esclarecimentos" class="block text-sm font-medium text-gray-700 mb-2">Outros Esclarecimentos</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                  id="outros_esclarecimentos" 
                                  name="outros_esclarecimentos" 
                                  rows="3"
                                  placeholder="Informações adicionais relevantes..."><?= htmlspecialchars($patrimonio['outros_esclarecimentos'] ?? '') ?></textarea>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-200 space-y-3 sm:space-y-0">
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <a href="<?= url('patrimonio') ?>" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Atualizar Patrimônio
                            </button>
                        </div>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <a href="<?= url('patrimonio/export/' . $patrimonio['id']) ?>" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-secondary-600 hover:bg-secondary-700 text-white font-medium rounded-lg transition-colors duration-200" 
                               target="_blank">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Exportar PDF
                            </a>
                            <button type="button" 
                                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200" 
                                    onclick="confirmDelete('<?= $patrimonio['id'] ?>', '<?= htmlspecialchars($patrimonio['bmp'] ?? 'N/A') ?>')">
                                <i class="fas fa-trash mr-2"></i>
                                Excluir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Calcular preço total automaticamente
document.getElementById('preco_unit').addEventListener('input', calcularPrecoTotal);
document.getElementById('quantidade').addEventListener('input', calcularPrecoTotal);

function calcularPrecoTotal() {
    const precoUnit = parseFloat(document.getElementById('preco_unit').value) || 0;
    const quantidade = parseInt(document.getElementById('quantidade').value) || 0;
    const precoTotalField = document.getElementById('preco_total');
    
    if (precoUnit > 0 && quantidade > 0) {
        precoTotalField.value = (precoUnit * quantidade).toFixed(2);
    }
}

// A função confirmDelete está definida globalmente no footer.php
</script>