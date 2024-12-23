<?php

class Charity {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    /**
     * Get all charities
     * @return array
     */
    public function getAllCharities() {
        $sql = "SELECT charity_id, charity_name, mission, goal FROM charity";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get total number of charities
     * @return int
     */
    public function getTotalCharities() {
        $sql = "SELECT COUNT(*) as total FROM charity";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
