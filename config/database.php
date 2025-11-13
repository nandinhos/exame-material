<?php

// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'exame');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('DB_CHARSET', 'utf8');

// Configurações da aplicação
define('APP_NAME', 'Sistema de Patrimônio');
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development'); // development, production

// Configurações de URL
// Detectar automaticamente o caminho base
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = dirname($scriptName);

// Remover /public do caminho se presente
if (substr($basePath, -7) === '/public') {
    $basePath = substr($basePath, 0, -7);
}

// Para o servidor PHP built-in rodando na pasta public, não incluir /public na URL
$publicPath = rtrim($basePath, '/');

define('BASE_URL', $protocol . '://' . $host);
define('BASE_PATH', $publicPath);

// Função para gerar URLs corretas
function url($path = '')
{
    $path = ltrim($path, '/');

    // Detectar se estamos no servidor de desenvolvimento local
    $isLocalDev = (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost:8000');

    if ($isLocalDev) {
        // No servidor de desenvolvimento, usar caminhos relativos
        return '/' . $path;
    } else {
        // Em produção, usar caminho completo
        if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico)$/i', $path)) {
            return BASE_URL . '/exame-material/public/' . $path;
        }
        return BASE_URL . '/exame-material/public' . ($path ? '/' . $path : '');
    }
}

// Função para gerar URLs completas
function fullUrl($path = '')
{
    $path = ltrim($path, '/');
    return BASE_URL . ($path ? '/' . $path : '');
}

// Configurações de upload
define('UPLOAD_MAX_SIZE', 10 * 1024 * 1024); // 10MB
define('UPLOAD_ALLOWED_TYPES', ['csv']);
define('UPLOAD_PATH', '../public/uploads/');

// Configurações de timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de erro (apenas para desenvolvimento)
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
}

// Configurações de sessão (antes de iniciar a sessão)
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Mudar para 1 em HTTPS
}

// Script SQL para criação da tabela (comentado para referência)
/*
CREATE DATABASE IF NOT EXISTS exame CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE exame;

CREATE TABLE patrimonio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classe VARCHAR(255) NULL,
    bmp VARCHAR(255) NULL,
    nomenclatura VARCHAR(255) NOT NULL,
    quantidade INT DEFAULT 1,
    data_inclusao DATE NULL,
    preco_unit DECIMAL(10, 2) DEFAULT 0.00,
    preco_total DECIMAL(10, 2) DEFAULT 0.00,
    estado_material VARCHAR(255) NULL,
    dano_sofrido TEXT NULL,
    causa_dano VARCHAR(255) NULL,
    motivo_forca_maior VARCHAR(255) NULL,
    responsavel_dano VARCHAR(255) NULL,
    materia_prima_aproveitavel VARCHAR(255) NULL,
    outros_esclarecimentos TEXT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir alguns dados de exemplo
INSERT INTO patrimonio (classe, bmp, nomenclatura, quantidade, data_inclusao, preco_unit, preco_total, estado_material) VALUES
('Informática', 'BMP001', 'Notebook Dell Inspiron 15', 1, '2024-01-15', 2500.00, 2500.00, 'Bom'),
('Móveis', 'BMP002', 'Mesa de Escritório em L', 1, '2024-01-16', 450.50, 450.50, 'Bom'),
('Móveis', 'BMP003', 'Cadeira Ergonômica', 2, '2024-01-17', 380.00, 760.00, 'Bom'),
('Informática', 'BMP004', 'Monitor Samsung 24 polegadas', 1, '2024-01-18', 650.00, 650.00, 'Bom'),
('Informática', 'BMP005', 'Impressora HP LaserJet', 1, '2024-01-19', 890.00, 890.00, 'Bom');
*/
