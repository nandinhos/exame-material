<?php

require_once 'Database.php';

class Patrimonio {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $sql = "SELECT * FROM patrimonio ORDER BY id";
        return $this->db->fetchAll($sql);
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM patrimonio WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function getByBmp($bmp) {
        $sql = "SELECT * FROM patrimonio WHERE bmp = ?";
        return $this->db->fetch($sql, [$bmp]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO patrimonio (classe, bmp, nomenclatura, quantidade, data_inclusao, preco_unit, preco_total, estado_material, dano_sofrido, causa_dano, motivo_forca_maior, responsavel_dano, materia_prima_aproveitavel, outros_esclarecimentos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->execute($sql, [
            $data['classe'] ?? null,
            $data['bmp'] ?? null,
            $data['nomenclatura'],
            $data['quantidade'] ?? 1,
            $data['data_inclusao'] ?? null,
            $data['preco_unit'] ?? 0.00,
            $data['preco_total'] ?? 0.00,
            $data['estado_material'] ?? null,
            $data['dano_sofrido'] ?? null,
            $data['causa_dano'] ?? null,
            $data['motivo_forca_maior'] ?? null,
            $data['responsavel_dano'] ?? null,
            $data['materia_prima_aproveitavel'] ?? null,
            $data['outros_esclarecimentos'] ?? null
        ]);
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE patrimonio SET classe = ?, bmp = ?, nomenclatura = ?, quantidade = ?, data_inclusao = ?, preco_unit = ?, preco_total = ?, estado_material = ?, dano_sofrido = ?, causa_dano = ?, motivo_forca_maior = ?, responsavel_dano = ?, materia_prima_aproveitavel = ?, outros_esclarecimentos = ? WHERE id = ?";
        return $this->db->execute($sql, [
            $data['classe'] ?? null,
            $data['bmp'] ?? null,
            $data['nomenclatura'],
            $data['quantidade'] ?? 1,
            $data['data_inclusao'] ?? null,
            $data['preco_unit'] ?? 0.00,
            $data['preco_total'] ?? 0.00,
            $data['estado_material'] ?? null,
            $data['dano_sofrido'] ?? null,
            $data['causa_dano'] ?? null,
            $data['motivo_forca_maior'] ?? null,
            $data['responsavel_dano'] ?? null,
            $data['materia_prima_aproveitavel'] ?? null,
            $data['outros_esclarecimentos'] ?? null,
            $id
        ]);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM patrimonio WHERE id = ?";
        return $this->db->execute($sql, [$id]);
    }
    
    public function search($term) {
        $sql = "SELECT * FROM patrimonio WHERE bmp LIKE ? OR nomenclatura LIKE ? OR classe LIKE ? ORDER BY id";
        $searchTerm = "%{$term}%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm]);
    }
    
    public function getByClasse($classe) {
        $sql = "SELECT * FROM patrimonio WHERE classe = ? ORDER BY id";
        return $this->db->fetchAll($sql, [$classe]);
    }
    
    public function getTotalValue() {
        $sql = "SELECT SUM(preco_total) as total FROM patrimonio";
        $result = $this->db->fetch($sql);
        return $result['total'] ?? 0;
    }
    
    public function getClasses() {
        $sql = "SELECT DISTINCT classe FROM patrimonio WHERE classe IS NOT NULL ORDER BY classe";
        return $this->db->fetchAll($sql);
    }
    
    public function getEstadosMaterial() {
        $sql = "SELECT DISTINCT estado_material FROM patrimonio WHERE estado_material IS NOT NULL ORDER BY estado_material";
        return $this->db->fetchAll($sql);
    }
    
    public function getByIds($ids) {
        if (!is_array($ids) || empty($ids)) {
            return [];
        }
        $filtered = array_values(array_filter(array_map(function($v){
            return is_numeric($v) ? (int)$v : null;
        }, $ids), function($v){ return $v !== null; }));
        if (empty($filtered)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($filtered), '?'));
        $sql = "SELECT * FROM patrimonio WHERE id IN ($placeholders) ORDER BY id";
        return $this->db->fetchAll($sql, $filtered);
    }

    public function getPatrimoniosComDano() {
        $sql = "SELECT * FROM patrimonio WHERE dano_sofrido IS NOT NULL AND dano_sofrido != '' ORDER BY id";
        return $this->db->fetchAll($sql);
    }
    
    public function getTotalQuantidade() {
        $sql = "SELECT SUM(quantidade) as total FROM patrimonio";
        $result = $this->db->fetch($sql);
        return $result['total'] ?? 0;
    }
}
