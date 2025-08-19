<tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex flex-col">
            <div class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($item['bmp'] ?? 'N/A') ?></div>
            <div class="text-xs text-gray-500">ID: <?= $item['id'] ?></div>
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="flex flex-col">
            <div class="text-sm font-medium text-gray-900 max-w-xs truncate" title="<?= htmlspecialchars($item['nomenclatura']) ?>">
                <?= htmlspecialchars($item['nomenclatura']) ?>
            </div>
            <?php if (!empty($item['dano_sofrido'])): ?>
                <div class="flex items-center mt-1">
                    <svg class="w-3 h-3 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs text-red-600 font-medium">Com dano</span>
                </div>
            <?php endif; ?>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <?php if (!empty($item['classe'])): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                <?= htmlspecialchars($item['classe']) ?>
            </span>
        <?php else: ?>
            <span class="text-gray-400 text-sm">-</span>
        <?php endif; ?>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-semibold text-gray-900"><?= number_format($item['quantidade'], 0, ',', '.') ?></div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex flex-col">
            <div class="text-sm font-semibold text-success-600">R$ <?= number_format($item['preco_unit'], 2, ',', '.') ?></div>
            <?php if ($item['preco_total'] != $item['preco_unit'] * $item['quantidade']): ?>
                <div class="text-xs text-gray-500">Total: R$ <?= number_format($item['preco_total'], 2, ',', '.') ?></div>
            <?php endif; ?>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <?php if (!empty($item['estado_material'])): ?>
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
        <?php else: ?>
            <span class="text-gray-400 text-sm">-</span>
        <?php endif; ?>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex items-center space-x-1">
            <a href="<?= url('patrimonio/export/' . $item['id']) ?>" 
               class="inline-flex items-center p-2.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-xl transition-all duration-200 group" 
               title="Exportar PDF" 
               target="_blank">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </a>
            <a href="<?= url('patrimonio/edit/' . $item['id']) ?>" 
               class="inline-flex items-center p-2.5 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-xl transition-all duration-200 group" 
               title="Editar">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </a>
            <button type="button" 
                    class="inline-flex items-center p-2.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-xl transition-all duration-200 group" 
                    title="Excluir" 
                    onclick="confirmDelete('<?= $item['id'] ?>', '<?= htmlspecialchars($item['bmp'] ?? 'N/A') ?>')">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>
    </td>
</tr>