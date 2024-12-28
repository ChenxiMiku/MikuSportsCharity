<?php

class Charity {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function getAllCharities() {
        $sql = "SELECT charity_id, charity_name FROM charity";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCharities() {
        $sql = "SELECT COUNT(*) as total FROM charity";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getCharityIdByName($name) {
        $sql = "SELECT charity_id FROM charity WHERE charity_name = :name";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['charity_id'];
    }
}
