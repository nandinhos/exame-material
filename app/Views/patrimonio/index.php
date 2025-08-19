<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestão de Patrimônio</h1>
                    <p class="text-gray-600">Controle e gerencie todos os patrimônios da empresa</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-end">
                    <button onclick="exportData()" class="inline-flex items-center justify-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Configurar Exportação
                    </button>
                    <a href="<?= url('patrimonio/import') ?>" class="inline-flex items-center justify-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                        </svg>
                        Importar CSV
                    </a>
                </div>
            </div>
        </div>
            
        <!-- Filters and Actions Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">
                <!-- Search Bar -->
                <div class="md:col-span-2 lg:col-span-5">
                    <form method="GET" class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               placeholder="Buscar por BMP, nomenclatura ou classe..." 
                               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span class="sr-only">Buscar</span>
                        </button>
                    </form>
                </div>
                
                <!-- Class Filter -->
                <div class="lg:col-span-2">
                    <form method="GET">
                        <select name="classe" onchange="this.form.submit()" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="">Todas as classes</option>
                            <?php foreach ($classes as $cls): ?>
                                <option value="<?= htmlspecialchars($cls['classe']) ?>" <?= ($_GET['classe'] ?? '') === $cls['classe'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cls['classe']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                
                <!-- State Filter -->
                <div class="lg:col-span-2">
                    <form method="GET">
                        <select name="estado" onchange="this.form.submit()" class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="">Todos os estados</option>
                            <?php foreach ($estados as $est): ?>
                                <option value="<?= htmlspecialchars($est['estado_material']) ?>" <?= ($_GET['estado'] ?? '') === $est['estado_material'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($est['estado_material']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                
                <!-- Action Button -->
                <div class="lg:col-span-3">
                    <a href="<?= url('patrimonio/create') ?>" class="inline-flex items-center justify-center w-full px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Adicionar Patrimônio
                    </a>
                </div>
            </div>
        </div>
            
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Items Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-50"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-xl group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600 mb-1">Total de Itens</p>
                            <p class="text-3xl font-bold text-gray-900"><?= number_format($totalItems) ?></p>
                        </div>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>Patrimônios cadastrados</span>
                    </div>
                </div>
            </div>
            
            <!-- Total Quantity Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-pink-50 opacity-50"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-xl group-hover:bg-purple-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600 mb-1">Quantidade Total</p>
                            <p class="text-3xl font-bold text-gray-900"><?= number_format($totalQuantidade) ?></p>
                        </div>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Unidades em estoque</span>
                    </div>
                </div>
            </div>
            
            <!-- Total Value Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600 mb-1">Valor Total</p>
                            <p class="text-3xl font-bold text-gray-900">R$ <?= number_format($totalValue, 2, ',', '.') ?></p>
                        </div>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>Valor do patrimônio</span>
                    </div>
                </div>
            </div>
            
            <!-- Average Value Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-red-50 opacity-50"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-xl group-hover:bg-orange-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600 mb-1">Valor Médio</p>
                            <p class="text-3xl font-bold text-gray-900">R$ <?= $totalItems > 0 ? number_format($totalValue / $totalItems, 2, ',', '.') : '0,00' ?></p>
                        </div>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>Preço médio por item</span>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Patrimônios List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">Lista de Patrimônios</h2>
                    <span class="text-sm text-gray-500"><?= count($patrimonios) ?> itens encontrados</span>
                </div>
            </div>
            
            <div class="p-6">
                <?php if (empty($patrimonios)): ?>
                    <div class="text-center py-16">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl w-32 h-32 flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Nenhum patrimônio encontrado</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">Comece importando seu primeiro arquivo CSV ou adicione itens manualmente para começar a gerenciar seu patrimônio.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?= url('patrimonio/import') ?>" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                                Importar CSV
                            </a>
                            <a href="<?= url('patrimonio/create') ?>" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Adicionar Manualmente
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Desktop Table -->
                    <div class="block overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">BMP</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomenclatura</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Classe</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Quantidade</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Valor Unitário</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Estado</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($patrimonios as $item): ?>
                                        <?php include '_item.php'; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Mobile Cards -->
                    <div class="hidden space-y-4 overflow-x-auto">
                        <?php foreach ($patrimonios as $item): ?>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-900"><?= htmlspecialchars($item['bmp']) ?></h3>
                                        <p class="text-sm text-gray-600"><?= htmlspecialchars($item['nomenclatura']) ?></p>
                                    </div>
                                    <?php 
                                        $badgeClasses = 'bg-gray-100 text-gray-800';
                                        if (stripos($item['estado_material'], 'bom') !== false) {
                                            $badgeClasses = 'bg-green-100 text-green-800';
                                        } elseif (stripos($item['estado_material'], 'excelente') !== false) {
                                            $badgeClasses = 'bg-blue-100 text-blue-800';
                                        } elseif (stripos($item['estado_material'], 'ruim') !== false || stripos($item['estado_material'], 'danificado') !== false) {
                                            $badgeClasses = 'bg-red-100 text-red-800';
                                        } elseif (stripos($item['estado_material'], 'regular') !== false) {
                                            $badgeClasses = 'bg-yellow-100 text-yellow-800';
                                        }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $badgeClasses ?>">
                                        <?= htmlspecialchars($item['estado_material']) ?>
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Classe:</span>
                                        <span class="font-medium"><?= htmlspecialchars($item['classe']) ?></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Quantidade:</span>
                                        <span class="font-medium"><?= number_format($item['quantidade']) ?></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Valor Unit.:</span>
                                        <span class="font-medium">R$ <?= number_format($item['preco_unit'] ?? 0, 2, ',', '.') ?></span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="<?= url('patrimonio/edit/' . $item['id']) ?>" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete('<?= $item['id'] ?>', '<?= htmlspecialchars($item['nomenclatura']) ?>')" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Summary Card -->
                    <div class="mt-8 bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 text-center sm:text-left">Resumo da Página</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-blue-600"><?= count($patrimonios) ?></p>
                                <p class="text-sm text-gray-600">Itens listados</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-green-600">R$ <?= number_format(array_sum(array_column($patrimonios, 'preco_total')), 2, ',', '.') ?></p>
                                <p class="text-sm text-gray-600">Valor total</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-purple-600"><?= array_sum(array_column($patrimonios, 'quantidade')) ?></p>
                                <p class="text-sm text-gray-600">Quantidade total</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>