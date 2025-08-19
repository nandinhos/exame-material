<?php

class PatrimonioController {
    private $patrimonioModel;
    
    public function __construct() {
        require_once APP_PATH . '/Models/Patrimonio.php';
        $this->patrimonioModel = new Patrimonio();
    }
    
    public function index() {
        $search = $_GET['search'] ?? '';
        $classe = $_GET['classe'] ?? '';
        $estado = $_GET['estado'] ?? '';
        
        if (!empty($search)) {
            $patrimonios = $this->patrimonioModel->search($search);
        } elseif (!empty($classe)) {
            $patrimonios = $this->patrimonioModel->getByClasse($classe);
        } else {
            $patrimonios = $this->patrimonioModel->getAll();
        }
        
        $classes = $this->patrimonioModel->getClasses();
        $estados = $this->patrimonioModel->getEstadosMaterial();
        $totalValue = $this->patrimonioModel->getTotalValue();
        $totalQuantidade = $this->patrimonioModel->getTotalQuantidade();
        $totalItems = count($patrimonios);
        
        include APP_PATH . '/Views/templates/header.php';
        include APP_PATH . '/Views/patrimonio/index.php';
        include APP_PATH . '/Views/templates/footer.php';
    }
    
    public function import() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleFileUpload();
        } else {
            include APP_PATH . '/Views/templates/header.php';
            include APP_PATH . '/Views/patrimonio/import.php';
            include APP_PATH . '/Views/templates/footer.php';
        }
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreate();
        } else {
            include APP_PATH . '/Views/templates/header.php';
            include APP_PATH . '/Views/patrimonio/create.php';
            include APP_PATH . '/Views/templates/footer.php';
        }
    }
    
    public function edit($id) {
        $patrimonio = $this->patrimonioModel->getById($id);
        if (!$patrimonio) {
            header('Location: patrimonio?error=not_found');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleUpdate($id);
        } else {
            include APP_PATH . '/Views/templates/header.php';
            include APP_PATH . '/Views/patrimonio/edit.php';
            include APP_PATH . '/Views/templates/footer.php';
        }
    }
    
    public function delete($id) {
        $patrimonio = $this->patrimonioModel->getById($id);
        if (!$patrimonio) {
            header('Location: /exame-material/public/patrimonio?error=not_found');
            exit;
        }
        
        if ($this->patrimonioModel->delete($id)) {
            header('Location: /exame-material/public/patrimonio?success=deleted');
        } else {
            header('Location: /exame-material/public/patrimonio?error=delete_failed');
        }
        exit;
    }
    
    public function export($id) {
        try {
            $patrimonio = $this->patrimonioModel->getById($id);
            
            if (!$patrimonio) {
                header('Location: /exame-material/public/patrimonio?error=not_found');
                exit;
            }
            
            // Preparar variáveis para o template PDF
            $classe = $patrimonio['classe'] ?? 'N/A';
            $bmp = $patrimonio['bmp'] ?? 'N/A';
            $nomenclatura = $patrimonio['nomenclatura'] ?? 'N/A';
            $qtd = $patrimonio['quantidade'] ?? 0;
            $data_inclusao = $patrimonio['data_inclusao'] ? date('d/m/Y', strtotime($patrimonio['data_inclusao'])) : 'N/A';
            $preco_unit = $patrimonio['preco_unit'] ?? 0;
            $preco_total = $patrimonio['preco_total'] ?? 0;
            $estado_material = $patrimonio['estado_material'] ?? 'N/A';
            $dano_sofrido = $patrimonio['dano_sofrido'] ?? 'N/A';
            $causa_dano = $patrimonio['causa_dano'] ?? 'N/A';
            $motivo_forca_maior = $patrimonio['motivo_forca_maior'] ?? 'N/A';
            $responsavel_dano = $patrimonio['responsavel_dano'] ?? 'N/A';
            $materia_prima_aproveitavel = $patrimonio['materia_prima_aproveitavel'] ?? 'N/A';
            $outros_esclarecimentos = $patrimonio['outros_esclarecimentos'] ?? 'N/A';
            
            // Definir headers para PDF
            header('Content-Type: text/html; charset=UTF-8');
            header('Content-Disposition: inline; filename="patrimonio_' . $bmp . '.pdf"');
            
            // Incluir o template PDF
            include APP_PATH . '/Views/patrimonio/export.php';
            
        } catch (Exception $e) {
            header('Location: /exame-material/public/patrimonio?error=export_failed');
            exit;
        }
    }
    
    public function configureExport() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processar formulário e gerar PDF
            $numero_termo = $_POST['numero_termo'] ?? '002/ICEA/2024';
            $protocolo = $_POST['protocolo'] ?? '';
            $corpo_documento = $_POST['corpo_documento'] ?? '';
            $oficio = $_POST['oficio'] ?? '';
            
            // Processar campos de assinatura e término do documento
            $local_assinatura = $_POST['local_assinatura'] ?? '';
            $data_assinatura = $_POST['data_assinatura'] ?? '';
            $local_data = !empty($local_assinatura) && !empty($data_assinatura) ? $local_assinatura . ', ' . $data_assinatura : '';
            $presidente_nome = $_POST['presidente_nome'] ?? '';
            $membros = $_POST['membros'] ?? [];
            $confere_local = $_POST['confere_local'] ?? '';
            $confere_data = $_POST['confere_data'] ?? '';
            $confere_local_data = !empty($confere_local) && !empty($confere_data) ? $confere_local . ', ' . $confere_data : '';
            $agente_controle_nome = $_POST['agente_controle'] ?? '';
            $texto_final = $_POST['texto_final'] ?? '';
            
            try {
                $patrimonios = $this->patrimonioModel->getAll();
                
                if (empty($patrimonios)) {
                    header('Location: /exame-material/public/patrimonio/configure-export?error=no_items');
                    exit;
                }
                
                // Configurar cabeçalhos para HTML
                header('Content-Type: text/html; charset=UTF-8');
                
                // Incluir o template de exportação com os dados do formulário
                include APP_PATH . '/Views/patrimonio/export_all.php';
                
            } catch (Exception $e) {
                error_log("Erro na exportação completa: " . $e->getMessage());
                header('Location: /exame-material/public/patrimonio/configure-export?error=export_failed');
                exit;
            }
        } else {
            // Exibir formulário de configuração
            include APP_PATH . '/Views/patrimonio/configure_export.php';
        }
    }
    
    public function exportAll() {
        try {
            $patrimonios = $this->patrimonioModel->getAll();
            
            if (empty($patrimonios)) {
                header('Location: /exame-material/public/patrimonio?error=no_items');
                exit;
            }
            
            // Configurar cabeçalhos para HTML
            header('Content-Type: text/html; charset=UTF-8');
            header('Content-Disposition: attachment; filename="patrimonio_completo_' . date('Y-m-d_H-i-s') . '.html"');
            
            // Incluir o template PDF para todos os itens
            include APP_PATH . '/Views/patrimonio/export_all.php';
            
        } catch (Exception $e) {
            header('Location: /exame-material/public/patrimonio?error=export_failed');
            exit;
        }
    }
    
    public function handleCreate() {
        $data = [
            'classe' => $_POST['classe'] ?? null,
            'bmp' => $_POST['bmp'] ?? null,
            'nomenclatura' => $_POST['nomenclatura'] ?? '',
            'quantidade' => $_POST['quantidade'] ?? 1,
            'data_inclusao' => $_POST['data_inclusao'] ?? null,
            'preco_unit' => $_POST['preco_unit'] ?? 0.00,
            'preco_total' => $_POST['preco_total'] ?? 0.00,
            'estado_material' => $_POST['estado_material'] ?? null,
            'dano_sofrido' => $_POST['dano_sofrido'] ?? null,
            'causa_dano' => $_POST['causa_dano'] ?? null,
            'motivo_forca_maior' => $_POST['motivo_forca_maior'] ?? null,
            'responsavel_dano' => $_POST['responsavel_dano'] ?? null,
            'materia_prima_aproveitavel' => $_POST['materia_prima_aproveitavel'] ?? null,
            'outros_esclarecimentos' => $_POST['outros_esclarecimentos'] ?? null
        ];
        
        // Validação básica
        if (empty($data['nomenclatura'])) {
            header('Location: /exame-material/public/patrimonio/create?error=nomenclatura_required');
            exit;
        }
        
        // Calcular preço total se não fornecido
        if (empty($data['preco_total']) && !empty($data['preco_unit']) && !empty($data['quantidade'])) {
            $data['preco_total'] = $data['preco_unit'] * $data['quantidade'];
        }
        
        if ($this->patrimonioModel->create($data)) {
            header('Location: /exame-material/public/patrimonio?success=created');
        } else {
            header('Location: /exame-material/public/patrimonio/create?error=create_failed');
        }
        exit;
    }
    
    public function handleUpdate($id) {
        $data = [
            'classe' => $_POST['classe'] ?? null,
            'bmp' => $_POST['bmp'] ?? null,
            'nomenclatura' => $_POST['nomenclatura'] ?? '',
            'quantidade' => $_POST['quantidade'] ?? 1,
            'data_inclusao' => $_POST['data_inclusao'] ?? null,
            'preco_unit' => $_POST['preco_unit'] ?? 0.00,
            'preco_total' => $_POST['preco_total'] ?? 0.00,
            'estado_material' => $_POST['estado_material'] ?? null,
            'dano_sofrido' => $_POST['dano_sofrido'] ?? null,
            'causa_dano' => $_POST['causa_dano'] ?? null,
            'motivo_forca_maior' => $_POST['motivo_forca_maior'] ?? null,
            'responsavel_dano' => $_POST['responsavel_dano'] ?? null,
            'materia_prima_aproveitavel' => $_POST['materia_prima_aproveitavel'] ?? null,
            'outros_esclarecimentos' => $_POST['outros_esclarecimentos'] ?? null
        ];
        
        // Validação básica
        if (empty($data['nomenclatura'])) {
            header('Location: /exame-material/public/patrimonio/edit/' . $id . '?error=nomenclatura_required');
            exit;
        }
        
        // Calcular preço total se não fornecido
        if (empty($data['preco_total']) && !empty($data['preco_unit']) && !empty($data['quantidade'])) {
            $data['preco_total'] = $data['preco_unit'] * $data['quantidade'];
        }
        
        if ($this->patrimonioModel->update($id, $data)) {
            header('Location: /exame-material/public/patrimonio?success=updated');
        } else {
            header('Location: /exame-material/public/patrimonio/edit/' . $id . '?error=update_failed');
        }
        exit;
    }
    
    private function handleFileUpload() {
        if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = PUBLIC_PATH . '/uploads/';
            $fileName = time() . '_' . $_FILES['csv_file']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            // Verificar se o diretório existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadPath)) {
                $result = $this->importFromCSV($uploadPath);
                if ($result['imported'] > 0) {
                    header('Location: /exame-material/public/patrimonio?success=' . $result['imported']);
                } else {
                    header('Location: /exame-material/public/patrimonio/import?error=import&details=' . urlencode(implode('; ', $result['errors'])));
                }
            } else {
                // Log do erro para debug
                error_log("Erro no upload: " . print_r($_FILES, true));
                error_log("Upload dir: " . $uploadDir);
                error_log("Upload path: " . $uploadPath);
                header('Location: /exame-material/public/patrimonio/import?error=upload');
            }
        } else {
            // Log do erro para debug
            error_log("Erro no arquivo: " . ($_FILES['csv_file']['error'] ?? 'Arquivo não enviado'));
            header('Location: /exame-material/public/patrimonio/import?error=file');
        }
    }
    
    public function processImport($csvData) {
        $imported = 0;
        $errors = [];
        
        foreach ($csvData as $index => $row) {
            // Pular cabeçalho
            if ($index === 0) continue;
            
            // Validar dados obrigatórios
            if (empty($row[2])) { // nomenclatura é obrigatória
                $errors[] = "Linha " . ($index + 1) . ": Nomenclatura é obrigatória";
                continue;
            }
            
            // Verificar se BMP já existe (se fornecido)
            if (!empty($row[1])) {
                $existing = $this->patrimonioModel->getByBmp($row[1]);
                if ($existing) {
                    $errors[] = "Linha " . ($index + 1) . ": BMP {$row[1]} já existe";
                    continue;
                }
            }
            
            $data = [
                'classe' => $row[0] ?? null,
                'bmp' => $row[1] ?? null,
                'nomenclatura' => $row[2],
                'quantidade' => intval($row[3] ?? 1),
                'data_inclusao' => !empty($row[4]) ? $row[4] : null,
                'preco_unit' => floatval($row[5] ?? 0),
                'preco_total' => floatval($row[6] ?? 0),
                'estado_material' => $row[7] ?? null,
                'dano_sofrido' => $row[8] ?? null,
                'causa_dano' => $row[9] ?? null,
                'motivo_forca_maior' => $row[10] ?? null,
                'responsavel_dano' => $row[11] ?? null,
                'materia_prima_aproveitavel' => $row[12] ?? null,
                'outros_esclarecimentos' => $row[13] ?? null
            ];
            
            try {
                $this->patrimonioModel->create($data);
                $imported++;
            } catch (Exception $e) {
                $errors[] = "Linha " . ($index + 1) . ": Erro ao importar - " . $e->getMessage();
            }
        }
        
        return [
            'imported' => $imported,
            'errors' => $errors
        ];
    }
    
    private function importFromCSV($filePath) {
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            $csvData = [];
            while (($data = fgetcsv($handle, 0, ';', '"', '\\')) !== FALSE) {
                $csvData[] = $data;
            }
            fclose($handle);
            
            return $this->processImport($csvData);
        }
        return ['imported' => 0, 'errors' => ['Erro ao abrir arquivo CSV']];
    }
}