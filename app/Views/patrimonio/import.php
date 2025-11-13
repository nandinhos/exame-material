<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Importação de Patrimônios</h1>
                    <p class="text-gray-600">Faça upload de um arquivo CSV para importar múltiplos patrimônios de forma rápida e eficiente</p>
                </div>
                <div class="flex justify-center lg:justify-end">
                    <a href="<?= url('patrimonio') ?>" class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl whitespace-nowrap no-underline">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Voltar ao Sistema
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            <div class="p-6">
                <?php if (isset($_GET['error'])): ?>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-medium text-red-800">Erro durante a importação</h3>
                                <div class="mt-1 text-sm text-red-700">
                                    <?php if ($_GET['error'] === 'upload'): ?>
                                        Falha no upload do arquivo. Verifique o arquivo e tente novamente.
                                    <?php elseif ($_GET['error'] === 'file'): ?>
                                        Nenhum arquivo foi selecionado ou o arquivo está corrompido.
                                    <?php elseif ($_GET['error'] === 'import'): ?>
                                        Ocorreram erros ao processar o CSV:
                                        <?php if (!empty($_GET['details'])): ?>
                                            <ul class="mt-2 list-disc list-inside">
                                            <?php foreach (explode('; ', $_GET['details']) as $d): ?>
                                                <li><?= htmlspecialchars($d) ?></li>
                                            <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            Verifique o formato do arquivo e tente novamente.
                                        <?php endif; ?>
                                    <?php else: ?>
                                        Ocorreu um erro inesperado. Verifique o arquivo e tente novamente.
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                    
                <!-- Instruções de Importação -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-8 shadow-sm mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Instruções para Importação</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start space-x-3 p-4 bg-white rounded-lg border border-gray-100">
                                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-sm">Arquivo no formato CSV com codificação UTF-8</span>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-white rounded-lg border border-gray-100">
                                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-sm">Primeira linha com cabeçalhos conforme especificado</span>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-amber-50 rounded-lg border border-amber-200">
                                    <div class="w-6 h-6 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-amber-800 text-sm">Use pontos (.) como separador decimal</span>
                                </div>
                                <div class="flex items-start space-x-3 p-4 bg-red-50 rounded-lg border border-red-200">
                                    <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-red-800 text-sm"><strong>Obrigatórios:</strong> nomenclatura, preço unitário, preço total</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <!-- Formulário de Upload -->
                <form action="<?= url('patrimonio/import') ?>" method="POST" enctype="multipart/form-data" id="importForm" class="mb-8">
                    <div class="space-y-8">
                        <!-- Upload Area -->
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-12 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-300" id="uploadArea">
                            <div class="space-y-6">
                                <div class="mx-auto w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-300">
                                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                    </svg>
                                </div>
                                <div>
                                    <label for="csv_file" class="cursor-pointer">
                                        <span class="text-xl font-semibold text-gray-900 block">Selecione seu arquivo CSV</span>
                                        <span class="text-base text-gray-600 mt-2 block">ou arraste e solte aqui</span>
                                    </label>
                                    <input type="file" class="hidden" id="csv_file" name="csv_file" accept=".csv" required>
                                </div>
                                <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Apenas arquivos CSV • Máximo 10MB</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- File Info -->
                        <div id="fileInfo" class="hidden bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900" id="fileName"></p>
                                        <p class="text-xs text-gray-500" id="fileSize"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="clearFile()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="text-center pt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-10 rounded-xl transition-all duration-200 inline-flex items-center space-x-3 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                                <span>Iniciar Importação</span>
                            </button>
                        </div>
                    </div>
                </form>
                    
                <!-- Formato do arquivo -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Formato do Arquivo CSV</h3>
                            <p class="text-gray-600">O arquivo deve conter as seguintes colunas na ordem especificada:</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">1. Classe</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">2. BMP</span>
                                <span class="text-xs text-gray-500">recomendado</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border border-red-200">
                                <span class="text-sm font-medium">3. Nomenclatura</span>
                                <span class="text-xs text-red-600 font-medium">obrigatório</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">4. Quantidade</span>
                                <span class="text-xs text-gray-500">padrão: 1</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">5. Data Inclusão</span>
                                <span class="text-xs text-gray-500">YYYY-MM-DD</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border border-red-200">
                                <span class="text-sm font-medium">6. Preço Unitário</span>
                                <span class="text-xs text-red-600 font-medium">obrigatório</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border border-red-200">
                                <span class="text-sm font-medium">7. Preço Total</span>
                                <span class="text-xs text-red-600 font-medium">obrigatório</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">8. Estado Material</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">9. Dano Sofrido</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">10. Causa Dano</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">11. Motivo Força Maior</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">12. Responsável Dano</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">13. Matéria Prima Aproveitável</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-white rounded border">
                                <span class="text-sm font-medium">14. Outros Esclarecimentos</span>
                                <span class="text-xs text-gray-500">opcional</span>
                            </div>
                        </div>
                    </div>
                        
                    <div class="bg-gray-900 rounded-xl p-6 mb-6 border border-gray-700">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            <h4 class="text-base font-semibold text-gray-100">Exemplo de Arquivo CSV</h4>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-4 border border-gray-600">
                            <pre class="text-xs text-green-400 overflow-x-auto leading-relaxed"><code>classe,bmp,nomenclatura,quantidade,data_inclusao,preco_unit,preco_total,estado_material,dano_sofrido,causa_dano,motivo_forca_maior,responsavel_dano,materia_prima_aproveitavel,outros_esclarecimentos
"Móveis","BMP001","Mesa de escritório",1,"2024-01-15",350.00,350.00,"Bom","","","","","",""
"Equipamentos","BMP002","Computador Dell",1,"2024-01-16",2500.50,2500.50,"Excelente","","","","","",""</code></pre>
                        </div>
                    </div>
                    
                    <!-- Link para download do exemplo -->
                    <div class="flex justify-center">
                        <a href="../../dados.csv" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 no-underline" download>
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Baixar Arquivo de Exemplo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Drag and drop functionality
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('csv_file');
const fileInfo = document.getElementById('fileInfo');
const fileName = document.getElementById('fileName');
const fileSize = document.getElementById('fileSize');
const submitBtn = document.getElementById('submitBtn');

// Prevent default drag behaviors
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

// Highlight drop area when item is dragged over it
['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, unhighlight, false);
});

// Handle dropped files
uploadArea.addEventListener('drop', handleDrop, false);

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function highlight(e) {
    uploadArea.classList.add('border-primary-400', 'bg-primary-50');
}

function unhighlight(e) {
    uploadArea.classList.remove('border-primary-400', 'bg-primary-50');
}

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        fileInput.files = files;
        handleFileSelect(files[0]);
    }
}

// Handle file selection
fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        handleFileSelect(file);
    }
});

function handleFileSelect(file) {
    // Verificar tamanho (10MB)
    if (file.size > 10 * 1024 * 1024) {
        Swal.fire({
            icon: 'error',
            title: 'Arquivo muito grande',
            text: 'O arquivo deve ter no máximo 10MB.',
            confirmButtonColor: '#3B82F6'
        });
        clearFile();
        return;
    }
    
    // Verificar extensão
    if (!file.name.toLowerCase().endsWith('.csv')) {
        Swal.fire({
            icon: 'error',
            title: 'Formato inválido',
            text: 'Por favor, selecione um arquivo CSV.',
            confirmButtonColor: '#3B82F6'
        });
        clearFile();
        return;
    }
    
    // Show file info
    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);
    fileInfo.classList.remove('hidden');
    uploadArea.classList.add('border-green-400', 'bg-green-50');
}

function clearFile() {
    fileInput.value = '';
    fileInfo.classList.add('hidden');
    uploadArea.classList.remove('border-green-400', 'bg-green-50', 'border-primary-400', 'bg-primary-50');
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Form submission
document.getElementById('importForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!fileInput.files[0]) {
        Swal.fire({
            icon: 'warning',
            title: 'Nenhum arquivo selecionado',
            text: 'Por favor, selecione um arquivo CSV para importar.',
            confirmButtonColor: '#3B82F6'
        });
        return;
    }
    
    Swal.fire({
        title: 'Confirmar importação',
        text: 'Deseja importar os dados do arquivo selecionado?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3B82F6',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Sim, importar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Importando...';
            submitBtn.disabled = true;
            this.submit();
        }
    });
});
</script>
