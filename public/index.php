<?php

// Arquivo principal de entrada da aplicação
// Este arquivo gerencia o roteamento e inicialização do sistema

// Iniciar sessão
session_start();

// Incluir configurações
require_once '../config/database.php';

// Definir caminhos
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', __DIR__);

// Autoload simples para as classes
spl_autoload_register(function ($className) {
    $paths = [
        APP_PATH . '/Controllers/' . $className . '.php',
        APP_PATH . '/Models/' . $className . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
});

// Função para roteamento simples
function route($uri) {
    // Remover query string
    $uri = strtok($uri, '?');
    
    // Remover barras extras
    $uri = trim($uri, '/');
    
    // Roteamento básico
    switch ($uri) {
        case '':
        case 'index.php':
        case 'patrimonio':
        case 'patrimonio/index':
            $controller = new PatrimonioController();
            $controller->index();
            break;
            
        case 'patrimonio/import':
        case 'import.php':
            $controller = new PatrimonioController();
            $controller->import();
            break;
            
        case 'patrimonio/create':
            $controller = new PatrimonioController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleCreate();
            } else {
                $controller->create();
            }
            break;
            
        default:
            // Verificar rotas dinâmicas com parâmetros
            if (preg_match('/^patrimonio\/edit\/(\d+)$/', $uri, $matches)) {
                $controller = new PatrimonioController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->handleUpdate($matches[1]);
                } else {
                    $controller->edit($matches[1]);
                }
                break;
            }
            
            if (preg_match('/^patrimonio\/delete\/(\d+)$/', $uri, $matches)) {
                $controller = new PatrimonioController();
                $controller->delete($matches[1]);
                break;
            }
            
            if (preg_match('/^patrimonio\/export\/(\d+)$/', $uri, $matches)) {
                $controller = new PatrimonioController();
                $controller->export($matches[1]);
                break;
            }
            
            if ($uri === 'patrimonio/export-all') {
                $controller = new PatrimonioController();
                $controller->exportAll();
                break;
            }
            
            if ($uri === 'patrimonio/configure-export') {
                $controller = new PatrimonioController();
                $controller->configureExport();
                break;
            }
            // Verificar se é um arquivo estático
            $filePath = PUBLIC_PATH . '/' . $uri;
            if (file_exists($filePath) && is_file($filePath)) {
                // Servir arquivo estático
                $mimeType = mime_content_type($filePath);
                header('Content-Type: ' . $mimeType);
                readfile($filePath);
                exit;
            }
            
            // Página não encontrada
            http_response_code(404);
            include '../app/Views/templates/header.php';
            echo '<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">';
            echo '<div class="max-w-md w-full text-center">';
            echo '<div class="mb-8">';
            echo '<h1 class="text-9xl font-bold text-gray-300 mb-4">404</h1>';
            echo '<h2 class="text-2xl font-semibold text-gray-900 mb-4">Página não encontrada</h2>';
            echo '<p class="text-gray-600 mb-8">A página que você está procurando não existe ou foi movida.</p>';
            echo '<a href="' . url('patrimonio') . '" class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200">';
            echo '<i class="fas fa-home mr-2"></i>Voltar ao início</a>';
            echo '</div></div></div>';
            echo '<style>body { margin: 0; }</style>';
            include '../app/Views/templates/footer.php';
            break;
    }
}

// Função para tratamento de erros
function handleError($errno, $errstr, $errfile, $errline) {
    // Não exibir erros durante redirects (POST requests)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        error_log("Erro: $errstr em $errfile na linha $errline");
        return true;
    }
    
    if (APP_ENV === 'development') {
        echo "<div class='bg-red-50 border border-red-200 rounded-lg p-4 m-4'>";
        echo "<div class='flex items-center'>";
        echo "<i class='fas fa-exclamation-circle text-red-500 mr-3'></i>";
        echo "<div class='text-red-800'>";
        echo "<strong>Erro:</strong> $errstr<br>";
        echo "<strong>Arquivo:</strong> $errfile<br>";
        echo "<strong>Linha:</strong> $errline";
        echo "</div></div></div>";
    } else {
        error_log("Erro: $errstr em $errfile na linha $errline");
        echo "<div class='bg-red-50 border border-red-200 rounded-lg p-4 m-4'>";
        echo "<div class='flex items-center'>";
        echo "<i class='fas fa-exclamation-circle text-red-500 mr-3'></i>";
        echo "<span class='text-red-800'>Ocorreu um erro interno. Tente novamente.</span>";
        echo "</div></div>";
    }
}

// Função para tratamento de exceções
function handleException($exception) {
    // Não exibir exceções durante redirects (POST requests)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        error_log("Exceção: " . $exception->getMessage());
        return;
    }
    
    if (APP_ENV === 'development') {
        echo "<div class='bg-red-50 border border-red-200 rounded-lg p-4 m-4'>";
        echo "<div class='flex items-start'>";
        echo "<i class='fas fa-exclamation-circle text-red-500 mr-3 mt-1'></i>";
        echo "<div class='text-red-800'>";
        echo "<strong>Exceção:</strong> " . $exception->getMessage() . "<br>";
        echo "<strong>Arquivo:</strong> " . $exception->getFile() . "<br>";
        echo "<strong>Linha:</strong> " . $exception->getLine() . "<br>";
        echo "<strong>Stack Trace:</strong><pre class='mt-2 text-sm bg-red-100 p-2 rounded overflow-auto'>" . $exception->getTraceAsString() . "</pre>";
        echo "</div></div></div>";
    } else {
        error_log("Exceção: " . $exception->getMessage());
        echo "<div class='bg-red-50 border border-red-200 rounded-lg p-4 m-4'>";
        echo "<div class='flex items-center'>";
        echo "<i class='fas fa-exclamation-circle text-red-500 mr-3'></i>";
        echo "<span class='text-red-800'>Ocorreu um erro interno. Tente novamente.</span>";
        echo "</div></div>";
    }
}

// Registrar handlers de erro
set_error_handler('handleError');
set_exception_handler('handleException');

// Obter URI da requisição
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

// Remover o caminho base se necessário
$basePath = '/exame-material/public';
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

// Remover index.php da URL se presente
if (strpos($requestUri, '/index.php') === 0) {
    $requestUri = substr($requestUri, strlen('/index.php'));
}

// Limpar a URI de parâmetros duplicados
$requestUri = preg_replace('/\/+/', '/', $requestUri);
$requestUri = rtrim($requestUri, '/');

// Debug: log da URI para diagnóstico
if (defined('APP_ENV') && APP_ENV === 'development') {
    error_log("URI processada: " . $requestUri);
}

// Executar roteamento
try {
    route($requestUri);
} catch (Exception $e) {
    handleException($e);
}

?>