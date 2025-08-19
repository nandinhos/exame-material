<!-- Main Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Adicionar Novo Patrimônio</h1>
            <p class="text-gray-600">Preencha os dados para cadastrar um novo item no sistema</p>
        </div>
        <a href="<?= url('patrimonio') ?>" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>

    <!-- Error Messages -->
    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400 text-lg"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Erro ao processar solicitação</h3>
                    <div class="mt-1 text-sm text-red-700">
                        <?php 
                        switch($_GET['error']) {
                            case 'nomenclatura_required':
                                echo 'A nomenclatura é obrigatória.';
                                break;
                            case 'create_failed':
                                echo 'Erro ao criar o patrimônio. Tente novamente.';
                                break;
                            default:
                                echo 'Erro desconhecido.';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
            
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Dados do Patrimônio</h2>
            <p class="text-sm text-gray-600 mt-1">Campos marcados com * são obrigatórios</p>
        </div>
        <div class="p-6">
            <form method="POST" action="<?= url('patrimonio/create') ?>" class="space-y-6" id="patrimonioForm">
                <!-- Informações Básicas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="classe" class="block text-sm font-medium text-gray-700 mb-2">Classe</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                               id="classe" 
                               name="classe" 
                               placeholder="Ex: Informática, Móveis, Veículos"
                               value="<?= htmlspecialchars($_POST['classe'] ?? '') ?>">
                    </div>
                    <div>
                        <label for="bmp" class="block text-sm font-medium text-gray-700 mb-2">BMP</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                               id="bmp" 
                               name="bmp" 
                               placeholder="Ex: BMP001"
                               value="<?= htmlspecialchars($_POST['bmp'] ?? '') ?>">
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
                           placeholder="Descreva o item do patrimônio"
                           value="<?= htmlspecialchars($_POST['nomenclatura'] ?? '') ?>">
                </div>
                        
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="quantidade" class="block text-sm font-medium text-gray-700 mb-2">Quantidade</label>
                        <input type="number" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                               id="quantidade" 
                               name="quantidade" 
                               min="1" 
                               placeholder="1"
                               value="<?= htmlspecialchars($_POST['quantidade'] ?? '1') ?>">
                    </div>
                    <div>
                        <label for="data_inclusao" class="block text-sm font-medium text-gray-700 mb-2">Data de Inclusão</label>
                        <input type="date" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                               id="data_inclusao" 
                               name="data_inclusao" 
                               value="<?= htmlspecialchars($_POST['data_inclusao'] ?? '') ?>">
                    </div>
                    <div>
                        <label for="estado_material" class="block text-sm font-medium text-gray-700 mb-2">Estado do Material</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                id="estado_material" 
                                name="estado_material">
                            <option value="">Selecione o estado...</option>
                            <option value="Excelente" <?= ($_POST['estado_material'] ?? '') === 'Excelente' ? 'selected' : '' ?>>Excelente</option>
                            <option value="Bom" <?= ($_POST['estado_material'] ?? '') === 'Bom' ? 'selected' : '' ?>>Bom</option>
                            <option value="Regular" <?= ($_POST['estado_material'] ?? '') === 'Regular' ? 'selected' : '' ?>>Regular</option>
                            <option value="Ruim" <?= ($_POST['estado_material'] ?? '') === 'Ruim' ? 'selected' : '' ?>>Ruim</option>
                            <option value="Danificado" <?= ($_POST['estado_material'] ?? '') === 'Danificado' ? 'selected' : '' ?>>Danificado</option>
                        </select>
                    </div>
                </div>
                        
                <!-- Informações Financeiras -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">Informações Financeiras</h3>
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
                                       placeholder="0,00"
                                       value="<?= htmlspecialchars($_POST['preco_unit'] ?? '') ?>">
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
                                       placeholder="0,00"
                                       value="<?= htmlspecialchars($_POST['preco_total'] ?? '') ?>">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Deixe em branco para calcular automaticamente (Preço Unitário × Quantidade)</p>
                        </div>
                    </div>
                </div>
                        
                <!-- Informações sobre Danos -->
                <div class="bg-amber-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">Informações sobre Danos (Opcional)</h3>
                    <div>
                        <label for="dano_sofrido" class="block text-sm font-medium text-gray-700 mb-2">Descrição do Dano</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                  id="dano_sofrido" 
                                  name="dano_sofrido" 
                                  rows="3" 
                                  placeholder="Descreva os danos sofridos pelo item, se houver..."><?= htmlspecialchars($_POST['dano_sofrido'] ?? '') ?></textarea>
                    </div>
                        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="causa_dano" class="block text-sm font-medium text-gray-700 mb-2">Causa do Dano</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="causa_dano" 
                                   name="causa_dano" 
                                   placeholder="Ex: Acidente, desgaste natural"
                                   value="<?= htmlspecialchars($_POST['causa_dano'] ?? '') ?>">
                        </div>
                        <div>
                            <label for="responsavel_dano" class="block text-sm font-medium text-gray-700 mb-2">Responsável pelo Dano</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="responsavel_dano" 
                                   name="responsavel_dano" 
                                   placeholder="Nome do responsável"
                                   value="<?= htmlspecialchars($_POST['responsavel_dano'] ?? '') ?>">
                        </div>
                    </div>
                        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="motivo_forca_maior" class="block text-sm font-medium text-gray-700 mb-2">Motivo de Força Maior</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                   id="motivo_forca_maior" 
                                   name="motivo_forca_maior" 
                                   placeholder="Ex: Enchente, incêndio"
                                   value="<?= htmlspecialchars($_POST['motivo_forca_maior'] ?? '') ?>">
                        </div>
                        <div>
                            <label for="materia_prima_aproveitavel" class="block text-sm font-medium text-gray-700 mb-2">Matéria Prima Aproveitável</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                                    id="materia_prima_aproveitavel" 
                                    name="materia_prima_aproveitavel">
                                <option value="">Selecione...</option>
                                <option value="Sim" <?= ($_POST['materia_prima_aproveitavel'] ?? '') === 'Sim' ? 'selected' : '' ?>>Sim</option>
                                <option value="Não" <?= ($_POST['materia_prima_aproveitavel'] ?? '') === 'Não' ? 'selected' : '' ?>>Não</option>
                                <option value="Parcialmente" <?= ($_POST['materia_prima_aproveitavel'] ?? '') === 'Parcialmente' ? 'selected' : '' ?>>Parcialmente</option>
                            </select>
                        </div>
                    </div>
                </div>
                        
                <div>
                    <label for="outros_esclarecimentos" class="block text-sm font-medium text-gray-700 mb-2">Outros Esclarecimentos</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200" 
                              id="outros_esclarecimentos" 
                              name="outros_esclarecimentos" 
                              rows="3" 
                              placeholder="Informações adicionais sobre o patrimônio..."><?= htmlspecialchars($_POST['outros_esclarecimentos'] ?? '') ?></textarea>
                </div>
                        
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="<?= url('patrimonio') ?>" class="inline-flex items-center justify-center px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-primary-500 hover:bg-primary-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Salvar Patrimônio
                    </button>
                </div>
            </form>
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

// Validação e confirmação do formulário com SweetAlert2
document.getElementById('patrimonioForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nomenclatura = document.getElementById('nomenclatura').value.trim();
    
    if (!nomenclatura) {
        Swal.fire({
            icon: 'error',
            title: 'Campo obrigatório',
            text: 'A nomenclatura é obrigatória.',
            confirmButtonColor: '#3B82F6'
        });
        return;
    }
    
    Swal.fire({
        title: 'Confirmar cadastro',
        text: 'Deseja salvar este patrimônio?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3B82F6',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Sim, salvar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                this.submit();
                resolve();
            });
        }
    });
});

// Mostrar notificação de sucesso se patrimônio foi criado
if (window.location.search.includes('success=created')) {
    Swal.fire({
        icon: 'success',
        title: 'Patrimônio cadastrado!',
        text: 'O patrimônio foi cadastrado com sucesso.',
        confirmButtonColor: '#3B82F6'
    }).then(() => {
        window.location.href = '/patrimonio';
    });
}
</script>