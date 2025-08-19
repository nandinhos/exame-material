<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Patrimônio</title>
    
    <!-- Tailwind CSS Local para Produção -->
    <link href="<?= url('css/tailwind.min.css') ?>" rel="stylesheet">
    
    <!-- Tailwind CSS customizado local -->
    <link href="<?= url('css/tailwind-custom.css') ?>" rel="stylesheet">
    
    <!-- Font Awesome com fallback melhorado -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" 
          onload="window.fontAwesomeLoaded = true;" 
          onerror="this.onerror=null; console.warn('FontAwesome CDN falhou, carregando fallback'); loadFontAwesomeFallback();">
    
    <!-- Fallback local para Font Awesome -->
    <link href="<?= url('css/fontawesome-fallback.css') ?>" rel="stylesheet" id="fa-fallback" disabled>
    
    <!-- SweetAlert2 com fallback melhorado -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" 
            onload="window.sweetAlert2Loaded = true;" 
            onerror="this.onerror=null; console.warn('SweetAlert2 CDN falhou, carregando fallback'); loadSweetAlert2Fallback();"></script>
    
    <!-- Fallback local para SweetAlert2 -->
    <script src="<?= url('js/sweetalert2-fallback.js') ?>" id="swal-fallback" class="display-none"></script>
    
    <!-- Script de gerenciamento de fallbacks -->
    <script>
        // Função para carregar fallback do Font Awesome
        function loadFontAwesomeFallback() {
            var fallbackLink = document.getElementById('fa-fallback');
            if (fallbackLink) {
                fallbackLink.disabled = false;
                document.body.classList.add('fa-fallback-loaded');
                console.log('Font Awesome fallback ativado');
            }
        }
        
        // Função para carregar fallback do SweetAlert2
        function loadSweetAlert2Fallback() {
            var fallbackScript = document.getElementById('swal-fallback');
            if (fallbackScript && typeof window.Swal === 'undefined') {
                fallbackScript.style.display = 'block';
                var newScript = document.createElement('script');
                newScript.src = '<?= url('js/sweetalert2-fallback.js') ?>';
                newScript.onload = function() {
                    console.log('SweetAlert2 fallback carregado');
                };
                document.head.appendChild(newScript);
            }
        }
        
        // Verificar carregamento após 2 segundos
        setTimeout(function() {
            // Verificar Font Awesome
            if (!window.fontAwesomeLoaded) {
                // Testar se Font Awesome está realmente disponível
                var testElement = document.createElement('i');
                testElement.className = 'fas fa-test';
                testElement.style.position = 'absolute';
                testElement.style.left = '-9999px';
                document.body.appendChild(testElement);
                
                var computedStyle = window.getComputedStyle(testElement, ':before');
                var fontFamily = computedStyle.getPropertyValue('font-family');
                
                if (!fontFamily || fontFamily.indexOf('Font Awesome') === -1) {
                    loadFontAwesomeFallback();
                }
                
                document.body.removeChild(testElement);
            }
            
            // Verificar SweetAlert2
            if (!window.sweetAlert2Loaded && typeof window.Swal === 'undefined') {
                loadSweetAlert2Fallback();
            }
        }, 2000);
    </script>
    
    <!-- Custom Styles com fallbacks -->
    <style>
        /* Fallback básico caso Tailwind não carregue */
        .fallback-styles {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.5;
        }
        
        /* Estilos básicos de fallback */
        .bg-white { background-color: #ffffff !important; }
        .bg-gray-50 { background-color: #f9fafb !important; }
        .text-gray-900 { color: #111827 !important; }
        .text-gray-600 { color: #6b7280 !important; }
        .p-4 { padding: 1rem !important; }
        .p-6 { padding: 1.5rem !important; }
        .mb-8 { margin-bottom: 2rem !important; }
        .rounded-lg { border-radius: 0.5rem !important; }
        .shadow { box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important; }
        .flex { display: flex !important; }
        .items-center { align-items: center !important; }
        .justify-between { justify-content: space-between !important; }
        
        /* Fallback para cores personalizadas */
        .text-primary-600 { color: #2563eb !important; }
        .bg-primary-50 { background-color: #eff6ff !important; }
        .bg-primary-500 { background-color: #3b82f6 !important; }
        .hover\:bg-primary-50:hover { background-color: #eff6ff !important; }
        .hover\:text-primary-600:hover { color: #2563eb !important; }
        .hover\:text-primary-700:hover { color: #1d4ed8 !important; }
        .focus\:ring-primary-500:focus { --tw-ring-color: #3b82f6 !important; }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
             from { opacity: 0; transform: translateY(20px); }
             to { opacity: 1; transform: translateY(0); }
         }
         
         /* Estilos profissionais para ícones Font Awesome */
         .fas {
             font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", sans-serif;
             font-weight: 900;
             font-style: normal;
             font-variant: normal;
             text-rendering: auto;
             line-height: 1;
             -webkit-font-smoothing: antialiased;
             -moz-osx-font-smoothing: grayscale;
         }
         
         /* Remove qualquer fundo dos ícones */
         .fas:before {
             background: none !important;
             background-color: transparent !important;
             box-shadow: none !important;
         }
         
         /* Garante que os ícones sejam exibidos corretamente */
         i.fas {
             display: inline-block;
             background: transparent !important;
             border: none !important;
             box-shadow: none !important;
         }
     </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="<?= url('patrimonio') ?>" class="flex items-center space-x-3 text-gray-800 hover:text-primary-600 transition-colors duration-200">
                        <div class="bg-primary-500 p-2 rounded-lg">
                            <i class="fas fa-building text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold">Sistema de Patrimônio</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="<?= url('patrimonio') ?>" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <i class="fas fa-list"></i>
                        <span>Listar Patrimônios</span>
                    </a>
                    <a href="<?= url('patrimonio/import') ?>" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <i class="fas fa-upload"></i>
                        <span>Importar CSV</span>
                    </a>
                    <button onclick="exportData()" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <i class="fas fa-download"></i>
                        <span>Exportar</span>
                    </button>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="space-y-2">
                    <a href="<?= url('patrimonio') ?>" class="flex items-center space-x-2 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <i class="fas fa-list"></i>
                        <span>Listar Patrimônios</span>
                    </a>
                    <a href="<?= url('patrimonio/import') ?>" class="flex items-center space-x-2 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <i class="fas fa-upload"></i>
                        <span>Importar CSV</span>
                    </a>
                    <button onclick="exportData()" class="flex items-center space-x-2 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200 w-full text-left">
                        <i class="fas fa-download"></i>
                        <span>Exportar</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="animate-fade-in">
        <!-- Seu conteúdo principal aqui -->
    </main>

    <!-- Script para o menu móvel -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>