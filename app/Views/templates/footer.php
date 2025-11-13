<!-- Main Content -->
    <main class="animate-fade-in">
        <!-- Seu conteúdo principal aqui -->
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-primary-500 p-2 rounded-lg">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-semibold text-gray-900">Sistema de Patrimônio</h5>
                        <p class="text-sm text-gray-600">Gestão corporativa de bens com interface moderna.</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-500">
                        Desenvolvido em <?= date('Y') ?> • PHP & Tailwind CSS
                    </p>
                </div>
                <div class="md:text-right">
                    <div class="flex md:justify-end space-x-4">
                        <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors" aria-label="GitHub">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors" aria-label="Contato">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">&copy; <?= date('Y') ?> Sistema de Patrimônio. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    
    <!-- Custom JavaScript -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
        
        // Função para configurar exportação
        function exportData() {
            Swal.fire({
                title: 'Configurar Exportação',
                text: 'Deseja configurar os dados do documento antes da exportação?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-cog"></i> Configurar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const params = new URLSearchParams(window.location.search);
                    const search = params.get('search') || '';
                    const classe = params.get('classe') || '';
                    const estado = params.get('estado') || '';
                    const base = '<?= url('patrimonio/configure-export') ?>';
                    const query = new URLSearchParams({ search, classe, estado }).toString();
                    window.location.href = `${base}${query ? ('?' + query) : ''}`;
                }
            });
        }
        
        // Função para confirmar exclusão de patrimônio
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Confirmar Exclusão',
                html: `Tem certeza que deseja excluir o patrimônio:<br><strong>${name}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-trash"></i> Sim, excluir',
                cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar loading
                    Swal.fire({
                        title: 'Excluindo...',
                        text: 'Por favor, aguarde.',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Redirecionar para a rota de exclusão
                    window.location.href = `<?= url('patrimonio/delete') ?>/${id}`;
                }
            });
        }
        
        // Notificações de sucesso
        function showSuccessNotification(message) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
        
        // Notificações de erro
        function showErrorNotification(message) {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        }
        
        // Função para formatar valores monetários
        function formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        }
        
        // Função para mostrar loading em botões
        function showButtonLoading(button, text = 'Carregando...') {
            const originalContent = button.innerHTML;
            button.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i>${text}`;
            button.disabled = true;
            
            return function() {
                button.innerHTML = originalContent;
                button.disabled = false;
            };
        }
        
        // Auto-hide notifications
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar se há mensagens de sucesso ou erro na URL
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('success');
            const error = urlParams.get('error');
            
            if (success) {
                showSuccessNotification(decodeURIComponent(success));
            }
            
            if (error) {
                showErrorNotification(decodeURIComponent(error));
            }
        });
        
        // Validação de formulários em tempo real
        function setupFormValidation() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('blur', function() {
                        validateField(this);
                    });
                });
            });
        }
        
        function validateField(field) {
            const isValid = field.checkValidity();
            const errorElement = field.parentNode.querySelector('.error-message');
            
            if (!isValid) {
                field.classList.add('border-red-500', 'focus:border-red-500');
                field.classList.remove('border-gray-300', 'focus:border-primary-500');
                
                if (!errorElement) {
                    const error = document.createElement('p');
                    error.className = 'error-message text-red-500 text-sm mt-1';
                    error.textContent = field.validationMessage;
                    field.parentNode.appendChild(error);
                }
            } else {
                field.classList.remove('border-red-500', 'focus:border-red-500');
                field.classList.add('border-gray-300', 'focus:border-primary-500');
                
                if (errorElement) {
                    errorElement.remove();
                }
            }
        }
        
        // Inicializar validação quando o DOM estiver pronto
        document.addEventListener('DOMContentLoaded', setupFormValidation);
    </script>
</body>
</html>
